<?php
    require_once "../crud/crud.php";
    $id_Cuestionario=$_POST['id_Cuestionario'];
    echo json_encode(Crud::obtenerDatosCu($id_Cuestionario));


?>