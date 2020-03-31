<?php
class causa_titularidadController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('causa_titularidad','catalogos');	
	}
	
	public function index(){
		try{
			$this->view->titulo = 'Causas de Titularidad';
			$this->view->descripcion = 'Mantenimiento de Información';
			$this->view->setMainJs(array(
				'JQGRID'
				,'JQGRID_DEFAULT'
				,'JQGRID_ES'
				,'JQUERY_INPUTMASK'
				,'JQUERY_ALERTS'
			));			
			$this->view->setJs(array('causa_titularidad-table'));		
			$this->view->rendering('causa_titularidad');		
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}

	}
}

?>