<?
    class Bio extends Oxygen_Common_Application {
        public $company, $auth;
        
        public function initDb(){
            $this->scope->loader->scope->connection = $this->scope->Oxygen_SQL_Connection_Mysql(
                include("config/mysql_config.php"), 
                true
            );
        }
        
        public function initAuthenticator(){
            $this->scope->register('Authenticator','Bio_Auth');
            $this->auth = $this->scope->__authenticated();
        }
        
        public function init(){
            //$this->scope->logger = $this->scope->Oxygen_Logger();
            $this->initDb();
            $this->configureLanguages("Oxygen_Language_DB", array(
                'db' => 'biosphere',
                'table' => 'language'
            ));
            $this->initAuthenticator();
            $this->user = $this->scope->user = $this->scope->auth->getCurrentUser();
            $this->scope->ROOT_URI = $this->go();
        }

        public function __complete() {
            $this->scope->SESSION['lang'] = 'en';
            $this->init();
            $this->scope->app = $this;
            $this->company = 'bio.sphere';
            
            $broadcast = new Oxygen_Communication_Broadcast("http://ulow.koding.io:8000/faye");
        }

        public function configure($x) {
            $x['auth']->Bio_Auth();
            if($this->scope->auth->isLogged()){
                $x['main']->Bio_Main();
            }
            $x['{x:any}']->Bio_Auth();
        }

        public function __toString() {
            return 'BioSphere';
        }
    }