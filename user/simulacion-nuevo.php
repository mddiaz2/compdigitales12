<?php
//Este codigo es para abrir la sesión de las páginas
  session_start();
  //Este codigo permite desencryptar la contraseña y verificar si esta en la base de datos el usuario
  require 'database.php'; 
  $emailregistrado='';
	$user='';
  if (!empty($_POST['email']) && !empty($_POST['password'])) {
	  include ('database.php');
	   $email=$_POST['email'];
	  $Activa=1;
	  $RecibirEmail=$_POST['email'];
	  //Ojo aqui valido que sea con la base de datos registrado para compara con el usuario y clave ingresada
	  
	//$recordsContexto1 = $conn->prepare("SELECT * FROM tb_contexto  where email='$RecibirEmail'"); 
    //$recordsContexto1->execute();
	//$rowContextoBD1=$recordsContexto1->fetch(PDO::FETCH_ASSOC);
     //$CompararEvaluado=$rowContextoBD1['email'];
	 
	 //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 
	            $recordsBuscarEvaluado = $conn->prepare("SELECT id, email, password FROM tb_personas WHERE email ='$email'");
				$recordsBuscarEvaluado->bindParam(':email', $_POST['email']);
				$recordsBuscarEvaluado->execute();
				$message = '';
				$buscaremailEvaluado='';	  
				$resultsBuscarEvaluado = $recordsBuscarEvaluado->fetch(PDO::FETCH_ASSOC);
				$buscaremailEvaluado=$resultsBuscarEvaluado['email']; 
				if(!empty($buscaremailEvaluado)){
				 $compara=($_POST['password']);
				//if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
							 if (count($resultsBuscarEvaluado) > 0 && ($compara==$resultsBuscarEvaluado['password'])) {
								$_SESSION['personas_email'] = $resultsBuscarEvaluado['email'];
								//$roliniciar = $conn->prepare('SELECT id_Personas, email, password FROM tb_personas WHERE email = :email');
								$roliniciar = $conn->prepare('SELECT * FROM tb_contexto WHERE email = :email');
								$roliniciar->bindParam(':email', $_POST['email']);
								$roliniciar->execute();
								$rowEvaluado=$roliniciar->fetch(PDO::FETCH_ASSOC);
								$CompararEvaluado=$rowEvaluado['email'];
								///header ('Location: SimularInstrumentoPrincipal_Frm.php');	
								
								if(!empty($CompararEvaluado)){
								
										$records = $conn->prepare("SELECT * FROM tb_respuestas where email='$CompararEvaluado'");
										$records->execute();
										$Token=0;
										while($row=$records->fetch(PDO::FETCH_ASSOC)){
										$Token=$row['Token'];
										}
								 $_SESSION['PasarToken'] = $Token;
									 //$Toma=$_SESSION['PasarToken'];
									 //Con esta variable debemos hacer halgo cunado se presente los detalles en una nueva php
									 $_SESSION['personas_email'] = $RecibirEmail;
									 
									?>
									<div class="overlay">
									<div class="popupPantallas">
									<!--Por el momento esto esta puentidao de ahi hay que hacer un cambio como detalles de la evaluaciones realizadas-->
									<form   action="EvaluacionesUsuarios.php" method="POST">
									<center>  <h4><div class='btn-primary'><b>Información</b></div></h4></center>
									<h6>Estimado usuario <?= $RecibirEmail;?>, usted ya a sido evaluado.<br>
									<hr>
									¿Desea ver sus resultados obtenidos?</h6>
									<hr>
									<center><b><h6> <a id="fondoMouse"   class="btn btn-outline-primary" href="index.php"><font color="#2696ff">Cancelar</font></a> <button name="btnindex" class="btn btn-info"  id="DiseñoMouse" type="submit">Aceptar</button></h6></b></center></center>
									</form>
									<h6>¿Desea realizar una vez más el test?<br></h6>
									<center><b><h6> <a    class="btn btn-success" href="SimularInstrumentoPrincipal_Frm.php"><font color="#fff">Realizar test</font></a></b></h6></center>
									</div>
									</div>
									<?php

								}else{
									//cuando el usaurio no se ha evaluado aun 
									$_SESSION['personas_email'] = $RecibirEmail;
									//Este codigo es para poder eliminar las respuestas que por alguna razon se quedaron bloqueda la pantalla del simulador y no pudo concluir la evaluacion 
									$recordsEliminarRespuestasTruncadas = $conn->prepare("DELETE FROM tb_respuestas WHERE email='$RecibirEmail'");
									$recordsEliminarRespuestasTruncadas->execute();
									//cuando el usaurio no se ha evaluado aun 
									$roliniciar = $conn->prepare('SELECT id, email password FROM tb_personas WHERE email = :email');
									$roliniciar->bindParam(':email', $_POST['email']);
									$roliniciar->execute();
									//header ('Location: SimularInstrumentoPrincipal_Frm.php');
										//Esta codigo es para presentar una pantalla de bienvenida al usuario y presentar idnicaciones generales
										?>
											<div class="container-all" id="modal">
												<div class="popup">
													<form   action="SimularInstrumentoPrincipal_Frm.php" method="POST">
													<div class="container-text">
													<h4><center><div class='btn-primary'><b>Bienvenido</b></div></center></h4>
												<h6 class="textopopupPantallas">Estimado usuario <?= $RecibirEmail;?>, a continuacíon se presenta el <font color="green"> test de autoevaluación</font><br>
											<h6><center><b><font color="purple">Indicaciones</font></b></center></h6><hr>
											<h6> La información del test está dividida en dos partes:<br><br>
											 <b>1.-</b> En la parte derecha, el área y competencia en la que usted está evaluándose, y en la parte inferior 
                                             la información del avance progresivo de cada ítem y la pantalla que está desarrollando.<br><br>
											 <b>2.-</b> En la parte izquierda, está el ítem planteado para ser desarrollado con el simulador del dispositivo móvil, y
											 en la parte izquierda está la acción de <b>"NO SÉ CÓMO HACERLO"</b>, que permite avanzar al siguiente ítem a evaluar.
											 </h6> 											
											
											<hr>
											<center>
											<b><h6> <a id="fondoMouse"   class="btn btn-outline-primary" href="index.php"><font color="#2696ff">Cancelar</font></a> <button name="btnBienvenida" class="btn btn-info"  id="DiseñoMouse" type="submit">Aceptar</button></h6></b></center>
											</center>
											</form>
											</div>
											</div>
										
										<?php
									
									///////////////////////////////////////////////////////////////////
								}
								
								
								
								
								
								
								}else{
								$message = 'Lo sentimos, la clave ingresada no es la correcta';
								}		
				}else{
					$message = 'Lo sentimos, el email no está registrado, revise el email ingresado o registre una cuenta';
				}

				//lave de los campos que esta vacios
				}
	 
	 //////////////////////////////////////////////////////////////////
	 
	 
	 
  
?>


<!DOCTYPE html>
<html>
<head>
  	  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <title>Competencias digitales</title>
   <!--Instalados de forma manual que fueron descargadas-->
    <!-- para los estilos css-->
       <meta charset="utf-8">
   <link rel="stylesheet" type="text/css" href="estilos/style.css">
    <!-- para el jquery-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
	 <!-- para el materialize CSS-->
	 <link rel="stylesheet" type="text/css" href="materialize-v1.0.0/css/materialize.css"> 
	 <!-- para el materialize js Script-->
	 <script type="text/javascript" src="materialize-v1.0.0/js/materialize.min.js"></script>
	 <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
	 <!-- para el bootstrap/4 CSS-->
	  <script type="text/javascript" src="bootstrap-4.3.1/js/popper.min.js"></script>
	 <!-- para el bootstrap-4 js Script-->
	 <link rel="stylesheet" type="text/css" href="bootstrap-4.3.1/css/bootstrap.min.css"> 
	 <!-- para el popper js Script-->
	 <script type="text/javascript" src="bootstrap-4.3.1/js/bootstrap.min.js"></script>
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
	 
	 
	 <script type="text/javascript">
$(document).ready(function (){
	$('#btnRegistroPersonas').click(function(){
		
		var datos=$('#frmCuentasPersonas_ajax').serialize();
			$.ajax({
			type:"POST",
			url:"Personas_Crear_ope.php",
			data:datos,
			success:function(r){
				if(r==1){
					
					alertify.success("Cuenta creada...! Iniciar sesión");
					
				}else{
					if(r==2){
					alertify.error("El email esta registrado...! Intente con otro por favor");
                     $('#frmCuentasPersonas_ajax').trigger('reset');					
					}else{
						if(r==3){
					alertify.error("El correo ingresado no es valido");
                     $('#frmCuentasPersonas_ajax').trigger('reset');					
					}else{
						alertify.error("Error de servidor 404...!");
						$('#frmCuentasPersonas_ajax').trigger('reset');
					}
					}
					
				}
				
			}
		})
	
	});
});
</script>

  </head>
  
   
  <body class="DiseñoGeneral" background="Imagenes/competanciadigital.png">
  <br>

  	<center><div class="AdminLogin">
	
	
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////-->	
<!-- confirmacion de mensajes -->
	    <?php
		if(!empty($message)){
			
			?>
	
	<form  class="DiseñoResponsivoIndex btn-danger">
	<center>  <div class='btn-warning'>Advertencia...!</div></center>
	<div class='btn-danger'><?= $message; ?></div>
	</form>
	
	<?php
		}
		?>
	
	
	
	<!-- Este formulario es para poder logearse a la aplicacion--->
	<form  class="DiseñoResponsivoIndex" action="simulacion-nuevo.php" method="POST">
   <center><img class="pequeña" src="ImagenesProgramacion/Logo1.png"></center>
	<br>
	<b><h5 class=""><center>Iniciar sesión</center></h5></b>
	<br>
	<h6 class="TamañoTexto"><b><font color="#2696ff"> Email:*</font></b></h6>
    <input class="DiseñoBox" required name="email" type="text" placeholder="Ingrese su correo electrónico"><br>
	<h6><b><font color="#2696ff"> Contraseña:*</font></b></h6>
    <input  class="DiseñoBox" required name="password" type="password" placeholder="Ingrese su password"><br>
	
	<button class="DiseñoBtn btn-primary" id="IngresarSesion" type="submit">Ingresar</button>
	<br>
	<br>
	 <center><b><h6><a id="fondoMouse" href="RecuperarClave_frm.php"><font color="#2696ff">Olvidé mi contraseña</font></a></h6></b></center>
    </form>
	<center><div  class="IzquierdoIndexInterno">

	<!--
	<b><h6><font color="#2696ff">¿No tienes cuentas?</font></h6></b>
	<!--<button name="btnEnviarModal1" id="btnEnviarModal1" class="DiseñoBtnIndex btn-primary" data-toggle="modal" data-target="#modalRegistrarPersonas1">Crear cuenta</button>-->
	<!--
	<h6><a    class=" btn btn-outline-primary" href="Personas_Crear_Cuenta_frm.php">Crear cuenta</a><h6> 
    -->
   
	<form class="DiseñoResponsivoIndex"  action="Personas_Crear_Cuenta_frm.php" method="POST">
   <b><h6 class=""><font color="#2696ff">¿No tienes cuenta?</font></h6></b>
   <br>
    <button class="DiseñoBtn btn-primary" id="DiseñoMouse" type="submit">Crear cuenta</button>
  </form>
   <form class="DiseñoResponsivoIndex"  action="index.php" method="POST">
   <b><h6 class=""><font color="#2696ff">¿Desea regresar a la pantalla de inicio?</font></h6></b>
   <br>

    <button class="DiseñoBtn btn-primary" id="DiseñoMouse" type="submit">< Volver</button>
  </form>
 
	 </div></center>
	</div></center>

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de registrar personas-->

<!-- Modal -->
<div class="modal fade" id="modalRegistrarPersonas1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><font Color="#2696ff">Crear cuenta</font></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <center><img class="pequeña" src="ImagenesProgramacion/Logo1.png"></center>
 
		<form  name="frmCuentasPersonas_ajax" id="frmCuentasPersonas_ajax" method="POST">
		<h6 class="TamañoTexto"><b><font color="#2696ff"> Email:*</font></b></h6>
		
		<input Class="DiseñoBox" required name="email" id="email1" required type="text" placeholder="Ingrese su correo electrónico">
		<br>
		<h6><b><font color="#2696ff"> Contraseña:*</font></b></h6>
		<input Class="DiseñoBox" required name="password" id="password1" required type="password" placeholder="Ingrese su password">
      </div>
      <div class="modal-footer">
 <button type="submit" id="btnRegistroPersonas" name="btnRegistroPersonas" class="btn btn-primary" data-dismiss="modal">Registrar</button>
		</form>  	 
        </div>
    </div>
  </div>
</div>
  </body>
  </html>