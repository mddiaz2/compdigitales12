<!DOCTYPE html>
<html>
  <head>
    
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta charset="utf-8">
   <title>Competencias Digitales</title>
   <!--Instalados de forma manual que fueron descargadas-->
    <!-- para los estilos css-->
	<link rel="stylesheet" type="text/css" href="assets/css/estilos.css">
    <!-- para el jquery-->
    
	  <!-- para el alertify css-->
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
	 <!-- para el materialize CSS-->
<!--
	 <link rel="stylesheet" type="text/css" href="materialize-v1.0.0/css/materialize.css"> 
	 <!-- para el materialize js Script-->
<!--
	 <script type="text/javascript" src="materialize-v1.0.0/js/materialize.min.js"></script>
	 <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	 <!-- para el bootstrap/4 CSS-->
	
	  <script type="text/javascript" src="bootstrap-4.3.1/js/popper.min.js"></script>
	 <!-- para el bootstrap-4 js Script-->

	 <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/css/bootstrap.min.css"> 
	 <!-- para el popper js Script-->
	 <script type="text/javascript" src="bootstrap-4.3.1/js/bootstrap.min.js"></script>
	 <!-- para el alertify js Script-->
	 <script src="alertifyjs/alertify.js"></script>
	
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
	<!--Este metodo es para agregar un nuevo registro --> 
	<!--Este metodo permite registrar nuevos items-->
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnGuardarItems').click(function(){
		var datos=$('#frmItemsRegistra_ajax').serialize();
		$.ajax({
			type:"POST",
			url:"Items_Crear_ope.php",
			data:datos,
			success:function(r){
				if(r==1){
					
					alertify.success("Se registro correctamente");
					
				}else{
					alertify.error("Error de servidor 404...!");
				}
			}
		})//.done(function (info){
			//modtar mensaje del servidor
		
			//alert(info);
			
			
		//});
		//Esta linea permite que no se refrezce la pagina por cuanto para algunas cosas si va pero en este caso no
		return false;
	});
});

</script>
	
<!--Codigo para poder presentar la tabla de registros-->

		<script type="text/javascript">
$(document).ready(function (){
$('#Items_Listar_Datos_frm1').load('pantallas2.php');	
});
	
</script>
  </head>
 
 <?php
	include ('database.php');
	
	$id_Cuestionario=$_REQUEST['id_Cuestionario'];
	$records = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Codigo_Indicador, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$id_Cuestionario'");
	//$records = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$id_Cuestionario'");
	$records->execute();
	$row=$records->fetch(PDO::FETCH_ASSOC);
	//ojo si no sale debemos enviar solo la pregunta que quermos poner el items
    $row['id_Cuestionario'];
	echo "<br>";
	echo $CuestionarioPregunta=$row['id_Cuestionario'];
    ?>
 
  <body>

<div class="container">
<div id="Items_Listar_Datos_frm1">

</div>
</div>


  </body>
</html>
