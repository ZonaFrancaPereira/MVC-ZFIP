function generarModalConFormulario($modalId, $tituloModal, $codigo, $id_proceso_fk, $proceso)
{



  echo '<!-- Modal -->';
  echo '<div class="modal fade" id="' . $modalId . '">';
  echo '    <div class="modal-dialog modal-lg">';
  echo '        <div class="modal-content">';
  echo '            <div class="modal-header">';
  echo '                <h4 class="modal-title">' . $tituloModal . '</h4>';
  echo '                <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
  echo '                    <span aria-hidden="true">&times;</span>';
  echo '                </button>';
  echo '            </div>';
  echo '            <div class="modal-body">';

  echo '            </div>';

  echo '        </div>';
  echo '        <!-- /.modal-content -->';
  echo '    </div>';
  echo '    <!-- /.modal-dialog -->';
  echo '</div>';
  echo '<!-- /.modal -->';

  echo '
  <!-- Main content -->
  <section class="content">
  
      <!-- Default box -->
      <div class="card">
          <div class="card-header">
              <h3 class="card-title">Gestión de Archivos  :' . $proceso . ' :</h3> <br>
  
              <div class="row panel panel-default">
                  <div class="col-md-4 col-lg-4 text-center">
                      <button class="btn btn-primary">Crear Carpeta</button>
                  </div>
                  <div class="col-md-8 col-lg-8">';
  generarFormulario($codigo, $id_proceso_fk, $proceso);
  echo '
                  </div>
              </div>
          </div>
  
      </div>
      <!-- /.card -->

  </section>
  <!-- /.content -->
  ';
}

?>