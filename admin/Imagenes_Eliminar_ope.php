<?php
//Este codigo permite eliminar las imagenes desde la base de datos
include('database.php');
$id_Imagenes=$_REQUEST['id_Imagenes'];
$records = $conn->prepare("DELETE FROM tb_imagenes WHERE id_Imagenes='$id_Imagenes'");
echo $records->execute();
//$row=$records->fetch(PDO::FETCH_ASSOC);
	//if(count($row)>0){
		//por el momento como esta si ajax debeo regresar a la misma pero se cambiara con ajax por que sino me refrezca
	//header('Location: Imagenes_Crear_Tabla_frm.php');
	//echo "exitoso";
//}
//else{
	//echo "Error de servidor 404...!";
//}

?>