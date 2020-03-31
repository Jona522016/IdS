<?php
class tipo_productoController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('tipo_producto','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Tipos de Producto';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('tipo_producto-table'));		
		$this->view->rendering('tipo_producto');		
	}
	
	
}

?>