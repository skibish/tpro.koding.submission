<?
    # WARNING: THIS CLASS HAS BEEN GENERATED !!!
    class Bio_Entity_User_ extends Oxygen_Entity {

    private static $data_set = null;
    private static $data_source = null;

    public $database = 'biosphere';
    public $table = 'user';

    public static $field_user_id = null;
    public static $field_login = null;
    public static $field_password = null;
    public static $field_hash = null;
    public static $field_roles = null;
    public static $field_email = null;
    public static $field_room_user = null;

    private static $fields = array();
    public static function __getFields() {
        return self::$fields;
    }

    public function __getPattern() {
        return '{user_id:int}';
    }

    public function __getPrimaryKey($pattern = false) {
        if($pattern === false){
            return 'user_id';
        }else{
        
            return '{user_id:int}';
        }
    
    }

    public function __getField($name) {
        return self::$fields[$name];
    }

    public static function all() {
        return self::$data_source;
    }

    public function __toString() {
                        return ''.(($x = $this->getLogin()) === "" ? "not-set" : $x).'';
    }

    public static function extendedConstructor(){
        // meant to add extra fields (non-database-based) in entity
    }

    public static function __class_construct($scope) {
        self::$data_set = $scope->connection['biosphere/user'];
        self::$data_set->scope->register('Row','Bio_Entity_User');
                self::$data_source = self::$data_set->getData('_');
            
        self::$fields['user_id'] = self::$field_user_id = $scope->Oxygen_Field_Integer(
            'User','user_id',
             array (
              'type' => 'integer',
              'readonly' => true,
            )  
        );
    
        self::$fields['login'] = self::$field_login = $scope->Oxygen_Field_String(
            'User','login',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
    
        self::$fields['password'] = self::$field_password = $scope->Oxygen_Field_String(
            'User','password',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
    
        self::$fields['hash'] = self::$field_hash = $scope->Oxygen_Field_String(
            'User','hash',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
    
        self::$fields['roles'] = self::$field_roles = $scope->Oxygen_Field_Set(
            'User','roles',
             array (
              'type' => 'set',
              'readonly' => false,
            )  
        );
    
        self::$fields['email'] = self::$field_email = $scope->Oxygen_Field_String(
            'User','email',
             array (
              'type' => 'string',
              'readonly' => false,
            )  
        );
    
        self::$fields['room_user'] = self::$field_room_user = $scope->Oxygen_Field_Object(
            'User','room_user',
             array (
              'type' => 'object',
              'readonly' => false,
              'data' => 
              array (
                'user_id' => 'user_id',
              ),
              'entity-class' => 'Bio_Entity_RoomUser',
            )  
        );
      
        self::extendedConstructor();  
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

        public function putLogin($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_login[$this]);
        	self::$field_login->put_($tpl, $args);
        }  

        public function _getLogin($tpl='short', $args=array()) {
            array_unshift($args, self::$field_login[$this]);
            return self::$field_login->get_($tpl, $args);
        } 

        public function extLogin($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['login']);
        	return self::$field_login->get_('extended_field', $args);
        }        

        public function getLogin() {
            return self::$field_login[$this];
        }


        public function setLogin($login) {
            self::$field_login[$this] = $login;
        }

        public function putPassword($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_password[$this]);
        	self::$field_password->put_($tpl, $args);
        }  

        public function _getPassword($tpl='short', $args=array()) {
            array_unshift($args, self::$field_password[$this]);
            return self::$field_password->get_($tpl, $args);
        } 

        public function extPassword($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['password']);
        	return self::$field_password->get_('extended_field', $args);
        }        

        public function getPassword() {
            return self::$field_password[$this];
        }


        public function setPassword($password) {
            self::$field_password[$this] = $password;
        }

        public function putHash($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_hash[$this]);
        	self::$field_hash->put_($tpl, $args);
        }  

        public function _getHash($tpl='short', $args=array()) {
            array_unshift($args, self::$field_hash[$this]);
            return self::$field_hash->get_($tpl, $args);
        } 

        public function extHash($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['hash']);
        	return self::$field_hash->get_('extended_field', $args);
        }        

        public function getHash() {
            return self::$field_hash[$this];
        }


        public function setHash($hash) {
            self::$field_hash[$this] = $hash;
        }

        public function putRoles($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_roles[$this]);
        	self::$field_roles->put_($tpl, $args);
        }  

        public function _getRoles($tpl='short', $args=array()) {
            array_unshift($args, self::$field_roles[$this]);
            return self::$field_roles->get_($tpl, $args);
        } 

        public function extRoles($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['roles']);
        	return self::$field_roles->get_('extended_field', $args);
        }        

        public function getRoles() {
            return self::$field_roles[$this];
        }


        public function setRoles($roles) {
            self::$field_roles[$this] = $roles;
        }

        public function putEmail($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_email[$this]);
        	self::$field_email->put_($tpl, $args);
        }  

        public function _getEmail($tpl='short', $args=array()) {
            array_unshift($args, self::$field_email[$this]);
            return self::$field_email->get_($tpl, $args);
        } 

        public function extEmail($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['email']);
        	return self::$field_email->get_('extended_field', $args);
        }        

        public function getEmail() {
            return self::$field_email[$this];
        }


        public function setEmail($email) {
            self::$field_email[$this] = $email;
        }

        public function putRoomUser($tpl='short', $args=array()) {
        	array_unshift($args, self::$field_room_user[$this]);
        	self::$field_room_user->put_($tpl, $args);
        }  

        public function _getRoomUser($tpl='short', $args=array()) {
            array_unshift($args, self::$field_room_user[$this]);
            return self::$field_room_user->get_($tpl, $args);
        } 

        public function extRoomUser($args=array()) {
            if(!is_array($args)){
                $args = (array)$args;
            }
        	array_unshift($args, $this['room_user']);
        	return self::$field_room_user->get_('extended_field', $args);
        }        

        public function getRoomUser() {
            return self::$field_room_user[$this];
        }


        public function setRoomUser($room_user) {
            self::$field_room_user[$this] = $room_user;
        }


    }

    

