<?php
 include('database.php');
//Codigo para crear las pantallas del modelo
	if (!empty($_POST['id_Cuestionario'])&& !empty($_POST['Items']) ) {
    $sql = 'INSERT INTO tb_items (id_Cuestionario, Items) VALUES (:id_Cuestionario, :Items)';
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_Cuestionario', $_POST['id_Cuestionario']);
	   $stmt->bindParam(':Items', $_POST['Items']);
	    echo $stmt->execute();
    //if ($stmt->execute()) {
	
	//echo "Has agregado un nuevo items";
	//header ('Location: Items_Crear_frm.php');
    //} else {
	//echo "Error de Servidor 404...!";

	//}
	}
?>
