$(document).ready(function(){

	var grid1 = $('#jqgrid1');
	generarGrid1(grid1);
	generarJqgridPager(grid1,'#jqgrid-pager1');

	function generarGrid1(grid1){
		if( grid1.length > 0 ) {
			grid1.jqGrid({
				datatype:"local"
				,editurl:"clientArray"
				,sortname: 'id_detalle_receta'
				,shrinkToFit: true
				,autowidth:true
				,pager: 'jqgrid-pager1'
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
					,{	name:'id_detalle_receta'
						,index:'id'
						,key:true
						,hidden:true
						,search:false
						,editable:false
					}					
					,{	name:'id_encabezado_receta'
						,index:'id_encabezado_receta'
						,key:true
						,label:'ID Encabezado'
						,align:"center"
						,width:90
						,search:false
						,editable:false
					}
					,{	name:'id_producto'
						,index:'id_producto'
						,key:true
						,label:'ID Producto'
						,align:"center"
						,width:80
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'descripcion'
						,index:'descripcion'
						,key:true
						,label:'Descripcion'
						,align:"center"
						,width:100
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'cantidad'
						,index:'cantidad'
						,key:true
						,label:'Cantidad'
						,align:"center"
						,width:80
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'id_medida'
						,index:'id_medida'
						,key:true
						,label:'ID Medida'
						,align:"center"
						,width:110
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
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
