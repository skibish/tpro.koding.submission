<?
    class Bio_Main extends Oxygen_Controller {
       
        public $room, $roomParams;
       
        public function __complete(){
            $this->room = Bio_Entity_Room::all()[1];
            $this->roomParams = json_decode($this->room['params'], true);
            $this->user = $this->scope->auth->getCurrentUser();

            foreach($this->user->getRooms() as $room){ 
                if($room['user_id'] == $this->user->getUserId()){
                    $this->roomUser = $room; 
                    break; 
                }
            }
            $this->userParams = json_decode($this->roomUser['params'], true);

            $this->localParams = array(
                'industry'        => array(
                    'cost' => array(
                        'money' => $this->userParams['industry']*1000
                    ),
                ),
                'taxes'           => array(
                    'cost' => array(
                        'money' => 0
                    ),
                ),
                'applied-science' => array(
                    'cost' => array(
                        'money' => $this->userParams['industry']*1000
                    ),
                ),
                'eco-science'     => array(
                    'cost' => array(
                        'money' => $this->userParams['industry']*1000
                    ),
                ),
                'medicine'        => array(
                    'cost' => array(
                        'money' => $this->userParams['industry']*1000
                    )
                )
            );
            $this->broadcast = new Oxygen_Communication_Broadcast("http://ulow.koding.io:8000/faye");
        }

        public function rpc_getUsers() {
            $users = array();
            foreach ($this->room->getUsers() as $user) {
                $user->getUser();
                $toMerge = json_decode($user['params'],true);
                $merge['users'][] = $toMerge;
            }
            return $merge;
        }

        public function rpc_getWorldData() {
            return $this->roomParams;
        }

        public function rpc_spendHealth($args){
            $this->roomParams['health'] += $args->health;
            $this->room['params'] = json_encode($this->roomParams);
            $this->room->__submit();
 
            $this->broadcast->publish("/world", array(
                "world"=> array("health"=>$args->health),
                "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
            ));
            return true;
        }

        public function rpc_increase($args){
            if(isset($args->param, $this->localParams[$args->param])){
                $amount = 10;
                $this->userParams[$args->param] += $amount;
                foreach($this->localParams[$args->param]['cost'] as $costParam => $value){
                    $this->userParams[$costParam] -= $value;
                }
                $this->roomUser['params'] = json_encode($this->userParams);
                $this->roomUser->__submit();
                $this->broadcast->publish("/world", array(
                    "param"=>$args->param,
                    "amount"=>$amount,
                    "author"=>$this->user['login'],
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
            }
        }

        public function rpc_decrease($args){
            if(isset($args->param, $this->localParams[$args->param])){
                $amount = -10;
                $this->userParams[$args->param] += $amount;
                $this->roomUser['params'] = json_encode($this->userParams);
                $this->roomUser->__submit();
                $this->broadcast->publish("/world", array(
                    "param"=>$args->param,
                    "amount"=>$amount,
                    "author"=>$this->user['login'],
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
            }
        }

        public function rpc_sendMoney($args){
            if(isset($args->receiver, $args->amount) && $args->receiver != $this->user['login']){
                $amount = max(0, (int)$args->amount);

                $receiver = null;
                foreach($this->user->getRooms() as $room){ 
                    if(strtolower($room->getUser()['login']) == strtolower($args->receiver)){
                        $receiver = $room; 
                        break; 
                    }
                }
                if($receiver !== null){
                    //send
                    $this->userParams['money'] -= $amount;
                    $this->roomUser['params'] = json_encode($this->userParams);
                    $this->roomUser->__submit();
                    //receive
                    $receiverParams = json_decode($receiver['params'], true);
                    $receiverParams['money'] += $amount;
                    $receiver['params'] = json_encode($receiverParams);
                    $receiver->__submit();
                }
                
                $this->broadcast->publish("/world", array(
                    "action"=>"send_money",
                    "receiver"=>$args->receiver,
                    "amount"=>$args->amount,
                    "author"=>$this->user['login'],
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
            }
        }
       
        public function rpc_submitChatText($args) {
            if (isset($args->text)) {
                $this->broadcast->publish("/messages", array(
                    "text"=>$args->text,
                    "author"=>$this->user['login'],
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
                return true;
            }
        }
    }