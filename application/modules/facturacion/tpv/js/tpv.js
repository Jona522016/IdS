jQuery.validator.setDefaults({
	debug: false,
	success: "valid"
});

$.validator.addMethod("valueNotEquals", function(value, element, arg){
	return arg !== value;
}, "Debe seleccionar un item para continuar.");


document.getElementById('barcode_file').onchange = function(e) {
	var interface = new Interface(base_url+'layout/plugins/my_codigo_barras/bardecode-worker.js');
//Editar salida
interface.on_stdout = function(x) { 
	var a = x.split(' ');
	$("#producto option[value="+ a[0] +"]").attr("selected",true);
	$("#modal").modal('hide');
};
interface.on_stderr = function(x) { console.log(x); };
var file = e.target.files[0];
var reader = new FileReader();

reader.onload = function(ev) {
	interface.addData(ev.target.result, '/barcode.jpg').then(function() {
		interface.run('/barcode.jpg').then(function() { console.log(arguments); });
	})
};
reader.readAsBinaryString(file);
};	

$(document).ready(function ()
{	


	$("#producto").prop('disabled', true);

	$('#barras').click(function() {
		$("#modal").modal('show');
	});


	var d = new Date();
	$('#fecha').val(d.getUTCDate()+'/'+(d.getMonth()+1)+'/'+d.getFullYear());
	$.post(base_url+"facturacion/tpv/generarCorrelativo",function( data ){
		respuesta = JSON.parse(data);
		if(respuesta["status"]== "error"){
			console.log("Ha ocurrido un error" + respuesta["message"],'Informacion');				
		}else{
			$('#serie').val('A')
			$('#numero').val(parseInt(respuesta.data[0].correlativo)+1)							
		}

	});

	validacion1=$("#frmDetalle").validate({
		rules :{
			bodega:{ required: true}
			,producto:{ required: true}
			,unidades:{ valueNotEquals: "0" }

		}
		,messages: { 
			bodega:"Debe seleccionar una bodega de ingreso" 
			,codigo_producto: "Debe ingresar el código del producto"
			,unidades: "Debe ingresar un valor mayor que 0"
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
			var data = 	{
				"id_operacion_detalle":last
				,"id_bodega":"1"
				,"tipo_movimiento":'E'
				,"id_producto":$("#producto").find(':selected').attr("data-id")
				,"codigo_producto":$('#producto').val()
				,"unidades":$('#unidades').val()
				,"valor_unitario":$("#producto").find(':selected').attr("data-precio")
				,"valor":calcular(0)
				,"valor_iva":calcular(1)
				,"estado_registro":'A'
			}
			var filas= jQuery("#jqgrid1").jqGrid('getRowData');

			$("#jqgrid1").jqGrid('addRowData',last,data,'last')	
			++last;			

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

	$('#aceptar').click(function()
	{
		var datosDetalle = $("#jqgrid1").jqGrid("getRowData");
		grid = $("#jqgrid1").jqGrid("getRowData");

		var info = { 
			datosEncabezado:{
				id_tipo_documento:"1"
				,fecha:$("#fecha").val()
				,serie:$("#serie").val()
				,numero:$("#numero").val()
				,observaciones:$("#observaciones").val()
				,id_categoria_operacion:"6"
				,oper:""
			}
			, datosDetalle : grid			
		};
		$.post(base_url+"facturacion/tpv/grabarIngreso",info,function( data ){
			respuesta = JSON.parse(data);
			if(respuesta["status"]== "error"){
				jAlert("Ha ocurrido un error" + respuesta["message"],'Informacion');				
			}else{
				jAlert('Se ha registrado el Ingreso de forma exitosa','Informacion');
				location.reload();							
			}

		});
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