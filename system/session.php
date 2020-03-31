<?php
/*
	Main Framework System 1.0
	Session 1.0
*/
class Session{
	
	public static $tiempo_transcurrido;
	public static $estado=false;
	
	public static function init(){
		session_start();
		if(!isset($_SESSION['autenticado'])){
			$_SESSION['autenticado'] = false;
		}
		if(!isset($_SESSION['id_usuario'])){
			$_SESSION['id_usuario'] = 0;
		}	
		if(!isset($_SESSION['id_empresa'])){
			$_SESSION['id_empresa'] = 0;
		}
		if(!isset($_SESSION['id_sucursal'])){
			$_SESSION['id_sucursal'] = 1;
		}				
	}
    
	public static function destroy($clave = false){
		if($clave){
			if(is_array($clave)){
				for($i = 0; $i < count($clave); $i++){
					if(isset($_SESSION[$clave[$i]])){
						unset($_SESSION[$clave[$i]]);
					}
				}
			}else{
				if(isset($_SESSION[$clave])){
					unset($_SESSION[$clave]);
				}
			}
		}else{
			session_destroy();
		}
	}
    
	public static function set($clave, $valor){
		if(!empty($clave))
			$_SESSION[$clave] = $valor;
	}

	public static function get($clave){
		if(isset($_SESSION[$clave])){
			return $_SESSION[$clave];
		}
			
	}
	
	public static function existe($clave){
		if(isset($_SESSION[$clave])){
			return true;
		}else{
			return false;
		}
	}
    
	public static function tiempo(){
		if(!Session::get('tiempo') || !defined('SESSION_TIME')){
			throw new Exception('No se ha definido el tiempo de sesion'); 
		}

		if(SESSION_TIME == 0){
			return;
		}

		if(time() - Session::get('tiempo') > (SESSION_TIME * 60)){
			Session::destroy();
			//header('location:' . BASE_URL);
		}else{
			self::$tiempo_transcurrido=time()-Session::get('tiempo');
			Session::set('tiempo', time());
		}
	}
}

?>