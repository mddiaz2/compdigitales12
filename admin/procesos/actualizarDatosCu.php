<?php

require_once "../crud/crud.php";



$datos=array(
    'id_Areas' => $_POST['id_Areasu'],
    'id_Competencias' => $_POST['id_Competenciasu'],
    'id_Niveles' => $_POST['id_Nivelesu'],
    'Numero' => $_POST['Numerou'],
    'Preguntas' => $_POST['Preguntasu'],
    'Nivel' => $_POST['Nivelu'],
    'ValorVerdadero' => $_POST['ValorVerdaderou'],
    'ValorFalso' => $_POST['ValorFalsou'],
    'id_Cuestionario' => $_POST['id_Cuestionario']

            );

echo Crud::actualizarDatosCu($datos);
?>