<?php
// Obtener el ID del usuario desde la sesión
$idUsuario = $_SESSION["id"];

// Llamar al método del controlador
$totalActivos = ControladorActivos::ctrContarActivosPorUsuario($idUsuario);
// Llamar al método del controlador para activos inactivos
$totalInactivos = ControladorActivos::ctrContarActivosInactivosPorUsuario($idUsuario);

// Mostrar el resultado
//echo "Total de activos para el usuario actual: " . $totalActivos;
?>
  <!-- Info boxes -->
  <div class="row">
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box bg-primary">
        <span class="info-box-icon"><i class="fas fa-tv"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Activos Fijos</span>
          <h3><?= $totalActivos ?></h3>

          <div class="progress">
            <div class="progress-bar" style="width:<?= $totalActivos ?>%"></div>
          </div>
          <span class="progress-description">
            Cantidad de Activos Asignados
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box bg-danger">
        <span class="info-box-icon"><i class="fas fa-trash"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Inactivos</span>
          <h3><?= $totalInactivos ?></h3>
          <div class="progress">
            <div class="progress-bar" style="width: <?= $totalInactivos ?>%"></div>
          </div>
          <span class="progress-description">
            Activos dados de baja
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix hidden-md-up"></div>

    <div class="col-md-4 col-sm-6 col-12">
      <div class="info-box bg-success">
        <span class="info-box-icon"><i class="fas fa-dollar-sign"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ordenes de Compra</span>
          <h3>2</h3>
          <div class="progress">
            <div class="progress-bar" style="width: 2%"></div>
          </div>
          <span class="progress-description">
            Esperando aprobación
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
    <!-- /.col -->




  </div>
  <!-- /CIERRA LAS CAJAS DE LA PARTE DE ARRIBA -->

  <!-- SECTION PARA MOSTRAR LOS ACTIVOS FIJO QUE DEBEMOS VERIFICAR EN EL INVENTARIO -->
  <?php
  $ctrInventario = new ControladorInventario();
  $id_inventario_abierto = $ctrInventario->ctrVerificarInventarioAbierto();

  if ($id_inventario_abierto) {
    $id_inventario = $id_inventario_abierto["id_inventario"];

  ?>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title"><B>Inventario <?php echo $id_inventario; ?> </B> de Activos Fijos </h3>
              </div>
              <div class="card-body row">
                <!-- TABLA QUE MUESTRA LOS ACTIVOS FIJOS QUE NO SE HAN VERIFICADO -->
                <div class="card col-md-6">
                  <div class="card-header border-0 bg-warning">
                    <h3 class="card-title">Activos por Verificar</h3>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table id="tabla-sinverificar" class="table table-striped table-valign-middle">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Articulo</th>
                          <th>Lugar</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- TABLA PARA MOSTRAR LOS ACTIVOS FIJOS QUE YA SE VERIFICARON -->
                <div class="card col-md-6">
                  <div class="card-header border-0 bg-teal">
                    <h3 class="card-title">Activos Verificados</h3>
                  </div>
                  <div class="card-body table-responsive p-0">
                    <table id="tabla-Averificados" class="table table-striped table-valign-middle">
                      <thead>
                        <tr>
                          <th>Código</th>
                          <th>Articulo</th>
                          <th>Descripción</th>
                          <th>Estado</th>
                          <th>Acciones</th>

                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- CIERRA TABLA DE ACTIVOS VERIFICADOS -->
              </div><!-- /.card-body -->
            </div><!-- /.card -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <!-- Modal -->
      <div class="modal fade" id="modalVerificacion" tabindex="-1" role="dialog" aria-labelledby="modalVerificacionLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalVerificacionLabel">Crear Verificación</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="verificarActivo" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="id_inventario_fk" value="<?php echo $id_inventario_abierto["id_inventario"]; ?>">
                <input type="hidden" name="id_activo_fk" id="id_activo_fk" value="">
                <input type="hidden" name="id_usuario_fk" value="<?php echo $_SESSION["id"]; ?>">
                <label for="estado">Estado:</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="Bueno">Bueno</option>
                  <option value="Dar de Baja">Dar de Baja</option>
                  <option value="Perdido">Perdido</option>
                </select>
                <label for="observaciones">Observaciones:</label>
                <textarea class="form-control" id="observaciones" name="observaciones"></textarea>
                <br>
                <button type="submit" class="btn bg-success" name="crear_verificacion">Crear Verificación</button>
                <?php
                if (isset($_POST['crear_verificacion'])) {
                  $crearVerificacion = new ControladorVerificaciones();
                  $crearVerificacion->ctrCrearVerificacion();
                }
                ?>
              </form>
            </div>
          </div>
        </div>
      </div>





      <script>
        $('#modalVerificacion').on('show.bs.modal', function(event) {
          var button = $(event.relatedTarget);
          var idActivo = button.data('id_activo');
          var nombreArticulo = button.data('nombre_articulo');
          var modal = $(this);
          modal.find('.modal-title').text('Verificación de Activo: ' + idActivo + ' - ' + nombreArticulo);
          modal.find('.modal-body #id_activo_fk').val(idActivo);
        });
      </script>
    </section><!-- /.content -->

  <?php } else { ?>
    <div class="alert alert-info">No hay ningún inventario abierto actualmente.</div>
  <?php } ?>