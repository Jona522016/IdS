<?php
class departamentoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_departamento';
		$this->id_tabla = 'id_departamento';
	
		$this->campos['id_departamento'] = 0;
		$this->campos['descripcion'] = '';
		$this->campos['estado_registro'] = 'A';				
		
		
	}
	
}

?>