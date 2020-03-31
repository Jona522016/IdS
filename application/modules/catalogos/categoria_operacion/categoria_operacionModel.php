<?php
class categoria_operacionModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'inv_categoria_operacion';
		$this->id_tabla = 'id_categoria_operacion';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>