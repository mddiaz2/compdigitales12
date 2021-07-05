<?php
    require_once "../crud/crud.php";
    $obj= new Crud();
    $datos=$obj->mostrarDatosA();
    $tabla=' <table class="table table-hover table-dark">
    <thead>
        <tr class="font-weight-bold">
            <td>Areas</td>
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
    </thead>
    <tbody>';
    $datosTabla="";
    foreach($datos as $key =>$value){
        $datosTabla=$datosTabla.'<tr>
        <td>'.$value['area'].'</td>
        <td>
            <span class="btn btn-warning btn-sm" onclick="obtenerDatosA('.$value['id_area'].')" data-toggle="modal" data-target="#actualizarModalA">
                <i class="fas fa-edit"></i>
            </span>
            
        </td>
        <td>
            <span class="btn btn-danger btn-sm" onclick="eliminarDatosA('.$value['id_area'].')">
                <li class="fas fa-trash-alt"></li>
            </span>
        </td>
    </tr>';
    }
    echo $tabla.$datosTabla.'</tbody></table>';
