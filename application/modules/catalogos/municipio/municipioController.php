<?php
class municipioController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');		
		$this->modelo = $this->loadModel('municipio','catalogos');	
		$this->modeloDepartamento = $this->loadModel('municipio','catalogos');	
	}
	
	public function index(){
		$this->view->titulo = 'Municipios';
		$this->view->descripcion = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_ES'
			,'JQGRID_DEFAULT'
			,'JQUERY_INPUTMASK'
		
		));			
		$this->view->setJs(array('municipio-table'));		
		$this->view->rendering('municipio');		
	}


	public function obtenerCatalogos(){
		$combos['departamento']=$this->ObtenerDatosCombo($this->modeloDepartamento);
		echo json_encode($combos);
	}
		
	
}
?>