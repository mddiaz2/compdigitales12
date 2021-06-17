<?php
    require_once "../crud/crud.php";

    $obj= new Crud();
    $datos=$obj->mostrarDatosCu();

    $tabla=' <table class="table  table-hover table-dark">
    <thead>
        <tr class="font-weight-bold">
            <td>Nro</td>
            <td>Áreas</td>
            <td>Competencias</td>
            <td>Preguntas</td>
            <td>Nivel</td>
            <td>Valor Verdadero</td>
            <td>Valor Falso</td>
            <td>Crear Pantallas</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
    </thead>
    <tbody>';
    $datosTabla="";

    foreach($datos as $key =>$value){
        $datosTabla=$datosTabla.'<tr>

        <td>'.$value['Numero'].'</td>
        <td>'.$value['area'].'</td>
        <td>'.$value['competencia'].'</td>
        <td>'.$value['Preguntas'].'</td>
        <td>'.$value['Nivel'].'</td>
        <td>'.$value['ValorVerdadero'].'</td>
        <td>'.$value['ValorFalso'].'</td>
      


        <td>
        <form action="pantallas2.php" method="POST">
        <input name="EnviarIdCuestionario1" value="'.$value['id_Cuestionario'].'" type="hidden">
        <button  class="btn-flat" name="btnPasarIdCuestionario1" id="btnPasarIdCuestionario1"><img class="pequeñaActivar" src="ImagenesProgramacion/cel22.png"></button>
        </form>
    </td>
        <td>
            <span class="btn btn-warning btn-sm" onclick="obtenerDatosCu('.$value['id_Cuestionario'].')" data-toggle="modal" data-target="#actualizarModalCu">
                <i class="fas fa-edit"></i>
            </span>
            
        </td>
       
        <td>
            <span class="btn btn-danger btn-sm" onclick="eliminarDatosCu('.$value['id_Cuestionario'].')">
                <li class="fas fa-trash-alt"></li>
            </span>
        </td>
    </tr>';
    }

    echo $tabla.$datosTabla.'</tbody></table>';

   
?>
