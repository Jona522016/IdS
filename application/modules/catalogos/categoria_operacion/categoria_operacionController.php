<?php
class categoria_operacionController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('categoria_operacion','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Categoria de Operaciones';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('categoria_operacion-table'));		
		$this->view->rendering('categoria_operacion');		
	}
	
	
}

?>