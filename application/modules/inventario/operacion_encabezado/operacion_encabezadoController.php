<?php
class operacionController extends Controller {
	function __construct() {
		parent::__construct();
		$this->modelo = $this->loadModel('operacion_encabezado','inventario');	
		$this->modeloDetalle = $this->loadModel('operacion_detalle','inventario');	
		$this->modeloBodega = $this->loadModel('bodega','catalogos');	
		$this->modeloProducto = $this->loadModel('producto','catalogos');	
		$this->modeloTipoDocumento = $this->loadModel('tipo_documento','catalogos');	
		$this->modeloCategoriaOperacion = $this->loadModel('categoria_operacion','catalogos');	
		$this->modeloProveedor = $this->loadModel('proveedor','catalogos');		
	}
	
	public function index(){
		$this->view->titulo = 'Operaciones';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQGRID_FLUID'
			,'JQUERY_INPUTMASK'
			,'JQUERY_ALERTS'
		));

		$this->view->setJs(array('operacion','operacion'));
		$this->view->rendering('operacion');		
	}
	
	public function grabarOperacion(){
		
		$params=array('prepare'=>true,'operacion'=>'add','datos'=>$_POST['datosEncabezado']);
		$resultado=$this->modelo->cudData($params); //modelo = A operacion_encabezadoModel.php
		if($resultado['status']=='ok'){
			$id_encabezado=$resultado['id_row'];
		}else{
			$id_encabezado=0;
		}
		
		if($resultado['status']=='ok' && $id_encabezado>0){
			$info=$_POST['datosDetalle'];
			$info['id_encabezado']=$id_encabezado;
			$params=array('prepare'=>true,'operacion'=>'add','datos'=>$info);
			$resultado=$this->modeloDetalle->cudData($params);
			if($resultado['status']=='ok'){
				$id_operacion_detalle=$resultado['id_row'];
			}else{
				$id_operacion_detalle=0;
			}
		}
				
		
		echo json_encode($resultado);
		
	}

	
	
}

