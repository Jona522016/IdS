<?php
class menuController extends Controller {
	function __construct() {
		parent::__construct();
		$this->modelo = $this->loadModel('menu','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Menú Principal';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
			,'COLOR_PICKER'
			,'COLOR_PICKER_ES'

		));
		$this->view->setMainCss(array(
			'COLOR_PICKER'
		));		

		$this->view->setJs(array('menu-table'));
		$this->view->rendering('menu');		
	}
}

