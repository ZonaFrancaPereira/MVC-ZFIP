
<div class="modal fade" id="modal-categoria" tabindex="-1" role="dialog" aria-labelledby="modal-categoriaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="modal-categoriaLabel">Nueva Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-categoria" method="POST">  
        <div class="form-group">
            <label for="nombre-categoria">Nombre Categoría</label>
            <input type="text" class="form-control" id="nuevaCategoria" name="nuevaCategoria" required>
          </div>
          <div class="form-group">
            <label for="descripcion-categoria">Descripción Categoría</label>
            <textarea class="form-control" id="descripcionCategoria" name="descripcionCategoria" rows="3" required></textarea>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn bg-success" name="guardar_categoria">Guardar</button>
            <?php  
                 if (isset($_POST['guardar_categoria'])) {
                  $CategoriaSadoc = new ControladorSadoc();
                  $CategoriaSadoc->ctrCrearCategoria();
                 }
            ?>
          </div>
        </form>
      </div>
    </div>
  </div>
