<?php
class uso_terrenoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('uso_terreno','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Uso del Terreno';
		$this->view->subtitulo = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('uso_terreno-table'));		
		$this->view->rendering('uso_terreno');		
	}
}

?>