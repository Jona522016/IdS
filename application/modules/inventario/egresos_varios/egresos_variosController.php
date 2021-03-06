<?php
class egresos_variosController extends Controller {
	function __construct() {
		parent::__construct();
		$this->modelo = $this->loadModel('operacion_encabezado','inventario');	
		$this->modeloDetalle = $this->loadModel('operacion_detalle','inventario');	
		$this->modeloBodega = $this->loadModel('bodega','catalogos');	
		$this->modeloProducto = $this->loadModel('producto','catalogos');	
		$this->modeloTipoDocumento = $this->loadModel('tipo_documento','catalogos');	
		$this->modeloCategoriaOperacion = $this->loadModel('categoria_operacion','catalogos');	
		$this->modeloProveedor = $this->loadModel('proveedor','catalogos');		
	}
	
	public function index(){
	$this->view->titulo = 'Egresos Varios';
		$this->view->descripcion = 'Ingreso de la información de la Egreso';
		$this->view->setMainJs(array(
			'JQGRID'
			,'JQGRID_DEFAULT'
			,'JQGRID_ES'
			,'JQUERY_VALIDATE'
			,'JQUERY_VALIDATE_ADDS'
			,'JQUERY_VALIDATE_ES'
			,'JQUERY_ALERTS'
			,'JQUERY_INPUTMASK'
			,'BOOTSTRAP_DATEPICKER'
			,'BOOTSTRAP_DATEPICKER_ES'
			,'SELECT2'
/*			
			,'DROPZONE'
			,'FILEINPUT'
			,'FILEINPUT_ES'
			,'DATATABLES'
			,'DATATABLES_BUTTONS'
			,'DATATABLES_BUTTONS_FLASH'
			,'JSZIP'
			,'PDFMAKE'
			,'PDFMAKE_VFS'
			,'DATATABLES_BUTTONS_HTML5'
			,'DATATABLES_BUTTONS_PRINT'
			,'DATATABLES_COLVIS'
			,'DATATABLES_SELECT'
			,'DATATABLES_COLORDER'
			,'DATATABLES_RESPONSIVE'
*/			
		));
		$this->view->setMainCss(array(
			'JQUERY_ALERTS'
			,'SELECT2'
/*			
			,'FILEINPUT'
			,'DATATABLES'
			,'DATATABLES_BUTTONS'
			,'DATATABLES_SELECT'
			,'DATATABLES_COLORDER'			
*/	
		));
		$combo=$this->generarCombo($this->modeloTipoDocumento,array('id'=>'tipo_documento'));	
		$this->view->tipo_documento = $combo['combo'];	
		$combo=$this->generarCombo($this->modeloProveedor,array('id'=>'proveedor'));	
		$this->view->proveedor = $combo['combo'];
		$combo=$this->generarCombo($this->modeloBodega,array('id'=>'bodega'));	
		$this->view->bodega = $combo['combo'];
		$combo=$this->generarCombo($this->modeloProducto,array('id'=>'producto','tipo'=>'metadatos'),TRUE);	
		$this->view->producto = $combo['combo'];
		
		$this->view->setJs(array('egresos_varios-table','egresos_varios'));
		$this->view->rendering('egresos_varios');		
	}

	
	public function grabarEgreso(){
		$params=array('prepare'=>true,'operacion'=>'add','datos'=>$_POST['datosEncabezado']);
		$resultado=$this->modelo->cudData($params); //modelo = A operacion_encabezadoModel.php
		if($resultado['status']=='ok'){
			$id_encabezado=$resultado['id_row'];
		}else{
			$id_encabezado=0;
		}			
		$datos=$_POST['datosDetalle'];
			foreach($datos as $dato){
				$params=array('prepare'=>true,'operacion'=>'add','datos'=>$dato, 'encabezado'=> $id_encabezado);
				$resultado=$this->modeloDetalle->cudData($params); //modelo = A operacion_encabezadoModel.php
			}	
		echo json_encode($resultado);
		
	}
	
	public function generarCombo($modelo,$parametros,$especial=FALSE){
		try{
			if(isset($parametros['condicion'])){
				$params=array('operacion'=>'combo','condicion'=>$parametros['condicion'],'especial'=>$especial);
			}else{
				$params=array('operacion'=>'combo','especial'=>$especial);
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
							$combo .= "<option value = '".$registro['id']."' data-precio='".$registro['precio']."' data-codigo='".$registro['codigo']."' >".$registro['descripcion']."</option>";
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

	
	
	
}

