<?php
class parametroController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('parametro','catalogos');	
		$this->modeloTipoParametro = $this->loadModel('tipo_parametro','catalogos');	
	}
	
	public function index(){
		try{
			$this->view->titulo = 'Parametros';
			$this->view->descripcion = 'Mantenimiento de Información';
			$this->view->setMainJs(array(
				'JQGRID'
				,'JQGRID_DEFAULT'
				,'JQGRID_ES'
				,'JQUERY_INPUTMASK'
				,'JQUERY_ALERTS'
				,'BOOTSTRAP_DATEPICKER'
				,'BOOTSTRAP_DATEPICKER_ES'
			));			
			$this->view->setMainCss(array(
				'BOOTSTRAP_DATEPICKER'
			));			
			
			$this->view->setJs(array('parametro-table'));		
			$this->view->rendering('parametro');		
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}
	
	public function obtenerCatalogos(){
		$combos['tipo_parametro']=$this->ObtenerDatosCombo($this->modeloTipoParametro);
		echo json_encode($combos);
	}
		
	
}

?>