<!-- Modal -->
<div class="modal fade" id="actualizarModalP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Persona</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="frminsertuP" onsubmit="return actualizarDatosP()" method="post">
            <input type="text" id="id" name="id" hidden="">
              <label>Email</label>
              <input type="text" id="emailp" name="emailp" class="form-control form-control-sm" required="">
              <label>Password</label>
              <input type="text" id="passp" name="passp" class="form-control form-control-sm" required="">

              
              <br>
               <input type="submit" value="Actualizar" class="btn btn-warning">
          </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>


