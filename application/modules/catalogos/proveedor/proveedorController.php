<?php
class proveedorController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('proveedor','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Proveedores';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('proveedor-table'));		
		$this->view->rendering('proveedor');		
	}
	
	
}

?>