<?php
class tipo_persona_entrevistaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('tipo_persona_entrevista','catalogos');	
	}
	
	public function index(){
		try{
			$this->view->titulo = 'Tipo de Persona que Muestra';
			$this->view->descripcion = 'Mantenimiento de Información';
			$this->view->setMainJs(array(
				'JQGRID'
				,'JQGRID_DEFAULT'
				,'JQGRID_ES'
				,'JQUERY_INPUTMASK'
				,'JQUERY_ALERTS'
			));			
			$this->view->setJs(array('tipo_persona_entrevista-table'));		
			$this->view->rendering('tipo_persona_entrevista');		
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}

	}
}

?>