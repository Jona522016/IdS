<?php
class modeloModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_modelo';
		$this->id_tabla = 'id_modelo';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['codigo_modelo'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>