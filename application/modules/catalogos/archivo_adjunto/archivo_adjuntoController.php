<?php
class archivo_adjuntoController extends Controller{
	
	public function __construct(){
		parent::__construct();
		$this->modelo=$this->loadModel('archivo_adjunto','catalogos');
		$this->modeloTipoArchivo=$this->loadModel('tipo_archivo','catalogos');
		$this->modeloOperador = $this->loadModel('entidad','entidades');	
	}
	
	public function index(){
		$this->view->titulo = 'Archivos Adjuntos';
		$this->view->descripcion = 'Mantenimiento de la informacion de Archivos';
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
		
		$this->view->setJs(array('archivo_adjunto-table'));		
		$this->view->rendering('archivo_adjunto');
	}

	public function obtenerCatalogos(){
		try{
			$combos['tipo_archivo']=$this->ObtenerDatosCombo($this->modeloTipoArchivo);
			$combos['operador']=$this->ObtenerDatosCombo($this->modeloOperador);
			echo json_encode($combos);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}		
	}

	function DataTable($id=false){
	 	try{
		 	$datos=$_POST;
			$datos['id']=$id;
			$sql="select";
			$sql.=" id_archivo_adjunto,'' as imp_archivo, '' as ver_archivo,id_expediente,correlativo_gestor";
			$sql.=",ficha_tecnica,fecha,descripcion,observaciones,archivo,id_tipo_archivo,id_operador,estado_registro ";
			$sql.=" from opr_archivo_adjunto";
			$datos['sql_query']=$sql;
			$params=array('id'=>$id,'datos'=>$datos,);
			$resultado = $this->modelo->DataTableView($params);
			echo json_encode($resultado);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Error $e) {
			$this->manejoErrores($e);
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
	
	public function editDetalle($id=false){
		$datos = $_POST;
		$params=array('id'=>$id,'operacion'=>'edit_detalle','detalle'=>$datos['detalle']);
		$resultado = $this->modelo->crudData($params);
		echo json_encode($resultado);
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
		    $response=json_encode(array('uploaded' => 'OK' ));
		    //$response='{"ver":"1.0","ret":true,"errmsg":null,"errcode":0,"data":{"status":"upload success","originalFilename":"testFileName.txt","fileName":"excelFile","fileType":"text/plain","fileSize":1733}';
		    if($id!=false){
				$params=array('id'=>$id,'operacion'=>'actualizaArchivo','getData'=>'N','archivo'=>$nombre_archivo);
				$resultado = $this->modelo->ejecutarQuery($params);
			 }
		    echo $response;
		}
	}		
}
?>