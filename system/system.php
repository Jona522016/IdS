<?php
function ErrorHandlerSystem($errno, $errstr, $errfile, $errline){
	switch ($errno){
   case E_WARNING:
		$error['message'] = $errstr;
		$error['code'] = 'E_WARNING';
		$error['file'] = $errfile;
		$error['line'] = $errline;
		$response['status'] = 'error';
		$response['message'] = 'Ocurrio un Warning: '.$errstr.'.  En el Archivo: '.$errfile.' en la línea: '.$errline;
		$response['data']=$error;
		echo json_encode($response);   
		return true;
		break;
	case E_NOTICE:
		$error['message'] = $errstr;
		$error['code'] = 'E_NOTICE';
		$error['file'] = $errfile;
		$error['line'] = $errline;
		$response['status'] = 'error';
		$response['message'] = 'Ocurrio un Warning: '.$errstr.'.  En el Archivo: '.$errfile.' en la línea: '.$errline;
		$response['data']=$error;
		echo json_encode($response);  	
		return true;
		break;
	default:
		return false;
		break;
	}
}
?>