$(document).ready(function(){

	var grid = $('#jqgrid');
	generarGrid(grid);
	generarJqgridPager(grid);

	function generarGrid(grid){
		if( grid.length > 0 ) {
			grid.jqGrid({
				url: base_url+'catalogos/empresa/DataTable/id_empresa'
				,editurl: base_url+"catalogos/empresa/DataTableEdit/id_empresa"
				,sortname: 'id_empresa'
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
					,{	name:'id_empresa'
						,index:'id_empresa'
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
					,{	name:'logo'
						,index:'logo'
						,label:'Logo'
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
							,placeholder:'Logo'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'logo_encabezado'
						,index:'logo_encabezado'
						,label:'Logo Encabezado'
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
							,placeholder:'Logo de Encabezado'
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
