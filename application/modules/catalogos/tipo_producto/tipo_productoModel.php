<?php
class tipo_productoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_tipo_producto';
		$this->id_tabla = 'id_tipo_producto';
		
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>