<?php
class unidad_medidaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('unidad_medida','catalogos');	
		$this->modeloTipoUnidadMedida = $this->loadModel('tipo_unidad_medida','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Unidades de Medida';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('unidad_medida-table'));		
		$this->view->rendering('unidad_medida');		
	}
	
	public function obtenerCatalogos(){
		$combos['tipo_unidad_medida']=$this->ObtenerDatosCombo($this->modeloTipoUnidadMedida);
		echo json_encode($combos);
	}	
	
}

?>