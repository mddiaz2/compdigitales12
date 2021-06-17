
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
<!-- Modal -->
<div class="modal fade" id="insertarModalC" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar nueva Competencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frminsertC" onsubmit="return insertarDatosC()" method="post">
                    <label>Competencia</label>
                    <input type="text" id="competencia" name="competencia" class="form-control form-control-sm"
                        required="">
                        <br>
                    <label>Seleccione el Área</label> <br>
                    <select class="DiseñoBox"  name="id_area">
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
                        </select> <br>
                        <input type="submit" value="Guardar" class="btn btn-primary">
                </form> <br>
            </div>
            
            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>