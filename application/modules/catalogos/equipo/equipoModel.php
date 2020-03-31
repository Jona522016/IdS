<?php
class equipoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_equipo';
		$this->id_tabla = 'id_equipo';
	
		$this->campos['id_equipo'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';				
		
	}

}

?>