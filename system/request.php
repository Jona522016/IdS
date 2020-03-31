<?php
/*
	Main Framework System 1.0
	Request 1.0
*/
class Request{
	private $_modulo;
	private $_controlador;
	private $_metodo;
	private $_argumentos;
	private $_url;
	private static $registry;
	private static $routing;
	public  static $modulos;	

	public function __construct($autenticado){
		self::$registry = Registry::getInstancia();
		self::$routing = self::$registry->routing;
		$request=array();
		$url='';
		if(isset($_GET['url'])){
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			if(!$autenticado){			
				$var=strpos($url,'autenticarUsuario');
				if(strpos($url,'autenticarUsuario')===false){
					$url='';
				}
			}			
		}
		$this->getRequest($url);
	}
	
	public function getRequest($url_original){
		$request=array();
		$modulos=scandir(APP_PATH . 'modules');
		$url=array();
		
		$this->_url = $url_original;

		$request = self::$routing->getRoute($this->_url);

		if($request){
			$this->_modulo = $request['modulo'];
			$this->_controlador = $request['controlador'];
			$this->_metodo = $request['metodo'];
			$this->_argumentos = $request['parametros'];
		}else{
			$url = explode('/', $url_original);
			$url = array_filter($url);
			$this->_modulo  = strtolower(array_shift($url));
			if(!$this->_modulo){
				$this->_modulo = FALSE;
			}else{
				if(count($modulos)){
					if(!in_array($this->_modulo,$modulos)){
						$this->_controlador = $this->_modulo;
						$this->_modulo = FALSE;
					}else{
						$this->_controlador = strtolower(array_shift($url));
						if(!$this->_controlador){
							$this->_controlador = 'index';
						}						
					}
				}else{
					$this->_controlador = $this->_modulo;
					$this->_modulo = FALSE;
				}
			}
			$this->_metodo = strtolower(array_shift($url));
			$this->_argumentos = $url;
		}

		if(!$this->_controlador){
			$this->_controlador = DEFAULT_CONTROLLER;
		}
		
		if(!$this->_metodo){
			$this->_metodo = 'index';
		}
		
		if(!isset($this->_argumentos)){
			$this->_argumentos = array();
		}
	}
	
	public function geturl(){
		return $this->_url;
	}
	
	public function getDirectorio(){
		return $this->_controlador;
	}	

	public function getModule(){
		return $this->_modulo;
	}

	public function getController(){
		return $this->_controlador;
	}

	public function getMethod(){
		return $this->_metodo;
	}

	public function getArgs(){
		return $this->_argumentos;
	}
}
?>