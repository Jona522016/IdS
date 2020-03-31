/***********************************/
/*    jQGrid Funciones Globales    */
/***********************************/

	jQuery.extend(jQuery.jgrid.defaults, {
		datatype:"json"
		,altRows:true 
		,mtype:"POST"
		,pager: 'jqgrid-pager'
		,ajaxSelectOptions: { contentType: 'application/json; charset=utf-8', dataType: 'json', type:"GET" }	
		,gridview:true
		,rowNum: 10
		,rowList: [10, 20, 30]
		,viewrecords: true
		,autowidth:false
		,height: 'auto'
		,headertitles:true
		,altRows:true	
		,sortorder: "asc"	
		,viewsortcols:[true,'vertical',true]
		,multiselect: true
		,multikey:'shiftkey'
		,responsive:true
	});

	jQuery.extend(jQuery.jgrid.edit,{
		reloadAfterSubmit:true
      ,afterSubmit: function (response, postdata){
			if(jQuery.parseJSON(response.responseText).estado  == 'error'){
				jAlert(jQuery.parseJSON(response.responseText).mensaje,'Alerta');
            return [false,null,null];
         }else{
				return [true,null,null];
         }
		}
	}); 
	
	jQuery.extend(jQuery.jgrid,{
		pager:
			"jqgrid-pager"
		
		,nav:{	
			edit:false
			,add:true
			,del:true
			,search:true
			,view:true
			,refresh:true
		}
	})

	$('#menu_switch1').bind('click', function() {
		if( $('#jqgrid').length > 0 ) {
			setTimeout(function(){
				var ancho=$('#jqgrid-wrapper').width()-2
			    $("#jqgrid").setGridWidth(ancho,true);
			},500)
		}	    
	})	
		
	$('#menu_switch').bind('click', function() {
		if( $('#jqgrid').length > 0 ) {
			setTimeout(function(){
				var ancho=$('#jqgrid-wrapper').width()-2
				var ancho_pantalla=screen.width
				var ancho_jqgrid=$("#jqgrid").width()
				if(ancho_jqgrid<ancho_pantalla){
					$("#jqgrid").setGridWidth(ancho,true);
				}else{
					$("#jqgrid").setGridWidth(ancho,false);
				}
			},500)
		}	    
	})

/*
	function resize_the_grid() {
		if( $('#jqgrid').length > 0 ) {
			$('#jqgrid').fluidGrid({example:'#jqgrid-wrapper', offset:-20});
		}
	}
*/

	function resize_grid() {
		if( $('#jqgrid').length > 0 ) {
			var ancho=$('#jqgrid-wrapper').width()-15;
			$("#jqgrid").setGridWidth(ancho,true);
		}
	}
	
	$(window).resize(resize_grid);

	$(window).on('resize.jqGrid', function() {
		$("#jqgrid").jqGrid('setGridWidth', $("#jqgrid-wrapper").width());
	})



	function obtenerDatosCombo(url){
		var datos;
		$.ajax({
			url: url
			,async: true
			,success: function(data) {
				datos=JSON.parse(data);
				return datos;
			}
			,error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
	}


	function formatCombo (cellvalue, options, rowObject){
		estado="";
		datos=eval("datosCombo_"+options.colModel.name)
		if(datos!=undefined){
			if (isNumber(cellvalue)){
				id=parseInt(cellvalue);
				if (id==-1||id==NaN){
					estado = 'Sin Datos';
				}else{
					if (datos.length>0){
						for(idx in datos){
							if (datos[idx].id==id){
								estado=datos[idx].descripcion;
								break;
							}else{
								estado= 'Sin Datos';
							}
						}
					}else{
						estado= 'Sin Datos';
					}
				}
			}else{
				estado = cellvalue
			}
		}
		return estado;
	}	

	function crearCombo(columna){
		//data=JSON.parse(eval("datosCombo_"+columna));
		data=eval("datosCombo_"+columna);
		var html = '', length = data.length,item1, item2;
		for (i=0; i < length; i++) {
			item1 = data[i].id;
			item2 = data[i].descripcion
			html += item1 + ":" + item2 ;
			if (i<length-1){
				html += ";"
			}
		}
		return html;
	};		


prmEdit = {
                    errorTextFormat: function(data) {
                     data.statusText + "'. Error code: " + data.status;
                    }
                };



function generarJqgridPager(grid,pager=false){
	var pager1='';
	if(!pager){
		pager1='#jqgrid-pager';
	}else{
		pager1=pager;
	}
	grid.jqGrid('navGrid'
		,pager1
		,{	edit:true
			,add:true
			,del:true
			,search:true
			,view:true
			,refresh:true
		}
		,{	
			closeAfterEdit:true
			,recreateForm: true
			,errorTextFormat: function(data) {
				alert(data);
         }
		}
		,{ 
			closeAfterAdd:true
			,recreateForm: true
			,width:525
		}			
		,{	
			width:350
		} 
		,{ 
			multipleSearch: true
		}
		,{ 
			width:500
		}
	);				
	
}
