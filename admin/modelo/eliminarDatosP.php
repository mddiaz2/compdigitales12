<?php
    require_once "../crud/crud.php";
    $id=$_POST['id'];
    echo Crud::eliminarDatosP($id);


?>