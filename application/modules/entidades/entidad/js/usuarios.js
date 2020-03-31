$(document).ready(function(){
	if (localStorage) {
		if (localStorage.getItem("usuario") != null) {
			$("#usuario").val(localStorage.getItem("usuario"));
		}
		if (localStorage.getItem("clave") != null) {
			$("#clave").val(localStorage.getItem("clave"));
		}
		if (localStorage.getItem("empresa") != null) {
			$("#empresa").val(localStorage.getItem("empresa"));
		}  	
	}
	
	
	$("#iniciar_sesion").click(function(e) {
		if (typeof(Storage) !== "undefined") {
			if($("#remember").prop("checked")){
				localStorage.setItem("usuario",$("#usuario").val());
				localStorage.setItem("clave",$("#clave").val());
				localStorage.setItem("empresa",$("#empresa").val());
				
			}else{
				localStorage.removeItem("usuario");	
				localStorage.removeItem("clave");	
				localStorage.removeItem("empresa");	
			}
		}	
		usuario=$('#usuario').val();
		clave=$('#clave').val();
		id_empresa=$('#empresa').val();
		nombre_empresa=$('#empresa option:selected').text();
		e.preventDefault();
		if(usuario=="" || clave=="" ){
			jAlert('Debe Ingresar su Usuario y Clave de Acceso para Continuar', 'Alerta');
		}else{
			$.ajax({
				url: base_url+"usuarios/usuarios/autenticar"
				,data:{usuario: usuario ,clave: clave, empresa:id_empresa,descripcion:nombre_empresa}
				,method:"POST"
				,async: false
				,success: function(data){
		  			autenticado=JSON.parse(data);
			  		if(autenticado.error){
						jAlert('Usuario o Clave de Acceso Incorrecta...', 'Alerta');
					}else{
						$(location).attr("href", base_url);
					}
				}
				,error: function(XMLHttpRequest, textStatus, errorThrown){
					alert(textStatus);
				}
			});			
		}
	});
});