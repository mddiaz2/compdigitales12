<?php
//Este codigo permite cerrar la sesion general de la aplicacion
  session_start();
  session_unset();
  session_destroy();
  header('Location: /compdigitales');
?>
