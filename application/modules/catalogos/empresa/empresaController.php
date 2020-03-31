<?php
class empresaController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->view->setTemplate('admin');
		$this->modelo = $this->loadModel('empresa','catalogos');	
	}
	
	public function index(){
		try{
			$this->view->titulo = 'Empresa';
			$this->view->descripcion = 'Mantenimiento de Información';
			$this->view->setMainJs(array(
				'JQGRID'
				,'JQGRID_DEFAULT'
				,'JQGRID_ES'
				,'JQUERY_INPUTMASK'
				,'JQUERY_ALERTS'
			));			
			$this->view->setJs(array('empresa-table'));		
			$this->view->rendering('empresa');	
		}catch(\Exception $e){
			$this->manejoErrores($e);
		}catch(\Error $e){
			$this->manejoErrores($e);			
		}			
	}
	
	public function obtenerDatosEmpresa(){
		try{
			$id_empresa=$_POST['id_empresa'];
			$datos=array(
				'id_empresa'=>$id_empresa
			);
			$params=array('operacion'=>'obtenerDatosEmpresa','prepare'=>true,'datos'=>$datos);
			$resultado=$this->modelo->ejecutarQuery($params);
			echo json_encode($resultado);
		}catch(\Exception $e){
			$this->manejoErrores($e);
		}catch(\Error $e){
			$this->manejoErrores($e);			
		}
		
	}
	
}

?>