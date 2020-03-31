<?php
class categoriaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('categoria','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Categorias de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('categoria-table'));		
		$this->view->rendering('categoria');		
	}
	
	
}

?>