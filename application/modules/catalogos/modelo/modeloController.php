<?php
class modeloController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('modelo','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Modelos del Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('modelo-table'));		
		$this->view->rendering('modelo');		
	}
	
	
}

?>