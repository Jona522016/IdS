<?php
/*
	Main Framework System 1.0
	Controller 1.0
*/
require_once INC_PATH."jqgrid.php";

abstract class Controller extends MainClass{
	use jqgrid;
	protected $registry;
	protected $view;
	protected $request;
	protected $routing;
	protected $modelo;
	protected $error;
	protected $reporte;
    
	public function __construct() {
		try{
			$this->registry = Registry::getInstancia();
			$this->request = $this->registry->request;
			$this->routing = $this->registry->routing;
			$this->modeloEntidad = $this->loadModel('entidad','entidades');
			$this->modeloEmpresa = $this->loadModel('empresa','catalogos');
			$this->view = new View($this->request);
			$this->view->setTemplate(ADMIN_LAYOUT);
			$this->view->setMainCss($this->view->dataTemplate[$this->view->template]->maincss);		
			$this->view->setMainJs($this->view->dataTemplate[$this->view->template]->mainjs);	
			$this->obtenerDatosIniciales();				
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}	
	
	abstract public function index();
	
	protected function obtenerDatosIniciales(){
		if(Session::get('autenticado')){
			$this->view->dataTemplate[$this->view->template]->Config('autenticado');
			$data=array(
				'avatar'=>Session::get('usuario_avatar')
				,'profile_avatar'=>Session::get('usuario_profile_avatar')
				,'descripcion'=>Session::get('usuario')
			);
			$this->view->usuario=$data;
			$data=array(
				'id_empresa'=>Session::get('id_empresa')
				,'logo'=>Session::get('logo_empresa')
				,'logo_encabezado'=>Session::get('logo_encabezado_empresa')
			);
			$this->view->empresa=$data;
			if(count(Session::get('menu'))==0)		{
				Session::set('menu',$this->obtenerMenuPrincipal('A'));
			}
			$this->view->dataMenu=Session::get('menu');			
			
		}else{
			$this->view->dataTemplate[$this->view->template]->Config('autenticado');
			if(Session::get('id_usuario')>0 && Session::get('id_empresa')>0){
				$datos=array(
					'id_entidad'=>Session::get('id_usuario')
					,'id_empresa'=>Session::get('id_empresa')
				);
				$params=array(
					'operacion'=>'obtenerDatosUsuario'
					,'prepare'=>true
					,'datos'=>$datos
				);
				$resultado=$this->modeloEntidad->ejecutarQuery($params);
				if($resultado['status']=='ok' && $resultado['rows']>0){
					$this->view->usuario=$resultado['data'][0];
				}else{
					$data=array(
						'avatar'=>'user_avatar.png'
						,'profile_avatar'=>'profile_avatar.png'
						,'descripcion'=>'Usuario sin Autenticacion'
					);
					$this->view->usuario=$data;
				}
				$params=array(
					'operacion'=>'obtenerDatosEmpresa'
					,'prepare'=>true
					,'datos'=>array('id_empresa'=>Session::get('id_empresa'))
				);
				$resultado=$this->modeloEmpresa->ejecutarQuery($params);
				if($resultado['status']=='ok' && $resultado['rows']>0){
					$this->view->empresa=$resultado['data'][0];
				}else{
					$data=array(
						'logo_encabezado'=>'logo_encabezado.png'
					);
					$this->view->empresa=$data;					
				}			
				
				Session::set('menu',$this->obtenerMenuPrincipal('A'));
				$this->view->dataMenu=Session::get('menu');												
			}

		}
	}
    
	protected function loadModel($modelo, $modulo=FALSE){

		if($modulo!=FALSE){
			$rutaModelo = APP_PATH . 'modules' . DS . $modulo . DS . $modelo . DS . $modelo . 'Model.php';
		}else{
			$rutaModelo = APP_PATH . $modelo . DS . $modelo . 'Model.php';
		}
		$clase=$modelo.'Model';
		if(is_readable($rutaModelo)){
			require_once $rutaModelo;
			$model = new $clase;
			return $model;
		}else {
			throw new Exception('Error de invocacion del modelo');
		}
	}
	
	protected function loadController($controlador, $modulo=FALSE){
		if($modulo!=FALSE){
			$rutaModelo = APP_PATH . 'modules' . DS . $modulo . DS . $controlador . DS . $controlador . 'Controller.php';
		}else{
			$rutaModelo = APP_PATH . $controlador . DS . $controlador . 'Controller.php';
		}
		$clase=$controlador.'Model';
		if(is_readable($rutaModelo)){
			require_once $rutaModelo;
			$control = new $clase;
			return $control;
		}else {
			throw new Exception('Error de invocacion del modelo');
		}
	}	
	
	protected function loadView($vista,$request){
		$rutaVista = LAYOUT_PATH . $vista . 'Template.php';
		$clase=$vista.'Template';
		if(is_readable($rutaVista)){
			require_once $rutaVista;
			$template = new $clase ($request);
			return $template;
		}else {
			throw new Exception('Error de invocacion de la Clase Vista');
		}
	}
	
	protected function loadReport($reporte1,$controller,$modulo){
		if($modulo!=FALSE){
			$rutaReporte = APP_PATH . 'modules' . DS . $modulo . DS . $controller . DS . $reporte1 .'.php' ;
		}else{
			$rutaReporte = APP_PATH . $controller . DS . $reporte1;
		}
		$clase=$reporte1;
		if(is_readable($rutaReporte)){
			require_once $rutaReporte;
			$report = new $clase;
			return $report;
		}else {
			throw new Exception('Error de invocacion del Reporte');
		}
	}	

	public function obtenerMenuPrincipal($tipo){
		$datos=array(
			'tipo'=>$tipo
		);
		$data=[];
		$this->modelo=$this->loadModel('menu','catalogos');
		$params=array(
			'operacion'=>'obtenerMenuPrincipal'
			,'prepare'=>true
			,'datos'=>$datos
		);			
		$resultado = $this->modelo->ejecutarQuery($params);
		if($resultado['status']=='ok'){
			$data=$resultado['data'];
		}
		return $data;
	}			
	
	protected function getLibrary($libreria,$ubicar = false){
		if (!$ubicar){
			$rutaLibreria = ROOT . 'libraries' . DS . 'class.' .$libreria . '.php';	
		}else{
			$rutaLibreria = ROOT . 'libraries' . DS . $ubicar . DS . $libreria . '.php';
		}
		
		if(is_readable($rutaLibreria)){
			require_once $rutaLibreria;
		}else{
			throw new Exception('Error de invocación de libreria');
		}
	}

	
	public function generarCombo($modelo,$parametros){
		try{
			if(isset($parametros['condicion'])){
				$params=array('operacion'=>'combo','condicion'=>$parametros['condicion']);
			}else{
				$params=array('operacion'=>'combo');
			}
			$data = $modelo->ejecutarQuery($params);	
			if($data['status']=='ok'){
				if(isset($parametros['class'])){
					if(isset($parametros['multiple'])){
						$combo  = "<select id='".$parametros['id']."' name='".$parametros['id']."' multiple class='form-control ".$parametros['class']."'>";							
					}else{
						$combo  = "<select id='".$parametros['id']."' name='".$parametros['id']."' class='form-control ".$parametros['class']."'>";	
					}
					
				}else{
					if(isset($parametros['multiple'])){
						$combo  = "<select id='".$parametros['id']."' name='".$parametros['id']."' multiple class='form-control'>";
					}else{
						$combo  = "<select id='".$parametros['id']."' name='".$parametros['id']."' class='form-control'>";
					}
				}
				if(isset($parametros['no_elegir'])){
					foreach($data['data'] as $registro){
						if(isset($parametros['tipo'])){
							$combo .= "<option value = '".$registro['id']."' data-tipo='".$registro['tipo']."' >".$registro['descripcion']."</option>";
						}else{
							$combo .= "<option value = '".$registro['id']."' >".$registro['descripcion']."</option>";
						}
					}
				}else{
					$combo .= "<option value = '0' data-tipo='0' selected='selected' class='elegir' >Elija una opción</option>";
					foreach($data['data'] as $registro){
						if(isset($parametros['tipo'])){
							$combo .= "<option value = '".$registro['id']."' data-tipo='".$registro['tipo']."' >".$registro['descripcion']."</option>";
						}else{
							$combo .= "<option value = '".$registro['id']."' >".$registro['descripcion']."</option>";
						}
					}
				}
				$combo .= "</select>";
			}else{
				$combo  = "<select id='".$parametros['id']."' name='".$parametros['id']."' class='form-control'>";
				$combo .= "<option value = '0' data-tipo='0' selected='selected' class='elegir' >Error</option>";
				$combo .= "</select>";
			}
			$response=array('registros'=>$data['rows'],'combo'=>$combo,'data'=>$data['data']);
			return $response;
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}

	

	public function ObtenerDatosComboBox($parametros=false){
		$data = $this->ObtenerDatosCombo($this->modelo,$parametros);
		echo json_encode($data);
	}	
	
	protected function ObtenerDatosCombo($modelo,$parametros=false){
		$condicion=array(
			"estado_registro='A'"
		);
		$params=array('condicion'=>$condicion);
		$resultado = $modelo->obtenerDatosComboBox($params);		
		return $resultado;
	}






	protected function Redireccionar($ruta = false){
		if($ruta){
			header('location:' . BASE_URL . $ruta);
		}else{
			header('location:' . BASE_URL);
		}
	}

	protected function getSql($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave] = strip_tags($_POST[$clave]);

			if(!get_magic_quotes_gpc()){
				$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
				$_POST[$clave] = $mysqli->real_escape_string($_POST[$clave]);

				//$_POST[$clave] = mysqli_real_escape_string($_POST[$clave], mysqli_connect(DB_HOST, DB_USER, DB_PASS));
			}

			return trim($_POST[$clave]);
		}
	}
    
	protected function getAlphaNum($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave] = (string) preg_replace('/[^A-Z0-9_]/i', '', $_POST[$clave]);
			return trim($_POST[$clave]);
		}
	}
    
	public function validarEmail($email){
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		return true;
	}
    
	protected function formatPermiso($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave] = (string) preg_replace('/[^A-Z_]/i', '', $_POST[$clave]);
			return trim($_POST[$clave]);
		}
	}	
	
	public static function NombreMes($mes){
		switch($mes){
			case 1:
				$nombre='Enero';
				break;
			case 2:
				$nombre='Febrero';
				break;
			case 3:
				$nombre='Marzo';
				break;
			case 4:
				$nombre='Abril';
				break;
			case 5:
				$nombre='Mayo';
				break;
			case 6:
				$nombre='Junio';
				break;
			case 7:
				$nombre='Julio';
				break;
			case 8:
				$nombre='Agosto';
				break;
			case 9:
				$nombre='Septiembre';
				break;
			case 10:
				$nombre='Octubre';
				break;
			case 11:
				$nombre='Noviembre';
				break;
			case 12:
				$nombre='Diciembre';
				break;
		}
		
		return $nombre;
	}
	
	public static function isotolat($fecha){
		$fechaiso=substr($fecha,-2)+'-'+substr($fecha,5,2)+'-'+substr($fecha,0,4);
		return $fechaiso;
	}

	public static function lattoiso($fecha){
		$fechalat=substr($fecha,-4)+'-'+substr($fecha,3,2)+'-'+substr($fecha,0,2);
		return $fechalat;
	}
	


	protected function getTexto($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave] = htmlspecialchars($_POST[$clave], ENT_QUOTES);
			return $_POST[$clave];
		}
		return '';
	}
    
	protected function getInt($clave){
		if(isset($_POST[$clave]) && !empty($_POST[$clave])){
			$_POST[$clave] = filter_input(INPUT_POST, $clave, FILTER_VALIDATE_INT);
			return $_POST[$clave];
		}
		return 0;
	}
    

	protected function filtrarInt($int){
		$int = (int) $int;
		if(is_int($int)){
			return $int;
		}else{
			return 0;
		}
	}
	
	protected function ObtenerCombo1($modelo,$where=false){
		$data = json_decode($modelo->crudData(array('tipo'=>'GET','operacion'=>'combo','parametros'=>array($where))));
		$combo  = "<select>";
		foreach($data as $registro){
			$combo .= "<option value = '".$registro->id."' >".$registro->descripcion."</option>";
		}
		$combo .= "</select>";
		echo $combo;
	}

	
	public function ObtenerCombo2($modelo,$id,$where=false,$tipo=false,$enable=false){
		$params=array('operacion'=>'combo','condicion'=>$where);
		$data = $modelo->crudData($params);	
		$data = json_decode($data,true);
		if ($enable){
			$combo  = "<select id='$id' name='$id' class='form-control' disabled >";
		}else{
			$combo  = "<select id='$id' name='$id' class='form-control' >";
		}
		//$combo  = "<select id='$id' name='$id' class='form-control'>";
		$combo .= "<option value = '0' selected='selected' class='elegir' >Elija una opción</option>";
		foreach($data as $registro){
			if($tipo){
				$combo .= "<option value = '".$registro['id']."' data-tipo='".$registro['tipo']."' >".$registro['descripcion']."</option>";
			}else{
				$combo .= "<option value = '".$registro['id']."' >".$registro['descripcion']."</option>";
			}
			
		}
		$combo .= "</select>";
		//echo $combo;
		return $combo;
	}		

	public function obtenerDatosCombo1($condicion=false){
		$condicion = rawurldecode($condicion);
		$data = $this->modelo->crudData(array('operacion'=>'combo','condicion'=>$condicion));
		$data=json_encode($data);
		echo $data;
	}	
		
	public function obtenerUTM($lat,$lon){
		$this->getLibrary("gpointconverter.class","gpoint");
		$gpconvert=new GpointConverter();
		$coor=$gpconvert->convertLatLngToUtm($lat,$lon );
		return $coor;
	}

	function cargarImagen($file,$directorio,$input,$nombre=false,$mini=false) {
		try{
			// Note: GD library is required for this function
	      $iWidth = 256;
	      $iHeight = 256;
	      $iJpgQuality = 90;
	      $iPngQuality = 5;
	      if ($file) {
	         // if no errors and size less than 250kb
	         if (! $file[$input]['error'] && $file[$input]['size'] < 1048576) {
	            if (is_uploaded_file($file[$input]['tmp_name'])) {
	               // new unique filename
	               if(!$nombre){
							$fName = md5(time().rand());
						}else{
							$fName = $nombre;
						}
	               
	               $sTempFileName = $directorio . $fName;
	               // move uploaded file into cache folder
	               
	               move_uploaded_file($file[$input]['tmp_name'], $sTempFileName);
	               list($ancho, $alto) = getimagesize($sTempFileName);
	               //change file permission to 644
	               //@chmod($sTempFileName, 0644);
	              	if (file_exists($sTempFileName) && filesize($sTempFileName) > 0) {
	                  $aSize = getimagesize($sTempFileName); // try to obtain image info
	                  if (!$aSize) {
	                      @unlink($sTempFileName);
	                      return;
	                  }
	                  // check for image type
	                  switch($aSize[2]) {
	                      case IMAGETYPE_JPEG:
	                          $sExt = '.jpg';
	                          // create a new image from file
	                          $vImg = @imagecreatefromjpeg($sTempFileName);
	                          break;
	                      case IMAGETYPE_PNG:
	                          $sExt = '.png';
	                          // create a new image from file
	                          $vImg = @imagecreatefrompng($sTempFileName);
	                          break;
	                      default:
	                          @unlink($sTempFileName);
	                          return;
	                  }
	                  
	                  // create a new true color image
	                  $vDstImg1 = @imagecreatetruecolor( $iWidth, $iHeight );
	                  imagealphablending($vDstImg1, false);
	     					imagesavealpha($vDstImg1, true);
	                  // copy and resize part of an image with resampling
	                  imagecopyresampled($vDstImg1, $vImg, 0, 0, 0, 0, $iWidth, $iHeight, $ancho,$alto);
	                  // define a result image filename
	                  $sResultFileName = $sTempFileName.'-max' . $sExt;
	                  $fName=$fName.'-max'.$sExt;
	                  // output image to file
	                  $response=imagepng($vDstImg1, $sResultFileName, $iPngQuality);
 							if($mini){
 								$vDstImg2 = @imagecreatetruecolor( 32, 32 );
								imagealphablending($vDstImg2, false);
	     						imagesavealpha($vDstImg2, true); 								
								imagecopyresampled($vDstImg2, $vImg, 0, 0, 0, 0, 32,32, $ancho,$alto);
								$sResultFileName = $sTempFileName.'-min' . $sExt;
								imagepng($vDstImg2, $sResultFileName, $iPngQuality);
							}	                  
	                  @unlink($sTempFileName);
	                  return $fName;
	              	}
	          	}
	         }
	      }			
		}catch(\Exception $e){
			$this->manejoErrores($e,FALSE);
		}
	}
	

}

?>