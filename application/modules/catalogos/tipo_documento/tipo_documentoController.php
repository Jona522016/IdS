<?php
class tipo_documentoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('tipo_documento','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Tipos de Documento';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('tipo_documento-table'));		
		$this->view->rendering('tipo_documento');		
	}
	
	
}

?>