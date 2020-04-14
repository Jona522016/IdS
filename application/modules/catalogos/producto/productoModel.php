<?php
class productoModel extends Model{
	
	public function __construct() {
		parent::__construct();
		$this->tabla = "opr_producto";
		$this->id_tabla = "id_producto";
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['id_sucursal'] = Session::get('id_sucursal');	
		$this->campos['id_bodega'] = 0;
		$this->campos['codigo'] = "";
		$this->campos['fecha'] = "";
		$this->campos['descripcion'] = "";
		$this->campos['id_marca'] = 0;
		$this->campos['id_modelo'] = 0;
		$this->campos['precio'] = "";
		$this->campos['id_tipo_producto'] = 0;
		$this->campos['id_categoria'] = 0;
		$this->campos['id_clase'] = 0;
		$this->campos['id_medida'] = 0;
		$this->campos['tipo_producto'] = '';
		$this->campos['imagen'] = "";
		$this->campos['observaciones'] = "";
		$this->campos['descripcion_alternativa'] = "";
		$this->campos['id_operador'] = Session::get('id_usuario');
		$this->campos['existencia'] = 0;
		$this->campos['estado_registro'] = 'A';					

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
						unset($campos['select']);
						unset($campos['fecha']);
						unset($campos['importar_archivo']);						
						unset($campos['ver_archivo']);
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
					}
				}	 	
				if($response['status']=='error'){
					$response['data']=array();
				}else{
					$fields=array();
					foreach($campos as $key => $value){
						$fields[$key]=$value;
					}	 			
					$response['data']=$fields;
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
		if ($parametros['operacion']=='actualizaArchivo'||$parametros['operacion']=='consultaInventario'||$parametros['operacion']=='consultaMovimiento'||$parametros['operacion']=='consultaVentasTotales'||$parametros['operacion']=='consultaExistencia'||isset($parametros['especial'])){
			try{
				if ($parametros['operacion']=='actualizaArchivo'){
					$sql  = "update $this->tabla";
					$sql .= " set imagen='".$parametros['archivo']."'";
					$sql .= " where id_producto=".$parametros['id'];
				}	
				else if ($parametros['operacion']=='consultaVentasTotales'){
					$sql  = "select ";
					$sql .= "fecha_operacion";
					$sql .= ",serie";
					$sql .= ",numero";
					$sql .= ",Total";
					$sql .= " from vw_inventario_totales";
					if(isset($parametros['condicion'])){
						$condicion = $parametros['condicion'];
						$sql .= " where $condicion";
					}
				}
				else if ($parametros['operacion']=='consultaMovimiento'){
					$sql  = "select *";
					$sql .= " from vw_inventario_totales";
					if(isset($parametros['condicion'])){
						$condicion = $parametros['condicion'];
						$sql .= " where $condicion";
					}
				}
				else if ($parametros['operacion']=='consultaInventario'){
					$sql  = "select *";
					$sql .= " from vw_inventario_productos";
					if(isset($parametros['condicion'])){
						$condicion = $parametros['condicion'];
						$sql .= " where $condicion";
					}
				}
				else if ($parametros['operacion']=='consultaExistencia'){
					$sql  = "select ";
					$sql .= "$this->id_tabla as id";
					$sql .= ",descripcion ";
					$sql .= ",existencia ";
					$sql .= " from $this->tabla ";
					if(isset($parametros['condicion'])){
						$condicion = $parametros['condicion'];
						$sql .= " where estado_registro='A' and $condicion";
					}else{
						$sql .= " where estado_registro='A'";
					}
				}
				else if ($parametros['especial']){
					$sql  = "select ";
					$sql .= "$this->id_tabla as id";
					$sql .= ",descripcion ";
					$sql .= ",codigo ";
					$sql .= ",precio ";
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
		}else{
			$response=parent::crearSqlQuery($parametros);
			
		}
		return $response;	
	}
	
	
}
?>