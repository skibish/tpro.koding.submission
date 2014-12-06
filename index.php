<?
$debug = false;

try{
    date_default_timezone_set('Europe/Riga');
    define('APC_CACHE_PREFIX', 'Bio::');

    define('CURRENT_ROOT_PATH', dirname(__FILE__));
    
    $scope = include 'oxygen/itself.php'; 
    session_start();
    $scope->strictMode();
    if(isset($_GET['generate']) && $_GET['generate'] == 1){
        $scope->Oxygen_Common_Module()->generateClasses('Bio');
    }else{
        handleHttpRequest($scope,'Bio', false, false);
    }
}catch(Exception $e){
    echo $e->getMessage();
}