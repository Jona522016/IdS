var datosCombo_id_tipo_unidad_medida;
$(document).ready(function(){
	
	
	var grid = $('#jqgrid');
	
	$.ajax({
		url: base_url+'catalogos/unidad_medida/obtenerCatalogos'
		,async: true
		,success: function(data) {
			datos=JSON.parse(data);
			datosCombo_id_tipo_unidad_medida  = datos.tipo_unidad_medida.datos;
			generarGrid(grid);
			generarJqgridPager(grid);
		}
		,error: function(XMLHttpRequest, textStatus, errorThrown) {
			alert(textStatus);
		}
	});


	function generarGrid(grid){
		if( grid.length > 0 ) {
			grid.jqGrid({
				url: base_url+'catalogos/unidad_medida/DataTable/id_unidad_medida'
				,editurl: base_url+"catalogos/unidad_medida/DataTableEdit/id_unidad_medida"
				,sortname: 'id_unidad_medida'
				,shrinkToFit: true
				,autowidth:true
				,colModel:[
					{	name:'select'
						,label:' '
						,width:80
						,fixed:true
						,sortable:false
						,resize:false
						,formatter:"actions"
						,formatoptions:{
							keys: true
						}
					}
					,{	name:'id_unidad_medida'
						,index:'id_unidad_medida'
						,key:true
						,label:'ID'
						,align:"center"
						,width:80
						,searchoptions:{sopt:['eq','ne','lt','le','gt','ge']}
						,searchrules:{
							required:true
							,integer:true
						}
					}
					,{	name:'id_empresa'
						,index:'id_empresa'
						,hidden:true
					}				
					,{	name:'descripcion'
						,index:'descripcion'
						,label:'Descripcion'
						,width:300
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:50
							,maxlength:75
							,placeholder:'Descripcion'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'clave'
						,index:'clave'
						,label:'Clave'
						,width:250
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:50
							,maxlength:45
							,onblur:'javascript:this.value=this.value.toUpperCase();'
							,placeholder:'Clave'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}				
					,{	name:'id_tipo_unidad_medida'
						,index:'id_tipo_unidad_medida'
						,label:'Tipo Unidad de Medida'
						,width: 80
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_tipo_unidad_medida');
								return datos;
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_tipo_unidad_medida');
								return datos;
							}
						}					
					}					
					,{	name:'estado_registro'
						,index:'estado_registro'
						,label:'Estado'
						,width: 100
						,align:'center'
						,formatter: 'select'
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: {
								'A':'Activo'
								,'B':'Baja'
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: {
								'A':'Activo'
								,'B':'Baja'
							}
							,dataInit: function (element) {
								$(element).prop('id','estado_registro');
								$(element).prop('disabled',true);
							}						
						}					
					}								
				]
			});
		}
		
		resize_grid();
	}
}); 
