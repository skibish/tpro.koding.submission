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
        }

        public function configure($x) {
            $x['auth']->Bio_Auth();
            $x['main']->Bio_Main();
        }

        public function __toString() {
            return 'BioSphere';
        }
    }