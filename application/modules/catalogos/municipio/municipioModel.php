<?php
class municipioModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_municipio';
		$this->id_tabla = 'id_municipio';
		
		$this->campos['id_municipio'] = 0;
		$this->campos['descripcion'] = '';
		$this->campos['id_departamento'] = '';
		$this->campos['estado_registro'] = 'A';				
				
	}

	public function crearSqlQuery($parametros){
		$response=array();
		try{
			if ($parametros['operacion']=='combo'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= ",id_departamento as tipo ";
				$sql .= " from $this->tabla ";
				if (isset($parametros['condicion'])){
					$condicion = rawurldecode($parametros['condicion']);					
					$sql .= " where estado_registro='A' and $condicion";
				}else{
					$sql .= " where estado_registro='A'";
				}	
				$sql .= " order by descripcion";
			}
			
			$response['status']='ok';
			$response['response']=$sql;
			$response['data']=0;						
		}catch(Exception $e){
			$response['status']='error';
			$response['message']='Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
			$response['data']=0;			
		}	
		return $response;	
	}

}
?>