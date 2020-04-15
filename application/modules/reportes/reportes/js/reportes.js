$(document).ready(function ()
{
	$.post(base_url+"catalogos/producto/consultaVentasTotales",function( data ){
		respuesta = JSON.parse(data);
		if(respuesta["status"]== "error"){
			console.log('No se ha podido realizar la consulta de existencia')			
		}else{	
			var total=0;
			respuesta.data.forEach(element => {

				var a =  element['fecha_operacion'].split(' ');					
				total+=parseFloat(element['Total']);
				var html='<td class="column100 column1" data-column="column1">'+a[0]+'</td>'
				html+='<td class="column100 column2" data-column="column2">'+element['serie']+'</td>'
				html+='<td class="column100 column3" data-column="column3">'+element['numero']+'</td>'
				html+='<td class="column100 column4" data-column="column4">Q.'+element['Total']+'</td>'
				html+='<td class="column100 column5" data-column="column5">---</td>'

				var elem = $(document.createElement('tr'))
				.attr('class',"row100")
				.html(html)
				.appendTo('#ventas');
			});
			var html='<td class="column100 column1" data-column="column1">---</td>'
			html+='<td class="column100 column2" data-column="column2">---</td>'
			html+='<td class="column100 column3" data-column="column3">---</td>'
			html+='<td class="column100 column4" data-column="column4">Total</td>'
			html+='<td class="column100 column5" data-column="column5">Q.'+total+'</td>'
			var elem = $(document.createElement('tr'))
			.attr('class',"row100")
			.html(html)
			.appendTo('#ventas');
		}
	});

	$.post(base_url+"catalogos/producto/consultaMovimiento",function( data ){
		respuesta = JSON.parse(data);
		if(respuesta["status"]== "error"){
			console.log('No se ha podido realizar la consulta de existencia')			
		}else{	
			respuesta.data.forEach(element => {
				var a =  element['fecha_operacion'].split(' ');		
				var html='<td class="column100 column1" data-column="column1">'+element['id_operacion']+'</td>'
				html+='<td class="column100 column2" data-column="column2">'+element['sucursal']+'</td>'
				html+='<td class="column100 column3" data-column="column3">'+element['tipo_documento']+'</td>'
				html+='<td class="column100 column4" data-column="column4">'+element['categoria_operacion']+'</td>'
				html+='<td class="column100 column5" data-column="column5">'+a[0]+'</td>'
				html+='<td class="column100 column6" data-column="column6">'+element['serie']+'</td>'
				html+='<td class="column100 column7" data-column="column7">'+element['numero']+'</td>'
				html+='<td class="column100 column8" data-column="column8">Q.'+element['Total']+'</td>'
				if (element['proveedor']==null) {
					html+='<td class="column100 column9" data-column="column9">---</td>'
				}else{
					html+='<td class="column100 column9" data-column="column9">'+element['proveedor']+'</td>'
				}
				html+='<td class="column100 column10" data-column="column10">'+element['operador']+'</td>'

				var elem = $(document.createElement('tr'))
				.attr('class',"row100")
				.html(html)
				.appendTo('#movimientos');
			});
		}
	});

	$.post(base_url+"catalogos/producto/consultaInventario",function( data ){
		respuesta = JSON.parse(data);
		if(respuesta["status"]== "error"){
			console.log('No se ha podido realizar la consulta de existencia')			
		}else{				
			var total=0;
			respuesta.data.forEach(element => {								
				total+=parseFloat(element['total']);
				var html='<td class="column100 column1" data-column="column1">'+element['id_producto']+'</td>'
				html+='<td class="column100 column2" data-column="column2">'+element['codigo']+'</td>'
				html+='<td class="column100 column3" data-column="column3">'+element['descripcion']+'</td>'
				html+='<td class="column100 column4" data-column="column4">'+element['marca']+'</td>'
				html+='<td class="column100 column5" data-column="column5">'+element['modelo']+'</td>'
				html+='<td class="column100 column6" data-column="column6">'+element['tipo_producto']+'</td>'
				html+='<td class="column100 column7" data-column="column7">'+element['estado_producto']+'</td>'
				html+='<td class="column100 column8" data-column="column8">Q.'+element['precio']+'</td>'
				html+='<td class="column100 column9" data-column="column9">'+element['existencia']+'</td>'
				html+='<td class="column100 column10" data-column="column10">Q.'+element['total']+'</td>'
				html+='<td class="column100 column11" data-column="column11">---</td>'

				var elem = $(document.createElement('tr'))
				.attr('class',"row100")
				.html(html)
				.appendTo('#inventario');
			});
			var html='<td class="column100 column1" data-column="column1">---</td>'
			html+='<td class="column100 column2" data-column="column2">---</td>'
			html+='<td class="column100 column3" data-column="column3">---</td>'
			html+='<td class="column100 column4" data-column="column4">---</td>'
			html+='<td class="column100 column5" data-column="column5">---</td>'
			html+='<td class="column100 column6" data-column="column6">---</td>'
			html+='<td class="column100 column7" data-column="column7">---</td>'
			html+='<td class="column100 column8" data-column="column8">---</td>'
			html+='<td class="column100 column9" data-column="column9">---</td>'
			html+='<td class="column100 column10" data-column="column10">Patrimonio</td>'
			html+='<td class="column100 column11" data-column="column11">Q.'+total+'</td>'

			var elem = $(document.createElement('tr'))
			.attr('class',"row100")
			.html(html)
			.appendTo('#inventario');
		}
	});

});