<?php
class clienteModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'cli_cliente';
		$this->id_tabla = 'id_cliente';
		
		$this->campos['id_cliente'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['direccion'] = '';
		$this->campos['telefono'] = '';
		$this->campos['correo'] = '';
		$this->campos['estado_registro'] = 'A';		
		
	}
	
}

?>