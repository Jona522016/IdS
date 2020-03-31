<?php
class sucursalController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('sucursal','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Sucursales';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('sucursal-table'));		
		$this->view->rendering('sucursal');		
	}
	
	
}

?>