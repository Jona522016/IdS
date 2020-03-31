<?php
class grupoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_grupo';
		$this->id_tabla = 'id_grupo';

		$this->campos['id_equipo'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['estado_registro'] = 'A';				
				
		
	}

}
?>