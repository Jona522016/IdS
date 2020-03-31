var datosCombo_id_grupo;
/*
$.ajax({
	url: base_url+'entidad/tipo_menu/obtenerDatosComboBox'
	,async: false
	,success: function(data) {
		datos=JSON.parse(data);
		if(datos.estado=='ok'){
			datosCombo_id_grupo = datos.datos;
		}
	}
	,error: function(XMLHttpRequest, textStatus, errorThrown) {
		alert(textStatus);
	}
});
*/
$(document).ready(function(){
	
	var grid = $('#jqgrid');
	if( grid.length > 0 ) {
		grid.jqGrid({
			//Data
			datatype:"json"
			,mtype:"POST"
			,url: base_url+'entidades/entidad/DataTable/id_entidad'
			,editurl: base_url+'entidades/entidad/DataTableEdit/id_entidad'
			,ajaxSelectOptions: {contentType: "application/json", dataType: 'json', type:"GET" }
			,gridview:true
			//Navegacion
			,pager: 'jqgrid-pager'
			,rowNum: 10
			,rowList: [10, 20, 30]
			,viewrecords: true
			//Presentacion
			,autowidth:true
			,shrinkToFit: true
			,height: '100%'
			,headertitles:true
			//Orden
			,sortname: 'id_entidad'
			,sortorder: "asc"
			,multiSort:true
			,viewsortcols:[true,'vertical',true]
			//Multiseleccion
			,multiselect: true
			,multikey:'shiftkey'
			//Modelo de Datos		
			,colModel:[
				{	name:'select'
					,label:' '
					,width:70
					,fixed:true
					,sortable:false
					,resize:false
					,formatter:"actions"
					,formatoptions:{
						keys: true
					}
				}
				,{	name:'id_entidad'
					,index:'id_entidad'
					,label:'ID'
					,key:true
					,align:"center"
					,width:40
					,sorttype: "number"
					,searchoptions:{sopt:['eq','ne','lt','le','gt','ge']}
				}
				,{	name:'id_empresa'
					,index:'id_empresa'
					,hidden:true
				}				
				,{ name:'descripcion'
					,index:'descripcion'
					,label:'Descripcion'
					,width:200
					,formoptions:{elmsuffix:'(*)'}
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,editable:true
					,editoptions:{
						size:25
						,maxlength:75
						,placeholder:'Descripcion de la Entidad'
					}
					,editrules:{
						required:true
					}
					
				}
				,{ name:'usuario'
					,index:'usuario'
					,label:'Usuario'
					,align:"left"
					,width:150
					,formoptions:{elmsuffix:'(*)'}
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}					
					,editable:true
					,editoptions:{
						size:17
						,maxlength:50
						,placeholder:'Usuario del Sistema'
					}
					,editrules:{
						required:true
					}
										
				}
				,{ name:'clave_acceso'
					,index:'clave_acceso'
					,label:'Clave de Acceso'
					,align:"left"
					,width:200
					,formoptions:{elmsuffix:'(*)'}	
					,hidden:false
					,editable:true
					,editoptions:{
						size:25
						,maxlength:25
						,placeholder:'Clave de Acceso al Sistema'
						,type:'password'
					}
					,editrules:{
						required:true
					}
											
				}
				,{ name:'telefono'
					,index:'telefono'
					,label:'Telefono'
					,align:"left"
					,width:250
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,editable:true
					,editoptions:{
						size:21
						,maxlength:21
						,placeholder:'Telefono'
					}
				}				
				,{ name:'correo'
					,index:'correo'
					,label:'Correo Electrónico'
					,align:"left"
					,width:250
					,formatter:'email'
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,editable:true
					,editoptions:{
						size:34
						,maxlength:90
						,placeholder:'Correo Electronico'
					}
					,editrules:{
						required:true
						,email:true
					}
				}

				,{ name:'codigo'
					,index:'codigo'
					,label:'Codigo'
					,align:"left"
					,width:250
					,search:false
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,editable:true
					,editoptions:{
						size:25
						,maxlength:90
						,placeholder:'Codigo'
						,dataInit: function (element) {
							$(element).prop('disabled',true);
						}
					}
				}
				,{ name:'avatar'
					,index:'avatar'
					,label:'Avatar'
					,align:"left"
					,width:150
					,formoptions:{elmsuffix:'(*)'}
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}					
					,editable:true
					,editoptions:{
						size:17
						,maxlength:50
						,placeholder:'Avatar de Colaborador'
					}
				}								
				,{ name:'estado_registro'
					,index:'estado_registro'
					,label:'Estado'
					,align:"center"
					,width: 100
					,formatter: 'select'
					,search:true					
					,searchrules:{integer:true}
					,stype:'select'
					,searchoptions:{
						value: {
							'A':'Activo'
							,'B':'Baja'
							,'S':'Suspendido'
						}
						,sopt:['eq','ne']
					}					
					,editable:true
					,edittype:'select'
					,editoptions:{
						value: {
							'A':'Activo'
							,'B':'Baja'
							,'S':'Suspendido'
						}

					}			
				}
			]

		});
		

	grid.jqGrid('navGrid'
			,'#jqgrid-pager'
			,{	edit:true
				,add:true
				,del:true
				,search:true
				,view:true
				,refresh:true
			}
			,{	/*Edit*/
				width:500
				,closeAfterEdit:true
				,recreateForm: true
			}
			,{ /*Add*/
				closeAfterAdd:true
				,width:500
				,recreateForm: true
			}			
			,{	/*Delete*/
				width:350
			} 
			,{ /*Search*/
				multipleSearch: true
				/*,showQuery:true*/
			}
			,{ /*View*/
				width:500
			}
		);
		
	
	}

	$(window).on('resize.jqGrid', function() {
		$("#jqgrid").jqGrid('setGridWidth', $("#content").width());
	})
	
	
	$('#correo_usuario').blur(function(){
		if ($('#correo_usuario').attr("value").match(/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,4}$/)) {
			alert("Bien");
		}else{
			alert("No es una direccion de correo Valida");
		}	
	});
	

	
});