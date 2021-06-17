<?php
$server = '127.0.0.1';
$username = 'root';
$password = '';
$database = 'competenciasdigitales_database';
try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' .$e->getMessage());
}

?>
