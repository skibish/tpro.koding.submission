<?

    class Bio_Auth extends Oxygen_Common_Auth {

        private $users = null;
        private $user = null;
        
        public function __complete(){
            parent::__complete();
            $this->users = Bio_Entity_User::all();
        }

        public function handlePost(){
            $this->authenticate($this->scope->POST);
            if($this->getCurrentUser() === null){
                return redirectResponse('/');
            }else{
                return redirectResponse('/main');
            }
        }
        
        public function authenticate($data) {
            $this->signOut();
            $login = $this->login = $data['login'];
            $password = $data['password'];
            
            $this->user = $this->getUser($login, $password);
            
            if($this->user!==null) {
                $user_id = $this->user_id = $this->user->getUserId();
            
                $roles = $this->roles = $this->user->getRoles();
                $role = $this->role = $roles[0];
                
                //$this->message = $this->_("auth_as"). ' ' . $role;
                $this->message = 'Logged in';
            } else {
                //$this->message = $this->_("try_again");
                $this->message = "try_again";
            }
            return $this->message;
        }

        public function getCurrentUser($force = false) {
            $this->user = $this->getUserById($this->user_id);
            return $this->user;
        }

        public function getUser($login, $password) {
            foreach($this->users->where("(login='".addslashes($login)."' or email='".addslashes($login)."')")->where(array('password'=>md5($password))) as $user){
                return $user;
            }
            return null;
        }

        public function getUserById($id) {
            foreach($this->users->where(array('user_id'=>$id)) as $user){
                return $user;
            }
            return null;
        } 

        public function getRoles() {
            return $this->user->getRoles();
        }
    }