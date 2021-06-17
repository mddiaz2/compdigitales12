
<!DOCTYPE html>
<html>
  <head>
     <meta charset="utf-8">
   <title>Competencias Digitales</title
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="Estilos/style.css">
<link rel="stylesheet"  href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 <!-- para el jquery-->
 <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
 
 <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> 
  </head>
  <body>


  <?php
  
$id_Items=$_REQUEST['id_Items'];
include ('database.php');
$records = $conn->prepare('SELECT id_Items, id_Cuestionario, Items FROM tb_items where id_Items=:$id_Items');
$records->execute();
$row=$records->fetch(PDO::FETCH_ASSOC);
?>
<br/><br/><br/>
    <form action="Items_Editar_ope.php" method="POST">
	<input name="id_Items" required type="text" placeholder="Ingrese el codigo del items" value="<?php echo $row['id_Items'];?>">
	<input name="id_Cuestionario" required type="text" placeholder="Ingrese el codigo de la pregunta" value="<?php echo $row['id_Cuestionario'];?>">
      
	  
	  
	  <br>
	<br>
	<label> Visualiza cuantos Items u Opciones de respuestas tienes para esta pregunta</label>
	<br>
	
	<select required name="ProbarItems">
	<?php
	$suma=0;
	include ('database.php');
	//Este codigo no hay es pporque se debe eliminar los items ojo
	//poner consulta exacta de quine corresponde
    //$records = $conn->prepare('SELECT id_Area, Area FROM tb_areas');
	//esta consulta trae en especifico la area a la que corresponde la competencia
	  $records = $conn->prepare("SELECT id_Items, id_Cuestionario, Items  FROM tb_items where id_Cuestionario='$CuestionarioPregunta'");
    $records->execute();
    while($buscarcompetencias=$records->fetch(PDO::FETCH_ASSOC)){
     $suma=$buscarcompetencias['Items'];
	
?>
	
	<option value="<?php echo $buscarcompetencias['Items'];?>"><?php echo $buscarcompetencias['Items'];?> </option>
	<?php
 }
	?>
	</select>
	
	
	<br>
	
	

	 <br>
	
	 <input type="text" name="Items" Value="<?php echo $suma+1;?>">
	
	<br>
	  
	  
	  
	  
      <input type="submit" value="Guardar">
    </form>
	
	
	
	
	
	
	
	
	
	
  </body>
</html>