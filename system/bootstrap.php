<?php
/*
	Main Framework System 1.0
	Bootstrap 1.0
*/
class Bootstrap{
	public static function run(Request $peticion){
		try{
			$modulo = $peticion->getModule();
			$directorio=$peticion->getDirectorio();
			$controlador = $peticion->getController() . 'Controller';
			$metodo = $peticion->getMethod();
			$argumentos = $peticion->getArgs();
		
			if($modulo){
				$rutaModulo = APP_PATH . $modulo . DS . $modulo . 'Controller.php';
				if (file_exists($rutaModulo)){
					if(is_readable($rutaModulo)){
						require_once $rutaModulo;
					}else{
						throw new Exception('Error de Base de modulo');
					}
				}
				$rutaControlador = APP_PATH . 'modules'. DS . $modulo . DS . $directorio . DS . $controlador . '.php';
				
			}else{
				$rutaControlador = APP_PATH . $directorio . DS . $controlador . '.php';
			}					
					
			if(is_readable($rutaControlador)){
				require_once $rutaControlador;
				$controlador = new $controlador;

				if(!is_callable(array($controlador, $metodo))){
					$metodo = 'index';
				}

				if(isset($argumentos) and count($argumentos)>0){
					call_user_func_array(array($controlador, $metodo), $argumentos);
				}else{
					call_user_func(array($controlador, $metodo));
				}
			}else {
				throw new Exception('Aplicacion no encontrada: '. $rutaControlador);
			}

		} catch (\Exception $e) {
			$error['message']=$e->getMessage();
			$error['code']=$e->getCode();
			$error['file']=$e->getFile();
			$error['line']=$e->getLine();
			$response['status']='error';
			$response['message']='Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
			$response['data']=$error;
		 	echo json_encode($response);
		}
	}
}
?>