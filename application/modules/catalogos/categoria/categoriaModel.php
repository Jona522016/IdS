<?php
class categoriaModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_categoria';
		$this->id_tabla = 'id_categoria';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>