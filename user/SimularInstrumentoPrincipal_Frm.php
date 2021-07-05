<<<<<<< HEAD
<?php
//este codigo es para iniciar sesion 
session_start();

require 'database.php';
$user = '';
if (isset($_SESSION['personas_email'])) {
	$records = $conn->prepare('SELECT id, email, password FROM tb_personas WHERE email = :email');
	$records->bindParam(':email', $_SESSION['personas_email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	if (count($results) > 0) {
		$user = $results;
		$Personas = $user['email'];
	}
	//La llve esta comentada es para ya poner el inicio de session activada
	//}
?>

	<?php
	//Dios mio ayudame si porfavor ya no mas atracos
	//Esta consulta es para que se guarde en la base de datos las respuestas del usuario 
	if (!empty($_POST['id_Cuestionario']) && !empty($_POST['id_Area']) && !empty($_POST['id_Competencias']) && !empty($_POST['id_Niveles']) && !empty($_POST['Numero']) && !empty($_POST['email']) && !empty($_POST['PuntajeVerdadero']) && !empty($_POST['ValorVerdadero']) && !empty($_POST['PuntajeFalso']) && !empty($_POST['ValorFalso']) && !empty($_POST['Nivel'])) {
		//$sql = 'INSERT INTO tb_respuestas (id_Cuestionario, id_Area, id_Competencias, id_Niveles, Numero, email, PuntajeVerdadero, ValorVerdadero, PuntajeFalso, ValorFalso, Nivel) VALUES (:id_Cuestionario, :id_Area, :id_Competencias, :id_Niveles, :Numero, :email, :PuntajeVerdadero, :ValorVerdadero, :PuntajeFalso, :ValorFalso, :Nivel)';
		//session_start();
		$RecibirToken = 1;
		if (isset($_SESSION['PasarToken'])) {

			if ($_SESSION['PasarToken'] > 0) {
				$RecibirToken = $_SESSION['PasarToken'];
				$RecibirToken = $RecibirToken + 1;
			}
		}

		$Token = $RecibirToken;
		$Id_Cuestionario = $_POST['id_Cuestionario'];
		$id_Area = $_POST['id_Area'];
		$id_Competencias = $_POST['id_Competencias'];
		$id_Niveles = $_POST['id_Niveles'];
		$Numero = $_POST['Numero'];
		$email = $_POST['email'];
		$PuntajeVerdadero = $_POST['PuntajeVerdadero'];
		$ValorVerdadero = $_POST['ValorVerdadero'];
		$PuntajeFalso = $_POST['PuntajeFalso'];
		$ValorFalso = $_POST['ValorFalso'];
		$Nivel = $_POST['Nivel'];
		ini_set('date.timezone', 'America/Mexico_City');
		$Fecha = date('Y-m-d', time());
		$sql = "INSERT INTO tb_respuestas (id_Cuestionario, id_Area, id_Competencias, id_Niveles, Numero, email, PuntajeVerdadero, ValorVerdadero, PuntajeFalso, ValorFalso, Nivel, Fecha, Token) VALUES ('$Id_Cuestionario', '$id_Area', '$id_Competencias', '$id_Niveles', '$Numero', '$email', '$PuntajeVerdadero', '$ValorVerdadero', '$PuntajeFalso', '$ValorFalso', '$Nivel', '$Fecha', '$Token')";
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':id_Cuestionario', $_POST['id_Cuestionario']);
		$stmt->bindParam(':id_Area', $_POST['id_Area']);
		$stmt->bindParam(':id_Competencias', $_POST['id_Competencias']);
		$stmt->bindParam(':id_Niveles', $_POST['id_Niveles']);
		$stmt->bindParam(':Numero', $_POST['Numero']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->bindParam(':PuntajeVerdadero', $_POST['PuntajeVerdadero']);
		$stmt->bindParam(':ValorVerdadero', $_POST['ValorVerdadero']);
		$stmt->bindParam(':PuntajeFalso', $_POST['PuntajeFalso']);
		$stmt->bindParam(':ValorFalso', $_POST['ValorFalso']);
		$stmt->bindParam(':Nivel', $_POST['Nivel']);
		if ($stmt->execute()) {
		} else {
		}
	}

	?>




	<!DOCTYPE html>
	<html>

	<head>

		<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta charset="utf-8">
		<title>Competencias digitales</title>
		<!--Instalados de forma manual que fueron descargadas-->
		<!-- para los estilos css-->
		<link rel="stylesheet" type="text/css" href="estilos/estilos.css">
		<!-- para el jquery-->
		<script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>



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

		<link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/css/bootstrap.css">
		<!-- para el popper js Script-->



		<script type="text/javascript" src="bootstrap-4.3.1/js/bootstrap.min.js"></script>

		<link rel="stylesheet" href="Iconos/fonts.css">
		<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas').click(function() {
					var datos = $('#RespuestasFrmAjax').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 2 sin recargar la pagina f2 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas2').click(function() {
					var datos = $('#RespuestasFrmAjax2').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


		<!--Este ajax permite guardar los valores de la posicion falsa 3 sin recargar la pagina f3 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas3').click(function() {
					var datos = $('#RespuestasFrmAjax3').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 4 sin recargar la pagina f4 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas4').click(function() {
					var datos = $('#RespuestasFrmAjax4').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 5 sin recargar la pagina f5 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas5').click(function() {
					var datos = $('#RespuestasFrmAjax5').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 6 sin recargar la pagina f6 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas6').click(function() {
					var datos = $('#RespuestasFrmAjax6').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 7 sin recargar la pagina f7 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas7').click(function() {
					var datos = $('#RespuestasFrmAjax7').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 8 sin recargar la pagina f8 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas8').click(function() {
					var datos = $('#RespuestasFrmAjax8').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 9 sin recargar la pagina f9 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas9').click(function() {
					var datos = $('#RespuestasFrmAjax9').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 10 sin recargar la pagina f10 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas10').click(function() {
					var datos = $('#RespuestasFrmAjax10').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 11 sin recargar la pagina f11 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas11').click(function() {
					var datos = $('#RespuestasFrmAjax11').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 12 sin recargar la pagina f12 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas12').click(function() {
					var datos = $('#RespuestasFrmAjax12').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 13 sin recargar la pagina f13 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas13').click(function() {
					var datos = $('#RespuestasFrmAjax13').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 14 sin recargar la pagina f14 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas14').click(function() {
					var datos = $('#RespuestasFrmAjax14').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 15 sin recargar la pagina f15 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas15').click(function() {
					var datos = $('#RespuestasFrmAjax15').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--Este ajax permite guardar los valores de la posicion falsa 16 sin recargar la pagina f16 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas16').click(function() {
					var datos = $('#RespuestasFrmAjax16').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 17 sin recargar la pagina f17 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas17').click(function() {
					var datos = $('#RespuestasFrmAjax17').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 18 sin recargar la pagina f18 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas18').click(function() {
					var datos = $('#RespuestasFrmAjax18').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 19 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas19').click(function() {
					var datos = $('#RespuestasFrmAjax19').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 20 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas20').click(function() {
					var datos = $('#RespuestasFrmAjax20').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 21 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas21').click(function() {
					var datos = $('#RespuestasFrmAjax21').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 22 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas22').click(function() {
					var datos = $('#RespuestasFrmAjax22').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 23 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas23').click(function() {
					var datos = $('#RespuestasFrmAjax23').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 24 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas24').click(function() {
					var datos = $('#RespuestasFrmAjax24').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->



		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 25 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas25').click(function() {
					var datos = $('#RespuestasFrmAjax25').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
		<!--Este ajax permite guardar los valores de la posicion falsa 26 -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#btnRespuestas26').click(function() {
					var datos = $('#RespuestasFrmAjax26').serialize();
					$.ajax({
						type: "POST",
						url: "Respuestas_Crear_ope.php",
						data: datos,
						//success:function(r){
						//if(r==1){
						//alert("se guardo");

						//}else{
						//alert("no se guardo");
						//}
						//}
					}).done(function(info) {
						//mostar mensaje del servidor
						alert(info);
					});
					return false;
				});
			});
		</script>
		<!--/////////////////////////////////////////////////////////////////////////////////////////////-->



		<!--
		<li>
    <p><?php //if(!empty($user)): 
		?>
Bienvenido(a):// <?= $user['email']; ?>
           
    <?php //endif; 
	?></p>
      </li>
	-->
		<!--Encabezado de la pagina principal -->
		<!--<div class="DivnavbarOculto">
=======

<?php
//este codigo es para iniciar sesion 
  session_start();
 
  require '../datos/db.php';
  $user ='';
  if (isset($_SESSION['personas_email'])) {
    $records = $conn->prepare('SELECT id, email, password, Estado FROM tb_personas WHERE email = :email');
    $records->bindParam(':email', $_SESSION['personas_email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    if (count($results) > 0) {
      $user = $results;
	 $Personas=$user['email'];
    }
	//La llve esta comentada es para ya poner el inicio de session activada
  //}
?>

<?php
//Dios mio ayudame si porfavor ya no mas atracos
//Esta consulta es para que se guarde en la base de datos las respuestas del usuario 
if (!empty($_POST['id_Cuestionario'])&& !empty($_POST['id_Area'])&& !empty($_POST['id_Competencias'])&& !empty($_POST['id_Niveles'])&&!empty($_POST['Numero']) && !empty($_POST['email'])&& !empty($_POST['PuntajeVerdadero']) && !empty($_POST['ValorVerdadero'])&& !empty($_POST['PuntajeFalso'])&& !empty($_POST['ValorFalso'])&& !empty($_POST['Nivel'])) {
    //$sql = 'INSERT INTO tb_respuestas (id_Cuestionario, id_Area, id_Competencias, id_Niveles, Numero, email, PuntajeVerdadero, ValorVerdadero, PuntajeFalso, ValorFalso, Nivel) VALUES (:id_Cuestionario, :id_Area, :id_Competencias, :id_Niveles, :Numero, :email, :PuntajeVerdadero, :ValorVerdadero, :PuntajeFalso, :ValorFalso, :Nivel)';
    //session_start();
	$RecibirToken=1;
		if (isset($_SESSION['PasarToken'])) {
			
			if ($_SESSION['PasarToken'] > 0) {
			 $RecibirToken=$_SESSION['PasarToken']; 
			 $RecibirToken=$RecibirToken+1;
			}
		}

     $Token=$RecibirToken;
	$Id_Cuestionario=$_POST['id_Cuestionario'];
	$id_Area=$_POST['id_Area'];
	$id_Competencias=$_POST['id_Competencias'];
	$id_Niveles=$_POST['id_Niveles'];
	$Numero=$_POST['Numero'];
	$email=$_POST['email'];
	$PuntajeVerdadero=$_POST['PuntajeVerdadero'];
	$ValorVerdadero=$_POST['ValorVerdadero'];
	$PuntajeFalso=$_POST['PuntajeFalso'];
	$ValorFalso=$_POST['ValorFalso'];
	$Nivel=$_POST['Nivel'];
	ini_set('date.timezone','America/Mexico_City');
	$Fecha=date('Y-m-d',time());
	$sql = "INSERT INTO tb_respuestas (id_Cuestionario, id_Area, id_Competencias, id_Niveles, Numero, email, PuntajeVerdadero, ValorVerdadero, PuntajeFalso, ValorFalso, Nivel, Fecha, Token) VALUES ('$Id_Cuestionario', '$id_Area', '$id_Competencias', '$id_Niveles', '$Numero', '$email', '$PuntajeVerdadero', '$ValorVerdadero', '$PuntajeFalso', '$ValorFalso', '$Nivel', '$Fecha', '$Token')";	
	$stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_Cuestionario', $_POST['id_Cuestionario']);
	$stmt->bindParam(':id_Area', $_POST['id_Area']);
	$stmt->bindParam(':id_Competencias', $_POST['id_Competencias']);
	$stmt->bindParam(':id_Niveles', $_POST['id_Niveles']);
	$stmt->bindParam(':Numero', $_POST['Numero']);
	$stmt->bindParam(':email', $_POST['email']);
	$stmt->bindParam(':PuntajeVerdadero', $_POST['PuntajeVerdadero']);
	$stmt->bindParam(':ValorVerdadero', $_POST['ValorVerdadero']);
	$stmt->bindParam(':PuntajeFalso', $_POST['PuntajeFalso']);
	$stmt->bindParam(':ValorFalso', $_POST['ValorFalso']);
	$stmt->bindParam(':Nivel', $_POST['Nivel']);
    if ($stmt->execute()) {
	 
    } else {


	}
	}

?>




<!DOCTYPE html>
<html>
  <head>
        
	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta charset="utf-8">
  <title>Competencias digitales</title>
   <!--Instalados de forma manual que fueron descargadas-->
    <!-- para los estilos css-->
   <link rel="stylesheet" type="text/css" href="estilos/style.css">
    <!-- para el jquery-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
	
	
	
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

	 <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/css/bootstrap.css"> 
	 <!-- para el popper js Script-->
	

	
	 <script type="text/javascript" src="bootstrap-4.3.1/js/bootstrap.min.js"></script>
	 
		  <link rel="stylesheet" href="Iconos/fonts.css"> 
	 <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas').click(function(){
		var datos=$('#RespuestasFrmAjax').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->	
	
	<!--Este ajax permite guardar los valores de la posicion falsa 2 sin recargar la pagina f2 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas2').click(function(){
		var datos=$('#RespuestasFrmAjax2').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	
<!--Este ajax permite guardar los valores de la posicion falsa 3 sin recargar la pagina f3 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas3').click(function(){
		var datos=$('#RespuestasFrmAjax3').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 4 sin recargar la pagina f4 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas4').click(function(){
		var datos=$('#RespuestasFrmAjax4').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 5 sin recargar la pagina f5 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas5').click(function(){
		var datos=$('#RespuestasFrmAjax5').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 6 sin recargar la pagina f6 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas6').click(function(){
		var datos=$('#RespuestasFrmAjax6').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 7 sin recargar la pagina f7 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas7').click(function(){
		var datos=$('#RespuestasFrmAjax7').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 8 sin recargar la pagina f8 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas8').click(function(){
		var datos=$('#RespuestasFrmAjax8').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 9 sin recargar la pagina f9 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas9').click(function(){
		var datos=$('#RespuestasFrmAjax9').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 10 sin recargar la pagina f10 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas10').click(function(){
		var datos=$('#RespuestasFrmAjax10').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 11 sin recargar la pagina f11 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas11').click(function(){
		var datos=$('#RespuestasFrmAjax11').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 12 sin recargar la pagina f12 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas12').click(function(){
		var datos=$('#RespuestasFrmAjax12').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 13 sin recargar la pagina f13 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas13').click(function(){
		var datos=$('#RespuestasFrmAjax13').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 14 sin recargar la pagina f14 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas14').click(function(){
		var datos=$('#RespuestasFrmAjax14').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

	<!--Este ajax permite guardar los valores de la posicion falsa 15 sin recargar la pagina f15 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas15').click(function(){
		var datos=$('#RespuestasFrmAjax15').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
	<!--Este ajax permite guardar los valores de la posicion falsa 16 sin recargar la pagina f16 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas16').click(function(){
		var datos=$('#RespuestasFrmAjax16').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 17 sin recargar la pagina f17 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas17').click(function(){
		var datos=$('#RespuestasFrmAjax17').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 18 sin recargar la pagina f18 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas18').click(function(){
		var datos=$('#RespuestasFrmAjax18').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 19 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas19').click(function(){
		var datos=$('#RespuestasFrmAjax19').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 20 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas20').click(function(){
		var datos=$('#RespuestasFrmAjax20').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 21 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas21').click(function(){
		var datos=$('#RespuestasFrmAjax21').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 22 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas22').click(function(){
		var datos=$('#RespuestasFrmAjax22').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 23 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas23').click(function(){
		var datos=$('#RespuestasFrmAjax23').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 24 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas24').click(function(){
		var datos=$('#RespuestasFrmAjax24').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 25 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas25').click(function(){
		var datos=$('#RespuestasFrmAjax25').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--Este ajax permite guardar los valores de la posicion falsa 26 --> 
	<script type="text/javascript">
$(document).ready(function (){
	$('#btnRespuestas26').click(function(){
		var datos=$('#RespuestasFrmAjax26').serialize();
		$.ajax({
			type:"POST",
			url:"Respuestas_Crear_ope.php",
			data:datos,
			//success:function(r){
				//if(r==1){
					//alert("se guardo");
					
				//}else{
					//alert("no se guardo");
				//}
			//}
		}).done(function (info){
			//mostar mensaje del servidor
			alert(info);
		});
		return false;
	});
});
</script>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	


	<!--
		<li>
    <p><?php //if(!empty($user)): ?>
Bienvenido(a):// <?= $user['email']; ?>
           
    <?php //endif; ?></p>
      </li>
	-->
<!--Encabezado de la pagina principal -->
<!--<div class="DivnavbarOculto">
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
    <nav class="navbar navbar-expand-lg navbar-light navAdministracion">
         <div><b>Competencias digitales: test de evaluación</b></div>
	<div class="navdiseño">
 
	   <ul class="uldiseño">
	
        <li id="fondoMouselinks" class="LinksnavbarActive"><a class="adiseño lidiseñoadaptable" href="#"><span class="icon-mobile span"></span><b>Principal</b></a></li>
    <!--
	   <li id="fondoMouselinks"  class="lidiseño"><a class="adiseño2 lidiseñoadaptable" href="logout.php"><span class="icon-exit span"></span>About</a></li>
    
	  </ul>
	  
    </div>
	
	<!--<a class="adiseño2 lidiseñoadaptable" href="#"><b>About</b></a></li>
    
  </nav>
 </div>  
-->
<<<<<<< HEAD
		<!--
=======
<!--
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
<div class="menu_bar">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
   <font color="#fff"><span class="icon-menu"></span>Menú</font>
  </button>
  </div>
 -->
<<<<<<< HEAD


	</head>
	<!--<body background="#212529">-->

	<body background="#fff">

		<?php
		//este codigo es para poder traer desde la base de datos las preguntas resgistradas desde la tabla cuestionario para hacer el ciclo for
		include('database.php');
		$sumapreguntas = 0;
		$recordssumapreguntas = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario");
		$recordssumapreguntas->execute();
		while ($TotalPreguntas = $recordssumapreguntas->fetch(PDO::FETCH_ASSOC)) {
			//esto me permite para presentar las preguntas que hay en la base de datos y visualice el usuarios
			$sumapreguntas = $TotalPreguntas['Numero'];
		}

		?>
		<!--Este código es para la barra de progresbar-->
		<?php

		// $UmentaPreguntasProgreso=$Totalpreguntas2=100/30;
		$UmentaPreguntasProgreso = (100 / $sumapreguntas);


		//$UmentaPreguntas=3.33;
		//if(isset($_POST['btnAumenta'])|| isset($_POST['NumeroPregunta'])){
		if (isset($_POST['NumeroPregunta'])) {
			$UmentaPreguntasProgreso += $_POST['valorProgreso'];
		} else {
			if (isset($_POST['sumaItemsbtn'])) {
				$UmentaPreguntasProgreso = $_POST['valorProgreso'];
			}
		}
		?>
		<style type="text/CSS">
			.progresdiseño{
=======
  

  </head>
  <!--<body background="#212529">-->
  <body background="#fff">
  
  <?php
//este codigo es para poder traer desde la base de datos las preguntas resgistradas desde la tabla cuestionario para hacer el ciclo for
	include ('database.php');
	$sumapreguntas=0;
    $recordssumapreguntas = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario");
    $recordssumapreguntas->execute();
    while($TotalPreguntas=$recordssumapreguntas->fetch(PDO::FETCH_ASSOC)){
	//esto me permite para presentar las preguntas que hay en la base de datos y visualice el usuarios
	$sumapreguntas=$TotalPreguntas['Numero'];	
	}

?>
  <!--Este código es para la barra de progresbar-->
 <?php 
  
  // $UmentaPreguntasProgreso=$Totalpreguntas2=100/30;
  $UmentaPreguntasProgreso=(100/$sumapreguntas);
  
 
  //$UmentaPreguntas=3.33;
  //if(isset($_POST['btnAumenta'])|| isset($_POST['NumeroPregunta'])){
	  if(isset($_POST['NumeroPregunta'])){
	  $UmentaPreguntasProgreso+=$_POST['valorProgreso'];
	  
  
  }else{
	 if(isset($_POST['sumaItemsbtn'])){
	 $UmentaPreguntasProgreso=$_POST['valorProgreso'];  
	 }
  }
  ?>
  <style type="text/CSS">
   .progresdiseño{
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
	  height:30px;
	  width:100%;
	 
  }
  .outter{
	  height:15px;
	  width:100%;
	  background-color: #fff;
	  border: solid 1px #fff;
  }
  .inner{
	  height:15px;
<<<<<<< HEAD
	  width:<?php echo $UmentaPreguntasProgreso ?>%; 
	  background-color: green;
  }
</style>
		<!--Fin del codigo de la barra de progresbar-->
		<div class="ContenedorSimularInstrumento">


			<?php
			echo "<div class='ContenedorCirculo'>";
			echo "<img class='ImgInicioSesion' src='ImagenesProgramacion/Logo.png'>";

			echo "</div>";

			echo "<div>";

			echo "<b><font color='#F7B40F'> Bienvenido(a)</font></b>";
			echo "<br>";
			echo "<b><font color='#fff'>";
			if (!empty($user)) {
				echo $user['email'];
			}
			echo "</font></b>";
			echo "<br>";
			echo "<b><font color='#F7B40F'> <a id='fondoMouseCerrarSesion' class='adiseño3' href='logout.php'>Cerrar sesión</a></font></b>";
			echo "</div>";
			echo "<br>";
			echo "<b><font color='#FFF'>Test de autoevaluación</font></b>";
			echo "<br>";
			echo "<hr color='#fff'>";







			$N = 1;
			//echo "<br>";
			//echo "La varibal N para las prehuntas numero que empieza en 1 es: ",$N;
			//$clicImagen=0;
			//echo "<br>";
			//echo "La varible clic imagen que empieza en 0 es: ",$clicImagen;
			$aumetaPreguntas = $N;
			//echo "<br>";
			//echo "La aumetaPreguntas=$N 1 es:",$aumetaPreguntas;
			$SumarPreguntas = 0;
			//para comprobar
			//echo "La pregunta en la que te encuentras respondiendo es la: ", $aumetaPreguntas=$SumarPreguntas+$N;
			//echo "<br>";
			//echo "La SumaPreguntas que empieza en 0 es:",$SumarPreguntas;
			//ojo esto debe estar debajo de to esto antes de if btneitems jojo
			$p = 1;
			//echo "<br>";
			//echo "La variable p que aumenta los items y empiez en 1:",$p;
			$aumetaItems = $p;
			//echo "<br>";
			//echo "La variable que aumenta los items se suma con p $aumetaItems=$p; y empiez en 1:",$aumetaItems=$p;
			$Tomarid_Cuestionario = 0;
			//echo "<br>";
			//echo "La variable Tomar idCuestionario empiez en 0: ",$Tomarid_Cuestionario;
			$sumaItems = 0;
			//echo "<br>";
			//echo "La variable sumaItems es para ver cuantos items hay empieza en 0: ",$sumaItems;
			$SumarItems = 0;
			//echo "<br>";
			//echo "La variable SumaItems es para aumentar los itemes con la base de datos que damos clci en la imagen empieza en ojo esto S s 0: ",$SumarItems;
			//ojo esta variable se la debe quitar si me sale un erro era de diseño ojo cuando hagas prueba 17
			$TomaridItems = 0;
			//	echo "<br>";
			//echo "La variable TomaridItems es para el items  empieza en 0: ",$TomaridItems;
			$buscarIdCuestionario = 0;
			//echo "<br>";
			//echo "La variable $buscarIdCuestionario es para tomar los idcuestioanrios empieza en 0: ",$buscarIdCuestionario;
			$SumaPreguntasClicImagenverdadera = 0;
			//echo "<br>";
			//Dios mio ayudame que ya estoy sin fuezas// Muy bien a qui traigo el valor de aumetaPreguntas-1 para poder avanzar con las preguntas
			if (isset($_POST['sumaItemsbtn'])) {
				$SumaPreguntasClicImagenverdadera = $_POST['AumetarPreguntas'];
				//ojo esta linea anterior me trare la pregunta actual menos 1
				//echo "<br>";
				$aumetaPreguntas = $SumaPreguntasClicImagenverdadera + $N;
				//echo "<br>";
				//echo "<br>";
			}
			//ojo debe estar la variable tambie fuera para que sea afectada ojo $aumetaPreguntas=$SumaPreguntasClicImagenverdadera+$N;
			//echo "<br>";

			//Solo para ver si pasa o no pasa y sino hacer un condicional
			$aumetaPreguntas = $SumaPreguntasClicImagenverdadera + $N;

			//Este codigo es para aumentar las preguntas mas uno
			if (isset($_POST['NumeroPregunta'])) {
				$message = 'Hola Dios debe aumenta con la consulta a 1+';
				$SumarPreguntas = $_POST['AumetarAumentarPreguntasBD'];
				//echo "<br>";
				$aumetaPreguntas = $SumarPreguntas + $N;
				//echo "<br>";

				//la llave que esta acontinuacion es del if de aumetanr itemes con el boton suma	
			}


			?>



			<!--////////////////////////////////////////////////////-->
			<!-- Este codigo lo realizare con el while inicializado en uno solo para poder probar y luego incrementare i=i+1 ojo cuando de el botn no se responder este incrementara o cuando de sigueinte-->

			<?php
			//$i=1;
			//se debe poner la variable una vez que este bien con logica  ($sumapreguntas) while($i<=$sumapreguntas){
			//  $AumetarAumentarPreguntasBD=0;
			//while($i<=1){


			//Inicio del if General
			if ($aumetaPreguntas <= $sumapreguntas) {
				//if($aumetaPreguntas<=1){
=======
	  width:<?php echo $UmentaPreguntasProgreso?>%; 
	  background-color: green;
  }
</style>  


  <!--Fin del codigo de la barra de progresbar-->
  














>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7




<<<<<<< HEAD
				///////////////////////////////////////////////
				//Consulta para traer pregunta a pregunta 
				//$Numero=1; ojo ya le cambie Dios
				include('database.php');
				$recordspreguntaindividual = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where Numero='$aumetaPreguntas'");
				//$recordspreguntaindividual = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, Codigo_Indicador, Preguntas, Nivel,Valor,Numero FROM tb_cuestionario where Numero='$i'");
				$recordspreguntaindividual->execute();
				$rowpregunta = $recordspreguntaindividual->fetch(PDO::FETCH_ASSOC);
				// esto es para buscar con la misma consulta
				$buscarAreas = $rowpregunta['id_Areas'];
				$buscarCompetencias = $rowpregunta['id_Competencias'];
				$buscarNivel = $rowpregunta['Nivel'];
				//Esta variable es solo para que se guarde los niveles Basico, Medio o Avanzado
				$buscarIdNiveles = $rowpregunta['id_Niveles'];
				//ojo esta varieble la pinicialice poruqe me daba error pero si me siguie dando mejor la quito de arriba de la inicializacionojojo
				$buscarIdCuestionario = $rowpregunta['id_Cuestionario'];
				//echo "<br>";
				//echo  "El id que justo trae de la tabla cuestionario es es: ", $buscarIdCuestionario;
				//Consulta para traer pregunta a pregunta 
				/////////////////////////////////////////////////////////////////////////////////////////////////



				//////////////////////////////////////////////////////////////////////////////////////////////////
				//Consulta para traer las areas de la base de datos segun la pregunta correspondiente


				echo "<b><font color='#fff'>Área:</font></b>";
				echo "<br>";
				$presentarArea = '';
				$recordsAreas = $conn->prepare("SELECT id_area, area FROM tb_area where id_area='$buscarAreas'");
				$recordsAreas->execute();
				while ($buscararea = $recordsAreas->fetch(PDO::FETCH_ASSOC)) {
					echo "<font color='#fff'>";
					echo  $presentarArea = $buscararea['area'];
					echo "</font>";
				}
				//<Blockquote>
				//Consulta para traer las areas de la base de datos segun la pregunta correspondiente
				///////////////////////////////////////////////////////////////////////////////////////////////////////


				//////////////////////////////////////////////////////////////////////////////////////////////////
				//Consulta para traer las competencias de la base de datos segun la pregunta correspondiente
				echo "<br>";
				echo "<br>";
				echo "<b><font color='#fff'>Competencia:</font></b>";
				echo "<br>";
				$presentarCompetencias = '';
				$recordsCompetencias = $conn->prepare("SELECT id, id_area, competencia FROM tb_competencias where id='$buscarCompetencias'");
				$recordsCompetencias->execute();
				while ($buscarcompetencias = $recordsCompetencias->fetch(PDO::FETCH_ASSOC)) {
					echo "<font color='#fff'>";
					echo  $presentarCompetencias = $buscarcompetencias['competencia'];
					echo "</font>";
				}



			?>


				<?php


				///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//Consulta para traer los items u opciones de respuesta que tiene pregunta correspondiente

				$recordsTototalItems = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$buscarIdCuestionario'");
				$recordsTototalItems->execute();
				while ($buscaritems = $recordsTototalItems->fetch(PDO::FETCH_ASSOC)) {
					$TomarIdItemsConConsultaBuscarCuestionario = $buscaritems['id_Items'];
					$Tomarid_Cuestionario = $buscaritems['id_Cuestionario']; //ojo a quei como el while no aumenta me toma el id_Cuestionario =17
					//ojo ya en la variable $buscarIdCuestionario me bien el valor de 1 y me trajo 2 items 
					//echo "<br>";
					//echo "Este id del cuestionario debe ser el 9 ",$Tomarid_Cuestionario;
					$sumaItems = $buscaritems['Items'];
				}
				//echo "<br>";
				//echo "<br>";
				echo "<br>";
				echo "<br>";
				//presentamos la pregunta desde la base de datos
				echo "<font color='#fff'><b>";
				echo "Ítem: ", $aumetaPreguntas, " de ", $sumapreguntas;
				echo "</b></font>";

				echo "<br>";
				//echo "<b>La pregunta que te encuentras respondiendo es la:</b> ", $aumetaPreguntas;

				//Ojo quie descomentar cuando tengas listo la variable aumetarPreguntas si por el momento apagala
				//echo "La pregunta en la que te encuentras respondiendo es la: ", $aumetaPreguntas=$SumarPreguntas+$N;

				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
				//Codigo del porgresbar-->
				echo "<div class='progresdiseño'>";
				echo "<div class='outter'>";
				echo "<div class='inner'>";
				//echo "<center>";
				//echo round ($UmentaPreguntasProgreso), "%";
				//echo "</center>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				///Fin Codigo del porgresbar-->
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
				echo "<font color='#fff'>";
				echo "Pantallas del Ítem: ", "<b>", $sumaItems, "</b>";
				echo "</font>";
				//Consulta para traer los items u opciones de respuesta que tiene pregunta correspondiente
				//////////////////////////////////////////////////////////////////////////////////////////////////
				//has aqui bien

				echo "<br>";
				//ojo eesta variables deben estar inicializadas en la parte superior ojo//////////////////
				////////////////////////////////// 

				/////////////////////////////////
				//este codigo falta la cosnulta de aumentar itemes mas uno
				if (isset($_POST['sumaItemsbtn'])) {
					$message = 'Hola Dios debe aumenta con la consulta a 1+';
					$SumarItems = $_POST['AumetarItemsBD'];
					//echo "<br>";
					$aumetaItems = $SumarItems + $p;
					//echo "<br>";
					//echo "<br>";
					//la llave que esta acontinuacion es del if de aumetanr itemes con el boton suma	
				}
				//esto no tiene en suma preguntas 
				//echo "El Items u Opcion de respuesta que estas respondiendo es: ", $aumetaItems=$SumarItems+$p;
				echo "<font color='#fff'>";
				echo "Pantalla desarrollando: <b>", $aumetaItems, " de ", $sumaItems, "</b>";
				echo "</font>";

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
				////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

				/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				//este if es para poner el boton debajo  interno falta el macro                     
				if ($aumetaItems <= $sumaItems) {
					//if($aumetaItems<=1){


					/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
					$recordsItemsIndividual = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where Items='$aumetaItems' and id_Cuestionario='$buscarIdCuestionario'");
					//esta linea cambie descomentas en caso de no salir
					//$recordsItemsIndividual = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where Items='$aumetaItems' and id_Cuestionario='$Tomarid_Cuestionario'");

					$recordsItemsIndividual->execute();
					while ($buscaritems = $recordsItemsIndividual->fetch(PDO::FETCH_ASSOC)) {
						//cambie esta variable por que me sale erro solo de diseño sime sale un erro es por esto que le puse en cero;
						$TomaridItems = $buscaritems['id_Items'];
					}

				?>


					<!--
</div>
-->
		</div>
		<!--
</div>
<!--Fin del apartado que presenta el total de preguntas y pantallas de respuesta con su pregunta de respuesta-->
		<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


		<div class="ContenedorSimularCelular">
			<div class="EncabezadoDatosSimular">
				<!--<font color="#fff"><b><h6> Item:<?php echo " ", $aumetaPreguntas, " de ", $sumapreguntas; ?></h6></b></font>-->
				<h5 class="DiseñoTextoEncabezadoCelular">
					<font color="purple"><?php echo $aumetaPreguntas, ". ", $rowpregunta['Preguntas']; ?></font>
				</h5>
				<!--<h5><b><font color="#fff"><?php echo $rowpregunta['Preguntas']; ?></font></b></h5>-->



				<?php
					//echo "<h6><font color='#0a5c80'>Estas en la pantalla: <b>", $aumetaItems, " de ",$sumaItems,"</b></h6></font>";
				?>
			</div>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para que me filtre la imagen con la consulta es para el fondo 
<?php
					$Cuestion = 'Fondo';
					$UbicarImagenfondo = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					echo "<br>";
					echo $UbicarImagenfondo = $rowimagen['Imagenes'];
?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadera posicion v1-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadera posicion v1
					$Cuestion = 'Verdadera posicion 1';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav1 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv1 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicio f1-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f1
					$Cuestion = 'Falsa posicion 1';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf1 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf1 = $rowimagen['Cuestion'];
			?>





			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadera posicion v2-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadera posicion v2
					$Cuestion = 'Verdadera posicion 2';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav2 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv2 = $rowimagen['Cuestion'];
			?>
			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f2-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f2
					$Cuestion = 'Falsa posicion 2';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf2 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf2 = $rowimagen['Cuestion'];
			?>











			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v3-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v3
					$Cuestion = 'Verdadera posicion 3';
					$UbicarImagenverdaderav3 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav3 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv3 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f3-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f3
					$Cuestion = 'Falsa posicion 3';
					$UbicarImagenfalsaf3 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf3 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf3 = $rowimagen['Cuestion'];
			?>




			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v4-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v4
					$Cuestion = 'Verdadera posicion 4';
					$UbicarImagenverdaderav4 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav4 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv4 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f4-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f4
					$Cuestion = 'Falsa posicion 4';
					$UbicarImagenfalsaf4 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf4 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf4 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v5-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v5
					$Cuestion = 'Verdadera posicion 5';
					$UbicarImagenverdaderav5 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav5 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv5 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f5-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f5
					$Cuestion = 'Falsa posicion 5';
					$UbicarImagenfalsaf5 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf5 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf5 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v6-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v6
					$Cuestion = 'Verdadera posicion 6';
					$UbicarImagenverdaderav6 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav6 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv6 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f6-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f6
					$Cuestion = 'Falsa posicion 6';
					$UbicarImagenfalsaf6 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf6 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf6 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v7-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v7
					$Cuestion = 'Verdadera posicion 7';
					$UbicarImagenverdaderav7 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav7 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv7 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f7-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f7
					$Cuestion = 'Falsa posicion 7';
					$UbicarImagenfalsaf7 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf7 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf7 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v8-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v8
					$Cuestion = 'Verdadera posicion 8';
					$UbicarImagenverdaderav8 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav8 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv8 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f8-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f8
					$Cuestion = 'Falsa posicion 8';
					$UbicarImagenfalsaf8 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf8 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf8 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v9-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v9
					$Cuestion = 'Verdadera posicion 9';
					$UbicarImagenverdaderav9 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav9 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv9 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f9-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f9
					$Cuestion = 'Falsa posicion 9';
					$UbicarImagenfalsaf9 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf9 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf9 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v10-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v10
					$Cuestion = 'Verdadera posicion 10';
					$UbicarImagenverdaderav10 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav10 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv10 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f10-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f10
					$Cuestion = 'Falsa posicion 10';
					$UbicarImagenfalsaf10 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf10 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf10 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v11-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v11
					$Cuestion = 'Verdadera posicion 11';
					$UbicarImagenverdaderav11 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav11 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv11 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f11-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f11
					$Cuestion = 'Falsa posicion 11';
					$UbicarImagenfalsaf11 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf11 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf11 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v12-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v12
					$Cuestion = 'Verdadera posicion 12';
					$UbicarImagenverdaderav12 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav12 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv12 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f12-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f12
					$Cuestion = 'Falsa posicion 12';
					$UbicarImagenfalsaf12 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf12 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf12 = $rowimagen['Cuestion'];
			?>

			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v13-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v13
					$Cuestion = 'Verdadera posicion 13';
					$UbicarImagenverdaderav13 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav13 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv13 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f13-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f13
					$Cuestion = 'Falsa posicion 13';
					$UbicarImagenfalsaf13 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf13 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf13 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v14-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v14
					$Cuestion = 'Verdadera posicion 14';
					$UbicarImagenverdaderav14 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav14 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv14 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f14-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f14
					$Cuestion = 'Falsa posicion 14';
					$UbicarImagenfalsaf14 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf14 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf14 = $rowimagen['Cuestion'];
			?>

			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v15-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v15
					$Cuestion = 'Verdadera posicion 15';
					$UbicarImagenverdaderav15 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav15 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv15 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f15-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f15
					$Cuestion = 'Falsa posicion 15';
					$UbicarImagenfalsaf15 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf15 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf15 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v16-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v16
					$Cuestion = 'Verdadera posicion 16';
					$UbicarImagenverdaderav16 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav16 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv16 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f16-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f16
					$Cuestion = 'Falsa posicion 16';
					$UbicarImagenfalsaf16 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf16 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf16 = $rowimagen['Cuestion'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v17-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v17
					$Cuestion = 'Verdadera posicion 17';
					$UbicarImagenverdaderav17 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav17 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv17 = $rowimagen['Cuestion'];
			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f17-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f17
					$Cuestion = 'Falsa posicion 17';
					$UbicarImagenfalsaf17 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf17 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf17 = $rowimagen['Cuestion'];
			?>




			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v18-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v18
					$Cuestion = 'Verdadera posicion 18';
					$UbicarImagenverdaderav18 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav18 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv18 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f18-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f18
					$Cuestion = 'Falsa posicion 18';
					$UbicarImagenfalsaf18 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf18 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf18 = $rowimagen['Cuestion'];
			?>




			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v19-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v19
					$Cuestion = 'Verdadera posicion 19';
					$UbicarImagenverdaderav19 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav19 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv19 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f19-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f19
					$Cuestion = 'Falsa posicion 19';
					$UbicarImagenfalsaf19 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf19 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf19 = $rowimagen['Cuestion'];
			?>





			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v20-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v20
					$Cuestion = 'Verdadera posicion 20';
					$UbicarImagenverdaderav20 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav20 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv20 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f20-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f20
					$Cuestion = 'Falsa posicion 20';
					$UbicarImagenfalsaf20 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf20 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf20 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v21-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v21
					$Cuestion = 'Verdadera posicion 21';
					$UbicarImagenverdaderav21 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav21 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv21 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f21-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f21
					$Cuestion = 'Falsa posicion 21';
					$UbicarImagenfalsaf21 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf21 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf21 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v22-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v22
					$Cuestion = 'Verdadera posicion 22';
					$UbicarImagenverdaderav22 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav22 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv22 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f22-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f22
					$Cuestion = 'Falsa posicion 22';
					$UbicarImagenfalsaf22 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf22 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf22 = $rowimagen['Cuestion'];
			?>




			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v23-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v23
					$Cuestion = 'Verdadera posicion 23';
					$UbicarImagenverdaderav23 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav23 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv23 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f23-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f23
					$Cuestion = 'Falsa posicion 23';
					$UbicarImagenfalsaf23 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf23 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf23 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v24-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v24
					$Cuestion = 'Verdadera posicion 24';
					$UbicarImagenverdaderav24 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav24 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv24 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f24-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f24
					$Cuestion = 'Falsa posicion 24';
					$UbicarImagenfalsaf24 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf24 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf24 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v25-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v25
					$Cuestion = 'Verdadera posicion 25';
					$UbicarImagenverdaderav25 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav25 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv25 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f25-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f25
					$Cuestion = 'Falsa posicion 25';
					$UbicarImagenfalsaf25 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf25 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf25 = $rowimagen['Cuestion'];
			?>



			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v26-->
			<?php
					//esta opcion es al que debe estar programada con el valor de verdadra posicion v26
					$Cuestion = 'Verdadera posicion 26';
					$UbicarImagenverdaderav26 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenverdaderav26 = $rowimagen['Imagenes'];
					$UbicarImagencuestionv26 = $rowimagen['Cuestion'];
					$UbicarItemsParamostrar = $rowimagen['id_Items'];

			?>


			<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
			<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f26-->
			<?php
					//esta opcion es al que debe estar programada con el valor de falsa posicion f26
					$Cuestion = 'Falsa posicion 26';
					$UbicarImagenfalsaf26 = '';
					$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
					$recordsImagnesbuscar->execute();
					$rowimagen = $recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
					$UbicarImagenfalsaf26 = $rowimagen['Imagenes'];
					$UbicarImagencuestionf26 = $rowimagen['Cuestion'];
			?>











			<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
			<!--Esta tabla sera el modelo a seguir para poder presentar el celular a simular;-->
			<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


			<center>

				<!--Este filtro ya es de la base de datos con la imagen que va ir de fondo;-->
				<div class="table-responsive">

					<table class="table-condensed" id="general" border="0" background="<?php echo $UbicarImagenfondo; ?>">
						<!--ojo esta tabla la puse para que ponga dentro el diseño del celular-->
						<tr>
							<td>
								<!--Tabla interna para traer los botones de las imagenes-->


								<center>
									<table class="table-condensed" id="generalbotonesImagenes" border="0">

										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<!--Encabezado del celuar-->
										<tr>
											<td id="colgeneral">

												<br>
												Claro
											</td>
											<td>
												<br>

												<center>
													<!--Este filtro ya es de la base de datos con la imagen es la verdadera clalo esta si desea puede ubicar mas verdadera;-->
													<!-- Posicion 1-->
													<?php
													if ($UbicarImagencuestionv1 == "Verdadera posicion 1") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 1';
														$UbicarImagenItemsverdaderav1 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav1 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<!-- ojo le pondre accion al metodo post solo para probar sino debe poner la variable buscarIdCuestionario ojo ayudamen Dios-->
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="bateria" src="<?php echo $UbicarImagenverdaderav1; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf1;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf1 == "Falsa posicion 1") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax" name="RespuestasFrmAjax" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas" size="40"><img class="bateria" src="<?php echo $UbicarImagenfalsaf1; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<br>

												<!--Este filtro ya es de la base de datos con la imagen es la verdadera clalo esta si desea puede ubicar mas verdadera;-->
												<!-- Posicion 2-->
												<center>
													<?php
													if ($UbicarImagencuestionv2 == "Verdadera posicion 2") {
														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
														$Cuestion = 'Verdadera posicion 2';
														$UbicarImagenItemsverdaderav2 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav2 = $rowimagenItems['id_Items'];
														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="bateria" src="<?php echo $UbicarImagenverdaderav2; ?>"></button>

														</form>

													<?php
													}

													?>

													<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
													<?php
													if ($UbicarImagencuestionf2 == "Falsa posicion 2") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax2" name="RespuestasFrmAjax2" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas2" size="40"><img class="bateria" src="<?php echo $UbicarImagenfalsaf2; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
											<td>
												<br>

												<div align="right">
													12:32
												</div>
											</td>
										</tr>
										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->








										<tr>
											<!--
<td id="colgeneral">
-->
											<td id="colgeneral">
												<center>
													<!-- Posicion 3-->

													<?php
													if ($UbicarImagencuestionv3 == "Verdadera posicion 3") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 3';
														$UbicarImagenItemsverdaderav3 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav3 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav3; ?>"></button>

														</form>

													<?php
													}

													?>

													<?php
													if ($UbicarImagencuestionf3 == "Falsa posicion 3") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax3" name="RespuestasFrmAjax3" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas3" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf3; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

												</center>
											</td>
											<td id="colgeneral">

												<!-- Posicion 4-->
												<center>
													<?php
													if ($UbicarImagencuestionv4 == "Verdadera posicion 4") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 4';
														$UbicarImagenItemsverdaderav4 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav4 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav4; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf4;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf4 == "Falsa posicion 4") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax4" name="RespuestasFrmAjax4" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas4" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf4; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td id="colgeneral">
												<!-- Posicion 5-->
												<center>
													<?php
													if ($UbicarImagencuestionv5 == "Verdadera posicion 5") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 5';
														$UbicarImagenItemsverdaderav5 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav5 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav5; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf5;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf5 == "Falsa posicion 5") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax5" name="RespuestasFrmAjax5" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas5" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf5; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
											<!--
<td id="colgeneral">
-->
											<td>
												<!-- Posicion 6-->
												<center>
													<?php
													if ($UbicarImagencuestionv6 == "Verdadera posicion 6") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 6';
														$UbicarImagenItemsverdaderav6 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav6 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav6; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf6;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf6 == "Falsa posicion 6") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax6" name="RespuestasFrmAjax6" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas6" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf6; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
										</tr>
										<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<tr>
											<!--
<td id="colgeneral">
-->
											<td id="colgeneral">
												<!-- Posicion 7-->
												<center>
													<?php
													if ($UbicarImagencuestionv7 == "Verdadera posicion 7") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 7';
														$UbicarImagenItemsverdaderav7 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav7 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav7; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf7;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf7 == "Falsa posicion 7") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax7" name="RespuestasFrmAjax7" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas7" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf7; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>


											<td>
												<!-- Posicion 8-->
												<center>
													<?php
													if ($UbicarImagencuestionv8 == "Verdadera posicion 8") {
														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
														$Cuestion = 'Verdadera posicion 8';
														$UbicarImagenItemsverdaderav8 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav8 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav8; ?>"></button>

														</form>

													<?php
													}

													?>

													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf8;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf8 == "Falsa posicion 8") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax8" name="RespuestasFrmAjax8" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas8" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf8; ?>"></button>
														</form>
													<?php
													}
													?>
												</center>
												<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
											</td>


											<td>
												<!-- Posicion 9-->
												<center>
													<?php
													if ($UbicarImagencuestionv9 == "Verdadera posicion 9") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
														$Cuestion = 'Verdadera posicion 9';
														$UbicarImagenItemsverdaderav9 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav9 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav9; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf9;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf9 == "Falsa posicion 9") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax9" name="RespuestasFrmAjax9" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas9" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf9; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 10-->
												<center>
													<?php
													if ($UbicarImagencuestionv10 == "Verdadera posicion 10") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 10';
														$UbicarImagenItemsverdaderav10 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav10 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav10; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf10;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf10 == "Falsa posicion 10") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax10" name="RespuestasFrmAjax10" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas10" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf10; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
										</tr>
										<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<tr>
											<!--
<td id="colgeneral">
-->
											<td id="colgeneral">
												<!-- Posicion 11-->
												<center>
													<?php
													if ($UbicarImagencuestionv11 == "Verdadera posicion 11") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 11';
														$UbicarImagenItemsverdaderav11 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav11 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav11; ?>"></button>
														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf11;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf11 == "Falsa posicion 11") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax11" name="RespuestasFrmAjax11" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas11" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf11; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 12-->
												<center>
													<?php
													if ($UbicarImagencuestionv12 == "Verdadera posicion 12") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 12';
														$UbicarImagenItemsverdaderav12 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav12 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav12; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf12;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf12 == "Falsa posicion 12") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax12" name="RespuestasFrmAjax12" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas12" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf12; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 13-->
												<center>
													<?php
													if ($UbicarImagencuestionv13 == "Verdadera posicion 13") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 13';
														$UbicarImagenItemsverdaderav13 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav13 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav13; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf13;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf13 == "Falsa posicion 13") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax13" name="RespuestasFrmAjax13" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas13" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf13; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 14-->
												<center>
													<?php
													if ($UbicarImagencuestionv14 == "Verdadera posicion 14") {
														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
														$Cuestion = 'Verdadera posicion 14';
														$UbicarImagenItemsverdaderav14 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav14 = $rowimagenItems['id_Items'];
														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav14; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf14;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf14 == "Falsa posicion 14") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax14" name="RespuestasFrmAjax14" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas14" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf14; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
										</tr>

										<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<tr>
											<!--
<td id="colgeneral">
-->
											<td id="colgeneral">
												<!-- Posicion 15-->
												<center>
													<?php
													if ($UbicarImagencuestionv15 == "Verdadera posicion 15") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 15';
														$UbicarImagenItemsverdaderav15 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav15 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav15; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf15 == "Falsa posicion 15") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax15" name="RespuestasFrmAjax15" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas15" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf15; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 16-->
												<center>
													<?php
													if ($UbicarImagencuestionv16 == "Verdadera posicion 16") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 16';
														$UbicarImagenItemsverdaderav16 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav16 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav16; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf16 == "Falsa posicion 16") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax16" name="RespuestasFrmAjax16" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas16" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf16; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 17-->
												<center>
													<?php
													if ($UbicarImagencuestionv17 == "Verdadera posicion 17") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 17';
														$UbicarImagenItemsverdaderav17 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav17 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav17; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf17 == "Falsa posicion 17") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax17" name="RespuestasFrmAjax17" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas17" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf17; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 18-->
												<center>
													<?php
													if ($UbicarImagencuestionv18 == "Verdadera posicion 18") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 18';
														$UbicarImagenItemsverdaderav18 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav18 = $rowimagenItems['id_Items'];
														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav18; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf18 == "Falsa posicion 18") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax18" name="RespuestasFrmAjax18" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas18" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf18; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
										</tr>
										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


										<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<tr>
											<td id="colgeneral">
												<!-- Posicion 19-->
												<center>
													<?php
													if ($UbicarImagencuestionv19 == "Verdadera posicion 19") {

														$Cuestion = 'Verdadera posicion 19';
														$UbicarImagenItemsverdaderav19 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav19 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav19; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf19 == "Falsa posicion 19") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax19" name="RespuestasFrmAjax19" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas19" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf19; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 20-->
												<center>
													<?php
													if ($UbicarImagencuestionv20 == "Verdadera posicion 20") {

														$Cuestion = 'Verdadera posicion 20';
														$UbicarImagenItemsverdaderav20 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav20 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav20; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf20 == "Falsa posicion 20") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax20" name="RespuestasFrmAjax20" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas20" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf20; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 21-->
												<center>
													<?php
													if ($UbicarImagencuestionv21 == "Verdadera posicion 21") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 21';
														$UbicarImagenItemsverdaderav21 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav21 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav21; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf21 == "Falsa posicion 21") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax21" name="RespuestasFrmAjax21" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas21" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf21; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>

											<td>
												<!-- Posicion 22-->
												<center>
													<?php
													if ($UbicarImagencuestionv22 == "Verdadera posicion 22") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 22';
														$UbicarImagenItemsverdaderav22 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav22 = $rowimagenItems['id_Items'];
														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav22; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf22 == "Falsa posicion 22") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax22" name="RespuestasFrmAjax22" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas22" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf22; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
											</td>
										</tr>


										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->





										<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
										<tr>
											<td id="colgeneral">
												<!-- Posicion 23-->
												<center>
													<?php
													if ($UbicarImagencuestionv23 == "Verdadera posicion 23") {

														$Cuestion = 'Verdadera posicion 23';
														$UbicarImagenItemsverdaderav23 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav23 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav23; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf23 == "Falsa posicion 23") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax23" name="RespuestasFrmAjax23" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas23" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf23; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
												<br>
											</td>

											<td>
												<!-- Posicion 24-->
												<center>
													<?php
													if ($UbicarImagencuestionv24 == "Verdadera posicion 24") {

														$Cuestion = 'Verdadera posicion 24';
														$UbicarImagenItemsverdaderav24 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav24 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav24; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf24 == "Falsa posicion 24") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax24" name="RespuestasFrmAjax24" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas24" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf24; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
												<br>
											</td>

											<td>
												<!-- Posicion 25-->
												<center>
													<?php
													if ($UbicarImagencuestionv25 == "Verdadera posicion 25") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 25';
														$UbicarImagenItemsverdaderav25 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav25 = $rowimagenItems['id_Items'];

														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav25; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf25 == "Falsa posicion 25") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax25" name="RespuestasFrmAjax25" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas25" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf25; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
												<br>
											</td>

											<td>
												<!-- Posicion 26-->
												<center>
													<?php
													if ($UbicarImagencuestionv26 == "Verdadera posicion 26") {

														//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

														$Cuestion = 'Verdadera posicion 26';
														$UbicarImagenItemsverdaderav26 = '';
														$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
														$recordsImagnesbuscarItems->execute();
														$rowimagenItems = $recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
														$UbicarImagenItemsverdaderav26 = $rowimagenItems['id_Items'];
														//esta consulta es para poder traer los items desde la base de datos para poder aumentar
														$TraerItemsConsecutivo = '';
														$recordsItemsCosecutivo = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
														$recordsItemsCosecutivo->execute();
														$rowItems = $recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
														$AumentarAumentarItems = $rowItems['Items'];
													?>
														<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
															<input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems; ?>">
															<input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas - 1; ?>">
															<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">
															<button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img class="pequeña" src="<?php echo $UbicarImagenverdaderav26; ?>"></button>

														</form>

													<?php
													}

													?>
													<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;
																											?>"></p></a>
-->
													<?php
													if ($UbicarImagencuestionf26 == "Falsa posicion 26") {
														include('database.php');
														$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
														$recordsErrores->execute();
														$rowpreguntaErrores = $recordsErrores->fetch(PDO::FETCH_ASSOC);
														// esto es para buscar con la misma consulta
														$AumetarPreguntasErrores = $rowpreguntaErrores['Numero'];
														$TomarValorVerdaderoImagenBD = $rowpreguntaErrores['ValorVerdadero'];
														$TomarValorFalsoImagenBD = $rowpreguntaErrores['ValorFalso'];
														$TomarNivelImagenBD = $rowpreguntaErrores['Nivel'];
														$TomarIdNivelImagenBD = $rowpreguntaErrores['id_Niveles'];
														$TomarIdAreaImagenBD = $rowpreguntaErrores['id_Areas'];
														$TomarIdCompetenciasImagenBD = $rowpreguntaErrores['id_Competencias'];
														//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
													?>
														<form id="RespuestasFrmAjax26" name="RespuestasFrmAjax26" method="POST">
															<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
															<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD; ?>">
															<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD; ?>">
															<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD; ?>">
															<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores; ?>">
															<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
															<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
															<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD; ?>">
															<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD; ?>">
															<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD; ?>">
															<button class="btn-flat" id="btnRespuestas26" size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf26; ?>"></button>
														</form>
													<?php
													}
													?>
													<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
												</center>
												<br>
											</td>
										</tr>



										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

										<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



									</table>

								</center>
								<!--Fin de la tabla general-->
							</td>
						</tr>
						<?php







						///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
						////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
						//Este else if dentro del else interno es apra que aparezca y desaparezca el boton NO SE QUE RESPONDER
						include('database.php');
						$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
						$recordspreguntasAumentar->execute();
						$rowpreguntaBD1 = $recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
						// esto es para buscar con la misma consulta
						$AumetarAumentarPreguntasBD = $rowpreguntaBD1['Numero'];
						$TomarValorVerdaderoBD1 = $rowpreguntaBD1['ValorVerdadero'];
						$TomarValorFalsoBD1 = $rowpreguntaBD1['ValorFalso'];
						$TomarIdAreasBD1 = $rowpreguntaBD1['id_Areas'];
						$TomarIdCompetenciasBD1 = $rowpreguntaBD1['id_Competencias'];
						$TomarIdNivelesBD1 = $rowpreguntaBD1['id_Niveles'];
						$TomarNivelBD1 = $rowpreguntaBD1['Nivel'];

						?>

						<!--<boton de no se como hacerlo a la izquierda y superior >-->
						<div align="right">
							<form action='SimularInstrumentoPrincipal_Frm.php' id="form1" name="form1" method='POST' align="right">
								<input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
								<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
								<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreasBD1; ?>">
								<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD1; ?>">
								<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelesBD1; ?>">
								<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
								<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
								<!--Tomar en cuenta si se da clic en NO SE QUE RESPONDER es por que tiene un puntaje de 0 y en erorres o puntaje falso tiene 0-->
								<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
								<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD1; ?>">
								<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
								<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD1; ?>">
								<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD1; ?>">
								<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">


								<button type='submit' class="DiseñoBtnSimular btn-primary" id="NumeroPregunta" name="NumeroPregunta">NO SÉ CÓMO HACERLO</button>
							</form>

						</div>

						<!--</center>-->


					</table>
				</div>
			</center>
			<!--Fin tabla del  modelo a seguir para poder presentar el celular a simular;-->
			<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
			<?php
=======









  
  <div class="ContenedorSimularInstrumento">
 
 
 <?php
 echo "<div class='ContenedorCirculo'>";
 echo "<img class='ImgInicioSesion' src='ImagenesProgramacion/Logo.png'>";
  
 echo "</div>";
 
 echo "<div>";
 
 echo "<b><font color='#F7B40F'> Bienvenido(a)</font></b>";
 echo"<br>";
 echo "<b><font color='#fff'>";
 if(!empty($user)){
	 echo $user['email'];
 }
 echo "</font></b>";
 echo"<br>";
  echo "<b><font color='#F7B40F'> <a id='fondoMouseCerrarSesion' class='adiseño3' href='logout.php'>Cerrar sesión</a></font></b>";
	echo "</div>";
 echo"<br>";
  echo "<b><font color='#FFF'>Test de autoevaluación</font></b>";
 echo "<br>";
  echo "<hr color='#fff'>";
 
 
 
 
 
 
 
$N=1;
//echo "<br>";
//echo "La varibal N para las prehuntas numero que empieza en 1 es: ",$N;
//$clicImagen=0;
//echo "<br>";
//echo "La varible clic imagen que empieza en 0 es: ",$clicImagen;
$aumetaPreguntas=$N;
//echo "<br>";
//echo "La aumetaPreguntas=$N 1 es:",$aumetaPreguntas;
$SumarPreguntas=0;
//para comprobar
//echo "La pregunta en la que te encuentras respondiendo es la: ", $aumetaPreguntas=$SumarPreguntas+$N;
//echo "<br>";
//echo "La SumaPreguntas que empieza en 0 es:",$SumarPreguntas;
//ojo esto debe estar debajo de to esto antes de if btneitems jojo
$p=1;
//echo "<br>";
//echo "La variable p que aumenta los items y empiez en 1:",$p;
$aumetaItems=$p;
//echo "<br>";
//echo "La variable que aumenta los items se suma con p $aumetaItems=$p; y empiez en 1:",$aumetaItems=$p;
	$Tomarid_Cuestionario=0;
//echo "<br>";
//echo "La variable Tomar idCuestionario empiez en 0: ",$Tomarid_Cuestionario;
	$sumaItems=0;
	//echo "<br>";
//echo "La variable sumaItems es para ver cuantos items hay empieza en 0: ",$sumaItems;
	$SumarItems=0;
		//echo "<br>";
//echo "La variable SumaItems es para aumentar los itemes con la base de datos que damos clci en la imagen empieza en ojo esto S s 0: ",$SumarItems;
	//ojo esta variable se la debe quitar si me sale un erro era de diseño ojo cuando hagas prueba 17
	$TomaridItems=0;
	//	echo "<br>";
//echo "La variable TomaridItems es para el items  empieza en 0: ",$TomaridItems;
	$buscarIdCuestionario=0;
	//echo "<br>";
//echo "La variable $buscarIdCuestionario es para tomar los idcuestioanrios empieza en 0: ",$buscarIdCuestionario;
	$SumaPreguntasClicImagenverdadera=0;
	//echo "<br>";
//Dios mio ayudame que ya estoy sin fuezas// Muy bien a qui traigo el valor de aumetaPreguntas-1 para poder avanzar con las preguntas
if(isset($_POST['sumaItemsbtn'])){
	$SumaPreguntasClicImagenverdadera=$_POST['AumetarPreguntas'];
	//ojo esta linea anterior me trare la pregunta actual menos 1
	//echo "<br>";
	$aumetaPreguntas=$SumaPreguntasClicImagenverdadera+$N;
	//echo "<br>";
	//echo "<br>";
}	
	//ojo debe estar la variable tambie fuera para que sea afectada ojo $aumetaPreguntas=$SumaPreguntasClicImagenverdadera+$N;
	//echo "<br>";
	
	//Solo para ver si pasa o no pasa y sino hacer un condicional
	$aumetaPreguntas=$SumaPreguntasClicImagenverdadera+$N;
	
//Este codigo es para aumentar las preguntas mas uno
  if (isset($_POST['NumeroPregunta'])) {
    $message='Hola Dios debe aumenta con la consulta a 1+';
	$SumarPreguntas=$_POST['AumetarAumentarPreguntasBD'];
	//echo "<br>";
	$aumetaPreguntas=$SumarPreguntas+$N;
	//echo "<br>";
	
//la llave que esta acontinuacion es del if de aumetanr itemes con el boton suma	
  }
 

?>



<!--////////////////////////////////////////////////////-->
 <!-- Este codigo lo realizare con el while inicializado en uno solo para poder probar y luego incrementare i=i+1 ojo cuando de el botn no se responder este incrementara o cuando de sigueinte-->
 
<?php
//$i=1;
  //se debe poner la variable una vez que este bien con logica  ($sumapreguntas) while($i<=$sumapreguntas){
	//  $AumetarAumentarPreguntasBD=0;
//while($i<=1){
	
	
	//Inicio del if General
	if($aumetaPreguntas<=$sumapreguntas){
//if($aumetaPreguntas<=1){




///////////////////////////////////////////////
//Consulta para traer pregunta a pregunta 
//$Numero=1; ojo ya le cambie Dios
include ('database.php');
$recordspreguntaindividual = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where Numero='$aumetaPreguntas'");
//$recordspreguntaindividual = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, Codigo_Indicador, Preguntas, Nivel,Valor,Numero FROM tb_cuestionario where Numero='$i'");
$recordspreguntaindividual->execute();
$rowpregunta=$recordspreguntaindividual->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$buscarAreas=$rowpregunta['id_Areas'];
$buscarCompetencias=$rowpregunta['id_Competencias'];
$buscarNivel=$rowpregunta['Nivel'];
//Esta variable es solo para que se guarde los niveles Basico, Medio o Avanzado
$buscarIdNiveles=$rowpregunta['id_Niveles'];
//ojo esta varieble la pinicialice poruqe me daba error pero si me siguie dando mejor la quito de arriba de la inicializacionojojo
$buscarIdCuestionario=$rowpregunta['id_Cuestionario'];
//echo "<br>";
//echo  "El id que justo trae de la tabla cuestionario es es: ", $buscarIdCuestionario;
//Consulta para traer pregunta a pregunta 
/////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////////////////////////////////////////////////////////////////////////////////
//Consulta para traer las areas de la base de datos segun la pregunta correspondiente

 
	echo "<b><font color='#fff'>Área:</font></b>";
	echo "<br>";
	$presentarArea='';
	$recordsAreas = $conn->prepare("SELECT id_Area, Area FROM tb_areas where id_Area='$buscarAreas'");
    $recordsAreas->execute();
    while($buscararea=$recordsAreas->fetch(PDO::FETCH_ASSOC)){
			echo "<font color='#fff'>";
		echo  $presentarArea=$buscararea['Area'];
			echo "</font>";
	}
	//<Blockquote>
//Consulta para traer las areas de la base de datos segun la pregunta correspondiente
///////////////////////////////////////////////////////////////////////////////////////////////////////


//////////////////////////////////////////////////////////////////////////////////////////////////
//Consulta para traer las competencias de la base de datos segun la pregunta correspondiente
    echo "<br>";
	echo "<br>";
	echo"<b><font color='#fff'>Competencia:</font></b>";
	echo "<br>";
	$presentarCompetencias='';
	$recordsCompetencias = $conn->prepare("SELECT id_Competencias, id_Area, Competencias FROM tb_competencias where id_Competencias='$buscarCompetencias'");
    $recordsCompetencias->execute();
    while($buscarcompetencias=$recordsCompetencias->fetch(PDO::FETCH_ASSOC)){
			echo "<font color='#fff'>";
		echo  $presentarCompetencias=$buscarcompetencias['Competencias'];
			echo "</font>";
		
    }
  
	 

?>


<?php

	
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Consulta para traer los items u opciones de respuesta que tiene pregunta correspondiente
	
	$recordsTototalItems = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$buscarIdCuestionario'");
    $recordsTototalItems->execute();
    while($buscaritems=$recordsTototalItems->fetch(PDO::FETCH_ASSOC)){
    $TomarIdItemsConConsultaBuscarCuestionario=$buscaritems['id_Items'];
	$Tomarid_Cuestionario=$buscaritems['id_Cuestionario']; //ojo a quei como el while no aumenta me toma el id_Cuestionario =17
	//ojo ya en la variable $buscarIdCuestionario me bien el valor de 1 y me trajo 2 items 
	//echo "<br>";
	//echo "Este id del cuestionario debe ser el 9 ",$Tomarid_Cuestionario;
	 $sumaItems=$buscaritems['Items'];
	}
	//echo "<br>";
//echo "<br>";
	echo "<br>";
echo "<br>";
//presentamos la pregunta desde la base de datos
echo "<font color='#fff'><b>";
		echo "Ítem: ",$aumetaPreguntas," de ", $sumapreguntas;
			echo "</b></font>";

echo "<br>";
 //echo "<b>La pregunta que te encuentras respondiendo es la:</b> ", $aumetaPreguntas;
 
//Ojo quie descomentar cuando tengas listo la variable aumetarPreguntas si por el momento apagala
//echo "La pregunta en la que te encuentras respondiendo es la: ", $aumetaPreguntas=$SumarPreguntas+$N;
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	//Codigo del porgresbar-->
echo "<div class='progresdiseño'>";
  echo "<div class='outter'>";
  echo "<div class='inner'>";
 //echo "<center>";
  //echo round ($UmentaPreguntasProgreso), "%";
   //echo "</center>";
  echo "</div>";
 echo "</div>";
 echo "</div>";
 ///Fin Codigo del porgresbar-->
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	echo "<font color='#fff'>";
	echo "Pantallas del Ítem: ", "<b>",$sumaItems,"</b>";
	echo "</font>";
//Consulta para traer los items u opciones de respuesta que tiene pregunta correspondiente
//////////////////////////////////////////////////////////////////////////////////////////////////
//has aqui bien

	echo "<br>";
//ojo eesta variables deben estar inicializadas en la parte superior ojo//////////////////
////////////////////////////////// 

/////////////////////////////////
//este codigo falta la cosnulta de aumentar itemes mas uno
  if (isset($_POST['sumaItemsbtn'])) {
    $message='Hola Dios debe aumenta con la consulta a 1+';
	$SumarItems=$_POST['AumetarItemsBD'];
	//echo "<br>";
	$aumetaItems=$SumarItems+$p;
	//echo "<br>";
	//echo "<br>";
//la llave que esta acontinuacion es del if de aumetanr itemes con el boton suma	
  }
  //esto no tiene en suma preguntas 
 //echo "El Items u Opcion de respuesta que estas respondiendo es: ", $aumetaItems=$SumarItems+$p;
 echo "<font color='#fff'>";
  echo "Pantalla desarrollando: <b>", $aumetaItems, " de ",$sumaItems,"</b>";
echo "</font>";

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//este if es para poner el boton debajo  interno falta el macro                     
	 if($aumetaItems<=$sumaItems){
		 //if($aumetaItems<=1){
		 	 
	 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
    $recordsItemsIndividual = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where Items='$aumetaItems' and id_Cuestionario='$buscarIdCuestionario'");
	//esta linea cambie descomentas en caso de no salir
	//$recordsItemsIndividual = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where Items='$aumetaItems' and id_Cuestionario='$Tomarid_Cuestionario'");
                                                                     
    $recordsItemsIndividual->execute();
    while($buscaritems=$recordsItemsIndividual->fetch(PDO::FETCH_ASSOC)){
		//cambie esta variable por que me sale erro solo de diseño sime sale un erro es por esto que le puse en cero;
       $TomaridItems=$buscaritems['id_Items'];
	}

?>


 <!--
</div>
-->
</div>
<!--
</div>
<!--Fin del apartado que presenta el total de preguntas y pantallas de respuesta con su pregunta de respuesta-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


  <div class="ContenedorSimularCelular">
  <div  class="EncabezadoDatosSimular">
  <!--<font color="#fff"><b><h6> Item:<?php echo " ", $aumetaPreguntas," de ", $sumapreguntas;?></h6></b></font>-->
  <h5 class="DiseñoTextoEncabezadoCelular"><font color="purple"><?php echo $aumetaPreguntas, ". ",$rowpregunta['Preguntas'];?></font></h5>
   <!--<h5><b><font color="#fff"><?php echo $rowpregunta['Preguntas'];?></font></b></h5>-->
 


  <?php
  //echo "<h6><font color='#0a5c80'>Estas en la pantalla: <b>", $aumetaItems, " de ",$sumaItems,"</b></h6></font>";
   ?>
  </div>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para que me filtre la imagen con la consulta es para el fondo 
<?php
$Cuestion='Fondo';
$UbicarImagenfondo='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	echo "<br>";
	echo $UbicarImagenfondo=$rowimagen['Imagenes'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadera posicion v1-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadera posicion v1
$Cuestion='Verdadera posicion 1';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav1=$rowimagen['Imagenes'];
	$UbicarImagencuestionv1=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicio f1-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f1
$Cuestion='Falsa posicion 1';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf1=$rowimagen['Imagenes'];
	$UbicarImagencuestionf1=$rowimagen['Cuestion'];
	?>





<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadera posicion v2-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadera posicion v2
$Cuestion='Verdadera posicion 2';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav2=$rowimagen['Imagenes'];
	$UbicarImagencuestionv2=$rowimagen['Cuestion'];
	?>
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f2-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f2
$Cuestion='Falsa posicion 2';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf2=$rowimagen['Imagenes'];
	$UbicarImagencuestionf2=$rowimagen['Cuestion'];
	?>


>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7







<<<<<<< HEAD
					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//Este else if dentro del else interno es apra que aparezca y desaparezca el boton NO SE QUE RESPONDER
					include('database.php');
					$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
					$recordspreguntasAumentar->execute();
					$rowpreguntaBD1 = $recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
					// esto es para buscar con la misma consulta
					$AumetarAumentarPreguntasBD = $rowpreguntaBD1['Numero'];
					$TomarValorVerdaderoBD1 = $rowpreguntaBD1['ValorVerdadero'];
					$TomarValorFalsoBD1 = $rowpreguntaBD1['ValorFalso'];
					$TomarIdAreasBD1 = $rowpreguntaBD1['id_Areas'];
					$TomarIdCompetenciasBD1 = $rowpreguntaBD1['id_Competencias'];
					$TomarIdNivelesBD1 = $rowpreguntaBD1['id_Niveles'];
					$TomarNivelBD1 = $rowpreguntaBD1['Nivel'];

			?>
			<!--Boyon comentado que estaba en la parte inferior--
<center>
	<form action='SimularInstrumentoPrincipal_Frm.php'  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php //echo $AumetarAumentarPreguntasBD;
																								?>">
     <input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php //echo $buscarIdCuestionario;
																				?>">
	 <input type="hidden" name="id_Area" id="id_Area" value="<?php //echo $TomarIdAreasBD1;
																?>">
	 <input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php //echo $TomarIdCompetenciasBD1;
																				?>">
	 <input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php //echo $TomarIdNivelesBD1;
																	?>">
	 <input type="hidden" name="Numero" id="Numero" value="<?php //echo $AumetarAumentarPreguntasBD;
															?>">
	 <input type="hidden" name="email" id="email" value="<?php //echo $Personas;
															?>">
	  <!--Tomar en cuenta si se da clic en NO SE QUE RESPONDER es por que tiene un puntaje de 0 y en erorres o puntaje falso tiene 0-->

			<!--<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php //echo $TomarValorVerdaderoBD1;
																			?>">
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php //echo $TomarValorFalsoBD1;
																	?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php //echo $TomarNivelBD1;
															?>">
	 <input type="hidden" name="valorProgreso" value="<?php //echo $UmentaPreguntasProgreso;
														?>">
     <br>
	  
	   <button type='submit' class="DiseñoBtnSimular btn-primary" id="NumeroPregunta" name="NumeroPregunta">NO SÉ CÓMO HACERLO</button> 
</form>
<br>

</center>
-->
			<?php



					///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
					////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


					//fin del if interno	
				} else {
					//if($aumetaItems<=2){
					if ($aumetaItems >= $SumarItems) {
						echo "<br>";

						///////////////////////////////////////////////////////////////////////////////////////

						echo "<br>";


						//ojo aquie es la consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->

						include('database.php');
						$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
						$recordspreguntasAumentar->execute();
						$rowpreguntaBD = $recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
						// esto es para buscar con la misma consulta
						$AumetarAumentarPreguntasBD = $rowpreguntaBD['Numero'];
						$TomarValorVerdaderoBD = $rowpreguntaBD['ValorVerdadero'];
						$TomarValorFalsoBD = $rowpreguntaBD['ValorFalso'];
						$TomarNivelBD = $rowpreguntaBD['Nivel'];
						$TomarIdNivelBD = $rowpreguntaBD['id_Niveles'];
						$TomarIdAreaBD = $rowpreguntaBD['id_Areas'];
						$TomarIdCompetenciasBD = $rowpreguntaBD['id_Competencias'];
						//ojo pero hay que hacer metodos separados pero con la misma variable a incrementar aumetaItems  en este boton debe guardar con el boto sigueinte avanza a la pregunta sigueinte y guarda con el valor de uno 1 tomar en cuenta que mejor poner un boton guardar
			?>
				<br>

				<div class="overlay">
					<div class="popup">
						<form action='SimularInstrumentoPrincipal_Frm.php' id="form1" name="form1" method='POST'>
							<!--<h3 class="textopopup">Correcto!</h3>-->
							<input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
							<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
							<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaBD; ?>">
							<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD; ?>">
							<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelBD; ?>">
							<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
							<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
							<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="<?php echo $TomarValorVerdaderoBD; ?>">
							<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD; ?>">
							<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
							<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
							<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD; ?>">
							<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD; ?>">
							<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">

							<!--
	 <input type='submit' id="NumeroPregunta" name="NumeroPregunta" value="Siguiente"> 
	 -->
							<center> <button type='submit' class="btn btn-success" id="NumeroPregunta" name="NumeroPregunta">Siguiente ítem</button></center>

						</form>
					</div>
				</div>


				<center>
					<div class='ContenedorRespuestasSimular btn-primary'>
						<br>
						<h3 class='DiseñoTexto'><b>Ok...!<br> Avance al siguiente ítem</b></h3>
					</div>

					<br>
					<form action='SimularInstrumentoPrincipal_Frm.php' id="form1" name="form1" method='POST'>
						<!--Esta caja de texto sigueinte permite tomar el valor para poder aumentar las preguntas-->
						<input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
						<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario; ?>">
						<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaBD; ?>">
						<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD; ?>">
						<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelBD; ?>">
						<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD; ?>">
						<input type="hidden" name="email" id="email" value="<?php echo $Personas; ?>">
						<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="<?php echo $TomarValorVerdaderoBD; ?>">
						<input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD; ?>">
						<!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
						<input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
						<input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD; ?>">
						<input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD; ?>">
						<input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso; ?>">

						<!--
	 <input type='submit' id="NumeroPregunta" name="NumeroPregunta" value="Siguiente"> 
	 -->
						<button type='submit' class="DiseñoBtnSimular btn-warning" id="NumeroPregunta" name="NumeroPregunta">Siguiente</button>
					</form>
					<br>
				</center>
			<?php


					}

					///////////////fin de else if  interno   
				}

				//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
				//Aquie la parte else del if General	 

				// continuacion la llave sigueinte es del if General 	
			} else {

				//if($aumetaPreguntas<=2){
				if ($aumetaPreguntas >= $sumapreguntas) {

					//ojo quei debe haber un boton donde se ponga aterminar y pasara a la pantallade preguntas de CONTEXTO PARA GUARDAR FINALMENTE Y PRESENTAR LOS RESULTADOS EN DICHA PLANTILLA OJO
			?>
			<br>
			<div class="overlay">
				<div class="popup">
					<h3 class="textopopup"><b>Felicidades...!</h3>
					<h6><br>
						<font color="#fff"> Ha desarrollado la primera parte.<br>Para obtener los resultados finales es necesario completar la siguiente información</b>
					</h6>
					<br>
					<form action='Contexto_Crear_frm.php' id="contexto" name="contexto" method='POST'>
						<center><button type='submit' class="btn btn-success" name="contexto">Terminar primera parte</button></center>

					</form>
				</div>
			</div>
			<center>

				<div class='ContenedorRespuestasSimular btn-primary'>
					<br>
					<h3 class='DiseñoTexto'><b>Felicidades...!<br> Ha desarrollado la primera parte. Para obtener los resultados finales es necesario completar la siguiente información</b></b></h3>
				</div>

				<br>
				<form action='Contexto_Crear_frm.php' id="contexto" name="contexto" method='POST'>
					<button type='submit' class="DiseñoBtnSimular btn-warning" name="contexto">Terminar primera parte</button>

				</form>
			</center>
			<br>
			<!--Esta funcion es la que se ejcutara para que se bloquee el boton NO SE QUE RESPONDER-->

	<?php


				}
				// continuacion la llave sigueinte es del else if General 		
			}



	?>

	<!--/AQUI TERMINA EL IF Y ALGORIMO DIOS MIO-->
	<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
	<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


	<!--Fin del contenedor que tiene el 75% y es del celular-->
		</div>
	</body>
	<!--
    <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
               <p class="grey-text text-lighten-4">Evaluamos tu perfil digital mediante la simulación de pantallas de dispositivos móviles.</p>
=======


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v3-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v3
$Cuestion='Verdadera posicion 3';
$UbicarImagenverdaderav3='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav3=$rowimagen['Imagenes'];
	$UbicarImagencuestionv3=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f3-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f3
$Cuestion='Falsa posicion 3';
$UbicarImagenfalsaf3='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf3=$rowimagen['Imagenes'];
	$UbicarImagencuestionf3=$rowimagen['Cuestion'];
	?>




<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v4-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v4
$Cuestion='Verdadera posicion 4';
$UbicarImagenverdaderav4='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav4=$rowimagen['Imagenes'];
	$UbicarImagencuestionv4=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f4-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f4
$Cuestion='Falsa posicion 4';
$UbicarImagenfalsaf4='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf4=$rowimagen['Imagenes'];
	$UbicarImagencuestionf4=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v5-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v5
$Cuestion='Verdadera posicion 5';
$UbicarImagenverdaderav5='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav5=$rowimagen['Imagenes'];
	$UbicarImagencuestionv5=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f5-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f5
$Cuestion='Falsa posicion 5';
$UbicarImagenfalsaf5='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf5=$rowimagen['Imagenes'];
	$UbicarImagencuestionf5=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v6-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v6
$Cuestion='Verdadera posicion 6';
$UbicarImagenverdaderav6='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav6=$rowimagen['Imagenes'];
	$UbicarImagencuestionv6=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f6-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f6
$Cuestion='Falsa posicion 6';
$UbicarImagenfalsaf6='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf6=$rowimagen['Imagenes'];
	$UbicarImagencuestionf6=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v7-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v7
$Cuestion='Verdadera posicion 7';
$UbicarImagenverdaderav7='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav7=$rowimagen['Imagenes'];
	$UbicarImagencuestionv7=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f7-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f7
$Cuestion='Falsa posicion 7';
$UbicarImagenfalsaf7='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf7=$rowimagen['Imagenes'];
	$UbicarImagencuestionf7=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v8-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v8
$Cuestion='Verdadera posicion 8';
$UbicarImagenverdaderav8='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav8=$rowimagen['Imagenes'];
	$UbicarImagencuestionv8=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f8-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f8
$Cuestion='Falsa posicion 8';
$UbicarImagenfalsaf8='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf8=$rowimagen['Imagenes'];
	$UbicarImagencuestionf8=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v9-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v9
$Cuestion='Verdadera posicion 9';
$UbicarImagenverdaderav9='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav9=$rowimagen['Imagenes'];
	$UbicarImagencuestionv9=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f9-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f9
$Cuestion='Falsa posicion 9';
$UbicarImagenfalsaf9='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf9=$rowimagen['Imagenes'];
	$UbicarImagencuestionf9=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v10-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v10
$Cuestion='Verdadera posicion 10';
$UbicarImagenverdaderav10='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav10=$rowimagen['Imagenes'];
	$UbicarImagencuestionv10=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f10-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f10
$Cuestion='Falsa posicion 10';
$UbicarImagenfalsaf10='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf10=$rowimagen['Imagenes'];
	$UbicarImagencuestionf10=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v11-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v11
$Cuestion='Verdadera posicion 11';
$UbicarImagenverdaderav11='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav11=$rowimagen['Imagenes'];
	$UbicarImagencuestionv11=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f11-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f11
$Cuestion='Falsa posicion 11';
$UbicarImagenfalsaf11='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf11=$rowimagen['Imagenes'];
	$UbicarImagencuestionf11=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v12-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v12
$Cuestion='Verdadera posicion 12';
$UbicarImagenverdaderav12='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav12=$rowimagen['Imagenes'];
	$UbicarImagencuestionv12=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f12-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f12
$Cuestion='Falsa posicion 12';
$UbicarImagenfalsaf12='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf12=$rowimagen['Imagenes'];
	$UbicarImagencuestionf12=$rowimagen['Cuestion'];
	?>

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v13-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v13
$Cuestion='Verdadera posicion 13';
$UbicarImagenverdaderav13='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav13=$rowimagen['Imagenes'];
	$UbicarImagencuestionv13=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f13-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f13
$Cuestion='Falsa posicion 13';
$UbicarImagenfalsaf13='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf13=$rowimagen['Imagenes'];
	$UbicarImagencuestionf13=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v14-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v14
$Cuestion='Verdadera posicion 14';
$UbicarImagenverdaderav14='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav14=$rowimagen['Imagenes'];
	$UbicarImagencuestionv14=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f14-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f14
$Cuestion='Falsa posicion 14';
$UbicarImagenfalsaf14='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf14=$rowimagen['Imagenes'];
	$UbicarImagencuestionf14=$rowimagen['Cuestion'];
	?>

<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v15-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v15
$Cuestion='Verdadera posicion 15';
$UbicarImagenverdaderav15='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav15=$rowimagen['Imagenes'];
	$UbicarImagencuestionv15=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f15-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f15
$Cuestion='Falsa posicion 15';
$UbicarImagenfalsaf15='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf15=$rowimagen['Imagenes'];
	$UbicarImagencuestionf15=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v16-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v16
$Cuestion='Verdadera posicion 16';
$UbicarImagenverdaderav16='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav16=$rowimagen['Imagenes'];
	$UbicarImagencuestionv16=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f16-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f16
$Cuestion='Falsa posicion 16';
$UbicarImagenfalsaf16='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf16=$rowimagen['Imagenes'];
	$UbicarImagencuestionf16=$rowimagen['Cuestion'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v17-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v17
$Cuestion='Verdadera posicion 17';
$UbicarImagenverdaderav17='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav17=$rowimagen['Imagenes'];
	$UbicarImagencuestionv17=$rowimagen['Cuestion'];
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f17-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f17
$Cuestion='Falsa posicion 17';
$UbicarImagenfalsaf17='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf17=$rowimagen['Imagenes'];
	$UbicarImagencuestionf17=$rowimagen['Cuestion'];
	?>




<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v18-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v18
$Cuestion='Verdadera posicion 18';
$UbicarImagenverdaderav18='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav18=$rowimagen['Imagenes'];
	$UbicarImagencuestionv18=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f18-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f18
$Cuestion='Falsa posicion 18';
$UbicarImagenfalsaf18='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf18=$rowimagen['Imagenes'];
	$UbicarImagencuestionf18=$rowimagen['Cuestion'];
	?>




<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v19-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v19
$Cuestion='Verdadera posicion 19';
$UbicarImagenverdaderav19='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav19=$rowimagen['Imagenes'];
	$UbicarImagencuestionv19=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f19-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f19
$Cuestion='Falsa posicion 19';
$UbicarImagenfalsaf19='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf19=$rowimagen['Imagenes'];
	$UbicarImagencuestionf19=$rowimagen['Cuestion'];
	?>





<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v20-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v20
$Cuestion='Verdadera posicion 20';
$UbicarImagenverdaderav20='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav20=$rowimagen['Imagenes'];
	$UbicarImagencuestionv20=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f20-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f20
$Cuestion='Falsa posicion 20';
$UbicarImagenfalsaf20='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf20=$rowimagen['Imagenes'];
	$UbicarImagencuestionf20=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v21-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v21
$Cuestion='Verdadera posicion 21';
$UbicarImagenverdaderav21='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav21=$rowimagen['Imagenes'];
	$UbicarImagencuestionv21=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f21-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f21
$Cuestion='Falsa posicion 21';
$UbicarImagenfalsaf21='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf21=$rowimagen['Imagenes'];
	$UbicarImagencuestionf21=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v22-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v22
$Cuestion='Verdadera posicion 22';
$UbicarImagenverdaderav22='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav22=$rowimagen['Imagenes'];
	$UbicarImagencuestionv22=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f22-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f22
$Cuestion='Falsa posicion 22';
$UbicarImagenfalsaf22='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf22=$rowimagen['Imagenes'];
	$UbicarImagencuestionf22=$rowimagen['Cuestion'];
	?>




<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v23-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v23
$Cuestion='Verdadera posicion 23';
$UbicarImagenverdaderav23='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav23=$rowimagen['Imagenes'];
	$UbicarImagencuestionv23=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f23-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f23
$Cuestion='Falsa posicion 23';
$UbicarImagenfalsaf23='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf23=$rowimagen['Imagenes'];
	$UbicarImagencuestionf23=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v24-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v24
$Cuestion='Verdadera posicion 24';
$UbicarImagenverdaderav24='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav24=$rowimagen['Imagenes'];
	$UbicarImagencuestionv24=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f24-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f24
$Cuestion='Falsa posicion 24';
$UbicarImagenfalsaf24='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf24=$rowimagen['Imagenes'];
	$UbicarImagencuestionf24=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v25-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v25
$Cuestion='Verdadera posicion 25';
$UbicarImagenverdaderav25='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav25=$rowimagen['Imagenes'];
	$UbicarImagencuestionv25=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f25-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f25
$Cuestion='Falsa posicion 25';
$UbicarImagenfalsaf25='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf25=$rowimagen['Imagenes'];
	$UbicarImagencuestionf25=$rowimagen['Cuestion'];
	?>



<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es verdadra y posicion es v26-->
<?php
//esta opcion es al que debe estar programada con el valor de verdadra posicion v26
$Cuestion='Verdadera posicion 26';
$UbicarImagenverdaderav26='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenverdaderav26=$rowimagen['Imagenes'];
	$UbicarImagencuestionv26=$rowimagen['Cuestion'];
	$UbicarItemsParamostrar=$rowimagen['id_Items'];
	
	?>


<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!-- filtra imagnes segun id_Items and Cuestion para el cuerpo del celular y las opciones de respuesta si es falsa posicion f26-->
<?php
//esta opcion es al que debe estar programada con el valor de falsa posicion f26
$Cuestion='Falsa posicion 26';
$UbicarImagenfalsaf26='';
	$recordsImagnesbuscar = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscar->execute();
	$rowimagen=$recordsImagnesbuscar ->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenfalsaf26=$rowimagen['Imagenes'];
	$UbicarImagencuestionf26=$rowimagen['Cuestion'];
	?>











<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Esta tabla sera el modelo a seguir para poder presentar el celular a simular;-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<center>

<!--Este filtro ya es de la base de datos con la imagen que va ir de fondo;-->
 <div class="table-responsive">

<table class="table-condensed" id="general" border="0" background="<?php echo $UbicarImagenfondo;?>">
<!--ojo esta tabla la puse para que ponga dentro el diseño del celular-->
<tr>
<td>
<!--Tabla interna para traer los botones de las imagenes-->


<center>
<table class="table-condensed" id="generalbotonesImagenes" border="0">

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Encabezado del celuar-->
<tr>
<td id="colgeneral">

<br>
Claro
</td>
<td>
<br>

<center>
<!--Este filtro ya es de la base de datos con la imagen es la verdadera clalo esta si desea puede ubicar mas verdadera;-->
<!-- Posicion 1-->
<?php
if($UbicarImagencuestionv1=="Verdadera posicion 1"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 1';
    $UbicarImagenItemsverdaderav1='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav1=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<!-- ojo le pondre accion al metodo post solo para probar sino debe poner la variable buscarIdCuestionario ojo ayudamen Dios-->
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="bateria" src="<?php echo $UbicarImagenverdaderav1;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf1;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf1=="Falsa posicion 1"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax" name="RespuestasFrmAjax" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas"  size="40"><img  class="bateria" src="<?php echo $UbicarImagenfalsaf1;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<br>

<!--Este filtro ya es de la base de datos con la imagen es la verdadera clalo esta si desea puede ubicar mas verdadera;-->
<!-- Posicion 2-->
<center>
<?php
if($UbicarImagencuestionv2=="Verdadera posicion 2"){
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
	$Cuestion='Verdadera posicion 2';
    $UbicarImagenItemsverdaderav2='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav2=$rowimagenItems['id_Items'];
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
  <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	     <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="bateria" src="<?php echo $UbicarImagenverdaderav2;?>"></button>

</form>
	
	<?php	
	}

?>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php
if($UbicarImagencuestionf2=="Falsa posicion 2"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax2" name="RespuestasFrmAjax2" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas2"  size="40"><img  class="bateria" src="<?php echo $UbicarImagenfalsaf2;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
<td>
<br>

<div align="right">
12:32
</div>
</td>
</tr>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->








<tr>
<!--
<td id="colgeneral">
-->
<td id="colgeneral">
<center>
<!-- Posicion 3-->

<?php
if($UbicarImagencuestionv3=="Verdadera posicion 3"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 3';
    $UbicarImagenItemsverdaderav3='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav3=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"   id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav3;?>"></button>

</form>
	
	<?php	
	}

?>

<?php
if($UbicarImagencuestionf3=="Falsa posicion 3"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax3" name="RespuestasFrmAjax3" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas3"  size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf3;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	

</center>
</td>
<td id="colgeneral">

<!-- Posicion 4-->
<center>
<?php
if($UbicarImagencuestionv4=="Verdadera posicion 4"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 4';
    $UbicarImagenItemsverdaderav4='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav4=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav4;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf4;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf4=="Falsa posicion 4"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax4" name="RespuestasFrmAjax4" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas4"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf4;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td id="colgeneral">
<!-- Posicion 5-->
<center>
<?php
if($UbicarImagencuestionv5=="Verdadera posicion 5"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 5';
    $UbicarImagenItemsverdaderav5='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav5=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	   <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav5;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf5;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf5=="Falsa posicion 5"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax5" name="RespuestasFrmAjax5" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas5"  size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf5;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
<!--
<td id="colgeneral">
-->
<td>
<!-- Posicion 6-->
<center>
<?php
if($UbicarImagencuestionv6=="Verdadera posicion 6"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 6';
    $UbicarImagenItemsverdaderav6='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav6=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav6;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf6;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf6=="Falsa posicion 6"){
	include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax6" name="RespuestasFrmAjax6" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas6"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf6;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
</tr>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
<!--
<td id="colgeneral">
-->
<td id="colgeneral">
<!-- Posicion 7-->
<center>
<?php
if($UbicarImagencuestionv7=="Verdadera posicion 7"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 7';
    $UbicarImagenItemsverdaderav7='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav7=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav7;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf7;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf7=="Falsa posicion 7"){
include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax7" name="RespuestasFrmAjax7" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas7"  size="40"><img class="pequeña" src="<?php echo $UbicarImagenfalsaf7;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>


<td>
<!-- Posicion 8-->
<center>
<?php
if($UbicarImagencuestionv8=="Verdadera posicion 8"){
	//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
	$Cuestion='Verdadera posicion 8';
    $UbicarImagenItemsverdaderav8='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav8=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav8;?>"></button>

</form>
	
	<?php	
	}

?>

<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf8;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf8=="Falsa posicion 8"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax8" name="RespuestasFrmAjax8" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas8"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf8;?>"></button>
</form>
		<?php
	}
?>
</center>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</td>


<td>
<!-- Posicion 9-->
<center>
<?php
if($UbicarImagencuestionv9=="Verdadera posicion 9"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
	$Cuestion='Verdadera posicion 9';
    $UbicarImagenItemsverdaderav9='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav9=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav9;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf9;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf9=="Falsa posicion 9"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax9" name="RespuestasFrmAjax9" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas9"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf9;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 10-->
<center>
<?php
if($UbicarImagencuestionv10=="Verdadera posicion 10"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 10';
    $UbicarImagenItemsverdaderav10='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav10=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav10;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf10;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf10=="Falsa posicion 10"){
	include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax10" name="RespuestasFrmAjax10" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas10"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf10;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
</tr>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
<!--
<td id="colgeneral">
-->
<td id="colgeneral">
<!-- Posicion 11-->
<center>
<?php
if($UbicarImagencuestionv11=="Verdadera posicion 11"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 11';
    $UbicarImagenItemsverdaderav11='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav11=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav11;?>"></button>
</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf11;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf11=="Falsa posicion 11"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax11" name="RespuestasFrmAjax11" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas11"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf11;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 12-->
<center>
<?php
if($UbicarImagencuestionv12=="Verdadera posicion 12"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 12';
    $UbicarImagenItemsverdaderav12='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav12=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav12;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf12;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf12=="Falsa posicion 12"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax12" name="RespuestasFrmAjax12" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas12"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf12;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 13-->
<center>
<?php
if($UbicarImagencuestionv13=="Verdadera posicion 13"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 13';
    $UbicarImagenItemsverdaderav13='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav13=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php"  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav13;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf13;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf13=="Falsa posicion 13"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax13" name="RespuestasFrmAjax13" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas13"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf13;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 14-->
<center>
<?php
if($UbicarImagencuestionv14=="Verdadera posicion 14"){
	//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
	$Cuestion='Verdadera posicion 14';
    $UbicarImagenItemsverdaderav14='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav14=$rowimagenItems['id_Items'];
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav14;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf14;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf14=="Falsa posicion 14"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax14" name="RespuestasFrmAjax14" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas14"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf14;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
</tr>

<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
<!--
<td id="colgeneral">
-->
<td id="colgeneral">
<!-- Posicion 15-->
<center>
<?php
if($UbicarImagencuestionv15=="Verdadera posicion 15"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 15';
    $UbicarImagenItemsverdaderav15='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav15=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav15;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf15=="Falsa posicion 15"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax15" name="RespuestasFrmAjax15" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas15"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf15;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 16-->
<center>
<?php
if($UbicarImagencuestionv16=="Verdadera posicion 16"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 16';
    $UbicarImagenItemsverdaderav16='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav16=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav16;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf16=="Falsa posicion 16"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax16" name="RespuestasFrmAjax16" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas16"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf16;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 17-->
<center>
<?php
if($UbicarImagencuestionv17=="Verdadera posicion 17"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 17';
    $UbicarImagenItemsverdaderav17='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav17=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav17;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf17=="Falsa posicion 17"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax17" name="RespuestasFrmAjax17" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas17"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf17;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 18-->
<center>
<?php
if($UbicarImagencuestionv18=="Verdadera posicion 18"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 18';
    $UbicarImagenItemsverdaderav18='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav18=$rowimagenItems['id_Items'];
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav18;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf18=="Falsa posicion 18"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax18" name="RespuestasFrmAjax18" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas18"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf18;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
</tr>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
<td id="colgeneral">
<!-- Posicion 19-->
<center>
<?php
if($UbicarImagencuestionv19=="Verdadera posicion 19"){

	$Cuestion='Verdadera posicion 19';
    $UbicarImagenItemsverdaderav19='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav19=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav19;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf19=="Falsa posicion 19"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax19" name="RespuestasFrmAjax19" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas19"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf19;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 20-->
<center>
<?php
if($UbicarImagencuestionv20=="Verdadera posicion 20"){
	
	$Cuestion='Verdadera posicion 20';
    $UbicarImagenItemsverdaderav20='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav20=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav20;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf20=="Falsa posicion 20"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax20" name="RespuestasFrmAjax20" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas20"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf20;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 21-->
<center>
<?php
if($UbicarImagencuestionv21=="Verdadera posicion 21"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 21';
    $UbicarImagenItemsverdaderav21='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav21=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav21;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf21=="Falsa posicion 21"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax21" name="RespuestasFrmAjax21" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas21"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf21;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>

<td>
<!-- Posicion 22-->
<center>
<?php
if($UbicarImagencuestionv22=="Verdadera posicion 22"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 22';
    $UbicarImagenItemsverdaderav22='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav22=$rowimagenItems['id_Items'];
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav22;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf22=="Falsa posicion 22"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax22" name="RespuestasFrmAjax22" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas22"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf22;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
</td>
</tr>


<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->





<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<tr>
<td id="colgeneral">
<!-- Posicion 23-->
<center>
<?php
if($UbicarImagencuestionv23=="Verdadera posicion 23"){

	$Cuestion='Verdadera posicion 23';
    $UbicarImagenItemsverdaderav23='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav23=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav23;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf15;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf23=="Falsa posicion 23"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax23" name="RespuestasFrmAjax23" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas23"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf23;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
<br>
</td>

<td>
<!-- Posicion 24-->
<center>
<?php
if($UbicarImagencuestionv24=="Verdadera posicion 24"){
	
	$Cuestion='Verdadera posicion 24';
    $UbicarImagenItemsverdaderav24='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav24=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav24;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf16;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf24=="Falsa posicion 24"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax24" name="RespuestasFrmAjax24" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas24"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf24;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
<br>
</td>

<td>
<!-- Posicion 25-->
<center>
<?php
if($UbicarImagencuestionv25=="Verdadera posicion 25"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 25';
    $UbicarImagenItemsverdaderav25='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav25=$rowimagenItems['id_Items'];
	
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav25;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf17;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf25=="Falsa posicion 25"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax25" name="RespuestasFrmAjax25" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas25"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf25;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
<br>
</td>

<td>
<!-- Posicion 26-->
<center>
<?php
if($UbicarImagencuestionv26=="Verdadera posicion 26"){
	
		//Esta consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	$Cuestion='Verdadera posicion 26';
    $UbicarImagenItemsverdaderav26='';
	$recordsImagnesbuscarItems = $conn->prepare("SELECT id_Imagenes, id_Items, Imagenes, Cuestion FROM tb_imagenes where id_Items='$TomaridItems' and Cuestion='$Cuestion'");
    $recordsImagnesbuscarItems->execute();
	$rowimagenItems=$recordsImagnesbuscarItems->fetch(PDO::FETCH_ASSOC);
	$UbicarImagenItemsverdaderav26=$rowimagenItems['id_Items'];
	//esta consulta es para poder traer los items desde la base de datos para poder aumentar
	$TraerItemsConsecutivo='';
	$recordsItemsCosecutivo= $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items='$TomaridItems'");
    $recordsItemsCosecutivo->execute();
	$rowItems=$recordsItemsCosecutivo->fetch(PDO::FETCH_ASSOC);
	$AumentarAumentarItems=$rowItems['Items'];
	?>
	<form action="SimularInstrumentoPrincipal_Frm.php" id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarItemsBD" id="AumetarItemsBD" value="<?php echo $AumentarAumentarItems;?>">
	   <input type="hidden" name="AumetarPreguntas" id="AumetarPreguntas" value="<?php echo $aumetaPreguntas-1;?>">
	      <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	   <button class="btn-flat" type='submit' id="sumaItemsbtn" name="sumaItemsbtn"><img  class="pequeña" src="<?php echo $UbicarImagenverdaderav26;?>"></button>

</form>
	
	<?php	
	}

?>
<!-- comente este toast por que no tengo internet pero si puedo mejor le activare ojo pendiente
<a onclick="M.toast({html: 'Lo sentimos...! Esta acción no es la correcta', })" ><img  class="pequeña"src="<?php // echo $UbicarImagenfalsaf18;?>"></p></a>
-->
<?php
if($UbicarImagencuestionf26=="Falsa posicion 26"){
		include ('database.php');
$recordsErrores = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordsErrores->execute();
$rowpreguntaErrores=$recordsErrores->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarPreguntasErrores=$rowpreguntaErrores['Numero'];
$TomarValorVerdaderoImagenBD=$rowpreguntaErrores['ValorVerdadero'];
$TomarValorFalsoImagenBD=$rowpreguntaErrores['ValorFalso'];
$TomarNivelImagenBD=$rowpreguntaErrores['Nivel'];
$TomarIdNivelImagenBD=$rowpreguntaErrores['id_Niveles'];
$TomarIdAreaImagenBD=$rowpreguntaErrores['id_Areas'];
$TomarIdCompetenciasImagenBD=$rowpreguntaErrores['id_Competencias'];
//Este codigo del formulario sigueinte avanza a la pregunta sigueinte y guarda con el valor de petitencia por dar click en la imagen incorrecta en la bd
	?>
	<form   id="RespuestasFrmAjax26" name="RespuestasFrmAjax26" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaImagenBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasImagenBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelImagenBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarPreguntasErrores;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoImagenBD;?>">
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoImagenBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelImagenBD;?>">
	<button class="btn-flat" id="btnRespuestas26"  size="40"><img  class="pequeña" src="<?php echo $UbicarImagenfalsaf26;?>"></button>
</form>
		<?php
	}
?>
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
</center>
<br>
</td>
</tr>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->



</table>

</center>
<!--Fin de la tabla general-->
</td>
</tr>
<?php







///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Este else if dentro del else interno es apra que aparezca y desaparezca el boton NO SE QUE RESPONDER
include ('database.php');
$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordspreguntasAumentar->execute();
$rowpreguntaBD1=$recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarAumentarPreguntasBD=$rowpreguntaBD1['Numero'];
$TomarValorVerdaderoBD1=$rowpreguntaBD1['ValorVerdadero'];
$TomarValorFalsoBD1=$rowpreguntaBD1['ValorFalso'];
$TomarIdAreasBD1=$rowpreguntaBD1['id_Areas'];
$TomarIdCompetenciasBD1=$rowpreguntaBD1['id_Competencias'];
$TomarIdNivelesBD1=$rowpreguntaBD1['id_Niveles'];
$TomarNivelBD1=$rowpreguntaBD1['Nivel'];
	
	?>

<!--<boton de no se como hacerlo a la izquierda y superior >-->
<div align="right">
	<form action='SimularInstrumentoPrincipal_Frm.php'  id="form1" name="form1" method='POST' align="right">
  <input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD;?>">
     <input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	 <input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreasBD1;?>">
	 <input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD1;?>">
	 <input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelesBD1;?>">
	 <input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	  <!--Tomar en cuenta si se da clic en NO SE QUE RESPONDER es por que tiene un puntaje de 0 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD1;?>">
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD1;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD1;?>">
	 <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
    
	  
	   <button type='submit' class="DiseñoBtnSimular btn-primary" id="NumeroPregunta" name="NumeroPregunta">NO SÉ CÓMO HACERLO</button> 
</form>

</div>

<!--</center>-->


</table>
</div>
</center>
<!--Fin tabla del  modelo a seguir para poder presentar el celular a simular;-->
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<?php







///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Este else if dentro del else interno es apra que aparezca y desaparezca el boton NO SE QUE RESPONDER
include ('database.php');
$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordspreguntasAumentar->execute();
$rowpreguntaBD1=$recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarAumentarPreguntasBD=$rowpreguntaBD1['Numero'];
$TomarValorVerdaderoBD1=$rowpreguntaBD1['ValorVerdadero'];
$TomarValorFalsoBD1=$rowpreguntaBD1['ValorFalso'];
$TomarIdAreasBD1=$rowpreguntaBD1['id_Areas'];
$TomarIdCompetenciasBD1=$rowpreguntaBD1['id_Competencias'];
$TomarIdNivelesBD1=$rowpreguntaBD1['id_Niveles'];
$TomarNivelBD1=$rowpreguntaBD1['Nivel'];
	
	?>
<!--Boyon comentado que estaba en la parte inferior--
<center>
	<form action='SimularInstrumentoPrincipal_Frm.php'  id="form1" name="form1" method='POST'>
  <input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php //echo $AumetarAumentarPreguntasBD;?>">
     <input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php //echo $buscarIdCuestionario;?>">
	 <input type="hidden" name="id_Area" id="id_Area" value="<?php //echo $TomarIdAreasBD1;?>">
	 <input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php //echo $TomarIdCompetenciasBD1;?>">
	 <input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php //echo $TomarIdNivelesBD1;?>">
	 <input type="hidden" name="Numero" id="Numero" value="<?php //echo $AumetarAumentarPreguntasBD;?>">
	 <input type="hidden" name="email" id="email" value="<?php //echo $Personas;?>">
	  <!--Tomar en cuenta si se da clic en NO SE QUE RESPONDER es por que tiene un puntaje de 0 y en erorres o puntaje falso tiene 0-->
	 
	 <!--<input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="0,1">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php //echo $TomarValorVerdaderoBD1;?>">
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php //echo $TomarValorFalsoBD1;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php //echo $TomarNivelBD1;?>">
	 <input type="hidden" name="valorProgreso" value="<?php //echo $UmentaPreguntasProgreso;?>">
     <br>
	  
	   <button type='submit' class="DiseñoBtnSimular btn-primary" id="NumeroPregunta" name="NumeroPregunta">NO SÉ CÓMO HACERLO</button> 
</form>
<br>

</center>
-->
<?php



///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


	//fin del if interno	
	 }else{
		 //if($aumetaItems<=2){
		  if($aumetaItems>=$SumarItems){
			   echo "<br>";
	
		///////////////////////////////////////////////////////////////////////////////////////
		
     echo "<br>";
			
		
		//ojo aquie es la consulta en las verdaderas traer desde la base de datos el items para los items sumas en j=j+items y trarer el items para realizar el idcuestionario y hacer con i=i+numero consultando en la tabla cuestionario el numero ojo -->
		
	include ('database.php');
$recordspreguntasAumentar = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$buscarIdCuestionario'");
$recordspreguntasAumentar->execute();
$rowpreguntaBD=$recordspreguntasAumentar->fetch(PDO::FETCH_ASSOC);
// esto es para buscar con la misma consulta
$AumetarAumentarPreguntasBD=$rowpreguntaBD['Numero'];
$TomarValorVerdaderoBD=$rowpreguntaBD['ValorVerdadero'];
$TomarValorFalsoBD=$rowpreguntaBD['ValorFalso'];
$TomarNivelBD=$rowpreguntaBD['Nivel'];
$TomarIdNivelBD=$rowpreguntaBD['id_Niveles'];
$TomarIdAreaBD=$rowpreguntaBD['id_Areas'];
$TomarIdCompetenciasBD=$rowpreguntaBD['id_Competencias'];
//ojo pero hay que hacer metodos separados pero con la misma variable a incrementar aumetaItems  en este boton debe guardar con el boto sigueinte avanza a la pregunta sigueinte y guarda con el valor de uno 1 tomar en cuenta que mejor poner un boton guardar
	?>
	<br>
	
	<div class="overlay">
 <div class="popup">
 <form action='SimularInstrumentoPrincipal_Frm.php'  id="form1" name="form1" method='POST'>
 <!--<h3 class="textopopup">Correcto!</h3>-->
 <input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD;?>">
     <input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="<?php echo $TomarValorVerdaderoBD;?>">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD;?>">
	 <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	 
	 <!--
	 <input type='submit' id="NumeroPregunta" name="NumeroPregunta" value="Siguiente"> 
	 -->
	  <center> <button type='submit' class="btn btn-success" id="NumeroPregunta" name="NumeroPregunta">Siguiente ítem</button></center>

 </form>
 </div>
 </div>
	
	
	<center>
	<div class='ContenedorRespuestasSimular btn-primary'>
<br>
  <h3 class='DiseñoTexto'><b>Ok...!<br> Avance al siguiente ítem</b></h3>
 </div>
	
	<br>
	<form action='SimularInstrumentoPrincipal_Frm.php'  id="form1" name="form1" method='POST'>
<!--Esta caja de texto sigueinte permite tomar el valor para poder aumentar las preguntas--> 
 <input type="hidden" name="AumetarAumentarPreguntasBD" id="AumetarAumentarPreguntasBD" value="<?php echo $AumetarAumentarPreguntasBD;?>">
     <input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $buscarIdCuestionario;?>">
	<input type="hidden" name="id_Area" id="id_Area" value="<?php echo $TomarIdAreaBD;?>">
	<input type="hidden" name="id_Competencias" id="id_Competencias" value="<?php echo $TomarIdCompetenciasBD;?>">
	<input type="hidden" name="id_Niveles" id="id_Niveles" value="<?php echo $TomarIdNivelBD;?>">
	<input type="hidden" name="Numero" id="Numero" value="<?php echo $AumetarAumentarPreguntasBD;?>">
	 <input type="hidden" name="email" id="email" value="<?php echo $Personas;?>">
	 <input type="hidden" name="PuntajeVerdadero" id="PuntajeVerdadero" value="<?php echo $TomarValorVerdaderoBD;?>">
	 <input type="hidden" name="ValorVerdadero" id="ValorVerdadero" value="<?php echo $TomarValorVerdaderoBD;?>">
	 <!--Tomar en cuenta si se da clic en sigueinte es or qye tiene un puntaje de 1,2 0 3 y en erorres o puntaje falso tiene 0-->
	 <input type="hidden" name="PuntajeFalso" id="PuntajeFalso" value="0,1">
	 <input type="hidden" name="ValorFalso" id="ValorFalso" value="<?php echo $TomarValorFalsoBD;?>">
	 <input type="hidden" name="Nivel" id="Nivel" value="<?php echo $TomarNivelBD;?>">
	 <input type="hidden" name="valorProgreso" value="<?php echo $UmentaPreguntasProgreso;?>">
	 
	 <!--
	 <input type='submit' id="NumeroPregunta" name="NumeroPregunta" value="Siguiente"> 
	 -->
	   <button type='submit' class="DiseñoBtnSimular btn-warning" id="NumeroPregunta" name="NumeroPregunta">Siguiente</button>	   
</form>
<br>
</center>
	<?php	
		
		
		 }
		
     ///////////////fin de else if  interno   
	 }
	 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	 
//Aquie la parte else del if General	 

// continuacion la llave sigueinte es del if General 	
}else{

	//if($aumetaPreguntas<=2){
if($aumetaPreguntas>=$sumapreguntas){
	
	//ojo quei debe haber un boton donde se ponga aterminar y pasara a la pantallade preguntas de CONTEXTO PARA GUARDAR FINALMENTE Y PRESENTAR LOS RESULTADOS EN DICHA PLANTILLA OJO
	?>
	<br>
<div class="overlay">
 <div class="popup">
 <h3 class="textopopup"><b>Felicidades...!</h3><h6><br><font color="#fff"> Ha desarrollado la primera parte.<br>Para obtener los resultados finales es necesario completar la siguiente información</b></h6>
 <br>	
	<form action='Contexto_Crear_frm.php'  id="contexto" name="contexto" method='POST'>
	<center><button type='submit' class="btn btn-success"  name="contexto">Terminar primera parte</button></center> 

</form>
 </div>
 </div>
	<center>

  <div class='ContenedorRespuestasSimular btn-primary'>
<br>
  <h3 class='DiseñoTexto'><b>Felicidades...!<br> Ha desarrollado la primera parte. Para obtener los resultados finales es necesario completar la siguiente información</b></b></h3>
 </div>
 
<br>	
	<form action='Contexto_Crear_frm.php'  id="contexto" name="contexto" method='POST'>
	<button type='submit' class="DiseñoBtnSimular btn-warning"  name="contexto">Terminar primera parte</button> 

</form>
</center>
<br>
<!--Esta funcion es la que se ejcutara para que se bloquee el boton NO SE QUE RESPONDER-->

	<?php	
	
	
	}	
// continuacion la llave sigueinte es del else if General 		
}



?>

<!--/AQUI TERMINA EL IF Y ALGORIMO DIOS MIO-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->
<!--/////////////////////////////////////////////////////////////////////////////////////////////-->


<!--Fin del contenedor que tiene el 75% y es del celular-->
</div>
  </body>
<!--
    <footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
               <p class="grey-text text-lighten-4">Evaluamos tu perfil digital mediante la simulación de pantallas de dispositivos móviles.</p>
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
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
  -->
<<<<<<< HEAD
	<!--pie de pagina central-->




	</html>
	<!--Lleve del inicio de sesion-->
<?php
} else {
?>

	<center> <img width="90%" src="ImagenesProgramacion/ErrorInicioSesion.png"></center>
	<center><b>
			<h2><a id="fondoMouse" href="index.php">
					<font color="#2696ff">Ir pantalla principal</font>
				</a></h2>
		</b></center>


<?php
}
?>
=======
  <!--pie de pagina central-->



 
</html>   
<!--Lleve del inicio de sesion-->
<?php
  }else{
	  ?>
	
	 <center> <img  width="90%" src="ImagenesProgramacion/ErrorInicioSesion.png"></center>
	  <center><b><h2><a id="fondoMouse" href="index.php"><font color="#2696ff">Ir pantalla principal</font></a></h2></b></center>
  
	
	  <?php
  }
	  ?>                                
>>>>>>> 49bae4deda0929eb401d5b0222962086251887c7
