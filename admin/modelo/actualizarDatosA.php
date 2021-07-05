<?php
require_once "../crud/crud.php";
$datos = array(
    'area' => $_POST['areau'],
    'id_area' => $_POST['id_area']
);
echo Crud::actualizarDatosA($datos);
