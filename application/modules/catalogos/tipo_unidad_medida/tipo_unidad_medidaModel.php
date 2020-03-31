<?php
class tipo_unidad_medidaModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_tipo_unidad_medida';
		$this->id_tabla = 'id_tipo_unidad_medida';
		
		$this->campos['id_tipo_unidad_medida'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';				
	}
	
}

?>