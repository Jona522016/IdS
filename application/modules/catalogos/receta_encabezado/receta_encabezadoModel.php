<?php
class receta_encabezadoModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_encabezado_receta';
		$this->id_tabla = 'id_encabezado_receta';
		
		$this->campos['id_empresa'] = Session::get('id_empresa');
		$this->campos['descripcion'] = '';
		$this->campos['clave'] = '';
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
		
	
	
	

}
	


?>