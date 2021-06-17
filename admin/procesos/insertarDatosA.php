<?php

require_once "../crud/crud.php";



$datos=array(

    'area' => $_POST['area']
            );

echo Crud::insertarDatosA($datos);
?>