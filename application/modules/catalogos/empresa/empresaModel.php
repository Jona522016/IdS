<?php
class empresaModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_empresa';
		$this->id_tabla = 'id_empresa';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
		$this->campos['logo'] = '';
		$this->campos['logo_encabezado'] = '';
		$this->campos['estado_registro'] = 'A';				
	}
	
	

	public function crearSqlQuery($parametros){
		$response=array();
		try{
			if ($parametros['operacion']=='combo'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= ",logo ";
				$sql .= ",logo_encabezado ";
				$sql .= " from $this->tabla ";
				if(isset($parametros['condicion'])){
					$condicion = rawurldecode($parametros['condicion']);
					$sql .= " where estado_registro='A' and $condicion";
				}else{
					$sql .= " where estado_registro='A'";
				}	
			}
			
			if ($parametros['operacion']=='obtenerDatosEmpresa'){
				$sql  = "select ";
				$sql .= "id_empresa";
				$sql .= ",descripcion ";
				$sql .= ",logo ";
				$sql .= ",logo_encabezado ";
				$sql .= " from $this->tabla ";
				if(isset($parametros['condicion'])){
					$condicion = rawurldecode($parametros['condicion']);
					$sql .= " where estado_registro='A' and $condicion";
				}else{
					$sql .= " where estado_registro='A' and id_empresa=:id_empresa";
				}	
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