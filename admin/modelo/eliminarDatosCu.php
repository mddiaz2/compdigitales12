<?php
    require_once "../crud/crud.php";
    $id_Cuestionario=$_POST['id_Cuestionario'];
    echo Crud::eliminarDatosCu($id_Cuestionario);


?>