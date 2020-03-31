<?php
class documento_titularidadModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_documento_titularidad';
		$this->id_tabla = 'id_documento_titularidad';
		
		$this->campos['id_documento_titularidad'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';		
		
	}
	
	
}

?>
