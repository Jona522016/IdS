<?php
class grupoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');	
		$this->modelo = $this->loadModel('grupo','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Grupo';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));			
		$this->view->setJs(array('grupo-table'));		
		$this->view->rendering('grupo');		
	}
	
}

?>