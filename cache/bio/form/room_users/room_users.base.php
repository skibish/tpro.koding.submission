<?
    class Bio_Form_RoomUsers_ extends Oxygen_Common_Forms {
        public function __construct($model = '*') {
            if($model === '*') {
                $model = Bio_Entity_RoomUser::all();
            }
            parent::__construct($model);
        }

        public function getListFields() {
            return $model = Bio_Entity_RoomUser::__getFields();
        }

        public function __toString() {
            //return 'Room Users';
            return $this->_("room_users");
        }

        public function getIcon() {
            return 'plugin';
        }

        public function configure($x) {
            $x['{room_user_id:int}']->Bio_Form_RoomUser($this->getModel());
        }
    }