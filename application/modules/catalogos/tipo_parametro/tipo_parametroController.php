<?php
class tipo_parametroController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('tipo_parametro','catalogos');	
	}
	
	public function index(){
		try{
			$this->view->titulo = 'Tipo de Parametros';
			$this->view->descripcion = 'Mantenimiento de Información';
			$this->view->setMainJs(array(
				'JQGRID'
				,'JQGRID_DEFAULT'
				,'JQGRID_ES'
				,'JQUERY_INPUTMASK'
				,'JQUERY_ALERTS'
			));			
			$this->view->setJs(array('tipo_parametro-table'));		
			$this->view->rendering('tipo_parametro');		
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}

	}
}

?>