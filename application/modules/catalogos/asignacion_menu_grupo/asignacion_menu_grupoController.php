<?php
class asignacion_menu_grupoController extends Controller{

	public function __construct(){
		parent::__construct();
		$this->modelo=$this->loadModel('asignacion_menu_grupo','catalogos');
		$this->modeloMenu=$this->loadModel('menu','catalogos');
		$this->modeloGrupo=$this->loadModel('grupo','catalogos');
		
	}
	
	public function index(){
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_ES'
			,'JQUERY_INPUTMASK'
			,'JQUERY_ALERTS'
			,'BOOTSTRAP_DUAL_LISTBOX'
		));			
		$this->view->setMainCss(array(
			'BOOTSTRAP_DUAL_LISTBOX'
			,'JQUERY_ALERTS'
		));
		$combo=$this->generarCombo($this->modeloGrupo,array('id'=>'grupo'));	
		$this->view->grupo = $combo['combo'];	
		$combo=$this->generarCombo($this->modeloMenu,array('id'=>'menu','class'=>'bdual-list','multiple'=>'multiple','no_elegir'=>true));	
		$this->view->menu = $combo['combo'];	
		
		$this->view->setJs(array('asignacion_menu_grupo'));		
		$this->view->rendering('asignacion_menu_grupo');		
	}
	
	public function DataTable($id=false,$idrow=false){
		$get=$_REQUEST;
		$get['id']=$id;
		$search = filter_var($get['_search'], FILTER_VALIDATE_BOOLEAN);
		
		if ($search){
			$filtros = json_decode($_REQUEST['filters'],true);
			$filtros['rules'][]=array('field'=>'id_rol_entidad','op'=>'eq','data'=>$idrow);
			$filter=json_encode($filtros);
		}else{
			$filtros=array('groupOp'=>'AND','rules'=>array(array('field'=>'id_rol_entidad','op'=>'eq','data'=>$idrow)));
			$filter=json_encode($filtros);
			$get['_search']=true;
			$get['filters']=$filter;
		}				
		
		$getdata = $this->DataTableView($get,$this->modelo);
		echo json_encode($getdata);
	}

	public function DataTableEdit($id=false,$id_rol=false){
		$datos = $_POST;
		if (array_key_exists('id',$datos)){
			if ($datos['id']=="_empty"){
				$id="0";
			}else{
				$id = $datos['id'];	
			}
		}else{
			$id = $datos[$id];
		}
		$datos['id_rol_entidad']=$id_rol;
		$params=array('id'=>$id,'operacion'=>$datos['oper'],'datos'=>$datos);
		$resultado = $this->modelo->crudData($params);
		echo $resultado;
	}	
	
	public function grabar_datos($id=false){
		$datos = $_POST;
		$params=array('prepare'=>true,'operacion'=>'delreg','datos'=>array('id_grupo'=>$id));
		$resultado = $this->modelo->ejecutarQuery($params);
		foreach($datos as $dato){
			$params=array('operacion'=>'add','datos'=>$dato);
			$resultado = $this->modelo->cudData($params);
		}
		echo json_encode($resultado);
	}	


	public function obtener_datos($id=false){
		$datos = $_POST;
		$params=array('prepare'=>true,'operacion'=>'obtener_datos','datos'=>array('id_grupo'=>$id));
		$resultado = $this->modelo->ejecutarQuery($params);
		echo json_encode($resultado);
	}		



	
	
	
}
?>