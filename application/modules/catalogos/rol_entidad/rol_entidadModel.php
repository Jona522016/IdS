<?php
class rol_entidadModel extends Model{
	
	public function __construct() {
		parent::__construct();
		$this->tabla = "sys_rol_entidad";
		$this->id_tabla = "id_rol_entidad";
		
		$this->campos['id_rol_entidad'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';					
	}

}
?>