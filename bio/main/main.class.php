<?
    class Bio_Main extends Oxygen_Controller {
       
        public $room, $roomParams;
       
        public function __complete(){
            $this->room = Bio_Entity_Room::all()[1];
            $this->roomParams = json_decode($this->room['params'], true);
            $this->user = $this->scope->auth->getCurrentUser();
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
 
            $broadcast = new Oxygen_Communication_Broadcast("http://ulow.koding.io:8000/faye");
            $broadcast->publish("/messages", array(
                "world"=> array("health"=>$args->health),
                "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
            ));
            return true;
        }
       
        public function rpc_submitChatText($args) {
            if (isset($args->text)) {
                $broadcast = new Oxygen_Communication_Broadcast("http://ulow.koding.io:8000/faye");
                $broadcast->publish("/messages", array(
                    "text"=>$args->text,
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
                return true;
            }
        }
    }