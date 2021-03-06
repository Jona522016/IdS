<?php
class operacion_encabezadoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'inv_operacion_encabezado';
		$this->id_tabla = 'id_operacion_encabezado';

		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['id_sucursal'] = Session::get('id_sucursal');
		$this->campos['id_tipo_documento'] = 0;
		$this->campos['id_categoria_operacion'] = 0;
		$this->campos['fecha'] = '';
		$this->campos['numero'] = '';
		$this->campos['serie'] = '';
		$this->campos['id_proveedor'] = 0;
		$this->campos['observaciones'] = '';
		$this->campos['id_operador'] = Session::get('id_usuario');
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
							case 'fecha':
							$fecha = DateTime::createFromFormat('d/m/Y', $campos[$key]);
							$campos[$key]=$fecha->format('Y-m-d');	
							break;								
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
		if ($parametros['operacion']=='generarCorrelativo'){
			try{				
				$sql  = "select count(id_categoria_operacion) as correlativo";
				$sql .= " from $this->tabla ";
				$condicion = $parametros['condicion'];
				$sql .= " where estado_registro='A' and $condicion";	
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
