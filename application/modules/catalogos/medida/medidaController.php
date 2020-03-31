<?php
class medidaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('medida','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Medidas de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('medida-table'));		
		$this->view->rendering('medida');		
	}
	
	
}

?>