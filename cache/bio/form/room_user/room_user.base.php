<?
    class Bio_Form_RoomUser_ extends Oxygen_Common_Form {
        public function configure($x) {
                            // Nothing to configure for room_user_id Oxygen_Field_Integer                
                            // Nothing to configure for room_id Oxygen_Field_Integer                
                            // Nothing to configure for user_id Oxygen_Field_Integer                
                            // Nothing to configure for params Oxygen_Field_String                
                            $x['user']->Bio_Form_User($this->model->getUser());                
                            $x['room']->Bio_Form_Room($this->model->getRoom());                
                    }

    }