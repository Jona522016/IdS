<?php
class identificador_direccionModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_identificador_direccion';
		$this->id_tabla = 'id_identificador_direccion';
	
		$this->campos['id_identificador_direccion'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';				
	}

	
	
}

?>