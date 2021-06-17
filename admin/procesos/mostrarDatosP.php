<?php
    require_once "../crud/crud.php";

    $obj= new Crud();
    $datos=$obj->mostrarDatosP();

    $tabla=' <table class="table table-hover table-dark">
    <thead>
        <tr class="font-weight-bold">
            <td>ID</td>
            <td>Email</td>
            <td>Password</td>
       
            <td>Editar</td>
            <td>Eliminar</td>
        </tr>
    </thead>
    <tbody>';
    $datosTabla="";

    foreach($datos as $key =>$value){
        $datosTabla=$datosTabla.'<tr>

        <td>'.$value['id'].'</td>
        <td>'.$value['email'].'</td>
        <td>'.$value['password'].'</td>
        

      
        <td>
            <span class="btn btn-warning btn-sm" onclick="obtenerDatosP('.$value['id'].')" data-toggle="modal" data-target="#actualizarModalP">
                <i class="fas fa-edit"></i>
            </span>
            
        </td>
        <td>
            <span class="btn btn-danger btn-sm" onclick="eliminarDatosP('.$value['id'].')">
                <li class="fas fa-trash-alt"></li>
            </span>
        </td>
    </tr>';
    }

    echo $tabla.$datosTabla.'</tbody></table>';

   
?>
