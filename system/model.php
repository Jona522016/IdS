<?php
/*
	Main Framework System 1.0
	Model 1.0
*/
interface validarDatos
{
    public function validar_datos($parametros);
}

class Model extends MainClass implements validarDatos{
	private $registry;
	public $id_usuario;
	public $id_empresa;
	public $tabla;
	public $id_tabla;
	public $campos = array();
	
   
	public function __construct() {
		$this->registry = Registry::getInstancia();
		$this->cnMySQL  = $this->registry->cnMySQL;
		if(Session::get('id_usuario')){
			$this->id_usuario = Session::get('id_usuario');
		}else{
			$this->id_usuario = 0;
		}
		if(Session::get('id_empresa')){
			$this->id_empresa = Session::get('id_empresa');
		}else{
			$this->id_empresa = 0;
		}
	}

	public function validar_datos($parametros){
		try{
			$response=array();
			$response['status']='ok';			
			$response['message']='';
			$campos=array();
			if(isset($parametros['datos'])){
				if($parametros['operacion']=='add' || $parametros['operacion']=='edit' ){
					foreach($parametros['datos'] as $key => $value){
						if(array_key_exists($key,$this->campos)){
							if(!empty($value)){
								$this->campos[$key]=$value;
							}
						}
		 			}
		 			$campos=$this->campos;
		 			if($parametros['operacion']=='add' || $parametros['operacion']=='edit'){
						unset($campos[$this->id_tabla]);
					}
				}else{
					foreach($parametros['datos'] as $key => $value){
						if(array_key_exists($key,$this->campos)){
							$campos[$key]=$value;
						}
		 			}
				}	
				foreach($campos as $key => $value){
					if($response['status']=='error'){
						return $response;
					}else{
						switch($key){
							default:
								break;
						}
					}
				}	 	
				if($response['status']=='error'){
					$response['data']=array();
				}else{
					$response['data']=$campos;
				}						
			}else{
				$response['data']=array();
			}
		}catch (\Error $e) {
			$response=$this->manejoErrores($e,TRUE);
		}catch (\Exception $e) {
			$response=$this->manejoErrores($e,TRUE);
		}
		return $response;			
	}	
	
	public function crearSqlQuery($parametros){
		$response=array();
		try{
			if ($parametros['operacion']=='combo'){
				$sql  = "select ";
				$sql .= "$this->id_tabla as id";
				$sql .= ",descripcion ";
				$sql .= " from $this->tabla ";
				if(isset($parametros['condicion'])){
					$condicion = $parametros['condicion'];
					$sql .= " where estado_registro='A' and $condicion";
				}else{
					$sql .= " where estado_registro='A'";
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

	public function ejecutarQuery($parametros){
		try{
			$response=array();			
			$sql = $this->crearSqlQuery($parametros);
			if($sql['status']=='ok'){
				$validar=$this->validar_datos($parametros);
				if($validar['status']=='ok'){
					if(isset($validar['data'])){
						$parametros['datos']=$validar['data'];
					}
					$sth = $this->cnMySQL->prepare($sql['response']);
					if (isset($parametros['prepare'])){
						foreach ($parametros['datos'] as $clave => $valor) {
	              		if(is_int($valor))	
	                    	$param = PDO::PARAM_INT;
	                	elseif(is_bool($valor))
	                    	$param = PDO::PARAM_BOOL;
	                	elseif(is_null($valor))
	                    	$param = PDO::PARAM_NULL;
            			elseif(is_string($valor))
                			$param = PDO::PARAM_STR;
            			else
                			$param = PDO::PARAM_STR;
		            	if($param){
								$sth->bindValue(":$clave",$valor,$param);
							}
						}
					}
					$resp  = $sth->execute();
					$error = $sth->errorInfo();
					$reg =  $sth->rowCount();
					if ($error[0]=='00000'){
						$response['status']='ok';
						$response['rows']=$sth->rowCount();
						switch($parametros['operacion']){
							case 'add':
								$response['message']='Se operó el registro '.$this->cnMySQL->lastInsertId();
								$response['id_row']=$this->cnMySQL->lastInsertId();
								break;
							case 'edit':
								$response['message']='Se modificarón '.$response['rows'].' registros';
								break;
							case 'del':
								$response['message']='Se dieron de baja '.$response['rows'].' registros';
								break;
							case 'delreg':
								$response['message']='Se dieron de baja '.$response['rows'].' registros';
								break;								
							default:
								$response['message']=$response['rows'].' Registros afectados ';
								$registros = $sth->fetchall(PDO::FETCH_ASSOC);
								if($response['rows']==0){
									$response['message']='Consulta sin Datos Retornados';
									$response['data']=array();
								}else{
									$response['data']=$registros;
								}
								break;
						}
					}else{
						if($error[2]==NULL){
							$response['status']='error';
							$response['message']='No se devolvieron datos.';
						}else{
							$response['status']='error';
							$response['message']=$error[2];
						}
					}
				}else{
					$response['status']='error';
					$response['message']=$validar['message'];
				}					
			}else{
				$response['status']='error';
				$response['message']=$sql['message'];
			}
		}catch(Exception $e){	
			$this->manejoErrores($e);			
		}catch(Error $e){	
			$this->manejoErrores($e);			
		}
		
		return $response;		
	}	
	
	public function cudData($parametros){
		try{
			$response=array();
			$validar=$this->validar_datos($parametros);
			if($validar['status']=='ok'){
				$parametros['datos']=$validar['data'];			
				$i=0;
				if ($parametros['operacion']=='add'){
					$sql  = "insert into $this->tabla (";
					foreach ($parametros['datos'] as $clave => $valor){
						if($i==0){
							$sql .= "$clave";
						}else{
							$sql .= ",$clave";
						}	
						$i=1;			
					}				
					$sql .= ") values (";
					$i=0;
					foreach ($parametros['datos'] as $clave => $valor){
						if($i==0){
							$sql .= ":$clave";
						}else{
							$sql .= ",:$clave";
						}	
						$i=1;				
					}		
					$sql .= ")";
				}
				
				if ($parametros['operacion']=='edit'){
					$i=0;
					$sql  = "update $this->tabla set ";
					foreach ($parametros['datos'] as $clave => $valor){
						if($i==0){
							$sql .= "$clave=:$clave";
						}else{
							$sql .= ",$clave=:$clave";
						}
						$i=1;
							
					}								
					$sql .= " where $this->id_tabla = :id";
				}
				
				if ($parametros['operacion']=='del'){
					$sql  = "update $this->tabla set ";
					$sql .= " estado_registro='B'";			
					$sql .= " where $this->id_tabla = :id";
				}
				
				if ($parametros['operacion']=='delreg'){
					$sql  = "delete from $this->tabla ";
					$sql .= " where $this->id_tabla = :id";
				}
				
				$sth = $this->cnMySQL->prepare($sql);
					
				foreach ($parametros['datos'] as $clave => $valor) {
	          		if(is_int($valor))	
	                	$param = PDO::PARAM_INT;
	            	elseif(is_bool($valor))
	                	$param = PDO::PARAM_BOOL;
	            	elseif(is_null($valor))
	                	$param = PDO::PARAM_NULL;
	            	elseif(is_string($valor))
	                	$param = PDO::PARAM_STR;
	            	else
	                	$param = PDO::PARAM_STR;
	            	if($param){
						$sth->bindValue(":$clave",$valor,$param);
					}
				}

				if(isset($parametros['id']) && $parametros['id']>0){
					$sth->bindValue(":id",$parametros['id'],PDO::PARAM_INT);
				}

				$resp  = $sth->execute();
				$error = $sth->errorInfo();
				
				if ($error[0]=='00000'){
					$response['status']='ok';
					$response['rows']=$sth->rowCount();
					switch($parametros['operacion']){
						case 'add':
							$response['id_row']=$this->cnMySQL->lastInsertId();
							$response['message']='Se operó el registro '.$this->cnMySQL->lastInsertId();
						
							break;
						case 'edit':
							$response['message']='Se modificarón '.$response['rows'].' registros';
							break;
						case 'del':
							$response['message']='Se dieron de baja '.$response['rows'].' registros';
							break;
						case 'delreg':
							$response['message']='Se eliminaron '.$response['rows'].' registros';
							break;						
						default:
							$response['message']='Se procesaron '.$response['rows'].' registros';
							$registros = $sth->fetchall(PDO::FETCH_ASSOC);
							if(count($registros)==0){
								$response['message']='Consulta sin Datos Retornados';
								$response['data']=0;
							}else{
								$response['data']=$registros;
							}
							break;
					}
					
				}else{
					if($error[2]==NULL){
						$response['status']='error';
						$response['message']='No se devolvieron datos.';
					}else{
						$response['status']='error';
						$response['message']=$error[2];
					}
				}			
			}else{
				$response=$validar;
			}			
		}catch (\Error $e) {
			$response=$this->manejoErrores($e,true);
		}catch (\Exception $e) {
			$response=$this->manejoErrores($e,true);
		}
		return $response;	
	}	
	
	public function datosJQGrid($param){
		try{
			$response=array();
			$start = $param['limit']*$param['page'] - $param['limit']; 
			if ($start<0){
				$start=0;
			}
			if ($param['orden']){
				$ordenar = "order by ".$param['orden'];
			}else{
				$ordenar = "";
			}
			if ($param['condicion']=='X'){
				$filtro = "";
			}else{
				$filtro = "where ".$param['condicion'];
			}			

			$sql1 = "select count(*) as total from ".$param['tabla']." ".$filtro;
			$sql2 = "select * from ".$param['tabla']." $filtro $ordenar limit $start,".$param['limit'];
			
			$stmt = $this->cnMySQL->prepare($sql1);
			
			$resp = $stmt->execute();
			$error = $stmt->errorInfo();	
			$reg1 =  $stmt->rowCount();		
			if ($error[0]==='00000'){
				$total = $stmt->fetchall(PDO::FETCH_ASSOC);
				if($total[0]['total']!=0){
					$stmt = $this->cnMySQL->prepare($sql2);
					$resp = $stmt->execute();
					$error = $stmt->errorInfo();	
					if ($error[0]==='00000'){
						$response['status']='ok';
						$registros = $stmt->fetchall(PDO::FETCH_ASSOC);
						$response['data']['total']=$total[0]['total'];
						$response['data']['registros']=$registros;
						$response['data']['registros_afectados']=$reg1;
					}else{
						if($error[2]==NULL){
							$response['status']='error';
							$response['message']='No se devolvieron datos.';
						}else{
							$response['status']='error';
							$response['message']=$error[2];
						}						
					}
				}else{
					$response['status']='ok';
					$response['message']='Consulta sin Datos Retornados';
					$response['data']['total']=$total[0]['total'];
					$response['data']['registros']=array();
				}
			}else{
				if($error[2]==NULL){
					$response['status']='error';
					$response['message']='No se devolvieron datos.';
				}else{
					$response['status']='error';
					$response['message']=$error[2];
				}
			}			
		}catch(Exception $e){				
			$response['status']='error';
			$response['message']='Ocurrio un Error en la clase '.get_class($e). ': '.$e->getMessage().'.  En el Archivo: '.$e->getFile().' en la línea: '.$e->getLine();
		}
		return $response;	
	}

	public function obtenerDatosComboBox($parametros){
		$response=array();
		try{
			$sql  = "select ";
			$sql .= "$this->id_tabla as id";
			$sql .= ",descripcion ";
			$sql .= " from $this->tabla ";
			if (isset($parametros['condicion'])){
				$sql.=" where ";
				$c=count($parametros['condicion']);
				for($i = 0; $i < $c; $i++){
					if($i==0){
						$sql.= $parametros['condicion'][$i];
					}else{
						$sql.= " and ".$parametros['condicion'][$i];
					}
				}
			}
			$sth = $this->cnMySQL->prepare($sql);
			$getinfo = $sth->execute();
			$error = $sth->errorInfo();
			$response=array();
			
			if ($error[0]=='00000'){
				$response['estado']='ok';
				$registros = $sth->fetchall(PDO::FETCH_ASSOC);
				$response['mensaje']='Consulta ejecutada exitosamente.';
				$response['datos']=$registros;
			}else{
				if($error[2]==NULL){
					$response['estado']='error';
					$response['mensaje']='No se devolvieron datos.';
				}else{
					$response['estado']='error';
					$response['mensaje']=$error[2];
				}
			}
		}catch(\Exception $e){
			$response['estado']='error';
			$response['mensaje']="Ocurrio el Error: ".$e->getMessage(). " en el Archivo ".$e->getFile()." en la clase ".get_class($e)." Linea: ".$e->getLine();
		}		
		return $response;
	}	
	
	public function obtenerMetaData($tabla){
		$sql="select * from $tabla";
		$stmt = $this->cnMySQL->prepare($sql);
		$pdo_stmt  = $stmt->execute();
		
		foreach(range(0, $stmt->columnCount() - 1) as $column_index){
  			$meta[] = $stmt->getColumnMeta($column_index);
		}		
		return $meta;		
	}	
	
}