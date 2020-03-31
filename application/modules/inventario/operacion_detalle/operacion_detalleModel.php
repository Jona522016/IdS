<?php
class operacion_detalleModel extends Model {
	public function __construct() {
		parent::__construct();
		$this->tabla = 'inv_operacion_detalle';
		$this->id_tabla = 'id_operacion_detalle';

		$this->campos['id_operacion_encabezado'] = 0;
		$this->campos['id_bodega'] = 0;
		$this->campos['tipo_movimiento'] = '';
		$this->campos['id_producto'] = 0;
		$this->campos['codigo_producto'] = '';
		$this->campos['unidades'] = 0;
		$this->campos['valor_unitario'] = 0;
		$this->campos['valor'] = 0;
		$this->campos['valor_iva'] = 0;
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
						unset($campos['id_operacion_detalle']);
						unset($campos['select']);
						if($parametros['operacion']=='add'){
							$campos['estado_registro'] = 'A';							
							$campos['id_operacion_encabezado'] = $parametros ['encabezado'];
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
