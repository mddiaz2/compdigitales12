
<!-- Modal -->
<div class="modal fade" id="insertarModalP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="frminsertP" onsubmit="return insertarDatosP()" method="post">
              <label>User</label>
              <input type="text" id="email" name="email" class="form-control form-control-sm" required="">
              <label>Password</label>
              <input type="text" id="password" name="password" class="form-control form-control-sm" required="">
              <label>Estado</label>
              <input type="text" id="estado" name="estado" class="form-control form-control-sm" required="">
              
              <br>
               <input type="submit" value="Guardar" class="btn btn-primary">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>



