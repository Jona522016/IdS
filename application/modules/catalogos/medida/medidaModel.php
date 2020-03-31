<?php
class medidaModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_medida';
		$this->id_tabla = 'id_medida';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>