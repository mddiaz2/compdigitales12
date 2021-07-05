
//FUNCIONES PARA ADMINISTRADORES
function mostrarcu(){
	$.ajax({
		type:"POST",
		url:"procesos/mostrarDatosCu.php",
		success:function(r){
			
			$('#tablaDatosCu').html(r);
			
		}
	});
}

function obtenerDatosCu(id_Cuestionario){
	$.ajax({
		type:"POST",
		data: "id_Cuestionario=" + id_Cuestionario,
		url:"procesos/obtenerDatosCu.php",
		success:function(r){
			console.log(r)
			r=jQuery.parseJSON(r);
			$('#id_Cuestionario').val(r['id_Cuestionario']);
			$('#id_Areasu').val(r['id_Areas']);
			$('#id_Competenciasu').val(r['id_Competencias']);
			$('#id_Nivelesu').val(r['id_Niveles']);
			$('#Numerou').val(r['Numero']);
			$('#Preguntasu').val(r['Preguntas']);
			$('#Nivelu').val(r['Nivel']);
			$('#ValorVerdaderou').val(r['ValorVerdadero']);
			$('#ValorFalsou').val(r['ValorFalso']);
			
			
		}
	});
}

function actualizarDatosCu(){
	$.ajax({
		type:"POST",
		url:"procesos/actualizarDatosCu.php",
		data: $('#frminsertuCu').serialize(),
		success:function(r){
		console.log(r)
			
			if(r==1){
				
				mostrarcu();
				swal("Cuestionario actualizado con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
			
			
		}
	});
	return false;
}

function eliminarDatosCu(id_Cuestionario){
	swal({
		title: "¿Estas seguro de eliminar este registro?",
		text: "!Una vez eliminado no podra recuperarse¡",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	})
	.then((willDelete) => {
		if (willDelete) {
			$.ajax({
				type:"POST",
				url:"procesos/eliminarDatosCu.php",
				data: "id_Cuestionario=" + id_Cuestionario,
				success:function(r){
					console.log(r);
					
					if(r==1){
			
						mostrarcu();
						swal("Cuestionario eliminado con éxito", ":D" ,"info");
					}else {
						swal("Error",":(","error");
					}
					
					
				}
			});
		} 
	});
}
function insertarDatosCu(){
	$.ajax({
		type:"POST",
		url:"procesos/insertarDatosCu.php",
		data: $('#frminsertCu').serialize(),
		success:function(r){
			console.log(r);
			if(r==1){
				$('#frminsertCu')[0].reset(); 
				mostrarcu();
				swal("Cuestionario agregado con exito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
		}
	});
	return false;
}


