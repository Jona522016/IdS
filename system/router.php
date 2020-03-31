<?php
/*
	Main Framework System 1.0
	Router 1.0
*/
class Router {
	private $registry;
	private $conexion;
	public static $routes;
	
	public function __construct() {
		$this->registry = Registry::getInstancia();
		$this->conexion  = $this->registry->cnMySQL;
		try{
			$sql="select url,modulo,controlador,metodo,parametros from sys_routes";
			$pdo = $this->conexion->prepare($sql);
			$resp  = $pdo->execute();
			$error = $pdo->errorInfo();
			$reg = $pdo->rowCount();
			if ($error[0]=='00000'){
				$registros = $pdo->fetchall(PDO::FETCH_ASSOC);
				self::$routes=$registros;
			}else{
				if($error[2]==NULL){
					$response['status']='error';
					$response['message']='No se devolvieron datos.';
				}else{
					$response['status']='error';
					$response['message']=$error[2];
				}
			}
			$pdo=null;
		}catch(Exception $e){				
			$response['status']='error';
			$response['message']='Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
		}
	}
	
	public function getRoute($url){
		$key = array_search($url, array_column(self::$routes, 'url'));
		if($key!==false){
			$registro=self::$routes[$key];
		}else{
			$registro=false;
		}
		return $registro ;
	}

}

?>