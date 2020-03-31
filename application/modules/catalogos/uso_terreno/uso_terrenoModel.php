<?php
class uso_terrenoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_uso_terreno';
		$this->id_tabla = 'id_uso_terreno';
		
		$this->campos['id_uso_terreno'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';						
	}
	
}

?>