<?php
class presentacionController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('presentacion','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Presentacion de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('presentacion-table'));		
		$this->view->rendering('presentacion');		
	}
	
	
}

?>