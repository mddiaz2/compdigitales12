
//FUNCIONES PARA ADMINISTRADORES
function mostrara(){
	$.ajax({
		type:"POST",
		url:"procesos/mostrarDatosA.php",
		success:function(r){
		
			$('#tablaDatosA').html(r);
			
		}
	});
}

function obtenerDatosA(id_area){
	$.ajax({
		type:"POST",
		data: "id_area=" + id_area,
		url:"procesos/obtenerDatosA.php",
		success:function(r){
			console.log(r)
			r=jQuery.parseJSON(r);
			$('#id_area').val(r['id_area']);
			$('#areau').val(r['area']);
		
			
			
		}
	});
}

function actualizarDatosA(){
	$.ajax({
		type:"POST",
		url:"procesos/actualizarDatosA.php",
		data: $('#frminsertuA').serialize(),
		success:function(r){
		console.log(r)
			
			if(r==1){
				
				mostrara();
				swal("Area actualizada con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
			
			
		}
	});
	return false;
}

function eliminarDatosA(id_area){
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
				url:"procesos/eliminarDatosA.php",
				data: "id_area=" + id_area,
				success:function(r){
					console.log(r)

					
					if(r==1){
			
						mostrara();
						swal("Area eliminada con éxito", ":D" ,"info");
					}else {
						swal("Error",":(","error");
					}
					
					
				}
			});
		} 
	});
}
function insertarDatosA(){
	$.ajax({
		type:"POST",
		url:"procesos/insertarDatosA.php",
		data: $('#frminsertA').serialize(),
		success:function(r){
				
			if(r==1){
				$('#frminsertA')[0].reset(); 
				mostrara();
				swal("Area agregada con éxito", ":D" ,"success");
			}else {
				swal("Error",":(","error");
			}
		}
	});
	return false;
}


