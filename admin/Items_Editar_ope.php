<?php
//Este codigo no hay es pporque se debe eliminar los items ojo
include('database.php');

$id_Items=$_POST['id_Items'];
$Id_Cuestionario=$_POST['id_Cuestionario'];
$Items=$_POST['Pantalla'];
if (!empty($_POST['id_Items']) && !empty($_POST['id_Cuestionario'])&& !empty($_POST['Pantalla']) ) {
$records = $conn->prepare("UPDATE tb_items SET id_Cuestionario='$Id_Cuestionario', Items='$Items' WHERE id_Items='$id_Items'");
echo $records->execute();


}
?>
 
  <script type="text/javascript">
$(document).ready(function (){
	$('#btnEditarPantallas').click(function(){
		var datos=$('#frmItemsEditar_ajax').serialize();
		
		$.ajax({
			type:"POST",
			url:"Items_Crear_frm.php",
			data:datos,
			success:function(r){
				if(r==1){
					//$('#Areas_Listar_Tablas_frm').load('modal_Areas_Listar_Tabla_frm.php');	
					alertify.success("Registro actualizado correctamente");
					
			}else{
					alertify.error("Error de servidor 404...!");
				}
		
			}
			
		})
	});
});
</script>













	
<!--Este metodo permite editar los items de la tabla-->
<?php
 include('database.php');
if(isset($_POST['btnEditarPantallas'])){
$id_Items=$_POST['id_Items'];
$Id_Cuestionario=$_POST['id_Cuestionario'];
$Items=$_POST['Pantalla'];

if (!empty($_POST['id_Items']) && !empty($_POST['id_Cuestionario'])&& !empty($_POST['Pantalla']) ) {

$records = $conn->prepare("UPDATE tb_items SET id_Cuestionario='$Id_Cuestionario', Items='$Items' WHERE id_Items='$id_Items'");
 $records->execute();


}
}
 ?>















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
        <h5 class="modal-title btn-warning" id="exampleModalLongTitle">Editar Pantalla</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
	  
	 
       <!--Formulario para Editar nuevas areas-->
	   <form  action="Items_Crear_frm.php"  method="POST">
	
	<br>
	
	Id Items
	<input class="form-control input-sm" name="id_Items" id="id_ItemsActualizar" type="text" placeholder="Ingrese el id_items a registrar" >
     <br>
	 id Cuestionario
  <input type="text" name="id_Cuestionario" id="id_CuestionarioActualizar">
	<br>
	<h6>Número de Pantalla:*</h6>
	<input class="form-control input-sm" name="Pantalla" id="PantallaActualizar" type="text" placeholder="Ingrese el número de pantalla a registrar" >
	<br>
	
	<br>
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








