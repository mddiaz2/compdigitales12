<?php
class Conexion{
    public function conectar(){
        $conexion = new PDO("mysql:host=127.0.0.1;dbname=competenciasdigitales_database","root","");
        return $conexion;
    }
}
?>