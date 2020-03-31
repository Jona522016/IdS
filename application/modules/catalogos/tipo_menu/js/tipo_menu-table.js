$(document).ready(function(){
	
	var grid = $('#jqgrid');

	$('#tipo_menu').popover({
		container: 'body',
		placement: 'top',
		html: true,
		trigger: 'hover',
		title: '<i class="fa fa-book"></i> Ayuda',
		content: "Mantenimiento de los datos de los tipos de menus que se encuentran en el sistema."
	});	
	
	if( grid.length > 0 ) {
		grid.jqGrid({
			url: base_url+'catalogos/tipo_menu/DataTable/id_tipo_menu'
			,editurl: base_url+"catalogos/tipo_menu/DataTableEdit/id_tipo_menu"
			,pager: 'jqgrid-pager'
			,sortname: 'id_tipo_menu'
			,shrinkToFit: true
			,colModel:[
				{	name:'select'
					,label:'Acciones '
					,width:80
					,fixed:true
					,search:false
					,sortable:false
					,resize:false
					,formatter:"actions"
					,formatoptions:{
						keys: true
					}
				}
				,{	name:'id_tipo_menu'
					,index:'id_tipo_menu'
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
					,label:'Descripción'
					,width:300
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,searchrules:{
						required:true
					}						
					,editable:true
					,editoptions:{
						size:48
						,maxlength:45
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
					,width:200
					,search:true
					,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
					,searchrules:{
						required:true
					}						
					,editable:true
					,editoptions:{
						size:33
						,maxlength:30
						,placeholder:'Clave'
						,onblur:'javascript:this.value=this.value.toUpperCase();'
					}
					,editrules:{
						required:true
					}
					,formoptions:{elmsuffix:'(*)'}
				}				
				,{	name:'estado_registro'
					,index:'estado_registro'
					,label:'Estado'
					,width: 80
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
					}					
				}								
			]
			
		});
		
		generarJqgridPager(grid);
		
		resize_the_grid();
	}

});	
