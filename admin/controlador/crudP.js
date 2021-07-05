
//FUNCIONES PARA ADMINISTRADORES
function mostrarp(){
	$.ajax({
		type:"POST",
		url:"procesos/mostrarDatosP.php",
		success:function(r){
		
			$('#tablaDatosP').html(r);
			
		}
	});
}

function obtenerDatosP(id){
	$.ajax({
		type:"POST",
		data: "id=" + id,
		url:"procesos/obtenerDatosP.php",
		success:function(r){
			r=jQuery.parseJSON(r);
			$('#id').val(r['id']);
			$('#emailp').val(r['email']);
			$('#passp').val(r['password']);
			
			
		}
	});
}

function actualizarDatosP(){
	$.ajax({
		type:"POST",
		url:"procesos/actualizarDatosP.php",
		data: $('#frminsertuP').serialize(),
		success:function(r){
		console.log(r)
			
			if(r==1){
				
				mostrarp();
				swal("Persona actualizada con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
			
			
		}
	});
	return false;
}

function eliminarDatosP(id){
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
				url:"procesos/eliminarDatosP.php",
				data: "id=" + id,
				success:function(r){
					
					if(r==1){
			
						mostrarp();
						swal("Persona eliminada con éxito", ":D" ,"info");
					}else {
						swal("Error",":(","error");
					}
					
					
				}
			});
		} 
	});
}
function insertarDatos(){
	$.ajax({
		type:"POST",
		url:"procesos/insertarDatos.php",
		data: $('#frminsert').serialize(),
		success:function(r){
			console.log(r);
			if(r==1){
				$('#frminsert')[0].reset();  //resetear el frminsert o limpiar
				mostrar();
				swal("Usuario agregado con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
			
			
		}
	});
	return false;
}


