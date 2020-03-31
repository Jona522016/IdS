<?php
class departamentoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('departamento','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Departamentos';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_ES'
			,'JQGRID_DEFAULT'
			,'JQUERY_INPUTMASK'
		));			
		$this->view->setJs(array('departamento-table'));		
		$this->view->rendering('departamento');		
	}
}

?>