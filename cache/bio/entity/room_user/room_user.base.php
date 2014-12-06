<?
    # WARNING: THIS CLASS HAS BEEN GENERATED !!!
    class Bio_Entity_RoomUser_ extends Oxygen_Entity {

    private static $data_set = null;
    private static $data_source = null;

    public $database = 'biosphere';
    public $table = 'room_user';

    public static $field_room_user_id = null;
    public static $field_room_id = null;
    public static $field_user_id = null;
    public static $field_params = null;

    private static $fields = array();
    public static function __getFields() {
        return self::$fields;
    }

    public function __getPattern() {
        return '{room_user_id:int}';
    }

    public function __getPrimaryKey($pattern = false) {
        if($pattern === false){
            return 'room_user_id';
        }else{
        
            return '{room_user_id:int}';
        }
    
    }

    public function __getField($name) {
        return self::$fields[$name];
    }

    public static function all() {
        return self::$data_source;
    }

    public function __toString() {
                        return 'Room #'.(($x = $this->getRoomId()) === "" ? "not-set" : $x).'';
    }

    public static function extendedConstructor(){
        // meant to add extra fields (non-database-based) in entity
    }

    public static function __class_construct($scope) {
        self::$data_set = $scope->connection['biosphere/room_user'];
        self::$data_set->scope->register('Row','Bio_Entity_RoomUser');
                self::$data_source = self::$data_set->getData('_');
            
        self::$fields['room_user_id'] = self::$field_room_user_id = $scope->Oxygen_Field_Integer(
            'RoomUser','room_user_id',
             array (
              'type' => 'integer',
              'readonly' => true,
            )  
        );
    
        self::$fields['room_id'] = self::$field_room_id = $scope->Oxygen_Field_Integer(
            'RoomUser','room_id',
             array (
              'type' => 'integer',
              'readonly' => false,
            )  
        );
    
        self::$fields['user_id'] = self::$field_user_id = $scope->Oxygen_Field_Integer(
            'RoomUser','user_id',
             array (
              'type' => 'integer',
              'readonly' => false,
            )  
        );
    
        self::$fields['params'] = self::$field_params = $scope->Oxygen_Field_String(
            'RoomUser','params',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
      
        self::extendedConstructor();  
    }


        public function putRoomUserId($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_room_user_id[$this]);
        	self::$field_room_user_id->put_($tpl, $args);
        }  

        public function _getRoomUserId($tpl='short', $args=array()) {
            array_unshift($args, self::$field_room_user_id[$this]);
            return self::$field_room_user_id->get_($tpl, $args);
        } 

        public function extRoomUserId($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['room_user_id']);
        	return self::$field_room_user_id->get_('extended_field', $args);
        }        

        public function getRoomUserId() {
            return self::$field_room_user_id[$this];
        }

        public function putRoomId($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_room_id[$this]);
        	self::$field_room_id->put_($tpl, $args);
        }  

        public function _getRoomId($tpl='short', $args=array()) {
            array_unshift($args, self::$field_room_id[$this]);
            return self::$field_room_id->get_($tpl, $args);
        } 

        public function extRoomId($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['room_id']);
        	return self::$field_room_id->get_('extended_field', $args);
        }        

        public function getRoomId() {
            return self::$field_room_id[$this];
        }


        public function setRoomId($room_id) {
            self::$field_room_id[$this] = $room_id;
        }

        public function putUserId($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_user_id[$this]);
        	self::$field_user_id->put_($tpl, $args);
        }  

        public function _getUserId($tpl='short', $args=array()) {
            array_unshift($args, self::$field_user_id[$this]);
            return self::$field_user_id->get_($tpl, $args);
        } 

        public function extUserId($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['user_id']);
        	return self::$field_user_id->get_('extended_field', $args);
        }        

        public function getUserId() {
            return self::$field_user_id[$this];
        }


        public function setUserId($user_id) {
            self::$field_user_id[$this] = $user_id;
        }

        public function putParams($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_params[$this]);
        	self::$field_params->put_($tpl, $args);
        }  

        public function _getParams($tpl='short', $args=array()) {
            array_unshift($args, self::$field_params[$this]);
            return self::$field_params->get_($tpl, $args);
        } 

        public function extParams($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['params']);
        	return self::$field_params->get_('extended_field', $args);
        }        

        public function getParams() {
            return self::$field_params[$this];
        }


        public function setParams($params) {
            self::$field_params[$this] = $params;
        }


    }

    

