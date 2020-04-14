$(document).ready(function(){
	$("#administrar").click(function(){
		$(location).attr("href", base_url);
		
	});
	
	$.post(base_url+"catalogos/producto/consultaExistencia/bajo",function( data ){
		respuesta = JSON.parse(data);
		if(respuesta["status"]== "error"){
			console.log('No se ha podido realizar la consulta de existencia')			
		}else{
			generar_notificaciones(respuesta);							
		}

	});

	function generar_notificaciones(datos){
		
		datos.data.forEach(element => {
			var d = new Date();
			var hora=d.getHours()+':'+d.getMinutes();
			var html='<div class="widget widget-hide-header widget-reminder">'
			html+='<div class="widget-header hide">'
			html+='<h3>Alerta de Existencia</h3>'
			html+='</div>'
			html+='<div class="widget-content">'
			html+='<div class="today-reminder">'
			html+='<br>'
			if (element['existencia'] == 0) {
				html+='<h4 class="reminder-title">No hay ninguna unidad de '+element['descripcion']+'</h4>'
			}else {
				html+='<h4 class="reminder-title">Hay menos de '+element['existencia']+' unidades</h4>'
			}
			html+='<p class="reminder-time"><i class="fa fa-clock-o"></i> '+hora+' </p>'
			html+='<p class="reminder-place">Actualización inventario</p>'
			html+='<em class="reminder-notes">Es necesario reabastecer la bodega de '+element['descripcion']+'</em>'
			html+='<i class="fa fa-bell"></i>'
			html+='<div class="btn-group btn-group-xs">'
			html+='<div class="btn-group  btn-grou p-xs">'
			html+='<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Recordarme en<span class="caret"></span></button>'
			html+='<ul class="dropdown-menu pull-right">'
			html+='<li><a href="#">15 minutos</a></li>'
			html+='<li><a href="#">30 minutos</a></li>'
			html+='<li><a href="#">1 hora</a></li>'
			html+='</ul>'
			html+='</div>'
			html+='</div>'
			html+='</div>'
			html+='</div>'
			html+='</div>'
			html+='<!-- END WIDGET REMINDER -->'
			var elem = $(document.reateElement('div'))c
			.attr('class',"col-md-3")
			.html(html)
			.appendTo('#alertas');
		});	
	}

	
});