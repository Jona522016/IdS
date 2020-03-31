<?php
class entidadModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_entidad';
		$this->id_tabla = 'id_entidad';
		$this->id_usuario = Session::get('id_usuario');
		$this->id_empresa = Session::get('id_empresa');
		
		$this->campos['id_entidad'] = Session::get('id_usuario');
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['usuario'] = '';
		$this->campos['clave_acceso'] = '';
		$this->campos['telefono'] = '';
		$this->campos['correo'] = '';
		$this->campos['codigo'] = '';
		$this->campos['avatar'] = '';
		$this->campos['estado_registro'] = 'A';						
		
	}
	
	public function crearSqlQuery($parametros) {
		try {
			if ($parametros['operacion']=='combo'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= " from $this->tabla ";
				if (isset($parametros['condicion'])){
					$condicion = rawurldecode($parametros['condicion']);
					$sql .= " where estado_registro='A' and $condicion";
				}else{
					$sql .= " where estado_registro='A'";
				}	
			}			
			if ($parametros['operacion']=='autenticarUsuario'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= ",correo ";
				$sql .= ",id_empresa ";
				$sql .= ",avatar ";
				$sql .= " from $this->tabla ";
				$sql .= " where usuario=:usuario and clave_acceso=:clave_acceso and id_empresa=:id_empresa" ;
			}

			if ($parametros['operacion']=='obtenerDatosUsuario'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id_entidad";
				$sql .= ",descripcion ";
				$sql .= ",usuario ";
				$sql .= ",correo ";
				$sql .= ",telefono ";
				$sql .= ",codigo ";
				$sql .= ",avatar ";
				$sql .= ",estado_registro ";
				$sql .= " from $this->tabla ";
				$sql .= " where id_entidad=:id_entidad and id_empresa=:id_empresa" ;
			}
			
			if ($parametros['operacion']=='verificarUsuario'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= ",correo";
				$sql .= ",codigo " ;
				$sql .= "from $this->tabla ";
				$sql .= "where usuario=:usuario and correo=:correo" ;
			}
			
			if ($parametros['operacion']=='validarClave'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= ",correo";
				$sql .= ",codigo " ;
				$sql .= "from $this->tabla ";
				$sql .= "where clave_acceso=:clave_acceso" ;
			}
			
			$response['status']='ok';
			$response['response']=$sql;
			$response['data']=0;				
			return $response;
		}catch (Exception $e) {
			$error['message']=$e->getMessage();
			$error['code']=$e->getCode();
			$error['file']=$e->getFile();
			$error['line']=$e->getLine();
		 	
		 	Session::set('error',$error);
		 	header("location:" . BASE_URL . "error");
		}
	}


}
?>