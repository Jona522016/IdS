<?php
class proveedorModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_proveedor';
		$this->id_tabla = 'id_proveedor';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');		
		$this->campos['id_sucursal'] = Session::get('id_sucursal');
		$this->campos['descripcion'] = '';
		$this->campos['telefono'] = '';
		$this->campos['correo'] = '';
		$this->campos['observaciones'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>