<?php
	//Este codigo es para abrir la sesión de las páginas
	session_start();
  	//este codigo permite desencryptar la contraseña y verificar si esta en la base de datos
    require 'datos/db.php';
	$emailregistrado='';
	$user='';
	if (!empty($_POST['email']) && !empty($_POST['password'])) {
	   //este codig busca un email registrado dentro de la base de datos 
	$recordsBuscar = $conn->prepare('SELECT id, email, password FROM tb_personas WHERE email = :email');
    $recordsBuscar->bindParam(':email', $_POST['email']);
    $recordsBuscar->execute();
	$message = '';
	$buscaremail='';	  
	$resultsBuscar = $recordsBuscar->fetch(PDO::FETCH_ASSOC);
	$buscaremail=$resultsBuscar['email']; 
	if(!empty($buscaremail)){
	 $compara=($_POST['password']);
    //if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) {
			if (count($resultsBuscar) > 0 && ($compara==$resultsBuscar['password'])) {
			$_SESSION['user_email'] = $resultsBuscar['email'];
			$roliniciar = $conn->prepare('SELECT id, email, password FROM tb_personas WHERE email = :email');
			$roliniciar->bindParam(':email', $_POST['email']);
			$roliniciar->execute();
  			header ('Location: user/SimularInstrumentoPrincipal_frm.php');
			}else{
			$message = 'Lo sentimos, la clave ingresada no es la correcta';
			}		
	}else{
		$message = 'Lo sentimos, el email no está registrado, revise el email ingresado';
	}
  
  }
  
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Login Usuario</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/onts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="estilos/assets/css/util.css">
    <link rel="stylesheet" type="text/css" href="estilos/assets/css/main.css">

    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('estilos/assets/images/campus.png');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Login Usuario
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" action="log-user.php" method="POST">

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn" type="submit">
                            Ingresar
                        </button>
                    </div>
                </form> <br>
                <form class="login100-form validate-form p-b-33 p-t-5" action="index.php" method="POST">
                    <div class="container-login100-form-btn m-t-32">
                        <h4>Regresar al Menú Principal</h4> <br>

                        <button class="login100-form-btn" type="submit">
                            Regresar
                        </button>
                    </div>
            </div>
        </div>


        <div id="dropDownSelect1"></div>

        <!--===============================================================================================-->
        <script src="estilos/vendor/jquery/jquery-3.2.1.min.js"></script>
        <!--===============================================================================================-->
        <script src="estilos/vendor/animsition/js/animsition.min.js"></script>
        <!--===============================================================================================-->
        <script src="estilos/vendor/bootstrap/js/popper.js"></script>
        <script src="estilos/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!--===============================================================================================-->
        <script src="estilos/vendor/select2/select2.min.js"></script>
        <!--===============================================================================================-->
        <script src="estilos/vendor/daterangepicker/moment.min.js"></script>
        <script src="estilos/vendor/daterangepicker/daterangepicker.js"></script>
        <!--===============================================================================================-->
        <script src="estilos/vendor/countdowntime/countdowntime.js"></script>
        <!--===============================================================================================-->
        <script src="js/main.js"></script>
		

</body>

</html>