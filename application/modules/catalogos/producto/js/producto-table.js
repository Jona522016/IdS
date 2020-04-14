var datosCombo_id_tipo_archivo;
var datosCombo_id_operador;
var gestor='';

function importaArchivo1(idRow){
	$("#jqgrid").jqGrid('setSelection', idRow);
	
	 $("#archivo1").fileinput('clear');
}

function ver_archivo(nombre){
	var link = base_url+"public/fotos/productos/"+nombre;
	var ext = getFileExtension(nombre);
	if(ext=='docx' || ext=='xlsx' || ext=='doc' || ext=='xls'){
		var archivo = encodeURIComponent(link);
		$("#iframe-view").html("<iframe src='https://view.officeapps.live.com/op/embed.aspx?src="+archivo+"' width='100%' height='500px' frameborder='0'>This is an embedded <a target='_blank' href='http://office.com'>Microsoft Office</a> document, powered by <a target='_blank' href='http://office.com/webapps'>Office Online</a>.</iframe>")
	}else{
		$("#iframe-view").html('<iframe width="100%" height="600px" id="frame-view" src='+link+'></iframe>');
	}
	
	$("#myModal3").modal("show");						
}	

function getFileExtension(filename) {
  return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
}
	
$(document).ready(function(){
    $("#archivo1").fileinput({
        showPreview: true
        ,showUpload: false
        ,elErrorContainer: '#kartik-file-errors'
        ,allowedFileExtensions: ["png","pdf","jpg","xls","doc","xlsx","docx"]
        ,language:"es"
        ,uploadUrl: base_url+'catalogos/producto/cargarArchivo'
        ,uploadExtraData: function(){
        		idRow = grid.jqGrid ('getGridParam', 'selrow'),
        		registro=$("#jqgrid").jqGrid('getRowData', idRow);
				gestor="productos";
        		return {id:idRow,objArchivo:'archivo1',gestor:gestor}
        	}
    });    

	$("#upload_archivo1").click(function(){
		$("#archivo1").fileinput('upload');
	});	
	
	$("#cerrar_upload1").click(function(){
		jQuery('#jqgrid').trigger('reloadGrid');
	});		
	
	var grid = $('#jqgrid');
	
	$.ajax({
		url: base_url+'catalogos/producto/obtenerCatalogos'
		,async: true
		,success: function(data) {
			var datos = JSON.parse(data);
			datosCombo_id_bodega = datos.bodega.datos;
			datosCombo_id_marca = datos.marca.datos;
			datosCombo_id_modelo = datos.modelo.datos;
			datosCombo_id_tipo_producto = datos.tipo_producto.datos;
			datosCombo_id_categoria = datos.categoria.datos;
			datosCombo_id_clase = datos.clase.datos;
			datosCombo_id_medida = datos.medida.datos;
			datosCombo_id_operador = datos.operador.datos;
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
				url: base_url+'catalogos/producto/DataTable/id_producto'
				,editurl: base_url+"catalogos/producto/DataTableEdit/id_producto"
				,sortname: 'id_producto'
				,shrinkToFit: false
				,autowidth:false
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
					,{	name:'id_producto'
						,index:'id_producto'
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
						,search:false
						,editable:false
					}
					,{	name:'id_sucursal'
						,index:'id_sucursal'
						,hidden:true
						,search:false
						,editable:false
					}
					,{	name:'id_bodega'
						,index:'id_bodega'
						,label:'Bodega'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_bodega');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_bodega');
								return datos;
							}
						}					
					}
					,{	name:'codigo'
						,index:'codigo'
						,label:'Código'
						,width:250
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:40
							,maxlength:45
							,placeholder:'Código'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'fecha'
						,index:'fecha'
						,hidden:true
						,search:false
						,editable:false
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
					,{	name:'id_marca'
						,index:'id_marca'
						,label:'Marca'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_marca');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_marca');
								return datos;
							}
						}					
					}
					,{	name:'id_modelo'
						,index:'id_modelo'
						,label:'Modelo'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_modelo');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_modelo');
								return datos;
							}
						}					
					}
					,{	name:'precio'
						,index:'precio'
						,label:'Precio'
						,align:"center"
						,width:50
						,searchoptions:{sopt:['eq','ne','lt','le','gt','ge']}
						,searchrules:{
							required:true
							,float:true
						}
						,editable:true
					}
					,{	name:'id_tipo_producto'
						,index:'id_tipo_producto'
						,label:'Tipo Producto'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_tipo_producto');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_tipo_producto');
								return datos;
							}
						}					
					}
					,{	name:'id_categoria'
						,index:'id_categoria'
						,label:'Categoria'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_categoria');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_categoria');
								return datos;
							}
						}					
					}
					,{	name:'id_clase'
						,index:'id_clase'
						,label:'Clase'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_clase');
								return datos;
							}
							,sopt:['eq','ne']
						}
						,searchrules:{
							required:true
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_clase');
								return datos;
							}
						}					
					}
					,{	name:'id_medida'
						,index:'id_medida'
						,label:'Medida'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_medida');
								return datos;
							}
							,sopt:['eq','ne']
						}				
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_medida');
								return datos;
							}
						}					
					}
					,{	name:'tipo_producto'
						,index:'tipo_producto'
						,label:'Estado Producto'
						,width: 100
						,align:'center'
						,formatter: 'select'
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: {
								'T':'Terminado'
								,'P':'Por Preparar'
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: {
								'T':'Terminado'
								,'P':'Por Preparar'
							}						
						}					
					}
					,{	name:'imagen'
						,index:'imagen'
						,hidden:true
						,search:false
						,editable:false
					}		
					,{ name:'observaciones'
						,index:'observaciones'
						,label: 'Observaciones'
						,editable:true
						,align:"left"
						,width:400
						,searchoptions:{sopt:['bw','nb','ew','en','cn','nc']}
						,edittype:"textarea"
						,editoptions:{
							rows:5
							,cols:50
							,placeholder:"Observaciones"
						}
						,cellattr: function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' }
					}									
					,{	name:'descripcion_alternativa'
						,index:'descripcion_alternativa'
						,label:'Descripcion Alternativa'
						,width:410
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:50
							,maxlength:75
							,placeholder:'Descripción'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}
					,{	name:'id_operador'
						,index:'id_operador'
						,hidden:true
						,search:false
						,editable:false
					}
					,{	name:'existencia'
						,index:'existencia'
						,hidden:true
						,search:false
						,editable:false
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
					,{	name:'importar_archivo'
						,index:'importar_archivo'
						,hidden:false
						,label:'Importar imagen'
						,width:235
						,align:'center'
	     				,formatter: function(cellvalue, options, rowObject) {
	        				 return '<input type="button" class="btn btn-primary" data-toggle="modal" data-target="#importarModal1" value="Importar Archivo" onclick="importaArchivo1('+options.rowId+');"\>';
	        				 
	        			}
					}		
					,{	name:'ver_archivo'
						,index:'ver_archivo'
						,hidden:false
						,label:'Ver Imagen'
						,width:200
						,align:'center'
						,formatter: function(cellvalue, options, rowObject) {
							let archivo=rowObject[10];
							return '<input type="button" class="btn btn-primary" value="Ver Archivo" onclick="ver_archivo(\''+rowObject[16]+'\');"\>';
        				}
					}
				]
			});
		}
		
		resize_grid();
	}
}); 
