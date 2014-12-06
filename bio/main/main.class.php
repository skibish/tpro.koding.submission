<?
    class Bio_Main extends Oxygen_Controller {
        
        public $room, $roomParams;
        
        public function __complete(){
            $this->room = Bio_Entity_Room::all()[1];
            $this->roomParams = json_decode($this->room['params'], true);
        }
        
        public function rpc_submitChatText($args) {
            if (isset($args->text)) {
                $broadcast->publish("/messages", array(
                    "text"=>"hi there",
                    "authToken"=>"h8yg7tf6r45ed5rf6gt7y8"
                ));
                return true;
            }
        }
    }