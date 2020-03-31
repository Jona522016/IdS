<?php
/*
	Main Framework System 1.0
	MainClass 1.0
*/
abstract class MainClass{
	protected $errorData;
	
	public function manejoErrores($e,$prog=false){
		$error['message'] = $e->getMessage();
		$error['code'] = $e->getCode();
		$error['file'] = $e->getFile();
		$error['line'] = $e->getLine();
		$response['status']='error';
		$response['message']='Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
		$response['data']=$error;
		if($prog){
			return $response;
		}else{
			echo json_encode($response);
		}
	}
}
