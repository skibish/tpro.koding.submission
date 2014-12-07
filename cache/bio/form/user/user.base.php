<?
    class Bio_Form_User_ extends Oxygen_Common_Form {
        public function configure($x) {
                            // Nothing to configure for user_id Oxygen_Field_Integer                
                            // Nothing to configure for login Oxygen_Field_String                
                            // Nothing to configure for password Oxygen_Field_String                
                            // Nothing to configure for hash Oxygen_Field_String                
                            // Nothing to configure for roles Oxygen_Field_Set                
                            // Nothing to configure for email Oxygen_Field_String                
                            $x['rooms']->Bio_Form_RoomUsers($this->model->getRooms());
                
                    }

    }