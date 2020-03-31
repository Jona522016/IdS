<?php
class reporteEntidadController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->view->setTemplate('kingadmin');
		$this->modelo = $this->loadModel('usuarios','entidades');
		$this->reporte =$this->loadReport('reporteEntidad','usuarios','entidades');
	}

	public function index(){
		$this->view->titulo = 'Catalogos';
		$this->view->subtitulo = 'Mantenimiento de Información';
		$this->view->setMainJs(array(
			'JQUERY_ALERT'
		));
		$this->view->setMainCss(array(
			'JQUERY_ALERT'			
		));
		$this->reporte->run->render();
		
	}

	
}
?>