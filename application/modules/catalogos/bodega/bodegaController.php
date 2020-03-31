<?php
class bodegaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('bodega','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Bodegas';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('bodega-table'));		
		$this->view->rendering('bodega');		
	}
	
	
}

?>