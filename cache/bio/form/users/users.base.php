<?
    class Bio_Form_Users_ extends Oxygen_Common_Forms {
        public function __construct($model = '*') {
            if($model === '*') {
                $model = Bio_Entity_User::all();
            }
            parent::__construct($model);
        }

        public function getListFields() {
            return $model = Bio_Entity_User::__getFields();
        }

        public function __toString() {
            //return 'Users';
            return $this->_("users");
        }

        public function getIcon() {
            return 'plugin';
        }

        public function configure($x) {
            $x['{user_id:int}']->Bio_Form_User($this->getModel());
        }
    }