<?php
class marcaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('marca','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Marcas de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('marca-table'));		
		$this->view->rendering('marca');		
	}
	
	
}

?>