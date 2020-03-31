$(document).ready(function ()
{
	var correlativo = 0;
	
	$('#aceptar_detalle').prop('disabled', true)
	
	jQuery.validator.setDefaults({
		debug: false,
		success: "valid"
	});
	
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg !== value;
	}, "Debe seleccionar un item para continuar.");
	
	validacion=$("#frmEncabezado").validate({
		rules :{
			clave:{ required: true}
			,descripcion:{ required: true}				
		}
		,messages: { 
			clave:"Debe ingresar una clave para la Receta, un Alias" 
			,descripcion: "Debe ponerle un nombre a la Receta"		
		}
		,errorElement: "span"
		,errorClass: 'error-block'
		,highlight: function(element) { $(element).closest('div').addClass('has-error');
		$(element).prev('label').addClass('error-block');
	}
	,unhighlight: function(element) { $(element).closest('div').removeClass('has-error'); $(element).prev('label').removeClass('error-block'); }
	,errorPlacement : function(error, element) {
		error.insertAfter(element.parent());
	}	
});
	
	validacion1=$("#frmDetalle").validate({
		rules :{
			producto:{ required: true}
			,descripcion:{ required: true}
			,cantidad:{ valueNotEquals: "0" }
			,medida:{ required: true}					
		}
		,messages: {  
			producto: "Debe seleccionar un producto"
			,descripcion: "Debe ingresar una descripcion para el producto"
			,cantidad: "Debe ingresar un valor mayor que 0"
			,medida: "Debe seleccionar una opción"			
		}
		,errorElement: "span"
		,errorClass: 'error-block'
		,highlight: function(element) { $(element).closest('div').addClass('has-error');
		$(element).prev('label').addClass('error-block');
	}
	,unhighlight: function(element) { $(element).closest('div').removeClass('has-error'); $(element).prev('label').removeClass('error-block'); }
	,errorPlacement : function(error, element) {
		error.insertAfter(element.parent());
	}	
});
	
	$('#aceptar_encabezado').click(function(){
		var forma_valida = $("#frmEncabezado").valid();
		var datosDetalle = $("#jqgrid1").jqGrid("getRowData");
		if(forma_valida){
			var info = { 
				datosEncabezado:{
					clave:$("#clave").val()
					,descripcion:$("#descripcion").val()
					,observaciones:$("#observaciones").val()
					,oper:""
				}			
			};
			$.post(base_url+"catalogos/receta/grabarEncabezado",info,function( data ){
				respuesta = JSON.parse(data);
				if(respuesta["status"]== "error"){
					jAlert("Ha ocurrido un error" + respuesta["message"],'Informacion');				
				}else{
					jAlert("Encabezado no. " +respuesta["id_row"] +" Grabado con exto",'Informacion');
					$('#clave').prop('readonly', true);
					$('#descripcion').prop('readonly', true);
					$('#observaciones').prop('readonly', true);
					$('#correlativo').text(respuesta["id_row"]);
					correlativo = parseInt(respuesta["id_row"]);
				}
				
			});
		}else{
			validacion.focusInvalid();
		}
		
	});

	$("#agregar_producto").click(function(){
		var detalle_valido1 = $("#frmDetalle").valid();
		
		if(detalle_valido1){
			var rows = $("#jqgrid1")[0].rows
			var last = rows.length;
			var data = 	{
				"id_detalle_receta":last
				,"id_encabezado_receta":correlativo
				,"id_producto":$('#producto').val()
				,"descripcion":$("#descripcion").val()
				,"cantidad":$('#cantidad').val()
				,"id_medida":$("#medida").val()
				,"estado_registro":'A'
			}
			var filas= jQuery("#jqgrid1").jqGrid('getRowData');

			$("#jqgrid1").jqGrid('addRowData',last,data,'last')	
			++last;			
			
			document.getElementById("frmDetalle").reset(); 

			$("#jqgrid1").trigger('reloadGrid');
			$('#producto').val("");
			$("#descripcion").val("");
			$('#cantidad').val("");
			$("#medida").val("");
		}else{
			validacion1.focusInvalid();
		}
		if($("#jqgrid1").getGridParam('records')>0){
			$("#aceptar_detalle").prop('disabled', false)	
		}
	});

	$('#aceptar_detalle').click(function()
	{
		grid = $("#jqgrid1").jqGrid("getRowData");
		var info = {
			datosDetalle : grid
		};
		$.post(base_url+"catalogos/receta/grabarDetalle",info,function( data ){
			var respuesta = JSON.parse(data);
			if(respuesta["status"]== "ok"){
				jAlert(respuesta.message,'Informacion');
				location.reload();							
			}else{
				jAlert(respuesta.message,'Informacion');
			}
		});
	});
	
	//Detalle operaciones
	
	$("#clave").on("blur", function(){
		var texto = $("#clave").val();
		$("#clave").val(texto.toUpperCase());	
	});
	
});