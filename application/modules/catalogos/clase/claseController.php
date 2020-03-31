<?php
class claseController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('clase','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Clases de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('clase-table'));		
		$this->view->rendering('clase');		
	}
	
	
}

?>