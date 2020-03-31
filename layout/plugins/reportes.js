var fecha1,fecha2,etiqueta,table,config,rpt_datos;

var fecha_ini = moment().subtract(29, 'days');
var fecha_fin = moment();
fecha1=fecha_ini.format('DD/MM/YYYY');
fecha2=fecha_fin.format('DD/MM/YYYY');	




function obtenerNombreArchivo(){
	var nombre;
	if($("#nombre_archivo").val()==""){
		nombre="archivo_exportado";
	}else{
		nombre=$("#nombre_archivo").val();
	}
	return nombre;
}

function obtenerMensaje(){
	var mensaje;
	if($("#encabezado").val()==""){
		mensaje="Reporte del "+$(".range-value").html();
	}else{
		mensaje=$("#encabezado").val();
	}
	return mensaje;
}

function obtenerTitulo(){
	var titulo;
	if($("#titulo").val()==""){
		titulo="Reporte";
	}else{
		titulo=$("#titulo").val();
	}
	return titulo;
}	
	
function mostrarFooter(){
	var checkeado;
	if( $('#mostrar_footer').is(':checked') ) {
		checkeado=true;
	}else{
		checkeado=false;
	}
	return checkeado;
}		

	function obtenerDatosReporte(id_reporte){
		if(id_reporte>0)				{
			$.ajax({
				url: base_url+"reportes/reportes/obtenerConfiguracion/"+id_reporte
				,method :"POST"
				//,data:{ fecha1:fecha1 , fecha2: fecha2}		
				,async: false
				,success: function(data) {
					rpt_datos = JSON.parse(data);
					config=rpt_datos[0].configuracion
					$("#id_reporte").val(rpt_datos[0].id_reporte)
					$("#descripcion").val(rpt_datos[0].descripcion)
					$("#descripcion1").val(rpt_datos[0].descripcion)
					$("#contenido").val(rpt_datos[0].contenido)
					$("#contenido1").val(rpt_datos[0].contenido)
					$("#nombre_archivo").val(rpt_datos[0].archivo_exportar)
					$("#nombre_archivo1").val(rpt_datos[0].archivo_exportar)					
					$("#tipo_reportes1").val(rpt_datos[0].id_tipo_reporte)
					if(rpt_datos[0].estado_publico=='P'){
						$("#estado_publico1").prop('checked', true);
					}else{
						$("#estado_publico1").prop('checked', false);
					}
					if(rpt_datos[0].mostrar_totales=='S'){
						$("#mostrar_footer").prop('checked', true);
						$("#mostrar_footer1").prop('checked', true);
					}else{
						$("#mostrar_footer").prop('checked', false);
						$("#mostrar_footer1").prop('checked', false);
					}					
					$("#titulo").val(rpt_datos[0].titulo)
					$("#titulo1").val(rpt_datos[0].titulo)
					$("#encabezado").val(rpt_datos[0].encabezado)
					$("#encabezado1").val(rpt_datos[0].encabezado)
					if(rpt_datos[0].tipo_papel=='C'){
						$("#tipo_papel").val('LETTER');
						$("#tipo_papel1").val(rpt_datos[0].tipo_papel);
					}else{
						$("#tipo_papel").val('LEGAL');
						$("#tipo_papel1").val(rpt_datos[0].tipo_papel);
					}	
					if(rpt_datos[0].orientacion=='P'){
						$("#orientacion").val('portrait');
						$("#orientacion1").val(rpt_datos[0].orientacion);
					}else{
						$("#orientacion").val('landscape');
						$("#orientacion1").val(rpt_datos[0].orientacion);
					}								
				}
				,error: function(XMLHttpRequest, textStatus, errorThrown) {
					alert(textStatus);
				}
			});					
		}		
	}	


	
	moment.locale('es');
		
	$('#reportrange').daterangepicker({
		"showDropdowns": true,
	    "linkedCalendars": false,
	    "autoUpdateInput": false,
	    "showCustomRangeLabel": false,
	    "startDate": moment().subtract(29,'days'),
	    "endDate": moment(),
	    "opens": "center",
		"ranges": {
			'Hoy': [moment(), moment()],
			'Ayer': [moment().subtract(1,'days'), moment().subtract(1,'days')],
			'Ultima Semana': [moment().subtract(6,'days'), moment()],
			'Ultimos 30 Dias': [moment().subtract(29,'days'), moment()],
			'Este Mes': [moment().startOf('month'), moment().endOf('month')],
			'Mes Pasado': [moment().subtract(1,'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
		},	
		"alwaysShowCalendars": true,    
		"locale": {
        	format: "MM/DD/YYYY",
        	separator: " - ",
        	applyLabel: "Aceptar",
        	cancelLabel: "Cancelar",
        	fromLabel: "From",
        	toLabel: "To",
        	customRangeLabel: "Personalizado",
        	weekLabel: "W",
        	daysOfWeek: [
            	"Dom",
            	"Lun",
            	"Mar",
            	"Mie",
            	"Jue",
            	"Vie",
            	"Sab"
        	],
        	monthNames: [
            	"Enero",
            	"Febrero",
            	"Marzo",
            	"Abril",
            	"Mayo",
            	"Junio",
            	"Julio",
            	"Agosto",
            	"Septiembre",
            	"Octubre",
            	"Noviembre",
            	"Diciembre"
        	],
        	"firstDay": 1
    	}	    
	    
	},function(start, end,label) {
		$('#reportrange span').html(start.format('D [de] MMMM [del] YYYY') + '  al  ' + end.format('D [de] MMMM [del] YYYY'));
		fecha1=start.format('DD/MM/YYYY');
		fecha2=end.format('DD/MM/YYYY');
		etiqueta=label;
	});

	$('#reportrange span').html(moment().subtract(29,'days').format('D [de] MMMM [del] YYYY') + '  al  ' + moment().format('D [de] MMMM [del] YYYY'));
	
	if($("#listado_reportes").val()>0)				{
		$.ajax({
			url: base_url+"reportes/reportes/obtenerConfiguracion/"+$("#listado_reportes").val()
			,method :"POST"
			//,data:{ fecha1:fecha1 , fecha2: fecha2}		
			,async: false
			,success: function(data) {
				rpt_datos = JSON.parse(data);
				config=rpt_datos[0].configuracion
				$("#id_reporte").val(rpt_datos[0].id_reporte)
				$("#descripcion").val(rpt_datos[0].descripcion)
				$("#descripcion1").val(rpt_datos[0].descripcion)
				$("#contenido").val(rpt_datos[0].contenido)
				$("#contenido1").val(rpt_datos[0].contenido)
				$("#nombre_archivo").val(rpt_datos[0].archivo_exportar)
				$("#nombre_archivo1").val(rpt_datos[0].archivo_exportar)					
				$("#tipo_reportes1").val(rpt_datos[0].id_tipo_reporte)
				if(rpt_datos[0].estado_publico=='P'){
					$("#estado_publico1").prop('checked', true);
				}else{
					$("#estado_publico1").prop('checked', false);
				}
				if(rpt_datos[0].mostrar_totales=='S'){
					$("#mostrar_footer").prop('checked', true);
					$("#mostrar_footer1").prop('checked', true);
				}else{
					$("#mostrar_footer").prop('checked', false);
					$("#mostrar_footer1").prop('checked', false);
				}					
				$("#titulo").val(rpt_datos[0].titulo)
				$("#titulo1").val(rpt_datos[0].titulo)
				$("#encabezado").val(rpt_datos[0].encabezado)
				$("#encabezado1").val(rpt_datos[0].encabezado)
				if(rpt_datos[0].tipo_papel=='C'){
					$("#tipo_papel").val('LETTER');
					$("#tipo_papel1").val(rpt_datos[0].tipo_papel);
				}else{
					$("#tipo_papel").val('LEGAL');
					$("#tipo_papel1").val(rpt_datos[0].tipo_papel);
				}	
				if(rpt_datos[0].orientacion=='P'){
					$("#orientacion").val('Portrait');
					$("#orientacion1").val(rpt_datos[0].orientacion);
				}else{
					$("#orientacion").val('Landscape');
					$("#orientacion1").val(rpt_datos[0].orientacion);
				}								
			}
			,error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});					
	}	


	
	function stringToDate(_date,_format,_delimiter){
      var formatLowerCase=_format.toLowerCase();
      var formatItems=formatLowerCase.split(_delimiter);
      var dateItems=_date.split(_delimiter);
      var monthIndex=formatItems.indexOf("mm");
      var dayIndex=formatItems.indexOf("dd");
      var yearIndex=formatItems.indexOf("yyyy");
      var month=parseInt(dateItems[monthIndex]);
      month-=1;
      var formatedDate = new Date(dateItems[yearIndex],month,dateItems[dayIndex]);
      return formatedDate;
	}
	
		
	



	if($.validator){
		
		jQuery.validator.setDefaults({
		  debug: false,
		  success: "valid"
		});

		var errorClass = 'error-block';
		var errorElement = "span";

	 	$.validator.addMethod("valueNotEquals", function(value, element, arg){
	  		return arg !== value;
	 	}, "Debe seleccionar un item para continuar.");
	 	
	 
		var validarForma=$("#frmGrabacion").validate({
			rules :{
				descripcion1:{ required: true,maxlength: 45 }
				,contenido1: {required: true,maxlength: 150}
				,nombre_archivo1: {required: true,maxlength: 75}
				,tipo_reportes1:{
					valueNotEquals: "0" 
					,required:{ 
	                    depends: function (element) {
	                    	if($("#tipo_reportes1").val()==null){
								return true						
							}
						}
					}								
				}
				,estado_publico1: {required: true}
				,mostrar_footer1: {required: true}
				,titulo1: {required: true,maxlength: 75}
				,encabezado1: {required: false,maxlength: 75}
				,tipo_papel1:{
					valueNotEquals: "0" 
					,required:{ 
	                    depends: function (element) {
	                    	if($("#tipo_papel1").val()==null){
								return true						
							}
						}
					}								
				}
				,orientacion1:{
					valueNotEquals: "0" 
					,required:{ 
	                    depends: function (element) {
	                    	if($("#orientacion1").val()==null){
								return true						
							}
						}
					}								
				}			

			}
			,messages: {
		   		contents: "Seleccione un Item." 
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
		
		$("#grabarReporte").click(function(){
			table=$('#reportes').DataTable();
			if(table==undefined){
				jAlert('Debe generar los datos antes de continuar...','Alerta');
				return;
			}
		
			var mostrar,publico,oper,id;
			
			table.state.save();
			var config = localStorage.getItem('DataTables_reportes_' + window.location.pathname); 
			
			if(!$("#mostrar_totales1").is(':checked')) {  
				mostrar='S'
			}else{
				mostrar='N'
			}
			if(!$("#estado_publico1").is(':checked')) {  
				publico='T'
			}else{
				publico='P'
			}
			if($("#id_reporte").val()==0){
				oper='add';
				id="_empty";
			}else{
				oper='edit';
				id=$("#id_reporte").val();
			}
			
			configuracion1= localStorage.getItem('rpt_config'); 
			
			
			var forma_valida = $("#frmGrabacion").valid();
								
			if(forma_valida){
				
				var info = {
					id_reporte:$("#id_reporte").val()
					,id_empresa:idEmpresa
					,descripcion:$("#descripcion1").val()
					,contenido : $("#contenido1").val()
					,configuracion:config
					,id_tipo_reporte:$("#tipo_reportes1").val()
					,estado_publico:publico
					,archivo_exportar:$("#nombre_archivo1").val()
					,mostrar_totales:mostrar
					,titulo:$("#titulo1").val()
					,encabezado:$("#encabezado1").val()
					,tipo_papel:$("#tipo_papel1").val()
					,orientacion:$("#orientacion1").val()
					,estado_registro:'A'
					,id_operador:idUsuario
					,oper:oper
					,id:id
				}	
				
				$.post(base_url+"reportes/reportes/DataTableEdit/id_reporte",info,function(data){
					respuesta=JSON.parse(data);
					if(respuesta.estado=="ok"){
						mensaje="Reporte "+respuesta.descripcion+" de ID "+respuesta.id+" fue grabado exitosamente";
						jAlert(mensaje,'Alerta');
						if(oper='add'){
							document.getElementById("frmGrabacion").reset();
						}
					}else{
						jAlert(respuesta.descripcion,'Error');
					}
					
				});
			}else{
				validarForma.focusInvalid();
			}

		});	
	}	

	$('#agrupar').on('click', function (e) {
		e.preventDefault();
		valsel=$("#agrupar_por option:selected").val()
		if(valsel!=0){
			table.rowGroup().enable().draw();	
			valdat=$("#agrupar_por option:selected").data('id')
     	table.rowGroup().dataSrc(valsel);
  	  	table.order.fixed( {pre: [[ valdat, 'asc' ]]} ).draw()
		}else{
			jAlert('Debe seleccionar un campo para continuar...','Alerta');
		}
	});			

	$('#desagrupar').on('click', function (e) {
		table.rowGroup().disable().draw();
    	//table.rowGroup().dataSrc('id_detalle_produccion');
    	table.order.fixed([null]).draw();
    	table.order([ 0, 'asc']).draw();
	});							
	
	
		