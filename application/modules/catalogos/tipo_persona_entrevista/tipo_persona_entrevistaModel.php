<?php
class tipo_persona_entrevistaModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_tipo_persona_entrevista';
		$this->id_tabla = 'id_tipo_persona_entrevista';
		
		$this->campos['id_tipo_persona_entrevista'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['estado_registro'] = 'A';		
		
	}
	
}

?>