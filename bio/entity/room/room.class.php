<?
    class Bio_Entity_Room extends Bio_Entity_Room_ {
        public function getHealth(){
            $params = json_decode($this['params'], true);
            return $params['health'] - (time() - $this['dt_created']);
        }
    }

    

