<?php
/*
	Main Framework System 1.0
	View 1.0
*/
class View extends MainClass {
	protected $registry;
	protected $request;

	protected $mainjs = array();
	protected $maincss = array();
	protected $js = array();
	protected $css = array();
	protected $rutas = array();
	protected $headerlibs=array();
	protected $footerlibs=array();

	public $template;
	public $error;
	public $dataTemplate;
	public $dataMainCss;
	public $dataMainJs;
	public $login=true;
	public $usuario;
	public $empresa;

	public function __construct(Request $request) {
		$this->registry = Registry::getInstancia();
		$this->request = $request;
		$this->dataTemplate=$this->registry->templates;

		$modulo      = $this->request->getModule();
		$controlador = $this->request->getController();

		if($modulo) {
			$this->rutas['view'] = APP_PATH . 'modules' . DS . $modulo . DS . $controlador . DS ;
			$this->rutas['js'] = BASE_URL . 'application/modules/' . $modulo . '/' . $controlador . '/js/';
			$this->rutas['css'] = BASE_URL . 'application/modules/' . $modulo . '/' . $controlador . '/css/';
		}else {
			$this->rutas['view'] = APP_PATH . $controlador . DS;
			$this->rutas['js'] = BASE_URL . 'application/' . $controlador  . '/js/' ;
			$this->rutas['css'] = BASE_URL . 'application/' . $controlador  . '/css/' ;
		}
	}


	public function rendering($vista, $item = false) {
		try {
			$js = array();
			$css = array();
			$mainjs = array();
			$maincss = array();

			if(count($this->mainjs)) {
				$mainjs = $this->mainjs;
			}
			if(count($this->maincss)) {
				$maincss = $this->maincss;
			}
			if(count($this->js)) {
				$js = $this->js;
			}
			if(count($this->css)) {
				$css = $this->css;
			}
			
			if(count($this->headerlibs)) {
				$headerlibs = $this->headerlibs;
			}
			if(count($this->footerlibs)) {
				$footerlibs = $this->footerlibs;
			}			

			$layout = $this->dataTemplate[$this->template]->rutas();
			$layout['mainjs'] = $mainjs;
			$layout['maincss'] = $maincss;
			$layout['js'] = $js;
			$layout['css'] = $css;
			$layout['headerlibs'] = $this->headerlibs;
			$layout['footerlibs'] = $this->footerlibs;

			$rutaView = $this->rutas['view'] . $vista . 'View.phtml';

			if(is_readable($rutaView)) {
				include_once ROOT . 'layout' . DS . $this->template . DS . 'template.php';
			}else {
				throw new Exception('Error al invocar la vista');
			}
		} catch(\Exception $e) {
			$this->manejoErrores($e);
		}

	}
	
	public function mostrar_vista($vista){
		
		
	}
	

	public function setTemplate($plantilla) {
		$this->template = (string) $plantilla;
		$this->dataMainCss = $this->dataTemplate[$this->template]->getMainCss();
		$this->dataMainJs = $this->dataTemplate[$this->template]->getMainJs();

	}

	public function getTemplate() {
		return $this->template;
	}


	public function setJs(array $js) {
		if(is_array($js) && count($js)) {
			for($i = 0; $i < count($js); $i++) {
				$this->footerlibs[] =array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=> $this->rutas['js'] . $js[$i] . '.js');
			}
		}else {
			throw new Exception('Error de js');
		}
	}

	public function setCss(array $css) {
		if(is_array($css) && count($css)) {
			for($i = 0; $i < count($css); $i++) {
				$this->headerlibs[] =array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEAD','ruta'=> $this->rutas['css'] . $css[$i] . '.css');
			}
		}else {
			throw new Exception('Error de css');
		}
	}

	public function setMainCss(array $css) {
		try{
			$main = $this->dataTemplate[$this->template]->getMainCss();;
			if(is_array($css) && count($css)) {
				for($i = 0; $i < count($css); $i++) {
					$this->headerlibs[] = $main[$css[$i]];
				}
			}else {
				throw new Exception('Error de Maincss',0,E_USER_ERROR);
			}			
		} catch (\Exception $e) {
			$this->manejoErrores($e);
		} catch (\Error $e) {
			$this->manejoErrores($e);			
		}

	}

	public function setMainJs(array $js) {
		try{
			$main = $this->dataTemplate[$this->template]->getMainJs();
			if(is_array($js) && count($js)) {
				for($i = 0; $i < count($js); $i++) {
					$lib=$main[$js[$i]];
					if($lib['ubicacion']=='HEADER'){
						$this->headerlibs[] = $main[$js[$i]];
					}else{
						$this->footerlibs[] = $main[$js[$i]];
					}
				}
			}else {
				throw new Exception('Error de Mainjs',0,E_USER_ERROR);
			}
		} catch (\Exception $e) {
			$this->manejoErrores($e);
		} catch (\Error $e) {
			$this->manejoErrores($e);			
		}
	}


}

?>
