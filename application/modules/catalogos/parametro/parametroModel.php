<?php
class parametroModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_parametro';
		$this->id_tabla = 'id_parametro';
		
		$this->campos['id_parametro'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['valor'] = '';
		$this->campos['id_tipo_parametro'] = '';
		$this->campos['estado_registro'] = 'A';		
		
	}
	
}
