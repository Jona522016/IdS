<?php
class equipoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');	
		$this->modelo = $this->loadModel('equipo','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Equipo ';
		$this->view->subtitulo = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));			
		$this->view->setJs(array('equipo-table'));		
		$this->view->rendering('equipo');		
	}
	
}

?>