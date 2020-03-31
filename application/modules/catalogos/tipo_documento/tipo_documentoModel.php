<?php
class tipo_documentoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'inv_tipo_documento';
		$this->id_tabla = 'id_tipo_documento';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
		
	}
	
}

?>