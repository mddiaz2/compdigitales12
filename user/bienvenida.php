
<?php
//este codigo es para iniciar sesion 
  session_start();
 
  require 'database.php';
  $user ='';
  if (isset($_SESSION['personas_email'])) {
    $records = $conn->prepare('SELECT id, email, password FROM tb_personas WHERE email = :email');
    $records->bindParam(':email', $_SESSION['personas_email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    
    if (count($results) > 0) {
      $user = $results;
	 $Personas=$user['email'];
    }
	//La llve esta comentada es para ya poner el inicio de session activada
  //}
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<title>Bienvenido</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="estilos/css/util.css">
	<link rel="stylesheet" type="text/css" href="estilos/css/main.css">
	<!--===============================================================================================-->
</head>

<body>


	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-38 p-l-15 p-r-15"
		style="background-image: url('Imagenes/bg02.jpg');">
		<div class="wsize1 bor1 bg1 p-t-75 p-b-38 p-l-65 p-r-65 respon1">
			<div class="wrappic1">
				<img src="Imagenes/lo.png" alt="LOGO">
			</div>
			<br>
			<br>
			<div class="wrappic1">
				<h1>BIENVENIDO</h1>
			</div>
			<p class="txt-center m1-txt1 p-t-33 p-b-38">
				Estimado <?php if(!empty($user)): ?>
                                        <?=$user['email']; ?>

                                        <?php endif; ?> a continuacíon se presenta el test de autoevaluación.
			</p>
			<div class="wrappic1">
				<h2>INDICACIONES</h2>
			</div>
			<p class="m1-txt2 p-t-33 p-b-38">
				La información del test está dividida en dos partes:
				<br>
				<br>

				<b>1.</b> En la parte derecha, el área y competencia en la que usted está evaluándose, y en la parte
				inferior
				la información del avance progresivo de cada ítem y la pantalla que está desarrollando.
				<br>
				<br>
				<b>2.</b> En la parte izquierda, está el ítem planteado para ser desarrollado con el simulador del
				dispositivo móvil, y
				en la parte izquierda está la acción de <b>"NO SÉ CÓMO HACERLO"</b>, que permite avanzar al siguiente
				ítem a evaluar.
			</p>
<br>
			<div class="wrappic1">
				<button  type="button" class="btn btn-ttc" onclick="window.location.href='../user/logout.php'">CANCELAR</button>
				<button  type="button" class="btn btn-ttc" onclick="window.location.href='../user/SimularInstrumentoPrincipal_Frm.php'">CONTINUAR</button>
			</div>
			<br>
			<br>
		</div>
	</div>
	</div>
</body>

</html>