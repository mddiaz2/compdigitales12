<?php
//este codigo es para iniciar sesion 
  session_start();
  unset($_SESSION['consultaUsuarios']);
  require '../datos/db.php';
  if (isset($_SESSION['user_email'])) {
    $records = $conn->prepare('SELECT * FROM tb_usuarios WHERE email = :email');
    $records->bindParam(':email', $_SESSION['user_email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $userAdmin = null;
    if (count($results) > 0) {
      $userAdmin = $results;
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>Panel de Administración</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
    <meta name="author" content="Codedthemes" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- themify icon -->
    <link rel="stylesheet" type="text/css" href="assets/icon/themify-icons/themify-icons.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome-n.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <!-- scrollbar.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/jquery.mCustomScrollbar.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>

<body>

    
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i
                                                class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i
                                                class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="admin2.php">
                            <img class="img-fluid" src="assets/images/logo.jpg" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>

                        </ul>
                        <ul class="nav-right">

                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="assets/images/user.svg" class="img-radius" alt="User-Profile-Image">
                                    <span><?php if(!empty($userAdmin)): ?>
                                        <?=$userAdmin['email']; ?>

                                        <?php endif; ?></span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">

                                    <li class="waves-effect waves-light">
                                        <a href="logout.php">
                                            <i class="ti-layout-sidebar-left"></i> Salir
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="assets/images/user.svg"
                                        alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php if(!empty($userAdmin)): ?>
                                            <?=$userAdmin['email']; ?>

                                            <?php endif; ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">

                                            <a href="logout.php"><i
                                                    class="ti-layout-sidebar-left"></i>Salir</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pcoded-navigation-label">Menú de Navegación</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="admin2.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Inicio</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Usuarios</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="personas.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Lista de Usuarios</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Personas</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="personas.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Lista de Personas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Competencias</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-mobile"></i><b>A</b></span>
                                        <span class="pcoded-mtext">Competencias Digitales</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="areas.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Areas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="niveles.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Niveles</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="competencias.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i
                                                        class="ti-layout-sidebar-left"></i><b>S</b></span>
                                                <span class="pcoded-mtext">Competencias</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Cuestionarios</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="cuestionario.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-menu-alt"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Cuestionario</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Reportes</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="reporte.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-bar-chart"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Reporte</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            

                            
                        </div>
                    </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="assets/images/user.svg"
                                        alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php if(!empty($userAdmin)): ?>
                                            <?=$userAdmin['email']; ?>

                                            <?php endif; ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">

                                            <a href="logout.php"><i
                                                    class="ti-layout-sidebar-left"></i>Salir</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="pcoded-navigation-label">Menú de Navegación</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="active">
                                    <a href="admin2.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext">Inicio</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Usuarios</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu">
                                    <a href="admin2.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-user"></i></span>
                                        <span class="pcoded-mtext">Lista de Usuarios</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>

                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Personas</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="personas.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-id-badge"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Lista de Personas</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Competencias</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="pcoded-hasmenu ">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-mobile"></i><b>A</b></span>
                                        <span class="pcoded-mtext">Competencias Digitales</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class="">
                                            <a href="areas.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Areas</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="niveles.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Niveles</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="competencias.php" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i
                                                        class="ti-layout-sidebar-left"></i><b>S</b></span>
                                                <span class="pcoded-mtext">Competencias</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Cuestionarios</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="cuestionario.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-menu-alt"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Cuestionario</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">Reportes</div>
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="">
                                    <a href="reporte.php" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti-bar-chart"></i><b>FC</b></span>
                                        <span class="pcoded-mtext">Reporte</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            

                            
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="page-header-title">
                                            <h5 class="m-b-10">Listado de Areas</h5>
                                            <p class="m-b-0">A continuación, se presentan los niveles registrados</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <ul class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="index.html"> <i class="fa fa-home"></i> </a>
                                            </li>
                                            <li class="breadcrumb-item"><a href="#!">Administración</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pcoded-inner-content">
                            <!-- Main-body start -->
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                    <div class="row">
                                    <div class="col-sm-12">
								<span class="btn btn-primary" data-toggle="modal" data-target="#insertarModalC">
									<i class="fas fa-plus-circle"></i> Nueva Competencia
								</span>
							</div>
						</div> 
                                        </br>
                                        <!-- Basic table card start -->

                                    <!--Insercion de la tablaDatos cargada en la funcion mostrar---->
                                       
									<div id="tablaDatosC"></div>
                                        

                                    </div>
                                    <!-- Page-body end -->
                                </div>
                            </div>
                            <!-- Main-body end -->

                            <div id="styleSelector">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once "modalInsertC.php" ?>
  
	<?php require_once "modalUpdateC.php" ?>
    <?php require_once "crud/Conexion.php" ?>


    <!-- Required Jquery -->
    <script type="text/javascript" src="assets/js/jquery/jquery.min.js "></script>
    <script type="text/javascript" src="assets/js/jquery-ui/jquery-ui.min.js "></script>
    <script type="text/javascript" src="assets/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap/js/bootstrap.min.js "></script>
    <!-- waves js -->
    <script src="assets/pages/waves/js/waves.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="assets/js/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- slimscroll js -->
    <script src="assets/js/jquery.mCustomScrollbar.concat.min.js "></script>

    <!-- menu js -->
    <script src="assets/js/pcoded.min.js"></script>
    <script src="assets/js/vertical/vertical-layout.min.js "></script>

    <script type="text/javascript" src="assets/js/script.js "></script>
    

	
	<script src="assets/librerias/sweetalert.min.js"></script>
	<script src="js/crudC.js"></script>

    <script type="text/javascript">
		mostrarc();
	</script>
</body>

</html>
