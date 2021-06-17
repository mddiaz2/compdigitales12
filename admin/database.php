<?php
//este codigo si funcionaba bien 

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'competenciasdigitales_database';
try {
 $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' .$e->getMessage());
}


//este codigo es para poder probar cuando se conecta y se libera memoria

//class Conexcion{
//private $server = 'localhost:3306';
//private $username = 'root';
//private $password = '';
//private $database = 'competenciasdigitales_database';
//private $conn=null;

//public function getConexcion(){
//try {
//$this->$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
 //return $this->$conn;
//} catch (PDOException $e) {
  //die('Connection Failed: ' .$e->getMessage());
//}
//finally{
	//$this->$conn=null;
//}
	
//}

 //}


?>