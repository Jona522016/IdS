<?php
class recetaController extends Controller {
	function __construct() {
		parent::__construct();
		$this->modelo = $this->loadModel('receta_encabezado','catalogos');	
		$this->modeloDetalle = $this->loadModel('receta_detalle','catalogos');	
		$this->modeloProducto = $this->loadModel('producto','catalogos');	
		$this->modeloMedida = $this->loadModel('medida','catalogos');
		}
	
	public function index(){
	$this->view->titulo = 'Receta';
		$this->view->descripcion = 'Ingreso de la información de la Receta';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_VALIDATE'
			,'JQUERY_VALIDATE_ADDS'
			,'JQUERY_VALIDATE_ES'
			,'JQUERY_ALERTS'
			,'JQUERY_INPUTMASK'
			,'BOOTSTRAP_DATEPICKER'
			,'BOOTSTRAP_DATEPICKER_ES'			
		));
		$this->view->setMainCss(array(
			'JQUERY_ALERTS'
		));
		
		$combo=$this->generarCombo($this->modeloProducto,array('id'=>'producto'));	
		$this->view->producto = $combo['combo'];
		$combo=$this->generarCombo($this->modeloMedida,array('id'=>'medida'));	
		$this->view->medida = $combo['combo'];
		
		$this->view->setJs(array('receta-table','receta'));
		$this->view->rendering('receta');		
	}

	
	public function grabarEncabezado(){
		
		$params=array('prepare'=>true,'operacion'=>'add','datos'=>$_POST['datosEncabezado']);
		$resultado=$this->modelo->cudData($params); //modelo = A operacion_encabezadoModel.php
		if($resultado['status']=='ok'){
			$id_encabezado=$resultado['id_row'];
		}else{
			$id_encabezado=0;
		}	
		echo json_encode($resultado);
		
	}
	public function grabarDetalle(){
		$datos=$_POST['datosDetalle'];
			foreach($datos as $dato){
				$params=array('prepare'=>true,'operacion'=>'add','datos'=>$dato);
				$resultado=$this->modeloDetalle->cudData($params); //modelo = A operacion_encabezadoModel.php
				if($resultado['status']=='ok'){
					$id_encabezado=$resultado['id_row'];
				}else{
					$id_encabezado=0;
				}
			}	
		echo json_encode($resultado);
		
	}
	
	
}

