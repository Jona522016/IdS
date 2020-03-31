<?php
class entidadController extends Controller{
	public function __construct(){
		parent::__construct();
		$this->modelo = $this->loadModel('entidad','entidades');
		$this->modeloEmpresa = $this->loadModel('empresa','catalogos');
	}
	
	public function index(){
		$this->view->titulo = 'Catalogos';
		$this->view->subtitulo = 'Mantenimiento de Información';
		
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_ES'
			,'JQGRID_FLUID'
			,'JQUERY_INPUTMASK'
		));
		$this->view->setJs(array('usuarios-table'));		
		$this->view->rendering('usuarios');		
	}
	
	function DataTableEdit($idFila=false){
		$datos = $_POST;
		if (array_key_exists('id',$datos)){
			if ($datos['id']=="_empty"){
				$id="0";
			}else{
				$id = $datos['id'];	
			}
			unset($datos['id']);
		}else{
			$id = $datos[$idFila];
		}
		$operacion=$datos['oper'];
		unset($datos['oper']);
		unset($datos[$idFila]);
		$clave=$this->generarClave(md5($datos['clave_acceso']));
		$datos['clave_acceso']=$clave;
		$params=array('id'=>$id,'operacion'=>$operacion,'datos'=>$datos);
		$resultado = $this->modelo->cudData($params);
		//echo $resultado;
	}
	
		
	public function perfil_usuario(){
		$this->view->titulo = 'Usuarios';
		$this->view->descripcion = 'Mantenimiento del Perfil del Usuario';
		$this->view->setMainCss(array(
			'BOOTSTRAP_FILEINPUT'	
			,'JQUERY_CONFIRM'	
		));		
		$this->view->setMainJs(array(
			'JQUERY_INPUTMASK'
			,'BOOTSTRAP_EDITABLE'
			,'BOOTSTRAP_SELECT2'
			,'JQUERY_VALIDATE'
			,'JQUERY_VALIDATE_ES'
			,'JQUERY_VALIDATE_ADDS'	
			,'BOOTSTRAP_FILEINPUT'	
			,'BOOTSTRAP_FILEINPUT_ES'	
			,'FILEINPUT_PIEXIF' 
			,'FILEINPUT_SORTABLE' 
			,'FILEINPUT_PURIFY'
			,'BOOTSTRAP_PROGRESSBAR'
			,'JQUERY_CONFIRM'
		));
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
		if($resultado['status']=='ok' && $resultado['rows_count']>0){
			$this->view->usuario=$resultado['data'][0];
		}else{
			$data=array(
				'avatar'=>'user_avatar.png'
				,'profile_avatar'=>'profile_avatar.png'
				,'descripcion'=>'Usuario Desconocido'
			);
			$this->view->usuario=$data;
		}
		$this->view->setCss(array('perfil_usuario'));				
		$this->view->setJs(array('perfil_usuario'));		
		$this->view->rendering('perfil_usuario');		
	}
	
	public function datos_perfil_usuario(){
		$campo = $_POST['name'];
		$id = $_POST['pk'];
		$valor = $_POST['value'];
		if($campo=='clave_acceso'){
			$clave=$this->generarClave($valor);
			$datos['clave_acceso']=$clave;
		}else{
			$datos[$campo]=$valor;
		}
		$params=array('id'=>$id,'operacion'=>'edit','datos'=>$datos);
		$resultado = $this->modelo->cudData($params);
		echo json_encode($resultado);		
	}
	
	public function grabarImagenPerfil($id){
		try {
			$file=$_FILES;
			$perfil_avatar=$id.'-avatar';
			$imagen=$this->cargarImagen($_FILES,USUARIO_FILE.'img/','avatar-1',$perfil_avatar,true);
			$nombre=array('nombre'=>$imagen);
			///echo json_encode($nombre) ;
			$params=array('id'=>$id,'operacion'=>'edit','datos'=>array('avatar'=>$imagen));
			$resultado = $this->modelo->cudData($params);
			$resultado['data']=array('nombre_archivo'=>$imagen);
			echo json_encode($resultado);	
		}catch (\Exception $e) {
			$this->manejoErrores($e);
		}		
	}
	
 
	public function logout(){
		Session::destroy('autenticado');
		Session::destroy('id_usuario');
		Session::destroy('id_empresa');		
		Session::destroy();
		$this->Redireccionar();
	}
	
	public function autenticarUsuario(){
		$datos=$_POST;
		try{
			$clave=$this->generarClave($datos['clave_acceso']);
			$datos=array(
				'usuario'=>$_POST['usuario']
				,'clave_acceso'=>$clave
				,'id_empresa'=>$_POST['id_empresa']
			);
			
			$params=array(
				'operacion'=>'autenticarUsuario'
				,'prepare'=>TRUE
				,'datos'=>$datos
			);
			
			$resultado= $this->modelo->ejecutarQuery($params);
			
			$params=array(
				'operacion'=>'obtenerDatosEmpresa'
				,'prepare'=>true
				,'datos'=>array('id_empresa'=>$_POST['id_empresa'])
			);
			$resultado_empresa=$this->modeloEmpresa->ejecutarQuery($params);
			$empresa=array();
			if($resultado_empresa['status']=='ok' && $resultado_empresa['rows']>0){
				$empresa=$resultado_empresa['data'][0];
			}else{
				$data=array(
					'logo_encabezado'=>'logo_encabezado.png'
				);
				$empresa=$data;					
			}						
			
			if ($resultado['status']=='ok' && $resultado['rows']>0){
				Session::set('autenticado', true);
				Session::set('usuario', $resultado['data'][0]['descripcion']);
				Session::set('usuario_avatar', $resultado['data'][0]['avatar']);
				Session::set('usuario_profile_avatar', $resultado['data'][0]['avatar']);
				Session::set('id_usuario', $resultado['data'][0]['id']);
				Session::set('correo', $resultado['data'][0]['correo']);
				Session::set('id_empresa',$_POST['id_empresa']);
				Session::set('nombre_empresa',$_POST['empresa']);
				Session::set('logo_empresa',$empresa['logo']);
				Session::set('logo_encabezado_empresa',$empresa['logo_encabezado']);
				Session::set('rutas',true);
				Session::set('tiempo', time());
				
				Session::set('menu',[]);
			}
			echo json_encode($resultado);
		}catch(\Exception $e){
			$error['message']=$e->getMessage();
			$error['code']=$e->getCode();
			$error['file']=$e->getFile();
			$error['line']=$e->getLine();
		 	
		 	$response['status']='error';
		 	$response['message']=$e->getMessage();
		 	$response['data']=$error;
		 	echo json_encode($response);
		}

	}	
	
	public function restablecerClave(){
		$this->view->login = false;
		$this->view->dataTemplate[DEFAULT_LAYOUT]->body_class='';
		$this->view->dataTemplate[DEFAULT_LAYOUT]->wrapper_class='class="wrapper full-page-wrapper page-auth page-login text-center"';
		$params=array('id'=>'empresas');
		$this->view->empresas=$this->generarCombo($this->modeloEmpresa,$params);
		$this->view->setMainCss(array('JQUERY_CONFIRM'));
		$this->view->setMainJs(array('JQUERY_CONFIRM'));
		$this->view->setJs(array('restablecer'));		
		$this->view->Rendering('restablecer');		
	}	

	public function recuperarClave(){
		$this->view->login = false;
		$this->view->dataTemplate[DEFAULT_LAYOUT]->body_class='';
		$this->view->dataTemplate[DEFAULT_LAYOUT]->wrapper_class='class="wrapper full-page-wrapper page-auth page-login text-center"';
		$this->view->setMainCss(array('JQUERY_CONFIRM'));
		$this->view->setMainJs(array('JQUERY_CONFIRM'));
		$this->view->setJs(array('recuperar'));		
		$this->view->Rendering('recuperar');		
	}	
	
	public function obtenerDatosUsuario($id_usuario){
		try{
			$params=array('operacion'=>'obtenerDatosUsuario','condicion'=>'id_usuario='.$id_usuario);
			$resultado=$this->modelo->ejecutarQuery($params);
			echo json_encode($resultado);
		}catch(\Exception $e){
			$error['message']=$e->getMessage();
			$error['code']=$e->getCode();
			$error['file']=$e->getFile();
			$error['line']=$e->getLine();
		 	
		 	$response['status']='error';
		 	$response['message']=$e->getMessage();
		 	$response['data']=$error;
		 	echo json_encode($response);
		}
	}	
	
	public function generarClave($clave_acceso){
		try{
			$clave= Hash::getHash('sha1', $clave_acceso, HASH_KEY);
			return $clave;
		}catch (Exception $e) {
			$error['status']='error';
			$error['message']=$e->getMessage();
			$error['data']['code']=$e->getCode();
			$error['data']['file']=$e->getFile();
			$error['data']['line']=$e->getLine();
			echo json_encode($error);
		}
	}
	
	public function validarClave(){
		try{
			$clave=$this->generarClave($_POST['clave_acceso']);
			$datos=array(
				'clave_acceso'=>$clave
			);
			$params=array(
				'operacion'=>'validarClave'
				,'prepare'=>true
				,'datos'=>$datos
			);
			$resultado=$this->modeloEntidad->ejecutarQuery($params);
			echo json_encode($resultado);
		}catch (Exception $e) {
			$error['status']='error';
			$error['message']=$e->getMessage();
			$error['data']['code']=$e->getCode();
			$error['data']['file']=$e->getFile();
			$error['data']['line']=$e->getLine();
			echo json_encode($error);
		}

	}

	
		
	
}

?>