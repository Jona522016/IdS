var datosCombo_id_tipo_archivo;
var datosCombo_id_operador;
var gestor='';

function importaArchivo1(idRow){
	$("#jqgrid").jqGrid('setSelection', idRow);
	
	 $("#archivo1").fileinput('clear');
}
function importaArchivo2(idRow){
	$("#jqgrid").jqGrid('setSelection', idRow);
	 $("#archivo2").fileinput('clear');
}

function ver_archivo(carpeta,nombre){
	var link = base_url+"public/fotos/"+carpeta+"/"+nombre;
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
        ,uploadUrl: base_url+'proyectos/archivo_adjunto/cargarArchivo'
        ,uploadExtraData: function(){
        		idRow = grid.jqGrid ('getGridParam', 'selrow'),
        		registro=$("#jqgrid").jqGrid('getRowData', idRow);
				gestor=registro.correlativo_gestor;
        		return {id:$("#jqgrid").jqGrid('getGridParam', 'selrow'),objArchivo:'archivo1',gestor:gestor}
        	}
    });

   $("#archivo2").fileinput({
        showPreview: true
        ,showUpload: false
        ,elErrorContainer: '#kartik-file-errors'
        ,allowedFileExtensions: ["png","pdf","jpg"]
        ,language:"es"
 			,uploadUrl: base_url+'web/productos/cargarArchivo/H'
        ,uploadExtraData: function(){
        		return {id:$("#jqgrid").jqGrid('getGridParam', 'selrow'),objArchivo:'archivo2'}
        	}
    });    

	$("#upload_archivo1").click(function(){
		$("#archivo1").fileinput('upload');
	});	
	
	$("#upload_archivo2").click(function(){
		$("#archivo2").fileinput('upload');
	});		

	$("#cerrar_upload1").click(function(){
		jQuery('#jqgrid').trigger('reloadGrid');
	});	
	$("#cerrar_upload2").click(function(){
		jQuery('#jqgrid').trigger('reloadGrid');
	});
		

	
	
	var grid = $('#jqgrid');
	
	$.ajax({
		url: base_url+'proyectos/archivo_adjunto/obtenerCatalogos'
		,async: true
		,success: function(data) {
			datos=JSON.parse(data);
			datosCombo_id_tipo_archivo = datos.tipo_archivo.data;
			datosCombo_id_operador = datos.operador.data;
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
				url: base_url+'proyectos/archivo_adjunto/DataTable/id_archivo_adjunto'
				,editurl: base_url+"proyectos/archivo_adjunto/DataTableEdit/id_archivo_adjunto"
				,sortname: 'id_archivo_adjunto'
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
					,{	name:'id_archivo_adjunto'
						,index:'id_archivo_adjunto'
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
					,{	name:'importar_archivo'
						,index:'importar_archivo'
						,hidden:false
						,label:'Importar Archivo'
						,width:235
						,align:'center'
	     				,formatter: function(cellvalue, options, rowObject) {
	        				 return '<input type="button" class="btn btn-primary" data-toggle="modal" data-target="#importarModal1" value="Importar Archivo" onclick="importaArchivo1('+options.rowId+');"\>';
	        				 
	        			}
					}		
					,{	name:'ver_archivo'
						,index:'ver_archivo'
						,hidden:false
						,label:'Ver Archivo'
						,width:200
						,align:'center'
						,formatter: function(cellvalue, options, rowObject) {
							let archivo=rowObject[5]+'//'+rowObject[10];
							return '<input type="button" class="btn btn-primary" value="Ver Archivo" onclick="ver_archivo(\''+rowObject[5]+'\',\''+rowObject[10]+'\');"\>';
        				}					}											
					,{	name:'id_expediente'
						,index:'id_expediente'
						,editable:true
						,editoptions:{
							dataInit: function (element) {
								$(element).prop('id','id_expediente');
							}
						}						
						,hidden:true
					}	
					,{	name:'correlativo_gestor'
						,index:'correlativo_gestor'
						,label:'Correlativo Gestor'
						,width:185
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:12
							,maxlength:10
							,placeholder:'Gestor'
							,dataInit: function (element) {
								$(element).inputmask('9{1,4}-9{1,5}');	
								$(element).prop('id','correlativo_gestor');
							}
							,dataEvents:[{
								type:"blur"
								,fn:function(e){
									let cValor = $(e.target).val();
							   	let valores = cValor.split("-");
							   	let inicio = valores[0];
							     	let final  = valores[1];
							   	inicio=('0000' + inicio).substr(-4);
							      final=('00000' + final).substr(-5);
									valor_nuevo=inicio+'-'+final;  
									$(e.target).val(valor_nuevo); 
									$.ajax({
										url: base_url+'proyectos/expediente/obtenerExpedienteGestor/'+cValor+'/C'
										,async: false
										,method:'POST'
										,data:{correlativo_gestor: cValor}
										,success: function(data) {
											datos  = JSON.parse(datosProducto);
											$('#id_expediente').val(datos[0].id_expediente);
											$('#ficha_tecnica').val(datos[0].ficha_tecnica);		
										}
										,error: function(XMLHttpRequest, textStatus, errorThrown) {
											alert(textStatus);
										}
									});
									
									datos  = JSON.parse(datosProducto);
			
								
									
								}
							}]																				
						}
					}		
					,{	name:'ficha_tecnica'
						,index:'ficha_tecnica'
						,label:'Ficha Técnica'
						,width:225
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:16
							,maxlength:14
							,placeholder:'ID Ficha Tecnica'
							,dataInit: function (element) {
								$(element).inputmask('99-99-99-999[*]',{casing: "upper"});
								$(element).prop('id','ficha_tecnica');
							}
							,dataEvents:[{
								type:"blur"
								,fn:function(e){
									let cValor = $(e.target).val();
							   	let valores = cValor.split("-");
							   	let inicio = valores[0];
							     	let final  = valores[1];
							   	inicio=('0000' + inicio).substr(-4);
							      final=('00000' + final).substr(-5);
									valor_nuevo=inicio+'-'+final;  
									$(e.target).val(valor_nuevo); 
									$.ajax({
										url: base_url+'proyectos/expediente/obtenerExpedienteGestorFicha/'+cValor+'/F'
										,async: false
										,method:'POST'
										,data:{correlativo_gestor: cValor}
										,success: function(data) {
											datos  = JSON.parse(datosProducto);
											$('#id_expediente').val(datos[0].id_expediente);
											$('#correlativo_gestor').val(datos[0].correlativo_gestor);		
										}
										,error: function(XMLHttpRequest, textStatus, errorThrown) {
											alert(textStatus);
										}
									});
									
									datos  = JSON.parse(datosProducto);
			
								
									
								}
							}]									
						}
					}													

					,{ name:'fecha'
						,index:'fecha'
						,label:'Fecha '
						,width:150
						,align:"left"
						,datefmt:"dd/mm/yyyy"
						,formatter:"date"
						,formatoptions:{
							srcformat:"Y-m-d H:i:s"
							,newformat:"d/m/Y"
						}
						,sorttype:"date"
						,search:true
						,searchoptions:{
							sopt:['eq','ne','lt','le','gt','ge']
							,dataInit: function (element) {
								$(element).datepicker({
									id: 'fecha_datePicker1'
									,format: 'yyyy-mm-dd'
									,autoclose:true
									,language:'es'
								});
							}
						}
						,editable:false
						,edittype:"text"
						,editrules:{date:true}					
						,editoptions: {
							placeholder:'Fecha'
							,size:10
							,dataInit: function (element) {
								$(element).datepicker({
									id: 'fecha_datePicker2'
									,format: 'dd/mm/yyyy'
									,autoclose:true
									,language:'es'
								});
							}
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
							,cols:60
							,placeholder:"Observaciones"
						}
						,cellattr: function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' }
					}									
					,{	name:'archivo'
						,index:'archivo'
						,label:'Archivo'
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
							,placeholder:'Archivo'
						}
						,editrules:{
							required:true
						}
						,formoptions:{elmsuffix:'(*)'}
					}						
					,{	name:'id_tipo_archivo'
						,index:'id_tipo_archivo'
						,label:'Tipo de Archivo'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_tipo_archivo');
								return datos;
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_tipo_archivo');
								return datos;
							}
						}					
					}		
													

					,{	name:'id_operador'
						,index:'id_operador'
						,label:'Operador'
						,width: 150
						,align:"center"
						,formatter: formatCombo
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: function(){
								var datos=crearCombo('id_operador');
								return datos;
							}
							,sopt:['eq','ne']
						}					
						,editable:false
						,edittype:'select'
						,editoptions:{
							value: function(){
								var datos= crearCombo('id_operador');
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
