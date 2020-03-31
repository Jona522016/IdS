<?php
/*
	Smarty Template Class 1.0
*/
class smartyTemplate extends MainClass {
	
	public $rutas;
	public $plantilla = DEFAULT_LAYOUT;
	public $body_class ='class="sidebar-fixed topnav-fixed"';
	public $wrapper_class='class="wrapper"';
	public $maincss;
	public $mainjs;
	public $tipo_template='default';
	
	public function __construct() {
		try{
			$this->maincss=array(
				'FUENTE_LATO'
				,'BOOTSTRAP'
				,'ESSENTIALS' 
				,'LAYOUT' 
				,'HEADER_1'
				,'ESQUEMA_COLOR'
				,'MY_STYLES'
			);		
			$this->mainjs=array(
				'JQUERY'
				,'BOOTSTRAP' 
				,'MAIN' 
			);
			
		} catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}	
	
	public function rutas(){
		$rutas = array(
			'ruta_css' =>  BASE_URL . 'layout/'.$this->plantilla.'/assets/css/'
			,'ruta_fonts'  => BASE_URL . 'layout/'.$this->plantilla.'/assets/fonts/'
			,'ruta_img' => BASE_URL . 'layout/'.$this->plantilla.'/assets/images/'
			,'ruta_js'  => BASE_URL . 'layout/'.$this->plantilla.'/assets/js/'
			,'ruta_plugins'=> BASE_URL . 'layout/'.$this->plantilla.'/assets/plugins/'
			,'ruta_my_plugins'=> BASE_URL . 'layout/plugins/'
		);
		return $rutas;
	}	
	
	public function getMainCss(){
		$rutas=$this->rutas();
      $css= array(
         'BOOTSTRAP' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_plugins'].'bootstrap/css/bootstrap.min.css')
			,'FONT_AWESOME' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_css'].'font-awesome.min.css')
			,'ESSENTIALS' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_css'].'essentials.css')
			,'MY_STYLES' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_my_plugins'].'my_styles.css') 
			,'LAYOUT' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_css'].'layout.css')	
			,'HEADER_1' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_css'].'header-1.css')	
			,'ESQUEMA_COLOR' =>array('tipo'=>'MAIN','ruta'=> $rutas['ruta_css'].'color_scheme.css')
			,'FUENTE_LATO' =>array('tipo'=>'MAIN','ruta'=>'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700')
			,'MY_STYLES' => array('tipo'=>'MAIN','ruta'=>$rutas['ruta_my_plugins'].'my_styles.css') 
		);	
		return $css;
	}	
		
	public function getMainJs(){
		$rutas=$this->rutas();
		$js=array(
			'JQUERY' => $rutas['ruta_plugins'].'jquery/jquery-3.2.1.min.js'
			,'MAIN' => $rutas['ruta_js'].'scripts.js'
			,'BOOTSTRAP' => $rutas['ruta_plugins'].'bootstrap/js/bootstrap.min.js'
			,'MY_SCRIPTS' => $rutas['ruta_my_plugins'].'my_scripts.js'
		);
		return $js;
	}   

	public function setMainMenu($data){
		$html = '<nav class="nav-main">';
		$html = '<ul id="topMain" class="nav nav-pills nav-main">';
		$data_menu = $data ;
		$reg = 0;
		$nivel3 = 0 ;
		if (isset($data) && count($data)) : 
			foreach ($data_menu as $key => $value) :
				if($reg<count($data)-1){
					++$reg ;
				}
				switch($value["nivel"]):
				case 1:
					if ($value["funcion"] == 'M' and $data_menu[$reg]["nivel"] == 2 and $key<=count($data)-1)  :
						$html.= '<li class="dropdown">';
						$html.= '<a href="'.BASE_URL.$value["link"].'" class="dropdown-toggle">';
						$html.= $value["descripcion"];
						$html.= '</a>';
						$html.= '<ul class="dropdown-menu">';
					else :
						$html.= '<li>';
						$html.= '<a href="'.BASE_URL.$value["link"].'">';
						$html.= $value["descripcion"];
						$html.= '</a>';
						$html.= '</li>';
					endif ;								
					break;
				case 2:
					if ($value["funcion"] == 'M' and $data_menu[$reg]["nivel"] == 3) : 
						$html.= '<li class="dropdown">';
						$html.= '<a href="'.BASE_URL.$value["link"].'" class="dropdown-toggle">';
						$html.= $value["descripcion"];
						$html.= '</a>';
						$html.= '<ul class="dropdown-menu">';
					else :
						$html.= '<li>';
						$html.= '<a href="'.BASE_URL.$value["link"].'">';
						$html.= $value["descripcion"];
						$html.= '</a>';
					endif ;	
						
					if ($reg<=count($data_menu)-1) :
						switch($data_menu[$reg]["nivel"]){
						case 1: 
							$html.= '</li></ul></li>';
							break;
						case 2:
							$html.= '</li>';
							break;
						}
					endif;
						
					break;
				case 3: 
					$html.= '<li>';
					$html.= '<a href="'.BASE_URL.$value["link"].'">';
					$html.= $value["descripcion"];
					$html.= '</a>';
					
					if ($reg<=count($data_menu)-1) :
						switch($data_menu[$reg]["nivel"]){
						case 1:
							$html.= '</li></ul></li></ul></li>';
							break;
						case 2:
							$html.= '</li></ul></li>';
							break;
						case 3:
							$html.= '</li>';
							break;									
						}
					endif;	
					break;
				endswitch;
			endforeach;
		endif ; 
		$html.= '</ul></nav>';
		echo $html;
	}
}	
?>