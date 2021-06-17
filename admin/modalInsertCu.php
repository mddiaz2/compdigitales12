
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
<div class="modal fade" id="insertarModalCu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Cuestionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frminsertCu" onsubmit="return insertarDatosCu()" method="post">
                   
                    <label>Seleccione el Área</label> <br>
                    <select class="DiseñoBox"  name="id_Areas">
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
                    <select class="DiseñoBox"  name="id_Competencias">
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
                    <select class="DiseñoBox"  name="id_Niveles">
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
     <input class="DiseñoBox" required name="Numero"   type="hidden" placeholder="La pregunta a crear es"  Value="<?php echo $CuestionarioNumeroPregunta+1;?>" >
	  
	  
      <input class="DiseñoBox" required name="Preguntas"  type="text" size="50" placeholder="Ingrese por favor la pregunta correspondiente" Value="<?php echo $CuestionarioNumeroPregunta+1;?>" disabled>


	<br>

                        <br>
                    <label>Ingrese la Pregunta</label>
                    <textArea class="form-control input-sm" required name="Preguntas"  type="text" size="50" placeholder="Ingrese la pregunta correspondiente"></textArea>
                        <br>
                    <label>Seleccionar Nivel</label> <br>
                        <select class="DiseñoBox"  name="Nivel" id="NivelActualizar">
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
                    <select class="DiseñoBox"  name="ValorVerdadero">
                        <option value="">Seleccionar</option>
                        <?php 
	                    for($i=1;$i<=100;$i++){
	                        ?>
	                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
	                                        <?php 
	                            	}
	                                ?>
                        <br>
                    </select>
                    <label>Ingrese el valor del error en porcentaje del valor de acierto (1-100%)</label> <br>
                     <select class="DiseñoBox"  name="ValorPorcentaje">
                        <option value="">Seleccionar</option>
                        <?php 
                                        for($j=1;$j<=100;$j++){
                                        ?>
                                        <option value="<?php echo $j;?>"><?php echo $j,"%";?></option>
                                        <?php
                                            
                                            }
                                        ?>
                        <br>
                    </select>
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
<!--Metodo script para realizar la busque de datos de los niveles segun la escala mediante ajax-->
