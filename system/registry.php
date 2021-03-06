<?php
/*
	Main Framework System 1.0
	Registry 1.0
*/
class Registry{
	private static $_instancia;
	private $_data;
	
	private function __construct(){}
	
	//Singleton
	public static function getInstancia(){
		if (!self::$_instancia instanceof self){
			self::$_instancia = new Registry();
		}
		return self::$_instancia;
	}
	
	public function __set($name,$value){
		$this->_data[$name] = $value;
	}
	
	public function __get($name){
		if (isset($this->_data[$name])){
			return $this->_data[$name];
		}
		return FALSE;
	}
}
?>