
<?php
//este codigo es para iniciar sesion 
  session_start();
  
 
  require 'database.php';
  if (isset($_SESSION['user_email'])) {
    $records = $conn->prepare('SELECT id_Usuarios, email, password FROM tb_usuarios WHERE email = :email');
    $records->bindParam(':email', $_SESSION['user_email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $user = null;
    if (count($results) > 0) {
      $user = $results;
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
        <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <title>Competencias Digitales</title>
   <!--Instalados de forma manual que fueron descargadas-->
    <!-- para los estilos css-->
   <link rel="stylesheet" type="text/css" href="Estilos/style.css">
    <!-- para el jquery-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
	
	
	
	 <!-- para el materialize CSS-->

	 <link rel="stylesheet" type="text/css" href="materialize-v1.0.0/css/materialize.css"> 
	 <!-- para el materialize js Script-->
	
	 <script type="text/javascript" src="materialize-v1.0.0/js/materialize.min.js"></script>
	 <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	 <!-- para el bootstrap/4 CSS-->
	<!--
	  <script type="text/javascript" src="bootstrap-4.3.1/js/popper.min.js"></script>
	 <!-- para el bootstrap-4 js Script-->
<!--
	 <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/css/bootstrap.min.css"> 
	 <!-- para el popper js Script-->
	
<!--
	
	 <script type="text/javascript" src="bootstrap-4.3.1/js/bootstrap.min.js"></script>
	 
	
	 <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	  
   <!--Estos links es para bootstrap/4 y Materilize pero desde Internet con conexion a internte-->
   <!-- Esta comentadas pero por el moemento que no tengo internet pero si ya tengo las descomentare y comentare las que estan locales
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
-->
<!--
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
-->
 <!-- Compiled and minified CSS -->
 <!--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	-->
    <!-- Compiled and minified JavaScript -->
	<!--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
	-->
	<!--ojo esto ya es ajax me falta como saber editar y eliminar los datos con --> 
	
<nav class="nav-extended">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">ECDDM</a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
      
        <li><a href="logout.php">Cerrar Sesión</a></li>
      </ul>
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent">
	   <li class="tab"><a class="active" href="Administracion_frm.php">Inicio</a></li>
        <li class="tab"><a class="active" href="#" id="Usuarios">Usuarios</a></li>
        <li class="tab"><a class="active" href="#" id="Personas">Personas</a></li>
        <li class="tab "><a class="active" href="#" id="Areas">Áreas</a></li>
		<li class="tab "><a class="active" href="#" id="Niveles">Niveles</a></li>
		<li class="tab "><a class="active" href="#" id="Competencias">Competencias</a></li>
		<li class="tab "><a class="active" href="#" id="Cuestionario">Cuestionario</a></li>
		<li class="tab "><a class="active" href="#" id="Imagenes">Cargar Imágenes</a></li>
      </ul>
    </div>
  </nav>
  </head>
 
  <body>

<Center><div  class="card" style="width: 60rem;">
  <div class="card-body">

   <Center>
    <table>
   <!--
   <div  class="card" style="width: 35rem;">
  <div class="card-body">
   <thead> 
   <tr>
      <!-- este codigo permite verificar que se carge desde la lista de cuestionario o preguntas para agregar un item-->
   <th colspan="1"><a href="Cuestionario_Listar_frm.php"><h6>Nuevo</h6></a></th>
   <th colspan="5"><h6>LISTA DE PANTALLAS CON RESPECTO A CADA PREGUNTA</h6></th>
   </tr>
   </thead>
   <tbody>
   <tr>
   <td>Nº</td> 
   <td>Preguntas</td>
   <td>Pantallas</td> 	  
   <td>Nuevo</td>
   <td>Cargar</td>
   <td>Eliminar</td>
   </tr>
  
   <?php

include ('database.php');
//esta linea estaba comentada es por que yo queria traer la consulta en dos tablas 
   $records = $conn->prepare('SELECT id_Items, id_Cuestionario, Items FROM tb_items');
  //$records = $conn->prepare('SELECT tb_items.id_Items, tb_items.id_Cuestionario, tb_items.Items, tb_cuestionario.Preguntas, tb_cuestionario.Numero FROM tb_items inner join tb_cuestionario');
    $records->execute();
 while($row=$records->fetch(PDO::FETCH_ASSOC)){

$BuscarIdCuestionarioItems=$row['id_Cuestionario'];
//Consulta Interna para poder traer las preguntas y numero correspondiente esto debo quitar en caso de que no salga
$recordsIdCuestionario = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Codigo_Indicador, Preguntas, Nivel,ValorVerdadero, ValorFalso,Numero FROM tb_cuestionario where id_Cuestionario='$BuscarIdCuestionarioItems'");
 $recordsIdCuestionario->execute();
   
while($rowIdCuestionario=$recordsIdCuestionario->fetch(PDO::FETCH_ASSOC)){

$PresentarPreguntas=$rowIdCuestionario['Preguntas'];
$PresentarNumeroPreguntas=$rowIdCuestionario['Numero'];


?>
<tr>
<!-- Esta linea esta comentada es por que funcionaba con la cosnulta que esta comentada //

<td> <?php //echo $row['id_Items']; ?></td>
<td> <?php //echo $row['id_Cuestionario']; ?></td>
<td> <?php //echo $row['Items']; ?></td>
-->
<td> <?php echo $PresentarNumeroPreguntas;?></td>
<td> <?php echo $PresentarPreguntas;?></td>
<td> <?php echo $row['Items']; ?></td>

<td> <a href="Cuestionario_Listar_frm.php"> <img class="pequeña" src="imagenes/contactos.png"></a></td>
<!-- Este codigo esta comentado por que estaba sin tabla
<td> <a href="Imagenes_Crear_frm.php?id_Items=<?php //echo $row['id_Items'];?>">  Agregar imagenes a la pantalla</a></td>
-->

<td>
<!--
<form name="FormularioPasarIdPantallas" id="FormularioPasarIdPantallas" action="Imagenes_Crear_Tabla_frm.php" method="POST">
-->
<form name="FormularioPasarIdPantallas" id="FormularioPasarIdPantallas" action="modal_Imagenes_Crear_Tabla_frm.php" method="POST">
<input type="hidden" name="PasarIdItems" value="<?php echo $row['id_Items'];?>">
<input type="hidden" name="PasarPregunta" value="<?php echo $PresentarPreguntas;?>">
<button class="btn-flat" id="DiseñoMouse" name="btnPasarPantallas" type="submit"><img class="pequeña" src="Imagenes/AgregarImagen.png"></button>
</form>
</td>
<td><a href="Items_Eliminar.php?id_Items=<?php echo $row['id_Items'];?>"><img class="pequeña" src="imagenes/eliminar1.png"></a></td>


</tr>

<?php
//Llave interna para buscar preguntas del while 
}

?>
<?php
//Llave general del while que si funciona
}

?>
   </tbody>
 
   </table>
   </center>
   </div>
   </div></center>











  </body>
    <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
               <p class="grey-text text-lighten-4">Evaluamos tu perfil digital mediante la simulación de pantallas de dispositivos móviles.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text"> Acerca de</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="www.facebook.com">Autor:</a></li>
                  <li><a class="grey-text text-lighten-3" href="www.utpl.edu.ec">Visitanos en UTPL</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2019 Copyright GPL
            <a class="grey-text text-lighten-4 right" href="https://scholar.google.com.ec/scholar?q=competencias+digitales+moviles&hl=es&as_sdt=0&as_vis=1&oi=scholart">Competencias Digitales</a>
            </div>
          </div>
        </footer>
</html>