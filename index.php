<?php
/**
* Main Program 1.0
*/
error_reporting(E_ALL);
ini_set('display_errors', 1);
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', ROOT . 'application' . DS);
define('SYS_PATH', ROOT . 'system' . DS);


try {
	require_once SYS_PATH . 'system.php';
	set_error_handler("ErrorHandlerSystem", E_WARNING);
	set_error_handler("ErrorHandlerSystem", E_NOTICE);	
	require_once SYS_PATH . 'autoload.php';
	require_once SYS_PATH . 'config.php';

	Session::init();

	$registry = Registry::getInstancia();

	$templates['admin'] = new adminTemplate();
//	$templates['smarty'] = new smartyTemplate();
	$registry->cnMySQL = new Database(DB_HOST,DB_NAME,DB_USER,DB_PASS,DB_CHAR);
	$registry->routing = new Router();
	$registry->request = new Request(Session::get('autenticado'));
	$registry->templates = $templates;

	//Session::set('autenticado',false);
	if(Session::existe('tiempo')) {
		Session::tiempo();
	}

	Bootstrap::run($registry->request);

}catch(\Exception $e) {
	$error['message'] = $e->getMessage();
	$error['code'] = $e->getCode();
	$error['file'] = $e->getFile();
	$error['line'] = $e->getLine();
	$response['status'] = 'error';
	$response['message'] = 'Ocurrio una Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
	echo json_encode($response);
}catch(\ErrorException $e) {
	$error['message'] = $e->getMessage();
	$error['code'] = $e->getCode();
	$error['file'] = $e->getFile();
	$error['line'] = $e->getLine();
	$response['status'] = 'error';
	$response['message'] = 'Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
	echo json_encode($response);
}
//restore_error_handler();
