<?php
class reportesController extends Controller {
	function __construct() {
		parent::__construct();
		}
	
	public function index(){
	$this->view->titulo = 'Reportes';
		$this->view->descripcion = 'Reportes disponibles';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_VALIDATE'
			,'JQUERY_VALIDATE_ADDS'
			,'JQUERY_VALIDATE_ES'
			,'JQUERY_ALERTS'
			,'JQUERY_INPUTMASK'
			,'BOOTSTRAP_DATEPICKER'
			,'BOOTSTRAP_DATEPICKER_ES'
			,'SELECT2'	
		));
		$this->view->setMainCss(array(
			'JQUERY_ALERTS'	
		));
		$this->view->setCss(array('main','util'));
		$this->view->setJs(array('reportes','main'));
		$this->view->rendering('reportes');		
	}	
	
}

