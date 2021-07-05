
//FUNCIONES PARA ADMINISTRADORES
function mostrarc(){
	$.ajax({
		type:"POST",
		url:"procesos/mostrarDatosC.php",
		success:function(r){
		
			$('#tablaDatosC').html(r);
			
		}
	});
}

function obtenerDatosC(id){
	$.ajax({
		type:"POST",
		data: "id=" + id,
		url:"procesos/obtenerDatosC.php",
		success:function(r){
			console.log(r)
			r=jQuery.parseJSON(r);
			$('#id').val(r['id']);
			$('#competenciau').val(r['competencia']);
			
			
		}
	});
}

function actualizarDatosC(){
	$.ajax({
		type:"POST",
		url:"procesos/actualizarDatosC.php",
		data: $('#frminsertuC').serialize(),
		success:function(r){
		console.log(r)
			
			if(r==1){
				
				mostrarc();
				swal("Competencia actualizada con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
			
			
		}
	});
	return false;
}

function eliminarDatosC(id){
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
				url:"procesos/eliminarDatosC.php",
				data: "id=" + id,
				success:function(r){
					
					if(r==1){
			
						mostrarc();
						swal("Competencia eliminada con éxito", ":D" ,"info");
					}else {
						swal("Error",":(","error");
					}
					
					
				}
			});
		} 
	});
}
function insertarDatosC(){
	$.ajax({
		type:"POST",
		url:"procesos/insertarDatosC.php",
		data: $('#frminsertC').serialize(),
		success:function(r){
			console.log(r);
			if(r==1){
				$('#frminsertC')[0].reset(); 
				mostrarc();
				swal("Competencia Agregada con exito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
		}
	});
	return false;
}


