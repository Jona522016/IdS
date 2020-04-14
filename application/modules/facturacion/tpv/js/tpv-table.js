$(document).ready(function(){

	var grid1 = $('#jqgrid1');
	generarGrid1(grid1);
	generarJqgridPager(grid1,'#jqgrid-pager1');

	function generarGrid1(grid1){
		if( grid1.length > 0 ) {
			grid1.jqGrid({
				datatype:"local"
				,editurl:"clientArray"
				,sortname: 'id_operacion_detalle'
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
					,{	name:'id_operacion_detalle'
						,index:'id'
						,key:true
						,hidden:true
						,search:false
						,editable:false
					}					
					,{	name:'id_bodega'
						,index:'id_bodega'
						,key:true
						,label:'ID Bodega'
						,align:"center"
						,width:70
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'tipo_movimiento'
						,index:'tipo_movimiento'
						,key:true
						,hidden:true
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
					,{	name:'codigo_producto'
						,index:'codigo_producto'
						,key:true
						,label:'Codigo Producto'
						,align:"center"
						,width:100
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'unidades'
						,index:'unidades'
						,key:true
						,label:'Unidades'
						,align:"center"
						,width:80
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'valor_unitario'
						,index:'valor_unitario'
						,key:true
						,label:'Valor Unitario'
						,align:"center"
						,width:110
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'valor'
						,index:'valor'
						,key:true
						,label:'Valor'
						,align:"center"
						,width:110
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
					}
					,{	name:'valor_iva'
						,index:'valor_iva'
						,key:true
						,label:'Valor IVA'
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
