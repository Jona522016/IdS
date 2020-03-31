$(document).ready(function(){

	var grid = $('#jqgrid');
	generarGrid(grid);
	generarJqgridPager(grid);
	$('#init').trigger('click');

	function generarGrid(grid){
		if( grid.length > 0 ) {
			grid.jqGrid({
				url: base_url+'catalogos/tipo_producto/DataTable/id_tipo_producto'
				,editurl: base_url+"catalogos/tipo_producto/DataTableEdit/id_tipo_producto"
				,sortname: 'id_tipo_producto'
				,shrinkToFit: false
				,colModel:[
					{	name:'select'
						,label:'Acciones '
						,width:80
						,fixed:true
						,sortable:false
						,resize:false
						,formatter:"actions"
						,formatoptions:{
							keys: true
						}
					}
					,{	name:'id_tipo_producto'
						,index:'id_tipo_producto'
						,key:true
						,label:'ID'
						,align:"center"
						,width:50
						,searchoptions:{sopt:['eq','ne','lt','le','gt','ge']}
						,searchrules:{
							required:true
							,integer:true
						}
					}
					,{	name:'id_empresa'
						,index:'id_empresa'
						,align:"center"
						,width:50
						,searchoptions:{sopt:['eq','ne','lt','le','gt','ge']}
						,searchrules:{
							required:true
							,integer:true
						}
						,editable:false
						,hidden:true
					}				
					,{	name:'descripcion'
						,index:'descripcion'
						,label:'Descripcion'
						,width:410
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:60
							,maxlength:75
							,placeholder:'Descripción'
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