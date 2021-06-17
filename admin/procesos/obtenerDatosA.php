<?php
    require_once "../crud/crud.php";
    $id_area=$_POST['id_area'];
    echo json_encode(Crud::obtenerDatosA($id_area));


?>