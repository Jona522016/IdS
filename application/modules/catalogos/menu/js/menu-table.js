$(document).ready(function(){

	var grid = $('#jqgrid');
	generarGrid(grid);
	generarJqgridPager(grid);
	$('#init').trigger('click');

	function generarGrid(grid){
		if( grid.length > 0 ) {
			grid.jqGrid({
				url: base_url+'catalogos/menu/DataTable/id_menu'
				,editurl: base_url+"catalogos/menu/DataTableEdit/id_menu"
				,sortname: 'id_menu'
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
					,{	name:'id_menu'
						,index:'id_menu'
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
					,{	name:'nivel'
						,index:'nivel'
						,label:'Nivel'
						,width: 100
						,formatter: 'select'
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: {
								'1':'Primero'
								,'2':'Segundo'
								,'3':'Tercero'
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: {
								'1':'Primero'
								,'2':'Segundo'
								,'3':'Tercero'
							}
						}					
					}	
					,{	name:'link'
						,index:'link'
						,label:'Programa'
						,width:410
						,formoptions:{elmsuffix:'(*)'}
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:60
							,maxlength:75
							,placeholder:'Programa'
							,onblur:'javascript:this.value=this.value.toLowerCase();'
						}
						,editrules:{
							required:true
						}
					}
					,{	name:'patron'
						,index:'patron'
						,label:'Posición'
						,width:80
						,formoptions:{elmsuffix:'(*)'}
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:3
							,maxlength:3
							,placeholder:'Posición'
							,onblur:'javascript:this.value=this.value.toUpperCase();'
						}
						,editrules:{
							required:true
						}
					}
					,{	name:'tipo_imagen'
						,index:'tipo_imagen'
						,label:'Tipo de Imagen'
						,width: 80
						,formatter: 'select'
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: {
								'I':'Icono'
								,'G':'Imagen'
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: {
								'I':'Icono'
								,'G':'Imagen'
							}
						}					
					}						
					,{	name:'imagen'
						,index:'imagen'
						,label:'Imagen'
						,width:230
						,formoptions:{elmsuffix:'(*)'}
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,editoptions:{
							size:30
							,maxlength:50
							,placeholder:'Imagen'
						}
					}
					,{	name:'color'
						,index:'color'
						,label:'Color'
						,width:80
						,formoptions:{elmsuffix:'(*)'}
						,search:true
						,searchoptions:{sopt:['eq','ne','bw','bn','ew','en','cn','nc']}
						,searchrules:{
							required:true
						}						
						,editable:true
						,edittype:'text'
						,editoptions:{
							size:10
							,maxlength:10
							,placeholder:'Color'
							,dataInit: function (element) {
								/*/$(element).prop('id','color');
								$(element).spectrum({
									preferredFormat: "hex"
								});	
								*/
							}
						}
					}
					,{	name:'ayuda'
						,index:'ayuda'
						,label:'Texto de Ayuda'
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
							,placeholder:'Texto de Ayuda'
						}
						,formoptions:{elmsuffix:'(*)'}
					}					
					,{	name:'funcion'
						,index:'funcion'
						,label:'Funcion'
						,width: 100
						,formatter: 'select'
						,search:true					
						,stype:'select'
						,searchoptions:{
							value: {
								'C':'Comando'
								,'M':'Menu'
							}
							,sopt:['eq','ne']
						}					
						,editable:true
						,edittype:'select'
						,editoptions:{
							value: {
								'C':'Comando'
								,'M':'Menu'
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