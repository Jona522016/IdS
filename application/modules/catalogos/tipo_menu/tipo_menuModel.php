<?php
class tipo_menuModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_tipo_menu';
		$this->id_tabla = 'id_tipo_menu';
		$this->campos=array(
			'id_tipo_menu'=>array('valor'=>0,'tipo'=>'integer')
			,'descripcion'=>array('valor'=>'','tipo'=>'integer','largo'=>45)
			,'clave'=>''
			,'estado_registro'=>'A'
		);
	}
	
	public function validar_datos($datos,$oper=false){
		$this->campos['id_tipo_menu']=$datos['id_tipo_menu'];
		$this->campos['descripcion']=$datos['descripcion'];
		$this->campos['clave']=strtoupper($datos['clave']);
		$this->campos['estado_registro']=strtoupper($datos['estado_registro']);
		
		if($this->campos['id_tipo_menu']<=0 || $this->campos['id_tipo_menu']=''){
			$this->errorData['message']='El valor de "id_tipo_menu" es menor o igual a cero';
			$this->errorData['status']='error';
		}
		if(strlen($this->campos['descripcion'])>45){
			$this->errorData['message']='El largo de "descripcion" es mayor a 45';
			$this->errorData['status']='error';
		}
		if(strlen($this->campos['clave'])>30){
			$this->errorData['message']='El largo de "clave" es mayor a 30';
			$this->errorData['status']='error';
		}
		
		
	}
}
?>
