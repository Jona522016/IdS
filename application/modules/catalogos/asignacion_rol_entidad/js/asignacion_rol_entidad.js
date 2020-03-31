$(document).ready(function(){
	var dual_list = $('#entidades').bootstrapDualListbox({
		nonSelectedListLabel: 'Opciones a Seleccionar'
		,selectedListLabel: 'Seleccionados'
		,infoTextFiltered:'<span class="label label-warning">Filtrados</span> {0} from {1}'
		,infoText:'Registros {0}'
		,infoTextEmpty:'Lista Vacia'
		,filterTextClear:'Mostrar Todos'
		,filterPlaceHolder:'Filtrar'
		,moveSelectedLabel:'Mover Seleccionados'
		,moveAllLabel:'Mover Todos'
		,removeSelectedLabel:'Quitar Seleccionados'
		,removeAllLabel:'Quitar Todos'
		,preserveSelectionOnMove: 'moved'
		,moveOnSelect: false
		,selectorMinimalHeight:250
	});
	
	$("#rol_entidad").change(function(){
		$.ajax({
			url: base_url+'catalogos/asignacion_rol_entidad/obtener_datos/'+$("#rol_entidad").val()
			,async: true
			,type:'POST'
			,success: function(data) {
				datos=JSON.parse(data);
				$("#entidades option").prop('selected',false);
				if(datos.status=='ok'){
					$.each(datos.data,function(idx,valor){
						$("#entidades option" ).each(function(){
							if($(this)[0].value==valor.id_entidad){
								$(this).prop('selected','selected');
							}
				    	});						
						
					})
					
					dual_list.bootstrapDualListbox('refresh');
				}
			}
			,error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});
	})	
	
	
	
	$("#aceptar").click(function(){
		if($("#rol_entidad").val()==0){
			jAlert('Debe ingresar un rol de entidad para continuar','Información')
			return;
		}
		
		var info={},i=0;
		$("#entidades option" ).each(function(){
			if($(this)[0].selected){
				info[i]={
					id_rol_entidad:$("#rol_entidad").val()
					,id_entidad:this.value
				}
				i++;
			}
    	});
		

		$.ajax({
			url: base_url+'catalogos/asignacion_rol_entidad/grabar_datos/'+$("#rol_entidad").val()
			,async: true
			,type:'POST'
			,data:info
			,success: function(data) {
				datos=JSON.parse(data);
				if(datos.status=='ok'){
					jAlert(datos.message,'Información')
				}else{
					jAlert(datos.message,'Error')
				}
			}
			,error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert(textStatus);
			}
		});

		
	});
	
});