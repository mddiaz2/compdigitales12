<?php
    require_once "../crud/crud.php";
    $id_area=$_POST['id_area'];
    echo Crud::eliminarDatosA($id_area);


?>