<?
    class Bio_Entity_RoomUser extends Bio_Entity_RoomUser_ {
        public function getMoney()
        {
            $params = json_decode($this['params'], true);
            return $params['money'];
        }
    }

    

