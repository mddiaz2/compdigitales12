<html>
<head>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <title>Competencias Digitales</title>
   <!--Instalados de forma manual que fueron descargadas-->
    <!-- para los estilos css-->
       <meta charset="utf-8">
  
   <link rel="stylesheet" type="text/css" href="Estilos/style.css">
   
   
    <!-- para el jquery-->
    <script type="text/javascript" src="jquery/jquery-3.4.0.min.js"></script>
	
	
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
	
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
	 <script src="alertifyjs/alertify.js"></script>
	  <link rel="stylesheet" href="Iconos/fonts.css"> 
	     <!-- para el select2 css-->
	 <link rel="stylesheet" type="text/css" href="Select2/css/select2.css"> 
	 <!-- para el select2 js Script-->
	 <script type="text/javascript" src="Select2/js/select2.js"></script>
	 <!-- para el datatable css-->
	<link rel="stylesheet" type="text/css" href="Datatable/Tableboostrasp4/bootstrap.css"> 
	  <link rel="stylesheet" type="text/css" href="Datatable/Tableboostrasp4/dataTables.bootstrap4.min.css"> 
	   <script src="Datatable/Tableboostrasp4/jquery.dataTables.min.js"></script>
	  <script src="Datatable/Tableboostrasp4/dataTables.bootstrap4.min.js"></script>
	  <script src="Datatable/Botones/dataTables.buttons.min.js"></script>
	  <script src="Datatable/Botones/jszip.min.js"></script>
	  <script src="Datatable/Botones/pdfmake.min.js"></script>
	   <script src="Datatable/Botones/vfs_fonts.js"></script>
	    <script src="Datatable/Botones/buttons.html5.min.js"></script>

<Script type="text/javascript">
function habilitar(){
	var boton=document.getElementById('Boton1');
	boton.disabled=true;
}
</script>
<body>

<button id="Boton1">Accion</button>


<button onclick="habilitar()" id="Boton2">Accionactivar</button>




<!--Textareas con el tinyMCE-->
<br>
<script type="text/javascript">
tinymce.init({
    selector: "#textarea",
	plugins: "image code media lists charmap hr fullscreen link wordcount textcolor advlist fullscreen tabfocus autoresize",
	toolbar1: "bold italic strikethrough bullist numlist blockquoute hr alignleft aligncenter alignright link unlink code fullscreen media image",
	relative_urls:false,
	remove_script_host:false,
	menu_bar: true,
	file_picker_callback:elfinder_browser,
	convert_urls: false,
	browser_spellcheck:true,
	fix_list_elements:true,
	entity_encoding: "raw",
	keep_styles:false,
	preview_styles:"font-family font-size font-weight font-style text-decoration text-transform"
	
 });
 function elfinder_browser(callback, value, meta){
	 tinymce.activeEditor.windowManager.open({
		 file: "/CompetenciasDigitales/elfinder/elfinder.html",
		 title: "Elfinder Explore",
		 width: 900,
		 height: 450,
		 resizable:"yes"
	 },{
		 oninsert:function(file, elf ){
			var url, reg, info; 
			url=file.url;
			reg = /\/[^/]+?\/\.\.\//;
			while(url.match(reg)){
				url=url.replace(reg, '/');
			}
			info = file.name+ '('+  elf.formatSize(file.size)+')';
			
			if(meta.filetype =='file'){
				callback(url, {text: info, title: info});
				
			}
			if(meta.filetype == 'image'){
				callback(url, {alt: info});
				
			}
			if(meta.filetype == 'media'){
				callback(url);
				
			}
		 }
	 }
	 );
	 return false;
 }
</script>
<form method="post">
    <textarea id="textarea"></textarea>
</form>
<br>




<!--Este respaldo es de como poner un tinyMCE-- y Responsibe Filemanager-->
  
  <!--////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
  
  <!--Diseño del elFinder y Tiny MCE para poder respalda y descargar las imagenes subidas en el servidor-->
  <button class="btn btn-warning" data-toggle="modal" data-target="#modalNuevoTinyMCE"><b><font color="#fff"><span class="icon-exit span"></span>Respaldo de imágenes</font></b></button>
 
<!-- Modal para presentar la imagne de carga de Fondo -->
<div class="modal fade" id="modalNuevoTinyMCE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <!--<div class="modal-dialog modal-sm" role="document">-->
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Respaldo de imágenes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    
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
   
   external_filemanager_path:"/compdigitales/filemanager/",
   filemanager_title:"Responsive Filemanager" ,
   external_plugins: { "filemanager" : "/compdigitales/filemanager/plugin.min.js"}
 });
</script>
   <form action="modal_Imagenes_Crear_Tabla_frm.php" align="right" method="POST">
    <textarea id="textareaFondo" name="textareaFondo"></textarea>
	<br>
	<input type="submit" class="btn-primary" name="btnCargarPicker"  value="Cargar">
	  <!--<button type="submit"  name="btnCargarPicker" class="btn btn-primary" data-dismiss="modal">Cargar</button>-->
       
		</form>
      </div>
      <div class="modal-footer">
      
	
		  	 
        </div>
    </div>
  </div>
</div>

<?php
 if(isset($_POST['btnCargarPicker'])){
	// $RutaImagenPiker=$_POST['textareaFondo'];
	 $RutaImagen=$_POST['textareaFondo'];
	 $arrayRuta=explode('"', $RutaImagen,3);
	 $arrayRutaP1=$arrayRuta[0];
	 $arrayRutaP2=$arrayRuta[1];
	 $arrayRutaP3=$arrayRuta[2];
	 echo "El valor de la primera posicion es:", $arrayRutaP2;
 }
?>
<br>
<form  action="Imagenes_Crear_ope.php" method="POST">
    <!--<input type="text" name="RecibirRuta" value="<?php echo $RutaImagenPiker;?>">-->
	<input type="text" name="RecibirRuta" value="<?php echo $arrayRutaP2;?>">
		<button type="submit"  name="btnEnviarImagenFondo2">Pasar</button>
       
		</form>
 
  <br>














</body>
</head>
</html>