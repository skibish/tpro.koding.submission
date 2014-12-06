<?
    # WARNING: THIS CLASS HAS BEEN GENERATED !!!
    class Bio_Entity_Room_ extends Oxygen_Entity {

    private static $data_set = null;
    private static $data_source = null;

    public $database = 'biosphere';
    public $table = 'room';

    public static $field_room_id = null;
    public static $field_params = null;
    public static $field_dt_created = null;
    public static $field_status = null;
    public static $field_users = null;

    private static $fields = array();
    public static function __getFields() {
        return self::$fields;
    }

    public function __getPattern() {
        return '{room_id:int}';
    }

    public function __getPrimaryKey($pattern = false) {
        if($pattern === false){
            return 'room_id';
        }else{
        
            return '{room_id:int}';
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
        self::$data_set = $scope->connection['biosphere/room'];
        self::$data_set->scope->register('Row','Bio_Entity_Room');
                self::$data_source = self::$data_set->getData('_');
            
        self::$fields['room_id'] = self::$field_room_id = $scope->Oxygen_Field_Integer(
            'Room','room_id',
             array (
              'type' => 'integer',
              'readonly' => true,
            )  
        );
    
        self::$fields['params'] = self::$field_params = $scope->Oxygen_Field_String(
            'Room','params',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
    
        self::$fields['dt_created'] = self::$field_dt_created = $scope->Oxygen_Field_Unixtime(
            'Room','dt_created',
             array (
              'type' => 'unixtime',
              'readonly' => false,
            )  
        );
    
        self::$fields['status'] = self::$field_status = $scope->Oxygen_Field_Integer(
            'Room','status',
             array (
              'type' => 'integer',
              'readonly' => false,
            )  
        );
    
        self::$fields['users'] = self::$field_users = $scope->Oxygen_Field_Collection(
            'Room','users',
             array (
              'type' => 'collection',
              'readonly' => true,
              'data' => 
              array (
                'room_id' => 'room_id',
              ),
              'entity-class' => 'Bio_Entity_RoomUser',
            )  
        );
      
        self::extendedConstructor();  
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

        public function putDtCreated($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_dt_created[$this]);
        	self::$field_dt_created->put_($tpl, $args);
        }  

        public function _getDtCreated($tpl='short', $args=array()) {
            array_unshift($args, self::$field_dt_created[$this]);
            return self::$field_dt_created->get_($tpl, $args);
        } 

        public function extDtCreated($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['dt_created']);
        	return self::$field_dt_created->get_('extended_field', $args);
        }        

        public function getDtCreated() {
            return self::$field_dt_created[$this];
        }


        public function setDtCreated($dt_created) {
            self::$field_dt_created[$this] = $dt_created;
        }

        public function putStatus($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_status[$this]);
        	self::$field_status->put_($tpl, $args);
        }  

        public function _getStatus($tpl='short', $args=array()) {
            array_unshift($args, self::$field_status[$this]);
            return self::$field_status->get_($tpl, $args);
        } 

        public function extStatus($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['status']);
        	return self::$field_status->get_('extended_field', $args);
        }        

        public function getStatus() {
            return self::$field_status[$this];
        }


        public function setStatus($status) {
            self::$field_status[$this] = $status;
        }

        public function putUsers($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_users[$this]);
        	self::$field_users->put_($tpl, $args);
        }  

        public function _getUsers($tpl='short', $args=array()) {
            array_unshift($args, self::$field_users[$this]);
            return self::$field_users->get_($tpl, $args);
        } 

        public function extUsers($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['users']);
        	return self::$field_users->get_('extended_field', $args);
        }        

        public function getUsers() {
            return self::$field_users[$this];
        }


    }

    

