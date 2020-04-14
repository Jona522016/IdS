<?php
class adminTemplate extends MainClass {
	
	public $rutas;
	public $plantilla = ADMIN_LAYOUT;
	public $body_class ='';
	public $wrapper_class='';
	public $maincss;
	public $mainjs;
	public $tipo_template='admin';
	public $config;
	
	public function __construct() {
		try{
			$this->maincss=array(
				'SELECT2'
				,'BOOTSTRAP'
				,'FONT_AWESOME' 
				,'MAIN' 
				,'MY_STYLES'
				,'MAIN_IE_1'
				,'MAIN_IE_2'
				,'SKINS'
			);		
			$this->mainjs=array(
				'JQUERY'
				,'LISTENER_PASIVE'
				,'BOOTSTRAP' 
				,'MODERNIZR'
				,'SLIMSCROLL' 
				,'KING_COMMON' 	
				,'MY_SCRIPTS'			
				
			);
			
			
			
		} catch (\Exception $e) {
			$this->manejoErrores($e);
		}
	}
	
	
	public function rutas(){
		$rutas = array(
			'ruta_css' =>  BASE_URL . 'layout/'.$this->plantilla.'/assets/css/'
			,'ruta_fonts'  => BASE_URL . 'layout/'.$this->plantilla.'/assets/fonts/'
			,'ruta_img' => BASE_URL . 'layout/'.$this->plantilla.'/assets/img/'
			,'ruta_ico'=> BASE_URL . 'layout/'.$this->plantilla.'/assets/ico/'
			,'ruta_js'  => BASE_URL . 'layout/'.$this->plantilla.'/assets/js/'
			,'ruta_plugins'=> BASE_URL . 'layout/'.$this->plantilla.'/assets/js/plugins/'
			,'ruta_my_plugins'=> BASE_URL . 'layout/plugins/'
			,'ruta_template' => BASE_URL . 'layout/' . $this->plantilla . '/'		
		);
		return $rutas;
	}	
	
	public function configuracionInicialLogin(){


	}
	
	public function Config($opcion){
		switch($opcion){
			case 'autenticado':
			$this->body_class ='class="sidebar-fixed topnav-fixed"';
			$this->wrapper_class='class="wrapper"';

			break;
			case 'login';
			$this->body_class ='';
			$this->wrapper_class='class="wrapper full-page-wrapper page-auth page-login text-center"';
			default:
			break;
		}
	}
	
	public function getMainCss(){
		$rutas=$this->rutas();
		$css= array(
			'BOOTSTRAP' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'bootstrap.min.css')
			,'FONT_AWESOME' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'font-awesome.min.css')
			,'SELECT2' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'select2/select2.min.css')
			,'MAIN' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'main.css')
			,'SKINS' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'skins/blue.css')
			,'MY_STYLES' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'my_styles.css') 
			,'MAIN_IE_1' => array('tipo'=>'CSS','nav'=>'IE9','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'main-ie.css')	
			,'MAIN_IE_2' => array('tipo'=>'CSS','nav'=>'IE9','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_css'].'main-ie-part2.css')	
			,'JQUERY_CONFIRM' =>array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=> $rutas['ruta_my_plugins'].'jquery_confirm/jquery-confirm.min.css')
			,'JQUERY_ALERTS' =>array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=> $rutas['ruta_my_plugins'].'jquery_alerts/jquery.alerts.css')
			,'JQGRID' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid/css/ui.jqgrid.css')
			,'JQGRID_UI' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid/css/ui.jqgrid-bootstrap-ui.css')
			,'BOOTSTRAP_FILEINPUT' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-fileinput/css/fileinput.min.css')
			,'COLOR_PICKER' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'spectrum/spectrum.css')		
			,'BOOTSTRAP_DATEPICKER' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_plugins'].'my_bootstrap-datepicker/css/bootstrap-datepicker.min.css')
			,'BOOTSTRAP_DUAL_LISTBOX' => array('tipo'=>'CSS','nav'=>'ALL','ubicacion'=>'HEADER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-duallistbox/bootstrap-duallistbox.min.css')										
		);	
		return $css;
	}	

	public function getMainJs(){
		$rutas=$this->rutas();
		$js=array(
			'JQUERY' =>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_js'].'jquery/jquery-2.1.0.js')
			,'JQUERY_UI' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_js'].'jquery-ui/jquery-ui-1.10.4.custom.min.js')
			,'BOOTSTRAP_TOUR' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'bootstrap-tour/bootstrap-tour.custom.js')
			,'PRUEBA' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_js'].'king-chart-stat.js')
			,'STAT_PIE_CHART' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/jquery.easypiechart.min.js')
			,'INTERFACE_BARRAS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'my_codigo_barras/interface.js')
			,'BARRAS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'my_codigo_barras/bardecode-worker.js')
			,'FLOT' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.min.js')
			,'FLOT_PIE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.pie.min.js')
			,'FLOT_RESIZE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.resize.min.js')
			,'FLOT_TOOLTIP' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.tooltip.min.js')
			,'FLOT_TIME' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.time.min.js')
			,'FLOT_SELECTION' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'stat/flot/jquery.flot.selection.min.js')
			,'BOOTSTRAP' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_js'].'bootstrap/bootstrap.min.js')
			,'MODERNIZR' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'modernizr/modernizr.js')
			,'KING_COMMON' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_js'].'king-common.js')
			,'MY_SCRIPTS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'my_scripts.js')
			,'SELECT2' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'select2/select2.min.js')
			,'LISTENER_PASIVE'=>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'event_listener_pasive/index.js')
			,'JQUERY_CONFIRM' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jquery_confirm/jquery-confirm.min.js')
			,'JQUERY_INPUTMASK' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'inputmask/jquery.inputmask.bundle.js'	)
			,'DROPZONE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'dropzone/dropzone.min.js'	)
			,'JQUERY_VALIDATE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jquery-validate/jquery.validate.min.js')
			,'JQUERY_VALIDATE_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jquery-validate/localization/messages_es.min.js')
			,'JQUERY_VALIDATE_ADDS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jquery-validate/additional-methods.min.js')
			,'JQUERY_ALERTS' =>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jquery_alerts/jquery.alerts.js')
			,'EVENT_LISTENER_PASSIVE'=>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'event_listener_pasive/index.js')
			,'BOOTSTRAP_EDITABLE'=>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'bootstrap-editable/bootstrap-editable.min.js')
			,'BOOTSTRAP_SELECT2'=>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'select2/select2.min.js')
			,'BOOTSTRAP_FILEINPUT' =>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=> $rutas['ruta_my_plugins'].'bootstrap-fileinput/js/fileinput.min.js')
			,'BOOTSTRAP_FILEINPUT_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-fileinput/js/locales/es.js')
			,'FILEINPUT_PIEXIF' =>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=> $rutas['ruta_my_plugins'].'bootstrap-fileinput/js/plugins/piexif.min.js')
			,'FILEINPUT_SORTABLE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-fileinput/js/plugins/sortable.min.js')
			,'FILEINPUT_PURIFY' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-fileinput/js/plugins/purify.min.js')
			,'JQGRID' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid/js/jquery.jqGrid.min.js')
			,'JQGRID_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid/js/i18n/grid.locale-es.js')
			,'JQGRID_FLUID' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid/js/jquery.jqGrid.fluid.js'	)
			,'JQGRID_DEFAULT' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'jqgrid.js')	
			,'BOOTSTRAP_PROGRESSBAR'=> array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'bootstrap-progressbar/bootstrap-progressbar.min.js'	)
			,'DATATABLES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/media/js/jquery.dataTables.js')
			,'DATATABLES_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/ruta_plugins/i18n/Spanish.lang')
			,'DATATABLES_BUTTONS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Buttons/js/dataTables.buttons.js')
			,'DATATABLES_BUTTONS_FLASH' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Buttons/js/buttons.flash.js')
			,'DATATABLES_BUTTONS_HTML5' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Buttons/js/buttons.html5.js')
			,'DATATABLES_BUTTONS_PRINT' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Buttons/js/buttons.print.js')
			,'DATATABLES_RESPONSIVE' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Responsive/js/dataTables.responsive.js')
			,'DATATABLES_SELECT' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Select/js/dataTables.select.min.js')
			,'DATATABLES_COLVIS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/Buttons/js/buttons.colVis.js')
			,'DATATABLES_COLORDER' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/ColReorder/js/dataTables.colReorder.min.js')
			,'DATATABLES_TOOLS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/dataTables.tableTools.js')
			,'DATATABLES_BOOTSTRAP' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/media/js/dataTables.bootstrap.js')
			,'DATATABLES_SWF' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'my_datatable/extensions/swf/copy_csv_xls_pdf.swf')
			,'JSZIP'  => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'jszip/jszip.min.js')
			,'PDFMAKE'  => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'pdfmake/pdfmake.min.js')
			,'PDFMAKE_VFS'  => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'pdfmake/vfs_fonts.js')
			,'GAUGE_JS'	=> array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'gauje.js/dist/gauge.js'	)	
			,'PROGRESS_BAR'	=> array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'bootstrap-progressbar/bootstrap-progressbar.min.js'	)
			,'FASTCLICK' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'fastclick/lib/fastclick.js')
			,'BOOTSTRAP_DATEPICKER' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'my_bootstrap-datepicker/bootstrap-datepicker.min.js')			
			,'BOOTSTRAP_DATEPICKER_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'my_bootstrap-datepicker/locales/bootstrap-datepicker.es.js')
			,'N_PROGRESS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'nprogress/nprogress.js')
			,'CHART_JS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'Chart.js/dist/Chart.min.js')
			,'I_CHECK' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'iCheck/icheck.min.js')
			,'SKYCONS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'skycons/skycons.js')
			,'DATE_JS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'DateJS/build/date.js')
			,'JQVMAP' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=> $rutas['ruta_plugins'].'jqvmap/dist/jquery.vmap.js')
			,'JQVMAP_MAPS' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'jqvmap/dist/maps/jquery.vmap.world.js')
			,'BOOTSTRAP_DATERANGEPICKER'=>array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'bootstrap-daterangepicker/daterangepicker.js')
			,'MOMENT' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'moment/min/moment.min.js')
			,'SLIMSCROLL' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_plugins'].'jquery-slimscroll/jquery.slimscroll.min.js')
			,'MD5' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'md5/md5.min.js')			
			,'COLOR_PICKER' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'spectrum/spectrum.js')			
			,'COLOR_PICKER_ES' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'spectrum/i18n/jquery.spectrum-es.js')		
			,'BOOTSTRAP_DUAL_LISTBOX' => array('tipo'=>'JS','nav'=>'ALL','ubicacion'=>'FOOTER','ruta'=>$rutas['ruta_my_plugins'].'bootstrap-duallistbox/jquery.bootstrap-duallistbox.min.js')														
		);
return $js;
}   

public function setMainMenu($data){
	$html='';
	$html.= '<nav class="main-nav"><ul class="main-menu">';
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
				if ($value["patron"] == 'A') :
					$html.= '<li id="opm'.$value['id_menu'].'" data-id="opm'.$value['id_menu'].'">';
				else :
					$html.= '<li id="opm'.$value['id_menu'].'" data-id="opm'.$value['id_menu'].'">';;
				endif ;
				if ($value["funcion"] == 'M' and $data_menu[$reg]["nivel"] == 2 and $key<=count($data)-1)  :
					$html.= '<a href="'.BASE_URL.$value["link"].'" class="js-sub-menu-toggle">';
					$html.= '<i class="fa fa-'.$value["imagen"].' fa-fw"></i>';
					$html.= '<span class="text">'.$value["descripcion"].'</span>';
					$html.= '<i class="toggle-icon fa fa-angle-left"></i>';
					$html.= '</a>';
					$html.= '<ul class="sub-menu">';
				else :
					$html.= '<a href="'.BASE_URL.$value["link"].'">';
					$html.= '<i class="fa fa-'.$value["imagen"].' fa-fw"></i>';
					$html.= '<span class="text">'.$value["descripcion"].'</span>';
					$html.= '</a></li>';
				endif ;								
				break;
				case 2:
				$html.= '<li id="opm'.$value['id_menu'].'" data-id="opm'.$value['id_menu'].'">';;
				if ($value["funcion"] == 'M' and $data_menu[$reg]["nivel"] == 3) : 
					$html.= '<a href="'.BASE_URL.$value["link"].'" class="js-sub-menu-toggle">';
					$html.= '<i class="fa fa-'.$value["imagen"].' fa-fw"></i>';
					$html.= '<span class="text">'.$value["descripcion"].'</span>';
					$html.= '<i class="toggle-icon fa fa-angle-left"></i>';
					$html.= '</a>';
					$html.= '<ul class="sub-menu">';
				else :
					$html.= '<a href="'.BASE_URL.$value["link"].'">';
					$html.= '<i class="fa fa-'.$value["imagen"].' fa-fw"></i>';
					$html.= '<span class="text">'.$value["descripcion"].'</span>';
					$html.= '</a>';
				endif ;	

				if ($reg<=count($data_menu)-1) :
					switch($data_menu[$reg]["nivel"]){
						case 1: 
						$html.= '</li></ul>';
						break;
						case 2:
						$html.= '</li>';
						break;
						case 3: 
						$html.= '<!--</ul></li>-->';
						break;									
					}
				endif;

				break;
				case 3: 
				$html.= '<li id="opm'.$value['id_menu'].'" data-id="opm'.$value['id_menu'].'">';
				$html.= '<a href="'.BASE_URL.$value["link"].'">';
				$html.= '<i class="fa fa-'.$value["imagen"].' fa-fw"></i>';
				$html.= '<span class="text">'.$value["descripcion"].'</span>';
				$html.= '</a>';

				if ($reg<=count($data_menu)-1) :
					switch($data_menu[$reg]["nivel"]){
						case 1:
						$html.= '</li></ul>';
						break;
						case 2:
						$html.= '</li></ul>';
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
	$html.= '</ul></ul></nav>';
	echo $html;
}
}	
?>