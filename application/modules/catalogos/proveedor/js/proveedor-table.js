$(document).ready(function(){

	var grid = $('#jqgrid');
	generarGrid(grid);
	generarJqgridPager(grid);
	$('#init').trigger('click');

	function generarGrid(grid){
		if( grid.length > 0 ) {
			grid.jqGrid({
				url: base_url+'catalogos/proveedor/DataTable/id_proveedor'
				,editurl: base_url+"catalogos/proveedor/DataTableEdit/id_proveedor"
				,sortname: 'id_proveedor'
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
					,{	name:'id_proveedor'
						,index:'id_proveedor'
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
					,{	name:'id_sucursal'
						,index:'id_sucursal'
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
					,{	name:'telefono'
						,index:'telefono'
						,label:'Telefono'
						,width:250
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:50
							,maxlength:8
							,placeholder:'Telefono'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'correo'
						,index:'correo'
						,label:'Correo'
						,width:250
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:50
							,maxlength:100
							,placeholder:'Correo'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'observaciones'
						,index:'observaciones'
						,label:'Observaciones'
						,width:250
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,edittype:"textarea"
						,editoptions:{
							size:50
							,maxlength:100
							,placeholder:'Observaciones'
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