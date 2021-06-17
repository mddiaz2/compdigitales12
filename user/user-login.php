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
									header ('Location: bienvenida.php');
										//Esta codigo es para presentar una pantalla de bienvenida al usuario y presentar idnicaciones generales
									/* 
                  ?>
											<div class="overlay">
											<div class="popupPantallas">
										
											<form  action="SimularInstrumentoPrincipal_Frm.php" method="POST">
											<h4><center><div class='btn-primary'><b>Bienvenido</b></div></center></h4>
											<h6 class="textopopupPantallas">Estimado usuario <?= $RecibirEmail;?>, a continuacíon se presenta el <font color="green"> test de autoevaluación</font><br>
											<h6><center><b><font color="purple">Indicaciones</font></b></center></h6><hr>
											<h6 class="textopopupPantallas"> La información del test está dividida en dos partes:<br><br>
											 <b>1.-</b> En la parte derecha, el área y competencia en la que usted está evaluándose, y en la parte inferior 
                                             la información del avance progresivo de cada ítem y la pantalla que está desarrollando.<br><br>
											 <b>2.-</b> En la parte izquierda, está el ítem planteado para ser desarrollado con el simulador del dispositivo móvil, y
											 en la parte izquierda está la acción de <b>"NO SÉ CÓMO HACERLO"</b>, que permite avanzar al siguiente ítem a evaluar.
											 </h6> 											
											
											<hr>
											<center>
											<b><h6><a id="fondoMouse"   class="btn btn-outline-primary" href="index.php"><font color="#2696ff">Cancelar</font></a> <button name="btnBienvenida" class="btn btn-info"  id="DiseñoMouse" type="submit">Aceptar</button></h6></b></center>
											</center>
											</form>
											</div>
											</div>
										
										<?php
									*/
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
  //CAMBIAR CODIGO DE ARRIBA, PARA ENLAZARLO CON EL CODIGO QUE GUARDA LAS EVALUACIONES

 
  //INSERCION DE DATOS 
  if(isset($_POST['insertar'])){
    ///////////// Informacion enviada por el formulario /////////////
    $email=$_POST['email'];
    $password=$_POST['password'];
    ///////// Fin informacion enviada por el formulario /// 

    ////////////// Insertar a la tabla la informacion generada /////////
    $sql="insert into tb_personas(email, password) 
    values(:email,:password)";
        
    $sql = $conn->prepare($sql);
        
    $sql->bindParam(':email',$email,PDO::PARAM_STR, 25);
    $sql->bindParam(':password',$password,PDO::PARAM_STR, 25);

    $sql->execute();

    $lastInsertId =$conn->lastInsertId();
  if($lastInsertId>0){

        echo "<div class='content alert alert-primary' > Gracias .. Tu email es : $email  </div>";
        }
        else{
            echo "<div class='content alert alert-danger'> No se pueden agregar datos, comuníquese con el administrador  </div>";

        print_r($sql->errorInfo()); 
        }
      }
?>

<!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>UTPL | Competencias Digitales</title>
    <link rel="stylesheet" href="estilos/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="wrapper">
      <div class="title-text">
        <div class="title login">LOGIN</div>
        <div class="title signup">REGISTRAR</div>
      </div>
      <div class="form-container">
        <div class="slide-controls">
          <input type="radio" name="slide" id="login" checked>
          <input type="radio" name="slide" id="signup">
          <label for="login" class="slide login">Ingresar</label>
          <label for="signup" class="slide signup">Registrarte</label>
          <div class="slider-tab"></div>
        </div>
        <div class="form-inner">
          <form action="user-login.php" method="POST" class="login">
            <div class="field">
              <input type="text" placeholder="Correo" name="email" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Contraseña" name="password" required>
            </div>
            <div class="pass-link"><a href="#">Olvidaste la contraseña?</a></div>
            <div class="field btn">
              <div class="btn-layer"></div>
              <input type="submit" value="Ingresar">
            </div>
            <div class="signup-link">No estás registrado? <a href="">Registrar ahora</a></div>
          </form>
          <form action="user-login.php" method="POST" class="signup">
            <div class="field">
              <input type="text" placeholder="Correo" name="email" required>
            </div>
            <div class="field">
              <input type="password" placeholder="Contraseña" name="password" required>
            </div>
            
            <div class="field btn">

              <div class="btn-layer"></div>
              <input type="submit" value="Registrar" name="insertar">
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      const loginText = document.querySelector(".title-text .login");
      const loginForm = document.querySelector("form.login");
      const loginBtn = document.querySelector("label.login");
      const signupBtn = document.querySelector("label.signup");
      const signupLink = document.querySelector("form .signup-link a");
      signupBtn.onclick = (()=>{
        loginForm.style.marginLeft = "-50%";
        loginText.style.marginLeft = "-50%";
      });
      loginBtn.onclick = (()=>{
        loginForm.style.marginLeft = "0%";
        loginText.style.marginLeft = "0%";
      });
      signupLink.onclick = (()=>{
        signupBtn.click();
        return false;
      });
    </script>

  </body>
</html>
