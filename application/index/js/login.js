$(document).ready(function(){
	if($("#registros").val()==1){
		imglogo=perfil_empresa+$("#id_empresa").val()+'/img/'+$("#logo").val();
		$("#img_logo_empresa").attr('src',imglogo);
		$("#logo_empresa").prop('hidden',false)
	}
	
	
	$("#empresas").change(function(e){
		
		info={
			id_empresa:$("#empresas").val()
		}
		$.post(
			base_url+'catalogos/empresa/obtenerDatosEmpresa'
			,info
			,function(data){
				var datos = JSON.parse(data);
				if(datos.status=='ok'){
					imglogo=perfil_empresa+datos.data[0].id_empresa+'/img/'+datos.data[0].logo;
					$("#img_logo_empresa").attr('src',imglogo)
					$("#logo_empresa").prop('hidden',false)
					$("#id_empresa").val($("#empresas").val());
					$("#nombre_empresa").val($("#empresas option:selected").text());
				}else{
					$.confirm({
        				title: 'Error'
        				,closeIcon: true
        				,content: datos.message
        				,type: 'red'
        				,typeAnimated: true
        				,buttons: {
            			close:{
            				text: 'OK'
            				,btnClass: 'btn-red'
							}
        				}
    				});
				}
			}
		)
	});

	jQuery.validator.setDefaults({
	  debug: false,
	  success: "valid"
	});

	var errorClass = 'error-block';
	var errorElement = "span";

 	$.validator.addMethod("valueNotEquals", function(value, element, arg){
  		return arg !== value;
 	}, "Debe seleccionar un item para continuar.");

	validacion=$("#frmLogin").validate({
		rules :{
			empresas:{ valueNotEquals: "0" }
			,usuario: { required: true, maxlength: 50 }
			,clave_acceso: { required: true, maxlength: 50 }
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
	
	$("#ingresar").click(function(){
		var forma_valida = $("#frmLogin").valid();

		if(forma_valida){
			var info = {
				id_empresa:$("#id_empresa").val()
				,usuario:$("#usuario").val()
				,clave_acceso : md5($("#clave_acceso").val())
				,empresa:$("#nombre_empresa").val()
			}
			

			$.post(base_url+"entidades/entidad/autenticarUsuario",info,function(data){
				respuesta=JSON.parse(data);
				if(respuesta.status=='ok'){
					if(respuesta.rows>0){
						$.confirm({
	        				title: 'Autenticación Correcta'
	        				,closeIcon: true
	        				,content: 'Bienvenido al Sistema'
	        				,type: 'green'
	        				,typeAnimated: true
	        				,autoClose: 'close|2000'
	        				,buttons: {
	            			close:{
	            				text: 'OK'
	            				,btnClass: 'btn-green'
								}
	        				}
							,onClose:function(){
								location.href=base_url;
							}		        				
	    				});	
					}else{
						$.confirm({
	        				title: 'Fallo Autenticación'
	        				,closeIcon: true
	        				,content: 'Usuario o Clave de Acceso Incorrectas'
	        				,type: 'red'
	        				,typeAnimated: true
	        				,buttons: {
	            			close:{
	            				text: 'OK'
	            				,btnClass: 'btn-red'
								}
	        				}
	    				});	
					}
				}else{
					$.confirm({
        				title: 'Error'
        				,closeIcon: true
        				,content: respuesta.message
        				,type: 'red'
        				,typeAnimated: true
        				,buttons: {
            			close:{
            				text: 'OK'
            				,btnClass: 'btn-red'
							}
        				}
    				});
				}
			});
			
		}else{
			validacion.focusInvalid();
		}
	});
});