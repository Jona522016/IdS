<?php
class archivo_adjuntoModel extends Model{
	
	public function __construct() {
		parent::__construct();
		$this->tabla = "opr_archivo_adjunto";
		$this->id_tabla = "id_archivo_adjunto";
		
		$this->campos['id_archivo_adjunto'] = array('valor'=>0);
		$this->campos['id_expediente'] = array('valor'=> 0);
		$this->campos['correlativo_gestor'] = array('valor'=> '');
		$this->campos['ficha_tecnica'] =  array('valor'=> '');
		$this->campos['fecha'] =  array('valor'=> '');
		$this->campos['descripcion'] =  array('valor'=> '');
		$this->campos['observaciones'] =  array('valor'=> '');
		$this->campos['archivo'] =  array('valor'=> '');
		$this->campos['id_tipo_archivo'] =  array('valor'=> 0);
		$this->campos['id_operador'] =  array('valor'=> 0);
		$this->campos['estado_registro'] =  array('valor'=> 'A');					
						
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
								$this->campos[$key]['valor']=$value;
							}
						}
		 			}
		 			$campos=$this->campos;
		 			if($parametros['operacion']=='add' || $parametros['operacion']=='edit'){
						unset($campos[$this->id_tabla]);
						unset($campos['fecha']);
					}
				}else{
					foreach($parametros['datos'] as $key => $value){
						if(array_key_exists($key,$this->campos)){
							$campos[$key]['valor']=$value;
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
					$fields=array();
					foreach($campos as $key => $value){
						$fields[$key]=$value['valor'];
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
		try{
			if ($parametros['operacion']=='actualizaArchivo'){
				$sql  = "update $this->tabla";
				$sql .= " set archivo='".$parametros['archivo']."'";
				$sql .= " where id_archivo_adjunto=".$parametros['id'];
			}	
			
			if ($parametros['operacion']=='informacion_consulta_archivos'){
				$sql  = "select * from vw_opr_consulta_archivo_adjunto";
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