<?php

require_once "../crud/crud.php";



$datos=array(
    'email' => $_POST['email'],
    'password' => $_POST['password']
            );

echo Crud::insertarDatos($datos);
?>