var datosCombo_id_departamento;
$(document).ready(function(){

	var grid = $('#jqgrid');
	
	$.ajax({
		url: base_url+'catalogos/municipio/obtenerCatalogos'
		,async: true
		,success: function(data) {
			datos=JSON.parse(data);
			datosCombo_id_departamento = datos.departamento.datos;
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
				url: base_url+'catalogos/municipio/DataTable/id_municipio'
				,editurl: base_url+"catalogos/municipio/DataTableEdit/id_municipio"
				,sortname: 'id_municipio'
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
					,{	name:'id_municipio'
						,index:'id_municipio'
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
					,{	name:'id_departamento'
						,index:'id_departamento'
						,label:'Departamento'
						,width: 80
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_departamento');
								return datos;
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_departamento');
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
