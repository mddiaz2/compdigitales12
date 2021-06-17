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
    <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
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
    <link rel="stylesheet" type="text/css" href="assets/css/estilos.css">





    
</head>

<body>

<!------------------------------------------INSERCION DE LOS SCRIPTS---------------------------------------------------->

<script type="text/javascript">
    $(document).ready(function (){
	    $('#btnGuardarItems').click(function(){
		
		var datos=$('#frmItemsRegistra_ajax').serialize();
		//alert("Se registro correctamente");
			$.ajax({
			type:"POST",
			url:"Items_Crear_ope.php",
			data:datos,
			success:function(r){
                console.log(r)
				if(r==1){
					
					alertify.success("Se registro correctamente");
					
				}else{
					alertify.error("Error de servidor 404...!");
				    }
				
			    }
		    })
		        alert('Se registro correctamente');
	    });
    });
</script>
<!--Este metodo permite Eliminar los items-->
<script type="text/javascript">
    $(document).ready(function (){
	    $('#btnEliminarItems').click(function(){
		
		var datos=$('#frmItemsEliminar_ajax').serialize();
		//alert("Se registro correctamente");
			$.ajax({
			type:"POST",
			url:"Items_Eliminar_ope.php",
			data:datos,
			success:function(r){
                console.log(r)
				if(r==1){
					
					alertify.success("Registro eliminado correctamente");
					
				}else{
					alertify.error("Error de servidor 404...!");
				    }
			
                }
	    	})
			alert('Registro eliminado correctamente');
	    });
    });
</script>
<!--Este metodo es para eliminar los items con confirmacion-->
<script type="text/javascript">
   function confirmarEliminacionItems(id_Items){
	   	   alertify.confirm('Eliminar datos', '¿Está seguro de eliminar el registro?',
	                    function(){EliminarRegistros(id_Items)},
						function(){alertify.error('Proceso cancelado')});
						
   }
</script>
<!-- Este metodo script permite  la eliminacion de los registros -->
<script type="text/javascript">
    function EliminarRegistros(id_Items){
		
	    var datosId="id_Items=" + id_Items;
			$.ajax({
			type:"POST",
			url:"Items_Eliminar_ope.php",
			data:datosId,
			success:function(r){
                console.log(r)
				if(r==1){
               
				alertify.success("Registro eliminado correctamente");	
				}else{
					alertify.error("Error de servidor 404...!");
				}
			}
		});
	
	}				
</script>
<!--Este metodo permite editar los items de la tabla-->
<?php
include('database.php');
    if(isset($_POST['btnEditarPantallas'])){
    $ItemsID=$_POST['id_Items'];
    $CuestionarioID=$_POST['id_Cuestionario'];
    $Items=$_POST['Pantalla'];

        if (!empty($_POST['id_Items']) && !empty($_POST['id_Cuestionario'])&& !empty($_POST['Pantalla']) ) {

        $records = $conn->prepare("UPDATE tb_items SET id_Cuestionario='$CuestionarioID', Items='$Items' WHERE id_Items='$ItemsID'");
        $records->execute();
  

        }
    }
?>
<?php
//Este metodo permite Eliminar los intes o pantallas de respuesta
include('database.php');
        if(isset($_POST['btnEliminarDatosItemsTabla'])){
        $id_Items=$_POST['id_Items'];
        $records = $conn->prepare("DELETE FROM tb_items WHERE id_Items='$id_Items'");
        $records->execute();
    }

?>
<?php
//Este metodo permite registar las retroalimentaciones que tiene cada pregunta 
include('database.php');
    if(isset($_POST['btnRegistrarIndicacion'])){
        if(!empty($_POST['Indicaciones'])){
    $NumeroRegistrar=$_POST['Numero'];
    $Indicaciones=$_POST['Indicaciones'];
    $records = $conn->prepare("INSERT INTO tb_retroalimentacion (Numero, Indicaciones) VALUES ('$NumeroRegistrar', '$Indicaciones')");
    $records->execute();
?>
    <script>
    alert ('Retroalimentación registrada correctamente');
    </script>
<?php
}else{
?>
    <script>
    alert ('Por favor el campo de retroalimentación está vacío');
    </script>
<?php	
        }
    }
?>
<?php
//Este metodo permite Editar las retroalimentaciones que tiene cada pregunta 
include('database.php');
    if(isset($_POST['btnActualizarRetroalimentacion'])){
        if(!empty($_POST['IndicacionesActualizar'])){
        $NumeroActualizar=$_POST['NumeroActualizar'];
        $IndicacionesActualizar=$_POST['IndicacionesActualizar'];
        $id_retroActualizar=$_POST['id_retroActualizar'];
        $records = $conn->prepare("UPDATE tb_retroalimentacion SET Numero='$NumeroActualizar', Indicaciones='$IndicacionesActualizar' WHERE id_retro='$id_retroActualizar'");
        $records->execute();
?>
    <script>
    alert ('Retroalimentación actualizada correctamente');
    </script>
<?php
}else{
?>
    <script>
    alert ('El campo de retroalimentación está vacío, revise por favor...!');
    </script>
<?php	
        }
    }
?>
<?php
//Este metodo permite Eliminar las retroalimentaciones que tiene cada pregunta 
include('database.php');
    if(isset($_POST['btnEliminarRetroalimentacion'])){

        $id_retroEliminar=$_POST['id_retroEliminar'];
        $records = $conn->prepare("DELETE FROM tb_retroalimentacion WHERE id_retro='$id_retroEliminar'");
        $records->execute();

    }
?>

<!--------------------------------------------FIN DE LOS SCRIPTS-------------------------------------------->
<!---Comienzo del cuerpo de la pagina---->
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
                                        <span class="input-group-prepend search-close"><i class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i class="ti-search input-group-text"></i></span>
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
                                    <span><?php if (!empty($userAdmin)) : ?>
                                            <?= $userAdmin['email']; ?>

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
                                    <img class="img-80 img-radius" src="assets/images/user.svg" alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details"><?php if (!empty($userAdmin)) : ?>
                                                <?= $userAdmin['email']; ?>

                                            <?php endif; ?><i class="fa fa-caret-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">

                                            <a href="logout.php"><i class="ti-layout-sidebar-left"></i>Salir</a>
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
                                                <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
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
                                            <img class="img-80 img-radius" src="assets/images/user.svg" alt="User-Profile-Image">
                                            <div class="user-details">
                                                <span id="more-details"><?php if (!empty($userAdmin)) : ?>
                                                        <?= $userAdmin['email']; ?>

                                                    <?php endif; ?><i class="fa fa-caret-down"></i></span>
                                            </div>
                                        </div>
                                        <div class="main-menu-content">
                                            <ul>
                                                <li class="more-details">

                                                    <a href="logout.php"><i class="ti-layout-sidebar-left"></i>Salir</a>
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
                                                        <span class="pcoded-micon"><i class="ti-layout-sidebar-left"></i><b>S</b></span>
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
                                                    <h5 class="m-b-10">Registrar Pantallas de Respuesta</h5>
                                                    <p class="m-b-0">A continuación, se presentan las personas registradas</p>
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

                                                    </div>
                                                </div>
                                                </br>
                                                <!-- Basic table card start -->

                                                <!--Codigo a cargar en la pagina---->
                                                <div id="Contenido_Items">
  
  
  
  <div class="Contenido_Items">
 
  <center><h5>Registrar pantallas de respuesta</h5></center>
    <form  class="DiseñoResponsivoItems btn-primary" method="POST">
	<?php
	
	include ('database.php');
	

	
	if(isset($_POST['btnPasarIdCuestionario1'])|| isset($_POST['btnRecargarDatosId'])||isset($_POST['btnEliminarDatosItems']) ||isset($_POST['btnModelo']) ||isset($_POST['btnError'])||isset($_POST['btnEditarPantallas']) ||isset($_POST['btnEliminarDatosItemsTabla'])||isset($_POST['btnRegistrarIndicacion'])||isset($_POST['btnActualizarRetroalimentacion'])||isset($_POST['btnEliminarRetroalimentacion'])||isset($_POST['btnPasarDatosEditar'])||isset($_POST['btnCancelarRetroEditar'])){ 
		$id_Cuestionario=0;;
		if(isset($_POST['btnPasarIdCuestionario1'])){
		$id_Cuestionario=$_POST['EnviarIdCuestionario1'];
	  	}
		if(isset($_POST['btnEliminarDatosItems'])){
		$id_Cuestionario=$_POST['Cuestionario'];	
		}
		if(isset($_POST['btnModelo'])){
		$id_Cuestionario=$_POST['CuestionarioComparar'];	
		}
		if(isset($_POST['btnError'])){
		$id_Cuestionario=$_POST['CuestionarioComparar'];	
		}
		if(isset($_POST['btnEditarPantallas'])){
			$id_Cuestionario=$_POST['id_Cuestionario'];
		}
			if(isset($_POST['btnRecargarDatosId'])){
		$id_Cuestionario=$_POST['CuestionarioRecargado'];	
		}
		if(isset($_POST['btnEliminarDatosItemsTabla'])){
		$id_Cuestionario=$_POST['Cuestionario'];	
		}
		if(isset($_POST['btnRegistrarIndicacion'])){
		$id_Cuestionario=$_POST['RetroaliemtacionId_Cuestionario'];	
		}
		if(isset($_POST['btnActualizarRetroalimentacion'])){
		$id_Cuestionario=$_POST['Id_CuestionarioRetroalimentar'];	
		}
		if(isset($_POST['btnEliminarRetroalimentacion'])){
		$id_Cuestionario=$_POST['Id_CuestionarioRetroalimentarEliminar'];	
		}
		if(isset($_POST['btnPasarDatosEditar'])){
		$id_Cuestionario=$_POST['IdCuestionarioAlEditar'];	
		}
		if(isset($_POST['btnCancelarRetroEditar'])){
		$id_Cuestionario=$_POST['Id_CuestionarioRetroalimentar'];	
		}
	
	//Este ide debe ser recargado tomado desde la base modal como lo isiste con el metod de modal_Imagenes_Crear_Tabla_frm el eliminar una magen
	$records = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel, ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$id_Cuestionario'");
	//$records = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$id_Cuestionario'");
	$records->execute();
	$row=$records->fetch(PDO::FETCH_ASSOC);
	//ojo si no sale debemos enviar solo la pregunta que quermos poner el items
    $row['id_Cuestionario'];
	$CuestionarioPregunta=$row['id_Cuestionario'];
	$TomarNumeroCuestionario=$row['Numero'];
    ?>
	<!--
	<input type="hidden"  name="id_Cuestionario" id="id_Cuestionario" required value="<?php //echo $row['id_Cuestionario'];?>">
	-->
	<br>
	<h3 class="DiseñoTexto">Pregunta a crear pantalla</h3>
    <div><?php echo $row['Numero'],". ", $row['Preguntas'];?></div>
	<hr>
	<!-- este metodo permite traer los intems de la base de datos y sumar uno mas en caso que se desee mas de uno-->
	
	
	<br>
	<h3 class="DiseñoTexto">Visualiza las pantallas que tiene la pregunta correspondiente</h3>
  
 
  
  
	<select class="DiseñoBox" name="PantallasSelect">
	<option value="">Seleccionar</option>
	<?php
	$compara=0;
	$suma=0;
	$Id_ItemsBD=0;
	include ('database.php');
	//poner consulta exacta de quine corresponde
    //$records = $conn->prepare('SELECT id_Area, Area FROM tb_areas');
	//esta consulta trae en especifico la area a la que corresponde la competencia
	$records = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$CuestionarioPregunta'");
    $records->execute();
    while($buscarItems=$records->fetch(PDO::FETCH_ASSOC)){
		$compara=$buscarItems['Items'];
     $suma=$buscarItems['Items'];
	$Id_ItemsBD=$buscarItems['id_Items'];
	
	  // $datos=$buscarItems['id_Items']."||".
        // $buscarItems['id_Cuestionario']."||".
		  //$buscarItems['Items'];
	
?>
	<option value="<?php echo $buscarItems['id_Items'];?>"> <?php echo "Pantalla:", $buscarItems['Items'];?> </option> 
	 <br>
	
	
	<?php
    }
	?>
	</select>
	<br>
	<br>
<h3 class="DiseñoTexto">Número de pantalla a crear:</h3>
<h3 class="DiseñoTexto"> <?php echo $suma+1;?></h3>

<hr>
 <div class="btn btn-warning" data-toggle="modal" data-target="#modalRegistrarItems">Agregar</div>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerPantallas" aria-controls="navbarTogglerPantallas" aria-expanded="false" aria-label="Toggle navigation"><img  width="70px" height="52px" src="ImagenesProgramacion/BotonEditar.png"></font></button>
<div class="btn btn-danger" data-toggle="modal" data-target="#modalEliminarItems">Borrar</div>

 

  <div class="collapse navbar-collapse" id="navbarTogglerPantallas">
  
   <table  class="table table-hover table-condensed table-bordered">
 <br>
 
 <thead>
 <tr>
   
   <td> <b>Pantallas</b></td> 

   <td><b>Editar </b></td>
     <td><b>Eliminar </b></td>
     </tr>
 </thead>
   <tbody>
   
     <?php
	 
include ('database.php');
   $recordsTabla = $conn->prepare("SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Cuestionario='$CuestionarioPregunta'");
       $recordsTabla->execute();
   while($rowTabla=$recordsTabla->fetch(PDO::FETCH_ASSOC)){
	   $rowTabla['id_Cuestionario'];
          $rowTabla['Items'];
   $datos=$rowTabla['id_Items']."||".
          $rowTabla['id_Cuestionario']."||".
		  $rowTabla['Items'];

?>
<tr>
<!--
<td> <?php echo $rowTabla['id_Items']; ?></td>
-->
<td> <?php echo $rowTabla['Items']; ?></td>
<!--
 <td>
 <button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevo"><img class="bateria" src="imagenes/contactos.png"></button>
 </td>
 -->
<td>
<div name="pasardatosPantallasEditar" id="pasardatosPantallasEditar" class="btn btn-warning" data-toggle="modal" data-target="#modalEdicionPantallasEdiatr" onclick="pasarDatosPantallas('<?php echo $datos;?>')"><img class="bateria" src="ImagenesProgramacion/EditarRegistros.png"></div>
</form>
</td>
<td>
<div class="btn btn-danger" data-toggle="modal" data-target="#modalEliminarItemsTabla" onclick="pasarDatosPantallasEliminar('<?php echo $datos;?>')"><img class="bateria" src="ImagenesProgramacion/EliminarRegistros.png"></div>
</td>
</tr>
<?php
}

?>
  </tbody>
   </table>
  
  
   </div>

   <!--//Fin del contenido de la tabla actualizar toolgoter-->
 

<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////-->



  <!--Fin del div del formulario-->
  </div>
  
  
  
  
  
  
 <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--
  	
	<!--Este div es para el formulario de retralimentacion-->
	 <div class="Contenido_Indicaciones">
	 <center><h5>Registrar Instrucciones</h5></center>
     <!---<div class="Contenido_Indicaciones1">--->
     
	    <form  class="DiseñoResponsivoItems btn-primary" method="POST">
	     <?php
	//$recordsRetroalimentacionIdCuestionario = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel, ValorVerdadero, ValorFalso, Numero FROM tb_cuestionario where id_Cuestionario='$id_Cuestionario'");
	//$recordsRetroalimentacionIdCuestionario->execute();
	//$rowRetroIdCue=$recordsRetroalimentacionIdCuestionario->fetch(PDO::FETCH_ASSOC);
	//$TomarNumeroCuestionarioNuevo=$rowRetroIdCue['Numero'];
	 ?>
	<br>
	<h3 class="DiseñoTexto">Pregunta a crear instrucciones</h3>
	<div id="textnu"><?php echo $row['Numero'],". ", $row['Preguntas'];?></div>
	 <hr>
	<!-- este metodo permite traer los intems de la base de datos y sumar uno mas en caso que se desee mas de uno-->
	

	<h3 class="DiseñoTexto">Visualiza las instrucciones pertenecientes a cada pregunta</h3>
  
 
	<select class="DiseñoBox" name="RetroalimentacionSelect">
	<option value="">Seleccionar</option>
	<?php
	$comparaIndicacion='';
	//$suma=0;
	//$Id_ItemsBD=0;
	include ('database.php');
	$recordsRetro = $conn->prepare("SELECT *  FROM tb_retroalimentacion where Numero='$TomarNumeroCuestionario'");
	  $recordsRetro->execute();
    while($buscarNumero=$recordsRetro->fetch(PDO::FETCH_ASSOC)){
		//esta variable permite tomar para que por lo menos una indicacion haya registrada por pregunta ojo
	$comparaIndicacion=$buscarNumero['Indicaciones'];
   	 	
?>
	<option value="<?php echo $buscarNumero['Numero'];?>"> <?php echo "Pregunta ",$buscarNumero['Numero'],": ", $buscarNumero['Indicaciones'];?> </option> 
	 <br>
	
	
	<?php
    }
	?>
	</select>
	<br>
	<br>
<h3 class="DiseñoTexto">Ingresa la instrucción a crear:*</h3>
<input class="DiseñoBox" type="hidden" name="RetroaliemtacionId_Cuestionario" value="<?php echo $CuestionarioPregunta;?>">
<input class="DiseñoBox" type="hidden" name="Numero" placeholder="Ingrese el numero del item" value="<?php echo $TomarNumeroCuestionario;?>" >
<textArea  class="form-control input-sm" type="Text" name="Indicaciones" placeholder="Ingrese la retroalimentación"></textArea>

<hr>
<button name="btnRegistrarIndicacion" class="btn btn-warning">Registrar</button>
 <!--<div class="btn btn-warning" data-toggle="modal" data-target="#modalRegistrarIndicaciones">Agregar</div>-->
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerIndicaciones" aria-controls="navbarTogglerIndicaciones" aria-expanded="false" aria-label="Toggle navigation"><img  width="70px" height="52px" src="ImagenesProgramacion/BotonEditar.png"></font></button>


 

  <div class="collapse navbar-collapse" id="navbarTogglerIndicaciones">
  
   <table  class="table table-hover table-condensed table-bordered">
 <br>
 
 <thead>
 <tr>
   
   <td> <b>N.</b></td> 
   <td> <b>Indicaciones</b></td> 
   <td colspan="2"><b>Acciones</b></td>
    
   <!--<td><b>Edit.</b></td>
     <td><b>Elim.</b></td>-->
     </tr>
 </thead>
   <tbody>
   
     <?php
	 
include ('database.php');
   $recordsTablaIndicaciones = $conn->prepare("SELECT * FROM tb_retroalimentacion where Numero='$TomarNumeroCuestionario'");
      $recordsTablaIndicaciones->execute();
   while($rowTablaInidicaciones=$recordsTablaIndicaciones->fetch(PDO::FETCH_ASSOC)){
	    $datosInidicaciones=$rowTablaInidicaciones['id_retro'];
         $rowTablaInidicaciones['Numero'];
		 $rowTablaInidicaciones['Indicaciones'];
   //$datosInidicaciones=$rowTablaInidicaciones['id_retro']."||".
     //     $rowTablaInidicaciones['Numero']."||".
		//  $rowTablaInidicaciones['Indicaciones'];

?>
<tr>
<!--
<td> <?php echo $rowTablaInidicaciones['id_retro']; ?></td>
-->
<td> <?php echo $rowTablaInidicaciones['Numero']; ?></td>
<td> <?php echo $rowTablaInidicaciones['Indicaciones']; ?></td>

<td>
</form>
<!--
<div name="pasardatosIndicacionesEditar" id="pasardatosIndicacionesEditar"  data-toggle="modal" data-target="#modalEdicionIndicaciones" onclick="pasarDatosIndicaciones('<?php echo $datosInidicaciones;?>')"><img class="bateria" src="ImagenesProgramacion/EditarRegistros.png"></div>
-->
<!--Este formulario es donde tomo el id retro a editar envio al formulario y en el formulario hago la consulta y lleno los campos y luego envio a editar-->
<form action="" method="POST">
<input type="hidden" name="IdCuestionarioAlEditar" id="IdCuestionarioAlEditar" value="<?php echo $row['id_Cuestionario'];?>">
<input type="hidden" name="EnviarId_retro" value="<?php  echo $rowTablaInidicaciones['id_retro'];?>">
<button class="btn-flat" name="btnPasarDatosEditar" id="btnPasarDatosEditar"><img class="bateria" src="ImagenesProgramacion/EditarRegistros.png"></div>
</form>
</td>
<td>
<div  data-toggle="modal" data-target="#modalEliminarIndicacionesTabla" onclick="pasarDatosIndicacionesEliminar('<?php echo $datosInidicaciones;?>')"><img class="bateria" src="ImagenesProgramacion/EliminarRegistros.png"></div>
</td>
</tr>
<?php
}

?>
  </tbody>
   </table>
  
  
   </div>
    </div>

   <!--//Fin del contenido de la tabla actualizar retroalimentacion -->
 

	
	</div>
	
 <!--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  	
	
  
  
  <br>
  <br>
  <div class="Contenido_Items_Accion">
  
  <!--columna para realizar las operaciones de ir a cuestionario y ir a cargar imaggenes-->
  <br>
   <center> <h4><b>¿Que deseas realizar?</b></h4>
   <hr>
  
  <div><b>Deseo agregar pantallas a nuevo ítem</b></div>
  </center>
  <hr>

 <!-- <form class="FormResponsivoItems btn-primary"  method="POST">-->
 
	
<center><b><a  href="cuestionario.php" ><font color="purple">Ir a cuestionario</font></a></b>
  
	
	<!--</form>-->

	<br>
	<br>
	<div> <b>Deseo cargar imágenes a las pantallas registradas</b></div>
	</center>
	 <hr>
	 
	 

	<!--Metedo para comparar si hay creadas pantallas de respuesta-->
	<?php
  if(isset($_POST['btnModelo'])){
  //if($compara>=1){
	  if($compara>=1 && !empty($comparaIndicacion) ){
	 
	  ?>
		<div class="overlay">
 <div class="popupPantallas">
	   <!--<form  class="FormResponsivoItems btn-primary" action="modal_Imagenes_Crear_Tabla_frm.php" method="POST">-->
	    <form   action="modal_Imagenes_Crear_Tabla_frm.php" method="POST">
	   <center>  <h5><div class='btn-warning'><b>Información</b></div></h5></center>
	  <h6>A continuación el formulario para cargar imágenes al simulador del dispositivo</h6>
	
    <button name="AgregarImagenes" class="DiseñoBtnContexto btn-primary"  id="DiseñoMouse" type="submit">Aceptar</button>
	</form>
		</div>
		</div>
		<?php
	
  }
  else{
	  ?>
	  		<div class="overlay">
 <div class="popupPantallas">
	  <form action="pantallas2.php" method="POST">
	 <!--<form class="FormResponsivoItems btn-primary" action="pantallas2.php" method="POST">-->
	
	<center>  <h5><div class='btn-warning'><b></font color="red">Advertencia...!</font></b></div></h5></center>
	  <h6 class="btn-danger">El ítem que desea cargar imágenes debe constar registrada al menos una pantalla o una retroalimentación de respuesta</h6>
	  <!--<div class='btn-danger'>La pregunta que deseas cargar imágenes no tiene Pantallas de respuestas Agregadas</div>-->
	  	<input type="hidden" name="CuestionarioComparar" id="CuestionarioComparar" value="<?php echo $row['id_Cuestionario'];?>">
	<center><button class="btn-danger " id="DiseñoMouse" name="btnError"><font color="#fff">Cerrar</font></button></center>
	</form>
	</div>
		</div>
	<?php
  }
  } else{
  ?>
  
	<form method="POST">
	<input type="hidden" name="CuestionarioComparar" id="CuestionarioComparar" value="<?php echo $row['id_Cuestionario'];?>">
	
	<center><button class="btn-flat " id="DiseñoMouse" name="btnModelo"><b><font color="purple">Ir a cargar imágenes</font></b></button></center>
		
		
		</form>
		<br>
	<?php
  }
  ?>
  

  <!--Fin del div contenedor Accion-->
  </div>
  
 
 	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
  <?php
  //hay que tomar en cuenta que esta llave es para que tome el ide cuastionario y nuevamente recarge la consulta por eso esta al final
	  //Fin del if or general
	}
	?>	
	
	
	
	
	
	

	

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de registros de datos de Items -->

<!-- Modal -->
<div class="modal fade" id="modalRegistrarItems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">¿Deseas crear la pantalla?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	 
    
	   <form  id="frmItemsRegistra_ajax" action="pantallas2.php" method="POST">
	<input type="hidden" name="id_Cuestionario" id="id_Cuestionario" value="<?php echo $row['id_Cuestionario'];?>">
	<input type="hidden" name="CuestionarioRecargado" id="CuestionarioRecargado" value="<?php echo $row['id_Cuestionario'];?>">
	<center>
	<h6> Pantalla número:</h6><label><?php echo $suma+1;?></label>
	</center>
<input type="hidden" name="Items" id="Items" value="<?php echo $suma+1;?>">
	
	<input type="hidden" name="id_Items" id="id_Items" value="<?php echo $Id_ItemsBD;?>">
	
       <center> <button name="btnRecargarDatosId" id="btnGuardarItems" class="btn btn-warning" type="submit">Aceptar</button> </center>
		</form>
      </div>
	  <!--
      <div class="modal-footer">
	  <button type="button"  class="btn btn-second" data-dismiss="modal">Cancelar</button>
      
       
      </div>
	  -->
    </div>
  </div>
</div>
<!--Fin proceso registro-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

  
	  	

<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de eliminar Items del ultimo al primero-->

<!-- Modal -->
<div class="modal fade" id="modalEliminarItems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">¿Deseas eliminar la pantalla?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 
	 
       <!--Formulario para eliminar imagen de fondo-->
	   <form  id="frmItemsEliminar_ajax" action="pantallas2.php" method="POST">

	<!--
		<input type="text" name="id_Cuestionario" value="<?php //echo $row['id_Items'];?>">
		-->
	<input type="hidden" name="Cuestionario" id="Cuestionario" value="<?php echo $row['id_Cuestionario'];?>">
	<center>
	<h6> Pantalla número:</h6><label><?php echo $suma;?></label>
	</center>
	<!--
<input type="text" name="Items" id="Items" value="<?php echo $suma;?>">
	<br>
	-->
<input type="hidden" name="id_Items" id="id_Items" value="<?php echo $Id_ItemsBD;?>">


	
       <center> <button name="btnEliminarDatosItems" class="btn btn-danger" id="btnEliminarItems" type="submit">Eliminar</button> </center>
		</form>
      </div>
	  <!--
      <div class="modal-footer">
	  <button type="button"  class="btn btn-second" data-dismiss="modal">Cancelar</button>
      
       
      </div>
	  -->
    </div>
  </div>
</div>
<!--Fin proceso eliminar pantallas-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--Este proceso es para eliminar datos pero de la tabla oculta-->

<!-- Este metodo script permite traer los datos al formulario para poder editar-->
<script type="text/javascript">
   function pasarDatosPantallasEliminar(datos){
	   Tomardatos=datos.split('||');
	   $('#id_ItemsActulizar').val(Tomardatos[0]);
	   $('#id_CuestionarioActualizar').val(Tomardatos[1]);
	   $('#PantallasItemsActualizar').val(Tomardatos[2]);
   }
	
</script>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de eliminar Items del ultimo al primero-->

<!-- Modal -->
<div class="modal fade" id="modalEliminarItemsTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">¿Deseas eliminar la pantalla?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 
	 
       <!--Formulario para eliminar imagen de fondo-->
	   <form   action="pantallas2.php" method="POST">

	<!--
		<input type="text" name="id_Cuestionario" value="<?php //echo $row['id_Items'];?>">
		-->
	<input type="hidden" name="Cuestionario" id="Cuestionario" value="<?php echo $row['id_Cuestionario'];?>">
	<center>
	<center><h6> Pantalla número:</h6></center>
	
	<br>
	<input  type="Text" disabled name="Pantallas" id="PantallasItemsActualizar" size="1">
	</center>
	<br>
<input type="hidden" name="id_Items" id="id_ItemsActulizar">


	
       <center> <button name="btnEliminarDatosItemsTabla" class="btn btn-danger" id="btnEliminarItems" type="submit">Eliminar</button> </center>
		</form>
      </div>
	  <!--
      <div class="modal-footer">
	  <button type="button"  class="btn btn-second" data-dismiss="modal">Cancelar</button>
      
       
      </div>
	  -->
    </div>
  </div>
</div>
<!--Fin proceso eliminar pantallas-->
<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->


<!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
































<!--<button name="pasardatosPantallas" id="pasardatosPantallas" class="btn btn-warning" data-toggle="modal" data-target="#modalEdicionPantallas" onclick="pasarDatosPantallas('<?php echo $datos;?>')"><img class="bateria" src="ImagenesProgramacion/EditarRegistros.png"></button>-->



 
 
 <!-- Este metodo script permite traer los datos al formulario para poder editar-->
<script type="text/javascript">
   function pasarDatosPantallas(datos){
	   Tomardatos=datos.split('||');
	   $('#id_ItemsActualizar').val(Tomardatos[0]);
	   $('#id_CuestionarioActualizar').val(Tomardatos[1]);
	   $('#PantallaActualizar').val(Tomardatos[2]);
   }
	
</script>
<!--Este metodo es para editar un registro-->

 

 
 
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de edicion de datos-->

<!-- Modal de edicion de los Items-->
<div class="modal fade" id="modalEdicionPantallasEdiatr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title btn-warning" id="exampleModalLongTitle">Editar pantalla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	
	 
       <!--Formulario para Editar nuevas areas-->
	   <form  action="pantallas2.php"  method="POST">
	
	
	<input class="form-control input-sm" name="id_Items" id="id_ItemsActualizar" type="hidden" placeholder="Ingrese el id_items a registrar" >
	
  <input class="form-control input-sm" type="hidden" name="id_Cuestionario" id="id_CuestionarioActualizar">

<center>	<h6>Número de pantalla:*</h6></center>
	<input class="form-control input-sm" name="Pantalla" id="PantallaActualizar" type="number" placeholder="Ingrese el número de pantalla a registrar" >
	
	<br>
	  <button type="submit" name="btnEditarPantallas" class="btn btn-warning">Actualizar</button>
       </form>
	 </div>
      <div class="modal-footer">
        <!--<button type="submit" id="btnEditarPantallas" name="btnEditarPantallas" class="btn btn-warning" data-dismiss="modal">Actualizar</button>-->
     
      </div>
    </div>
  </div>
</div>



<br>
<br>
<div id="Pantalla_Listar_Tablas_frm">

</div>





<!-- Este metodo script permite interactuar con el usuario la confirmacion si o no de eliminar un registro -->
<script type="text/javascript">
   function confirmarEliminacionRegistros(id_Items){
	   alertify.confirm('Eliminar Datos', '¿Esta seguro de eliminar el registro?',
	                    function(){EliminarRegistros(id_Items)}
						,function(){alertify.error('Proceso cancelado')});
   }
	
</script>

<!-- Este metodo script permite  la eliminacion de los registros -->
<script type="text/javascript">
function EliminarRegistros(id_Items){
	
		var datosId="id_Items=" + id_Items;
		$.ajax({
			type:"POST",
			url:"Items_Eliminar_ope.php",
			data:datosId,
			success:function(r){
				if(r==1){
					//$('#Areas_Listar_Tablas_frm').load('modal_Areas_Listar_Tabla_frm.php');	
					alertify.success("Registro Eliminado correctamente");
										
				}else{
					alertify.error("Error de servidor 404...!");
				}
			}
		});//.done(function (info){
			//modtar mensaje del servidor
		
		     
			
			
		//});
		//Esta linea permite que no se refrezce la pagina por cuanto para algunas cosas si va pero en este caso no
		//return false;
	}

</script>







<!--///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->

  <?php 
	  //Codigo pra hacer la consulta por el id a editar y con esta consulta cargar en las cajas de exto a editar.
	  if(isset($_POST['btnPasarDatosEditar'])){
		  $RecibirId_retro=$_POST['EnviarId_retro'];
		  include ('database.php');
			$recordsRetroalimentaciones = $conn->prepare("SELECT * FROM tb_retroalimentacion where id_retro='$RecibirId_retro'");
			$recordsRetroalimentaciones->execute();
			while($rowRetroalimentacion=$recordsRetroalimentaciones->fetch(PDO::FETCH_ASSOC)){
	 
	  ?>
			 <div class="overlay">
			<div class="popupPantallas">
			   <!--Formulario para Editar nuevas areas-->
			   <form  action="pantallas2.php"  method="POST">
			  <h6 class="btn-warning"> Editar retroalimentación</h6>
			  <br>
			<input class="form-control input-sm" name="id_retroActualizar"  type="hidden" placeholder="Ingrese el id_retro a registrar" value="<?php echo $rowRetroalimentacion['id_retro']; ?>" >
			<input class="form-control input-sm" name="NumeroActualizar" type="hidden" placeholder="Ingrese el número a registrar" value="<?php echo $rowRetroalimentacion['Numero']; ?>">
			<input class="form-control input-sm" type="hidden" name="Id_CuestionarioRetroalimentar" value="<?php echo $CuestionarioPregunta;?>">
			<center>	<h6>Retroalimentación a editar:*</h6></center>
			<textArea class="form-control input-sm" name="IndicacionesActualizar" type="text" placeholder="Ingrese la retroalimentación a editar"><?php echo $rowRetroalimentacion['Indicaciones']; ?></textArea>
				<br>
				<center><button  class="btn btn-outline-primary" name="btnCancelarRetroEditar"><font color="#2696ff">Cancelar</font></button> <button type="submit" name="btnActualizarRetroalimentacion" class="btn btn-warning">Actualizar</button></center>
				 <!--<b><h6><a id="fondoMouse"   class="btn btn-outline-primary" href="pantallas2.php"><font color="#2696ff">Cancelar</font></a>-->
			   </form>
			   </div>
		   </div>
	   	<?php
	  }
	  }
	?>
   







 

 
 
 
 <!-- Este metodo script permite traer los datos al formulario de retroalimentacion para poder editar las indicaciones-->
<script type="text/javascript">
   function pasarDatosIndicaciones(datos){
	   Tomardatos=datos.split('||');
	   $('#id_retroActualizar').val(Tomardatos[0]);
	   $('#NumeroActualizar').val(Tomardatos[1]);
	   $('#IndicacionesActualizar').val(Tomardatos[2]);
   }
	
</script>
<!--Este metodo es para editar un registro de retroaliemntacion -->

 

 
 
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de edicion de datos de retroaliemntacion-->

<!-- Modal de edicion de los indicaciones-->
<div class="modal fade" id="modalEdicionIndicaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title btn-warning" id="exampleModalLongTitle">Editar retroalimentación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	    <?php 
	  //Codigo pra hacer la consulta por el id a editar y con esta consulta cargar en las cajas de exto a editar.
	  if(isset($_POST['btnPasarDatosEditar'])){
		  $RecibirId_retro=$_POST['EnviarId_retro'];
		  include ('database.php');
			$recordsRetroalimentaciones = $conn->prepare("SELECT * FROM tb_retroalimentacion where id_retro='$RecibirId_retro'");
			$recordsRetroalimentaciones->execute();
			while($rowRetroalimentacion=$recordsRetroalimentaciones->fetch(PDO::FETCH_ASSOC)){
	 
	  ?>
	 
       <!--Formulario para Editar nuevas areas-->
	   <form  action="pantallas2.php"  method="POST">
	
	
	<!--<input class="form-control input-sm" name="id_retroActualizar" id="id_retroActualizar" type="hidden" placeholder="Ingrese el id_retro a registrar" >-->
  	
	<input class="form-control input-sm" name="id_retroActualizar"  type="text" placeholder="Ingrese el id_retro a registrar" value="<?php echo $rowRetroalimentacion['id_retro']; ?>" >
  	
	<!--<input class="form-control input-sm" name="NumeroActualizar" id="NumeroActualizar" type="hidden" placeholder="Ingrese el id_retro a registrar" >-->
  <input class="form-control input-sm" name="NumeroActualizar" type="text" placeholder="Ingrese elnumero a registrar" value="<?php echo $rowRetroalimentacion['Numero']; ?>">
  <input class="form-control input-sm" type="hidden" name="Id_CuestionarioRetroalimentar" value="<?php echo $CuestionarioPregunta;?>">

<center>	<h6>Retroalimentación a editar:*</h6></center>
	<!--<textArea class="form-control input-sm" name="IndicacionesActualizar" id="IndicacionesActualizar" type="text" placeholder="Ingrese la retroalimentación a editar" ></textArea>-->
	<textArea class="form-control input-sm" name="IndicacionesActualizar" type="text" placeholder="Ingrese la retroalimentación a editar" value="<?php echo $rowRetroalimentacion['Indicaciones']; ?>" ></textArea>
		
		<br>
	
	  <button type="submit" name="btnActualizarRetroalimentacion" class="btn btn-warning">Actualizar</button>
       </form>
	   	<?php
	  }
	  }
	?>
	 </div>
      <div class="modal-footer">
        <!--<button type="submit" id="btnEditarPantallas" name="btnEditarPantallas" class="btn btn-warning" data-dismiss="modal">Actualizar</button>-->
     
      </div>
    </div>
  </div>
</div>



<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->





<!--Este proceso es para eliminar las retroaliemntaciones que estan ocultas-->

<!-- Este metodo script permite traer los datos al formulario para eliminar las retroalimentaciones-->
<script type="text/javascript">
   function pasarDatosIndicacionesEliminar(datos){
	   $('#id_retroEliminar').val(datos);
	   //Tomardatos=datos.split('||');
	   //$('#id_retroEliminar').val(Tomardatos[0]);
	   //$('#NumeroEliminar').val(Tomardatos[1]);
	   //$('#InidicacionesEliminar').val(Tomardatos[2]);
   }
	
</script>
<!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
<!--Modal Para el boton de eliminar las retroaliemntaciones-->

<!-- Modal -->
<div class="modal fade" id="modalEliminarIndicacionesTabla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLongTitle">¿Deseas eliminar la retroalimentación?</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	 
	   <form   action="pantallas2.php" method="POST">

		<input class="form-control input-sm" name="id_retroEliminar" id="id_retroEliminar" type="hidden" placeholder="Ingrese el id_retro a registrar" >
  		  <input class="form-control input-sm" type="hidden" name="Id_CuestionarioRetroalimentarEliminar" value="<?php echo $CuestionarioPregunta;?>">

	
       <center> <button name="btnEliminarRetroalimentacion" class="btn btn-danger" id="btnEliminarRetroalimentacion" type="submit">Eliminar</button> </center>
		</form>
      </div>
	  <!--
      <div class="modal-footer">
	  <button type="button"  class="btn btn-second" data-dismiss="modal">Cancelar</button>
      
       
      </div>
	  -->
    </div>
  </div>
</div>
                                                
                                          




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

            <?php require_once "modal.php" ?>
            <?php require_once "Items_Crear_ope.php" ?>
            <?php require_once "Items_Eliminar_ope.php" ?>



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


</body>

</html>