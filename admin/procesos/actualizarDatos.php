<?php

require_once "../crud/crud.php";



$datos=array(
    'email' => $_POST['emailu'],
    'password' => $_POST['passu'],
    'id' => $_POST['id']
            );

echo Crud::actualizarDatos($datos);
?>