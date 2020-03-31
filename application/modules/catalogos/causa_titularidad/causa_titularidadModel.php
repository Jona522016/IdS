<?php
class causa_titularidadModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_causa_titularidad';
		$this->id_tabla = 'id_causa_titularidad';
		
		$this->campos['id_causa_titularidad'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';		
		
	}
	
}

?>