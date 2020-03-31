<?php
class tipo_unidad_medidaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('tipo_unidad_medida','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Tipo de Unidades de Medida';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('tipo_unidad_medida-table'));		
		$this->view->rendering('tipo_unidad_medida');		
	}
}

?>