var tasa_iva = 0.12;


function generarSerial(len) {
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
    var string_length = 10;
    var randomstring = '';

    for (var x=0;x<string_length;x++) {

        var letterOrNumber = Math.floor(Math.random() * 2);
        if (letterOrNumber == 0) {
            var newNum = Math.floor(Math.random() * 9);
            randomstring += newNum;
        } else {
            var rnum = Math.floor(Math.random() * chars.length);
            randomstring += chars.substring(rnum,rnum+1);
        }

    }
    return randomstring
}

function number_format(amount, decimals) {
	amount += ''; // por si pasan un numero en vez de un string
	amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto
	decimals = decimals || 0; // por si la variable no fue fue pasada
	// si no es un numero o es igual a cero retorno el mismo cero
	if (isNaN(amount) || amount === 0) 
		return parseFloat(0).toFixed(decimals);

	// si es mayor o menor que cero retorno el valor formateado como numero
	amount = '' + amount.toFixed(decimals);

	var amount_parts = amount.split('.'),
	regexp = /(\d+)(\d{3})/;

	while (regexp.test(amount_parts[0]))
	amount_parts[0] = amount_parts[0].replace(regexp, '$1' + ',' + '$2');

	return amount_parts.join('.');
}	

esArreglo=function (a) {
	return (!!a) && (a.constructor === Array);
};

esObjeto=function (a) {
	return (!!a) && (a.constructor === Object);
};

function isNumber(obj) { 
	return !isNaN(parseFloat(obj)) 
}


	function getLocation(lat,lon) {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(
				function(position) {
					$("#"+lat).val(position.coords.latitude);
					$("#"+lon).val(position.coords.longitude);
				}
				,function() {
					handleLocationError(true);
				}
				,{
					maximumAge:600000
					, timeout:5000
					, enableHighAccuracy: true
				}
			);
		} else {
			handleLocationError(false);
		}
	}
	
	function handleLocationError(browserHasGeolocation) {
		browserHasGeolocation ?
			jAlert('Error: The Geolocation service failed.','Alerta') :
			jAlert('Error: Your browser doesn\'t support geolocation.','Alerta')
	}	

	function showError(error) {
	    switch(error.code) {
	        case error.PERMISSION_DENIED:
	            x.innerHTML = "User denied the request for Geolocation."
	            break;
	        case error.POSITION_UNAVAILABLE:
	            x.innerHTML = "Location information is unavailable."
	            break;
	        case error.TIMEOUT:
	            x.innerHTML = "The request to get user location timed out."
	            break;
	        case error.UNKNOWN_ERROR:
	            x.innerHTML = "An unknown error occurred."
	            break;
	    }
	} 		
		
/********************************
*
* Opciones Generales de JqGrid
*
*********************************/



$(document).ready(function(){
	/*
	$("#jqgrid").jqGrid('navGrid'
		,'#jqgrid-pager'
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
		}
		,{ 
			closeAfterAdd:true
			,recreateForm: true
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
	*/			
});		

