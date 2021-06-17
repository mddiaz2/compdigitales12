<?php
 //include('database.php');
 // require 'database.php';
  //$message = '';
 //$id_Items=$_REQUEST['id_Items'];
//$NombreImagenes=$_FILES['imagen']['name'];
//$archivo=$_FILES['imagen']['tmp_name'];
//$ruta="Imagenes";
//$ruta=$ruta."/".$NombreImagenes;
//move_uploaded_file($archivo,$ruta);
//$Cuestion=$_REQUEST['Cuestion'];

  //  $sql = "INSERT INTO tb_imagenes (id_Items, Imagenes, Cuestion) VALUES ('$id_Items', '$ruta', '$Cuestion')";
    //$stmt = $conn->prepare($sql);
    //$stmt->bindParam(':id_Items', $_POST['id_Items']);
	  // $stmt->bindParam(':ruta', $_POST['ruta']);
	    //$stmt->bindParam(':Cuestion', $_POST['Cuestion']);
    //if ($stmt->execute()) {
	//header ('Location: Items_Listar_frm.php');
	//header ('Location: Imagenes_Crear_Tabla_frm.php');
	//header ('Location: modal_Imagenes_Crear_Tabla_frm.php');
	//echo "Haz agregado un nueva imagen";
   
    //} else {
   //echo "hola no se pudo guardar la imagen";

	//}
	
?>


<?php
	//este codigo permite registrar las imagenes dentro de la base de datos 
 //include('database.php');
 // if(isset($_POST['btnCargarImagen'])){
	//$id_Items=$_REQUEST['id_Items'];
	//$NombreImagenes=$_FILES['imagen']['name'];
	//$archivo=$_FILES['imagen']['tmp_name'];
	//$ruta="Imagenes";
	//$ruta=$ruta."/".$NombreImagenes;
	//move_uploaded_file($archivo,$ruta);
	//$Cuestion=$_REQUEST['Cuestion'];
    //$sql = "INSERT INTO tb_imagenes (id_Items, Imagenes, Cuestion) VALUES ('$id_Items', '$ruta', '$Cuestion')";
   // $stmt = $conn->prepare($sql);
   // $stmt->bindParam(':id_Items', $_POST['id_Items']);
	 //  $stmt->bindParam(':ruta', $_POST['ruta']);
	  //  $stmt->bindParam(':Cuestion', $_POST['Cuestion']);
    //if ($stmt->execute()) {
	
   // } else {
   
	//}
  //}
  
	
?>


<!--
	<script type="text/javascript">
tinymce.init({
     selector: "#textareaFondo",theme: "modern",width: 460,height: 200,
	//selector: "#textarea",theme: "modern",width: 270,height: 60,
	//selector: "#textarea",theme: "modern",width: 680,height: 300,

    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
   ],
   toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",
   toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",
   image_advtab: true ,
   
   external_filemanager_path:"/CompetenciasDigitales/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/CompetenciasDigitales/filemanager/plugin.min.js"}
 });
</script>
        
<br>
<form  action="Imagenes_Crear_ope.php" method="POST">
    <textarea id="textareaFondo" name="textareaFondo"></textarea>
	
		<button type="submit"  name="btnEnviarImagenFondo2">Pasar</button>
       
		</form>
 
  <br>
  -->
  
  <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  





<?php
 include('database.php');
 if(isset($_POST['btnEnviarImagenFondo2'])){
	 $RutaImagen=$_POST['textareaFondo'];
	 $arrayRuta=explode('"', $RutaImagen,3);
	 $arrayRutaP1=$arrayRuta[0];
	 $arrayRutaP2=$arrayRuta[1];
	 $arrayRutaP3=$arrayRuta[2];
	 echo "El valor de la primera posicion es:", $arrayRutaP2;
	 
 }



?>
