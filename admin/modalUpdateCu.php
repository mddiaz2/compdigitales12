
<style>

input.DiseñoBox{
	width: 100%;
	margin-bottom: 20px;
	text-align: center;
	padding: 7px;
	box-sizing: border-box;
	margin:0;
	font-size: 17px;
  
}
select.DiseñoBox{
	width: 100%;
	margin-bottom: 20px;
	text-align: center;
	padding: 7px;
	box-sizing: border-box;
	margin:0;
	font-size: 17px;	
}

</style>

<!-- Este metodo script permite traer los el numero de la prgunta actulizada-->
<script type="text/javascript">
   function pasarNumeroPregunta(datosNumero){
	    Tomardatos=datosNumero;
		$('#PasarPreguntaNumero').val(Tomardatos);
		$('#MostraPregunta').val(Tomardatos);
		
	     }
		 
</script>
<!-- Modal -->
<div class="modal fade" id="actualizarModalCu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Cuestionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form id="frminsertuCu" onsubmit="return actualizarDatosCu()" method="post">
            <input type="text" id="id_Cuestionario" name="id_Cuestionario" hidden="">
                   
                    <label>Seleccione el Área</label> <br>
                    <select class="DiseñoBox"  name="id_Areasu" id="id_Areasu">
                        <option value="">Seleccionar</option>
                        <?php
                              include ('../datos/db.php');
                                $records = $conn->prepare('SELECT id_area, area FROM tb_area');
                                $records->execute();
                                while($row=$records->fetch(PDO::FETCH_ASSOC)){

                            ?>

                        <option value="<?php echo $row['id_area'];?>"><?php echo $row['area'];?> </option>
                        <?php
                                }
                        ?>
                        <br>
                        </select>
                        <br>
                            <label>Seleccionar competencia: (Área -> Competencia)</label> <br>
                    <select class="DiseñoBox"  name="id_Competenciasu" id="id_Competenciasu">
                        <option value="">Seleccionar</option>
                        <?php
                                include ('../datos/db.php');
                                //$records = $conn->prepare('SELECT id_Competencias, id_Area, Competencias FROM tb_competencias');
                                $records = $conn->prepare('SELECT tb_competencias.id, tb_competencias.id_area, tb_competencias.competencia, tb_area.area FROM tb_competencias inner join tb_area on tb_competencias.id_area=tb_area.id_area');
                                                                                                                                                        
                                $records->execute();
                                while($rowCompetencias=$records->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $rowCompetencias['id'];?>"><?php echo $rowCompetencias['area'], "-> ",$rowCompetencias['competencia'];?> </option>
                                <?php
                                }
	                        ?>
                        <br>
                    </select>
                    <br>
                    <label>Seleccionar Nivel General</label> <br>
                    <select class="DiseñoBox"  name="id_Nivelesu" id="id_Nivelesu">
                        <option value="">Seleccionar</option>
                        <?php
                            include ('../datos/db.php');
                            $recordsNiveles = $conn->prepare('SELECT id_Niveles, Basico, Medio, Avanzado FROM tb_niveles');
                            $recordsNiveles->execute();
                            while($rowNiveles=$recordsNiveles->fetch(PDO::FETCH_ASSOC)){
                        ?>
                            <option value="<?php echo $rowNiveles['id_Niveles'];?>"><?php echo $rowNiveles['Basico'], " ", $rowNiveles['Medio'], " ",$rowNiveles['Avanzado'];?> </option>

                         <?php
                            }
                         ?>
                        <br>
                    </select>
                    <br>
                    <?php
	//Este codigo permite traer el numero de pregunta para poder incrementar sin necesidad del usaurio
	include ('../datos/db.php');
    $CuestionarioNumeroPregunta=0;
    $records = $conn->prepare("SELECT id_Cuestionario, id_Areas, id_Competencias, id_Niveles, Preguntas, Nivel,ValorVerdadero, ValorFalso,Numero FROM tb_cuestionario");
    $records->execute();
	while( $row=$records->fetch(PDO::FETCH_ASSOC)){
	//ojo si no sale debemos enviar solo la pregunta que quermos poner el items
    $row['Numero'];
	$CuestionarioNumeroPregunta=$row['Numero'];
	}
	//este es solo para ver si me trae la ultima pregunta
	
	?>
     <label>Numero de Pregunta a Crear:</label>
     <input class="DiseñoBox" required name="Numerou" id="Numerou" type="text" placeholder="Ingrese numero de la pregunta">
	  
	  
     


	<br>

                        <br>
                    <label>Ingrese la Pregunta</label>
                    <textArea class="form-control input-sm" required name="Preguntasu" id="Preguntasu" type="text" size="50" placeholder="Ingrese la pregunta correspondiente"></textArea>
                        <br>
                    <label>Seleccionar Nivel</label> <br>
                        <select class="DiseñoBox"  name="Nivelu" id="Nivelu">
                        <option value="">Seleccionar</option>
                        <?php
                            include ('../datos/db.php');
                            $records = $conn->prepare('SELECT id_Niveles, Basico, Medio, Avanzado FROM tb_niveles');
                            $records->execute();
                            while($row=$records->fetch(PDO::FETCH_ASSOC)){

                        ?>
                            
                            <option value="<?php echo $row['Basico'];?>"><?php  echo $row['Basico'];?> </option>
                            <option value="<?php echo $row['Medio'];?>"><?php echo $row['Medio'];?> </option>
                            <option value="<?php echo $row['Avanzado'];?>"><?php echo $row['Avanzado'];?> </option>
                            <?php
                        }
                            ?>
                        <br>
                    </select>
                    <label>Seleccionar el Nivel de Acierto</label> <br>
                    <input class="DiseñoBox" require name="ValorVerdaderou" id="ValorVerdaderou" type="number" placeholder="Ingrese valor de acierto">
                    <label>Ingrese el valor del error en porcentaje del valor de acierto (1-100%)</label> <br>
                    <input class="DiseñoBox" require name="ValorFalsou" id="ValorFalsou" type="number" placeholder="Ingrese valor de acierto">

                    <br>


                        <input type="submit" value="Guardar" class="btn btn-primary">
                </form> <br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>



