<?php
class asignacion_menu_entidadModel extends Model{
	
	public function __construct() {
		parent::__construct();
		$this->tabla = "sys_asignacion_menu_entidad";
		$this->id_tabla = "id_asignacion_menu_entidad";
		
		$this->campos['id_asignacion_menu_entidad'] = 0;
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['id_entidad'] = '';
		$this->campos['id_menu'] = '';
		
	}
	
	public function crearSqlQuery($parametros) {
		try {
			if($parametros['operacion'] == 'delreg') {
				$empresa = $this->id_empresa;
				$sql     = "delete from $this->tabla where id_entidad=:id_entidad and id_empresa=$empresa";
			}
			if($parametros['operacion'] == 'obtener_datos') {
				$empresa = $this->id_empresa;
				$sql     = "select * from $this->tabla where id_entidad=:id_entidad and id_empresa=$empresa";
			}			
			$response['status'] = 'ok';
			$response['response'] = $sql;
			$response['data'] = 0;
			return $response;
		}catch(Exception $e) {
			$response['estado'] = 'error';
			$response['mensaje'] = "Ocurrio el Error: ".$e->getMessage(). " en el Archivo ".$e->getFile()." en la clase ".get_class($e)." Linea: ".$e->getLine();
		}
	}	
	

	
}
?>