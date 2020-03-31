<?php
class productoController extends Controller{
	
	public function __construct(){
		parent::__construct();
		$this->modelo=$this->loadModel('producto','catalogos');
		$this->modeloBodega=$this->loadModel('bodega','catalogos');
		$this->modeloMarca=$this->loadModel('marca','catalogos');
		$this->modeloModelo=$this->loadModel('modelo','catalogos');
		$this->modeloTipoProducto=$this->loadModel('tipo_producto','catalogos');
		$this->modeloCategoria=$this->loadModel('categoria','catalogos');
		$this->modeloClase=$this->loadModel('clase','catalogos');
		$this->modeloPresentacion=$this->loadModel('presentacion','catalogos');
		$this->modeloMedida=$this->loadModel('medida','catalogos');
		$this->modeloOperador = $this->loadModel('entidad','entidades');	
	}
	
	public function index(){
		$this->view->titulo = 'Productos';
		$this->view->descripcion = 'Mantenimiento de la informacion de Productos';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQGRID_FLUID' 
			,'JQUERY_INPUTMASK'
			,'JQUERY_ALERTS'
			,'BOOTSTRAP_DATEPICKER'
			,'BOOTSTRAP_DATEPICKER_ES'
			,'DROPZONE'
			,'BOOTSTRAP_FILEINPUT' 
			,'BOOTSTRAP_FILEINPUT_ES'			
		));				
		$this->view->setMainCss(array(
			'BOOTSTRAP_DATEPICKER'
			,'JQUERY_ALERTS'
			,'BOOTSTRAP_FILEINPUT' 
		));				
		
		$this->view->setJs(array('producto-table'));		
		$this->view->rendering('producto');
	}
	
	public function obtenerCatalogos(){
		try{
			$combos['bodega']=$this->ObtenerDatosCombo($this->modeloBodega);
			$combos['marca']=$this->ObtenerDatosCombo($this->modeloMarca);
			$combos['modelo']=$this->ObtenerDatosCombo($this->modeloModelo);
			$combos['tipo_producto']=$this->ObtenerDatosCombo($this->modeloTipoProducto);
			$combos['categoria']=$this->ObtenerDatosCombo($this->modeloCategoria);
			$combos['clase']=$this->ObtenerDatosCombo($this->modeloClase);
			$combos['presentacion']=$this->ObtenerDatosCombo($this->modeloPresentacion);
			$combos['medida']=$this->ObtenerDatosCombo($this->modeloMedida);
			$combos['operador']=$this->ObtenerDatosCombo($this->modeloOperador);
			echo json_encode($combos);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}		
	}	

	public function cargarArchivo(){
		$fileobj=$_POST['objArchivo'];
		$id=$_POST['id'];
		$gestor=$_POST['gestor'];
		if (!empty($_FILES)) {
		   $tempFile = $_FILES[$fileobj]['tmp_name'];  
		    $nombre_archivo1=$_FILES[$fileobj]['name']; 
		    $nombre_archivo=str_replace(' ','_', $nombre_archivo1);
			$carpeta = PHOTO_PATH.$gestor.DS;
			if (!file_exists($carpeta)) {
    			mkdir($carpeta, 0777, true);
			}
			$targetFile = $carpeta . $nombre_archivo;		    

		    move_uploaded_file($tempFile,$targetFile);
		    $response=json_encode(array('uploaded' => 'OK', 'ruta_archivo' => $nombre_archivo ));
		    //$response='{"ver":"1.0","ret":true,"errmsg":null,"errcode":0,"data":{"status":"upload success","originalFilename":"testFileName.txt","fileName":"excelFile","fileType":"text/plain","fileSize":1733}';
		    if($id!=false){
				$params=array('id'=>$id,'operacion'=>'actualizaArchivo','getData'=>'N','archivo'=>$nombre_archivo);
				$resultado = $this->modelo->ejecutarQuery($params);
			 }
		    /*echo $response;*/
		}
	}	

	 function DataTableEdit($idTable=false){
 		try{
			$datos = $_POST;
			$oper=$datos['oper'];
			if(array_key_exists('id',$datos)){
				if ($datos['id']=="_empty"){
					$id="0";
				}else{
					$id = $datos['id'];	
				}
			}else{
				$id = $datos[$idTable];
			}
			unset($datos['oper']);
			unset($datos[$id]);
			$params=array('id'=>$id,'operacion'=>$oper,'datos'=>$datos);
			$resultado = $this->modelo->cudData($params);
			echo json_encode($resultado);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Error $e) {
			$this->manejoErrores($e);
		}
	}	

}
?>