<?php

require_once "../crud/crud.php";



$datos=array(
    'email' => $_POST['emailp'],
    'password' => $_POST['passp'],
    'id' => $_POST['id']
            );

echo Crud::actualizarDatosP($datos);
?>