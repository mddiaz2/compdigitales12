<?php

require_once "../crud/crud.php";



$datos=array(
    'competencia' => $_POST['competencia'],
    'id_area' => $_POST['id_area']
            );

echo Crud::insertarDatosC($datos);
?>