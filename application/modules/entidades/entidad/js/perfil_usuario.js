function checkPassword(pass) {
	var numbers = pass.match(/\d+/g);
	var uppers  = pass.match(/[A-Z]/);
	var lowers  = pass.match(/[a-z]/);
	var special = pass.match(/[!@#$%&*\+]/);
	var resultado=[];

	if (numbers === null){
		resultado['numeros']=false
	}else{
		resultado['numeros']=true
	}
	
	if (uppers === null){
		resultado['mayusculas']=false
	}else{
		resultado['mayusculas']=true
	}
	
	if (lowers === null){
		resultado['minusculas']=false
	}else{
		resultado['minusculas']=true
	}	
	
	if (special === null){
		resultado['especiales']=false
	}else{
		resultado['especiales']=true
	}		

	if (numbers === null || uppers === null || lowers === null || special === null)
	  valid = false;

	if (numbers !== null && uppers !== null && lowers !== null && special !== null)
	  valid = true;

	return resultado;

}

function scorePassword(pass) {
	/*
	if (password.length < 6) {
		$('#result1').removeClass()
		$('#result1').addClass('short')
		return 'Too short'
	}
	*/	
   var score = 0;
   if (!pass){
		return score;
	}
   // award every unique letter until 5 repetitions
	//  var letters = new Object();
  	var letters = {};
   for (var i=0; i<pass.length; i++) {
   	letters[pass[i]] = (letters[pass[i]] || 0) + 1;
      score += 5.0 / letters[pass[i]];
   }

   // bonus points for mixing it up
   var variations = {
      digits: /\d/.test(pass),
      lower: /[a-z]/.test(pass),
      upper: /[A-Z]/.test(pass),
      nonWords: /\W/.test(pass)
   };

   variationCount = 0;
   for (var check in variations) {
      variationCount += (variations[check] === true) ? 1 : 0;
   }
   score += (variationCount - 1) * 10;

	// return parseInt(score);
   return parseInt(score, 10);
}

//********************************************************
// run scoring and apply a value to it
//********************************************************

function checkPassStrength(pass,este) {
	var score = scorePassword(pass);
	$('#result1').removeClass()
	$('#pass1').removeClass()
	$('#pass1').removeClass().addClass('progress-bar')
   if (score > 79){
   	$('#result1').addClass('excellent');
   	$('#result1').html('excellent');
		$('#pass1').attr('data-transitiongoal','100')
 		$('#pass1').addClass('progress-bar-excellent')		   	
	 	return 'excellent';
	}
	if (between(score, 60, 79)){
		$('#result1').addClass('strong');
		$('#result1').html('strong');
		$('#pass1').attr('data-transitiongoal','80')
 		$('#pass1').addClass('progress-bar-success')				
      return 'strong';		
	}
	if (between(score, 40, 59)){
		$('#result1').addClass('good');
		$('#result1').html('good');
		$('#pass1').attr('data-transitiongoal','60')
 		$('#pass1').addClass('progress-bar-info')		
		return 'good';
	}
	if (between(score, 21, 39)){
		$('#result1').addClass('weak');
		$('#result1').html('weak');
		$('#pass1').attr('data-transitiongoal','40')
 		$('#pass1').addClass('progress-bar-warning')
		return 'weak';
	}
   if (score < 21){
 		$('#result1').addClass('poor');
 		$('#result1').html('poor');
 		$('#pass1').attr('data-transitiongoal','20')
 		$('#pass1').addClass('progress-bar-danger')
 		
 		return 'poor';
 	}
   return '';
}

function between(n, a, b){
    return ((a==n)&&(b==n))? true : (n-a)*(n-b)<0;
}
$(document).ready(function(){
	$("#avatar-1").fileinput({
		overwriteInitial: true
		,maxFileSize: 1500
		,showClose: false
		,showCaption: false
		,browseLabel: ''
		,removeLabel: ''
		,browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>'
		,removeIcon: '<i class="glyphicon glyphicon-remove"></i>'
		,removeTitle: 'Cancelar los cambios'
		,showUpload: false
		,elErrorContainer: '#kv-avatar-errors-1'
		,msgErrorClass: 'alert alert-block alert-danger'
		,defaultPreviewContent: '<img src="'+layout_img+'user_default.png" alt="Avatar" width="100%">'
		,layoutTemplates: {main2: '{preview} {remove} {browse}'}
		,allowedFileExtensions: ["jpg", "png"]
		,language:"es"
		,uploadUrl: base_url+'entidades/entidad/grabarImagenPerfil/'+$("#id_entidad").val()
	});	
	
	$('#avatar-1').on('fileuploaded', function(event, data, previewId, index) {
		if(data.response.status=='ok'){
			var archivo=base_url+"/public/img/usuarios/"+data.response.data.nombre_archivo;
			$("#avatar_perfil").prop('src',archivo)
			$("#user_avatar").prop('src',archivo)
		}
	});		
	
	//$.fn.editable.defaults.mode = 'inline';
	$.fn.editable.defaults.url = base_url+'entidades/entidad/datos_perfil_usuario';
	
	$('#usuario').editable({
		validate: function(value) {
			if($.trim(value) == '') return 'Este campo es requerido';
		}
	});
	$('#correo').editable({
		validate: function(value) {
			if($.trim(value) == '') return 'Este campo es requerido';
		}
	});
	$('#telefono').editable();
	$('#celular').editable();

	$('#estado_registro').editable({
		prepend: "Elejir una Opción"
		,source: [
			{value: 'A', text: 'Alta'}
			,{value: 'B', text: 'Baja'}
			,{value: 'S', text: 'Suspendido'}
		]
		,value:$("#estado_registro1").val()
	});
	
	$("#password1").blur(function(){
		var validar = checkPassword($("#password1").val());
		checkPassStrength($("#password1").val(),this);
		$('.progress .progress-bar').progressbar({
				display_text: 'fill'
		});		
		/*
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
		*/		
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


	validacion=$("#frmCambioClave").validate({
		rules :{
			old_password: { required: true, maxlength: 35 }
			,password1: { required: true, maxlength: 35 }
			,password2: { required: true, maxlength: 35 }
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

	
	$("#aceptar").click(function(){
		var forma_valida = $("#frmCambioClave").valid();
		
		$.post(
			base_url+"entidades/entidad/validarClave"
			,{clave_acceso:$("#old_password").val()}
			,function(data){
				respuesta=JSON.parse(data);
				if(respuesta.status=='ok'){
					if(respuesta.rows_count==0){
						forma_valida=false
						$.confirm({
	        				title: 'Error'
	        				,closeIcon: true
	        				,content: 'No existe la clave ingresada, ingresela nuevamente...'
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
					forma_valida=false
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
			}
		);	
		
		if($("#password1").val()!==$("#password2").val()){
			forma_valida=false
			$.confirm({
  				title: 'Error'
  				,closeIcon: true
  				,content: 'La Nueva clave no es igual a la confirmación de clave, ingresela de nuevo...'
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
		
		if($("#old_password").val()==$("#password1").val()){
			forma_valida=false
			$.confirm({
  				title: 'Error'
  				,closeIcon: true
  				,content: 'La Nueva clave no puede ser igual a la clave anterior ,ingresela de nuevo...'
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

		if(forma_valida){		
			$.ajax({
				url: base_url+"entidades/entidad/datos_perfil_usuario"
				,data:{name: 'clave_acceso' ,pk:$("#id_entidad").val() , value:$("#password1").val()}
				,method:"POST"
				,async: false
				,success: function(data){
		  			respuesta=JSON.parse(data);
			  		if(respuesta.status['error']){
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
					}else{
						$.confirm({
	        				title: 'Cambio de Clave'
	        				,closeIcon: true
	        				,content: 'Cambio de Clave Correcta'
	        				,type: 'green'
	        				,typeAnimated: true
	        				,buttons: {
	            			close:{
	            				text: 'OK'
	            				,btnClass: 'btn-green'
								}
	        				}
	    				});	
					}
				}
				,error: function(XMLHttpRequest, textStatus, errorThrown){
					alert(textStatus);
				}
			});
		}else{
			validacion.focusInvalid();
		}					
	});
	

	
	$('#enable').click(function() {
		$('#user .editable').editable('toggleDisabled');
	});

	if( localStorage.getItem('xmode') == 'inline' ) {
		$('#user .editable').editable('option', 'mode', 'inline');
		$('#switch-inline-input').prop('checked', true);
	}else {
		$('#user .editable').editable('option', 'mode', 'popup');
		$('#switch-inline-input').prop('checked', false);
	}

	$('#switch-inline-input').on('change', function() {
		if( $(this).prop('checked') == true) {
			localStorage.setItem('xmode', 'inline');
			window.location.href="?mode=inline";
		}else {
			localStorage.setItem('xmode', 'popup');
			window.location.href="?mode=popup";
		}
	});
		
})