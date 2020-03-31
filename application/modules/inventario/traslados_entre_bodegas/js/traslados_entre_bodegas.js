$(document).ready(function ()
{	
	$('#producto').select2();
	
	$('#fecha').inputmask("date");

	$('#fecha').datepicker({
		id: 'fecha1'
		,format: 'dd/mm/yyyy'
		,autoclose:true
		,language:'es'
	});
	
	jQuery.validator.setDefaults({
		debug: false,
		success: "valid"
	});
	
	$.validator.addMethod("valueNotEquals", function(value, element, arg){
		return arg !== value;
	}, "Debe seleccionar un item para continuar.");

	validacion=$("#frmEncabezado").validate({
		rules :{
			tipo_documento:{ required: true}
			,fecha:{ required: true}
			,serie:{ required: true}
			,numero:{ valueNotEquals: "0" }	
			,proveedor:{ required: true }	

		}
		,messages: { 
			fecha:"Debe ingresar la fecha del documento" 
			,tipo_documento: "Debe seleccionar un tipo de documento"
			,proveedor: "Debe seleccionar un proveedor"
			,serie: "Debe ingresar la serie del documento"
			,numero: "Debe ingresar el numero del documento"			
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
			bodega:{ required: true}
			,producto:{ required: true}
			,codigo_producto:{ required: true}
			,unidades:{ valueNotEquals: "0" }	
			,valor:{ valueNotEquals: "0" }

		}
		,messages: { 
			bodega:"Debe seleccionar una bodega de ingreso" 
			,producto: "Debe seleccionar un producto"
			,codigo_producto: "Debe ingresar el código del producto"
			,unidades: "Debe ingresar un valor mayor que 0"
			,valor: "Debe ingresar el monto"			
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

	$("#agregar_producto").click(function(){
		var detalle_valido1 = $("#frmDetalle").valid();
		
		if(detalle_valido1){
			var rows = $("#jqgrid1")[0].rows
			var last = rows.length;
			var rows1 = $("#jqgrid2")[0].rows
			var last1 = rows1.length;
			var data1 = 	{
				"id_operacion_detalle":last
				,"id_bodega":$("#bodegaI").val()
				,"tipo_movimiento":'I'
				,"id_producto":$('#producto').val()
				,"codigo_producto":$("#producto").find(':selected').attr("data-codigo")
				,"unidades":$('#unidades').val()
				,"valor_unitario":$("#producto").find(':selected').attr("data-precio")
				,"valor":calcular(0)
				,"valor_iva":calcular(1)
				,"estado_registro":'A'
			}
			var data2 = 	{
				"id_operacion_detalle":last1
				,"id_bodega":$("#bodegaE").val()
				,"tipo_movimiento":'E'
				,"id_producto":$('#producto').val()
				,"codigo_producto":$("#producto").find(':selected').attr("data-codigo")
				,"unidades":$('#unidades').val()
				,"valor_unitario":$("#producto").find(':selected').attr("data-precio")
				,"valor":calcular(0)
				,"valor_iva":calcular(1)
				,"estado_registro":'A'
			}
			var filas= jQuery("#jqgrid1").jqGrid('getRowData');

			$("#jqgrid1").jqGrid('addRowData',last,data1,'last')	
			++last;			

			var filas= jQuery("#jqgrid2").jqGrid('getRowData');

			$("#jqgrid2").jqGrid('addRowData',last1,data2,'last')	
			++last1;
			document.getElementById("frmDetalle").reset(); 

			$("#jqgrid1").trigger('reloadGrid');
			$("#bodega").val("");
			$('#producto').val("");
			$("#codigo_producto").val("");
			$('#unidades').val("");
			$("#valor_unitario").val("");
			$('#valor').val("");
			$("#valor_iva").val("");
			
		}else{
			validacion1.focusInvalid();
		}
		if($("#jqgrid1").getGridParam('records')>0){
			$("#aceptar_detalle").prop('disabled', false)	
		}
	});

	$('#aceptar').click(function(){
		var forma_valida = $("#frmEncabezado").valid();
		var datosDetalle = $("#jqgrid1").jqGrid("getRowData");
		if(forma_valida){
			grid = $("#jqgrid1").jqGrid("getRowData");
			grid1 = $("#jqgrid2").jqGrid("getRowData");
			var info = { 
				datosEncabezado:{
					id_tipo_documento:$("#tipo_documento").val()
					,fecha:$("#fecha").val()
					,serie:$("#serie").val()
					,numero:$("#numero").val()
					,observaciones:$("#observaciones").val()
					,id_categoria_operacion:"5"
					,oper:""
				}
				,datosDetalleIngreso : grid			
				,datosDetalleEgreso : grid1		
			};
			$.post(base_url+"inventario/traslados_entre_bodegas/grabarTraslado",info,function( data ){
				respuesta = JSON.parse(data);
				if(respuesta["status"]== "error"){
					jAlert("Ha ocurrido un error" + respuesta["message"],'Informacion');				
				}else{
					jAlert('Se ha registrado el Ingreso de forma exitosa','Informacion');
					location.reload();							
				}
				
			});
		}else{
			validacion.focusInvalid();
		}
		
	});
	
	//Detalle operaciones
	
	function calcular (num)
	{
		var valorUnitario = parseFloat($("#producto").find(':selected').attr("data-precio"));
		var unidades = $("#unidades").val();
		var valor = parseFloat(valorUnitario*unidades);
		var valorIVA = 	parseFloat(valor*0.12);	
		if (num==0)
			return valor.toFixed(2);
		else
			return valorIVA.toFixed(2);
		
	} 	
	
});