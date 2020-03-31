<?php
class identificador_direccionController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('identificador_direccion','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Identificador de Direccion';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
			,'JQUERY_ALERTS'
		));			
		$this->view->setJs(array('identificador_direccion-table'));		
		$this->view->rendering('identificador_direccion');		
	}
}

?>