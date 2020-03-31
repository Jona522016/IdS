<?php
class rol_entidadController extends Controller{
	
	public function __construct(){
		parent::__construct();
		$this->modelo=$this->loadModel('rol_entidad','catalogos');
	}
	
	public function index(){
		$this->view->titulo = 'Rol de Entidad en Sistema';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_ES'
			,'JQGRID_DEFAULT'
			,'JQUERY_INPUTMASK'
		));			
		$this->view->setJs(array('rol_entidad-table'));		
		$this->view->rendering('rol_entidad');		
	}
	
}
?>