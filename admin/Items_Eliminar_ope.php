<?php
//Este metodo permite Eliminar los intes o pantallas de respuesta
include('database.php');
//El metdo $id_Items=$_REQUEST['id_Items']; es para cuando se envia el id por el navegador, y lo voy hacer mejor por el metodo post 
//$id_Items=$_REQUEST['id_Items'];
$id_Items=$_POST['id_Items'];
$records = $conn->prepare("DELETE FROM tb_items WHERE id_Items='$id_Items'");
echo $records->execute();
//$rowAfetada=$records->fetch(PDO::FETCH_ASSOC);

	//if(count($rowAfetada)>0){
	//por el momento como esta si ajax debeo regresar a la misma pero se cambiara con ajax
	//header ('Location: Items_Crear_frm.php');
	//echo "exitoso";
//}
//else{
	//echo "Error de servidor: 404...!";
//}


?>