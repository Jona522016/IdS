<?php
class tipo_menuController extends Controller {

	public function __construct() {
		parent::__construct();
		$this->modelo = $this->loadModel('tipo_menu','catalogos');	
	}

	public function index(){
		$this->view->titulo = 'Tipo de Menús';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->boton_ayuda = 'tipo_menu';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQGRID_FLUID'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('tipo_menu-table'));
		$this->view->rendering('tipo_menu');		
	}	
	
	public function obtenerMetaData(){
		$meta=$this->modelo->obtenerMetaData('sys_tipo_menu');
		echo json_encode($meta);
	}		
	
	
	
}

?>