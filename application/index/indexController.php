<?php
class indexController extends Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index() {
		try {
			if (Session::get('autenticado')) {
				$this->view->titulo = 'Home';
				$this->view->descripcion = 'Inicio de Sistema';
				$this->view->setMainCss(array('JQUERY_CONFIRM'));
				$this->view->setMainJs(array('JQUERY_CONFIRM'));
				$this->view->dataTemplate[$this->view->template]->Config('autenticado');
				$this->view->setJs(array('index'));
				$this->view->Rendering('index');
			}else {
				$this->view->setMainCss(array(
					'JQUERY_CONFIRM'
					,'JQUERY_ALERTS'
				));
				$this->view->setMainJs(array(
					'JQUERY_CONFIRM'
					,'JQUERY_UI'
					,'JQUERY_VALIDATE'
					,'JQUERY_VALIDATE_ES'
					,'JQUERY_VALIDATE_ADDS'
					,'JQUERY_ALERTS'
					,'MY_SCRIPTS' 
					,'MD5'
				));
				$params = array('id'=>'empresas');
				$resultado=$this->generarCombo($this->modeloEmpresa,$params);
				if($resultado['registros']>1){
					$this->view->empresas = $resultado['combo'];
					$this->view->id_empresa = '0';
					$this->view->nombre_empresa = '';
					$this->view->logo = '';
					$this->view->reg = $resultado['registros'];					
				}else{
					$this->view->id_empresa = $resultado['data'][0]['id'];
					$this->view->nombre_empresa = $resultado['data'][0]['descripcion'];
					$this->view->logo = $resultado['data'][0]['logo'];
					$this->view->reg = $resultado['registros'];
				}
				$this->view->dataTemplate[$this->view->template]->Config('login');
				$this->view->setJs(array('login'));
				$this->view->Rendering('login');

			}
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}
}
?>