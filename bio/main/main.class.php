<?
    class Bio_Main extends Oxygen_Controller {
        public function __complete(){
            $this->room = Bio_Entity_Room::all()[1];
            $this->roomParams = json_decode($this->room['params'], true);
        }
    }