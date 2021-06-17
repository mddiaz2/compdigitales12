<?php
//Este codigo es para abrir la sesión de las páginas
  session_start();

  ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Competencias Digitales</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">


  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,500,600,700,700i|Montserrat:300,400,500,600,700" rel="stylesheet">

  <!-- Bootstrap -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS Lib-->
  <link href="lib/font-awesome/assets/css/font-awesome.min.css" rel="stylesheet">
  
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
  <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

  <!-- Hoja de Estilos, CSS -->
  <link href="estilos/assets/css/style.css" rel="stylesheet">

  
</head>

<body>
  <!--========================== Header ============================-->
  <header id="header">

  

    <div class="container">

        <!-- logo-->
    <div id="logo">
        <img src="estilos/assets/images/institucional.png" class="app-logo" alt="Logotipo" />
    </div>
      <nav class="main-nav float-right d-none d-lg-block">
        <ul>
          <li class="active"><a href="#intro">Inicio</a></li>
          <li><a href="#compdig">Competencias Digitales</a></li>
          <li><a href="#perfildig">Perfil Digital</a></li>
          <li><a href="#areasev">Áreas Evaluadas</a></li>
          <li><a href="log-admin.php">Administrador</a></li>
        </ul>
      </nav><!-- .main-nav -->
      
    </div>
  </header><!-- fin del header -->

  <!--==========================
    Intro 
  ============================-->
  <section id="intro" class="clearfix">
    <div class="container d-flex h-100">
      <div class="row justify-content-center align-self-center">
        <div class="col-md-6 intro-info order-md-first order-last">
          <h2>Evaluación<br>de <span>Competencias Digitales</span></h2>
          <div>
            <a class="btn-get-started scrollto"  href="user/user-login.php">Comienza</a>
          </div>
        </div>
  
        <div class="col-md-6 intro-img order-md-last order-first">
          <img src="estilos/assets/images/intro-img.svg" alt="" class="img-fluid">
        </div>
      </div>

    </div>
  </section><!-- #intro -->

  <main id="main">

    <!--==========================LOGIN USER=====
    <div class="overlay" id="overlay">
			<div class="popup" id="popup">
				<a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup"><i class="fas fa-times"></i></a>
				<h3>Bienvenido</h3>
				<h4>Ingresa tu Usuario y Contraseña</h4>
				<form action="">
					<div class="contenedor-inputs">
						<input type="text" placeholder="Usuario" name="username">
						<input type="password" placeholder="Contraseña" name="password">
					</div>
					<input type="submit" class="btn-submit" value="Ingresar">
				</form>
      <div class="nuevouser">
        <h4>¿No tienes usuario?</h4>
        <input type="submit" class="btn-nuevous" value="Registrarme">
      </div>
			</div>
		</div>
=======================-->
    <!--==========================Competencias Digitales============================-->
    <section id="compdig">
      <div class="container">

        <header class="section-header">
          <h3>Competencias Digitales</h3>
        </header>
        <div class="contenedor-caja-video">
        <div class="caja-video">
        <iframe class="video" src="https://www.youtube.com/embed/MVtVJK_qbnI"></iframe>
        </div>
    </div>
      </div>
    </section><!-- fin compdig -->

    <!--==========================Perfil Digital============================-->
    <section id="perfildig">

      <div class="container">
        <div class="row">

          <div class="col-lg-5 col-md-6">
            <div class="perfildig-img">
              <img src="estilos/assets/images/img2.jpg" alt="">
            </div>
          </div>

          <div class="col-lg-7 col-md-6">
            <div class="perfildig-content">
              <h2>Perfil Digital</h2>
              <h3>Descripción del Test</h3>
              <p>El test de autoevaluación de competencias digitales, es una herramienta basada de manera rigurosa en el marco europeo de competencias digitales DigComp, que está diseñada para facilitar al usuario un autodiagnóstico de su nivel de competencia digital de comunicación y colaboración en dispositivos móviles, en contextos de aprendizaje, a través de simuladores.</p>
              <p>El test se compone de dos partes, la <b>primera</b> es de autodiagnóstico de las competencias digitales y la <b>segunda</b> de información de su contexto de movilidad.</p>
              <p>Para proceder a desarrollar la primera parte, se debe contestar cada ítem planteado, realizando las acciones que usted considere correctas en la pantalla simulada del dispositivo móvil. Si la acción es correcta se mostrarán las siguientes opciones en la pantalla, hasta aparecer la acción de <b>"SIGUIENTE"</b>, que permite otorgar una valoración de puntuación correcta y avanzar al siguiente ítem.</p>
              <p>Tenga en cuenta que, en caso de realizar acciones no solicitadas en el ítem, la valoración de puntuación marcará error, minimizando el nivel de habilidad del usuario, por ello, en caso de no saber que responder, la herramienta facilita una acción,<b>"NO SÉ CÓMO HACERLO"</b> que permitirá continuar al siguiente ítem.</p>
              <p>Como resultado de la realización de esta prueba de autodiagnóstico se presenta al final del test un informe personalizado, completo que proporciona una visión global y detallada del nivel de competencia digital alcanzado del usuario.</p>
            </div>
          </div>
        </div>
      </div>

    </section><!-- fin perfil digital -->


    <!--==========================Áreas a ser evaluadas============================-->
    <section id="areasev" class="section-bg">
      <div class="container">

        <header class="section-header">
          <h3>Áreas Evaluadas</h3>
          <p>A continuación, se describen las áreas a ser evaluadas en el test de competencias digitales.</p>
        </header>

        <div class="row">

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #fceef3;"><i class="ion-ios-analytics-outline" style="color: #ff689b;"></i></div>
              <h4 class="title"><a href="">Información y Alfabetización Digital</a></h4>
              <p class="description">Identificar, localizar, obtener, almacenar, organizar y analizar información digital, evaluando su finalidad y relevancia</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #fff0da;"><i class="ion-ios-people" style="color: #e98e06;"></i></div>
              <h4 class="title"><a href="">Comunicación y Colaboración </a></h4>
              <p class="description">Comunicarse en entornos digitales, compartir recursos por medio de herramientas en red,
                                    conectar con otros y colaborar mediante herramientas digitales</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #e6fdfc;"><i class="ion-ios-paper-outline" style="color: #3fcdc7;"></i></div>
              <h4 class="title"><a href="">Creación de contenidos digitales</a></h4>
              <p class="description">Crear y editar contenidos digitales nuevos, integrar y reelaborar conocimientos y contenidos
                previos, saber aplicar los derechos de propiedad intelectual y las licencias de uso</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.1s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #eafde7;"><i class="ion-ios-speedometer-outline" style="color:#41cf2e;"></i></div>
              <h4 class="title"><a href="">Seguridad</a></h4>
              <p class="description">Protección de información y datos personales, protección de la identidad digital, medidas de seguridad, uso responsable y seguro</p>
            </div>
          </div>

          <div class="col-md-6 col-lg-4 wow bounceInUp" data-wow-delay="0.2s" data-wow-duration="1.4s">
            <div class="box">
              <div class="icon" style="background: #e1eeff;"><i class="ion-ios-world-outline" style="color: #2282ff;"></i></div>
              <h4 class="title"><a href="">Resolución de problemas</a></h4>
              <p class="description">Identificar necesidades de uso de recursos digitales, tomar decisiones informadas sobre las
                                    herramientas digitales más apropiadas según el propósito o la necesidad</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- fin areas evaluadas-->

    <!--==========================Iniciar Test============================-->
    <section id="call-to-action" class="wow fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 text-center text-lg-left">
            <h3 class="cta-title">Iniciar Test de Competencias Digitales </h3>
            <p class="cta-text"> Pulsa Iniciar para comenzar el test de competencias digitales</p>
          </div>
          <div class="col-lg-3 cta-btn-container text-center">
            <a class="cta-btn align-middle">Iniciar</a>
          </div>
        </div>

      </div>
    </section><!-- #call-to-action -->
  </main>

  <!--==========================Footer============================-->
  <footer id="footer" class="section-bg">
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>CompDig</strong>. All Rights Reserved
      </div>
      <div class="credits">
      
        Desarrollado por <a href="">Competencias Digitales</a>
      </div>
    </div>
  </footer><!-- #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <!-- Uncomment below i you want to use a preloader -->
  <!-- <div id="preloader"></div> -->

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/mobile-nav/mobile-nav.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/isotope/isotope.pkgd.min.js"></script>
  <script src="lib/lightbox/js/lightbox.min.js"></script>


  <!-- javascript -->
  <script src="js/main.js"></script>

</body>
</html>
