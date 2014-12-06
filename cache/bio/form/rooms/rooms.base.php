<?
    class Bio_Form_Rooms_ extends Oxygen_Common_Forms {
        public function __construct($model = '*') {
            if($model === '*') {
                $model = Bio_Entity_Room::all();
            }
            parent::__construct($model);
        }

        public function getListFields() {
            return $model = Bio_Entity_Room::__getFields();
        }

        public function __toString() {
            //return 'Rooms';
            return $this->_("rooms");
        }

        public function getIcon() {
            return 'plugin';
        }

        public function configure($x) {
            $x['{room_id:int}']->Bio_Form_Room($this->getModel());
        }
    }