<?php
class documento_titularidadController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');	
		$this->modelo = $this->loadModel('documento_titularidad','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Documento que ampara la titularidad';
		$this->view->subtitulo = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));			
		$this->view->setJs(array('documento_titularidad-table'));		
		$this->view->rendering('documento_titularidad');		
	}
	
}

?>