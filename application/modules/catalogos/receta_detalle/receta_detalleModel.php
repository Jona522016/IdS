<?php
class receta_detalleModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'opr_detalle_receta';
		$this->id_tabla = 'id_detalle_receta';

		$this->campos['id_encabezado_receta'] = 0;
		$this->campos['id_producto'] = "";
		$this->campos['descripcion'] = "";
		$this->campos['cantidad'] = "";
		$this->campos['id_medida'] = 0;
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
						if($parametros['operacion']=='add'){
							$campos['estado_registro'] = 'A';
						}
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
