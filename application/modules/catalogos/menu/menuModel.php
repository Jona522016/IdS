<?php
class menuModel extends Model {

	public $id_usuario = 1;

	public function __construct() {
		parent::__construct();
		$this->tabla = 'sys_menu';
		$this->id_tabla = 'id_menu';

		$this->campos['id_empresa'] = 1;
		$this->campos['descripcion'] = '';
		$this->campos['nivel'] = 1;
		$this->campos['link'] = '';
		$this->campos['patron'] = '';
		$this->campos['tipo_imagen'] = '';
		$this->campos['imagen'] = '';
		$this->campos['color'] = '';
		$this->campos['ayuda'] = '';
		$this->campos['funcion'] = '';
		$this->campos['estado_registro'] = '';
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
							$this->campos[$key]=$value;
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
				foreach($campos as $campo){
					if($response['status']=='error'){
						return $response;
					}else{
						switch($campo){
							case 'link':
								$this->campos['link']=strtolower($campo);
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


	public function crearSqlQuery($parametros) {
		try {
			if($parametros['operacion'] == 'obtenerMenuPrincipal') {
				$usuario = $this->id_usuario;
				$empresa = $this->id_empresa;
				$tipo    = $parametros['datos']['tipo'];
				$sql     = "call sp_usr_genera_menu('$tipo',$usuario,$empresa); ";
			}
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
			
			$response['status'] = 'ok';
			$response['response'] = $sql;
			$response['data'] = 0;
			return $response;
		}catch(Exception $e) {
			$response['estado'] = 'error';
			$response['mensaje'] = "Ocurrio el Error: ".$e->getMessage(). " en el Archivo ".$e->getFile()." en la clase ".get_class($e)." Linea: ".$e->getLine();
		}
	}


}

?>
