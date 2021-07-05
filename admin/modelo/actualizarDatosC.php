<?php

require_once "../crud/crud.php";



$datos=array(
    'competencia' => $_POST['competenciau'],
    'id' => $_POST['id']

            );

echo Crud::actualizarDatosC($datos);
?>