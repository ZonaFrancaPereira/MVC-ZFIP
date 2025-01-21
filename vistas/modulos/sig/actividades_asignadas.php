

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">Actividades Asignadas</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card-body">
          <div class="col-md-12">
            <hr style="width: 60em; border-radius: 2em; background: white;">
            <div class="row">

              <!-- Tabla de actividades incompletas -->
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header bg-success text-white">
                    <h4>Actividades Incompletas</h4>
                  </div>
                  <div class="card-body">
                    <table id="tabla-actividades-asignadas" class="table table-bordered table-striped dt-responsive" width="100%">
                      <thead class="bg-dark text-white">
                        <tr>
                          <th>#</th>
                          <th>Fecha</th>
                          <th>Descripción Actividad</th>
                          <th>Estado</th>
                          <th>Subir Evidencia</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

              <!-- Tabla de actividades completas -->
              <div class="col-md-12">
                <div class="card">
                  <div class="card-header bg-primary text-white">
                    <h4>Actividades Completas</h4>
                  </div>
                  <div class="card-body">
                    <table id="tabla-actividades-completas" class="table table-bordered table-striped dt-responsive" width="100%">
                      <thead class="bg-dark text-white">
                        <tr>
                          <th>#</th>
                          <th>Fecha</th>
                          <th>Descripción Actividad</th>
                          <th>Estado</th>
                          <th>Informe</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>

            <!-- Modal para Subir Evidencia -->
            <div class="modal fade" id="modal-evidencia" tabindex="-1" role="dialog" aria-labelledby="modal-evidencia-label" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header bg-info text-white">
                    <h4 class="modal-title" id="modal-evidencia-label">Subir Evidencia</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="form_evidencia" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="id_actividad_fk">Actividad</label>
                        <input type="text" id="id_actividad_fk" name="id_actividad_fk" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="id_usuario_e_fk">Nombre del Responsable</label>
                        <input type="text" id="id_usuario_e_fk" name="id_usuario_e_fk" value="<?php echo $_SESSION['id']; ?>" class="form-control" readonly>
                      </div>
                      <div class="form-group">
                        <label for="fecha_evidencia">Fecha</label>
                        <input type="date" name="fecha_evidencia" class="form-control" id="fecha_evidencia" required>
                      </div>
                      <div class="form-group">
                        <label for="evidencia">Evidencia</label>
                        <textarea class="editor" id="evidencia" name="evidencia" style="display: none;"></textarea>
                        <div class="quill-content"></div>
                      </div>
                      <div class="form-group">
                        <label for="recursos">Recursos</label>
                        <select class="form-control" id="recursos" name="recursos" required>
                          <option value="" disabled selected>Seleccione un recurso...</option>
                          <option value="Tecnico">Técnico</option>
                          <option value="Tecnologico">Tecnológico</option>
                          <option value="Humano">Humano</option>
                          <option value="Financiero">Financiero</option>
                        </select>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" form="form_evidencia" class="btn btn-primary">Subir Evidencia</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                      </div>
                    </form>
                    <?php
                    $subirEvidencia = new ControladorAcpm();
                    $subirEvidencia->ctrSubirEvidencia();
                    ?>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
