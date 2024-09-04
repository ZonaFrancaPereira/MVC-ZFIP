<?php
// Incluir archivo de conexión y CSS
include 'conexion.php'; // Asegúrate de que el archivo de conexión está en la ruta correcta
include 'acpm.css'; // Asegúrate de que el archivo CSS está en la ruta correcta

// Obtener el ID de ACPM desde la URL
$id_acpm = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($id_acpm > 0) {
  try {
    // Preparar la consulta para obtener datos de ACPM
    $tabla_acpm = 'acpm'; // Nombre de la tabla de ACPM
    $query_acpm = "
            SELECT 
                $tabla_acpm.*, 
                usuarios.nombre, 
                usuarios.apellidos_usuario
            FROM 
                $tabla_acpm
            INNER JOIN 
                usuarios 
            ON 
                $tabla_acpm.id_usuario_fk = usuarios.id
            WHERE 
                $tabla_acpm.id_consecutivo = :id_acpm
        ";

    $stmt_acpm = Conexion::conectar()->prepare($query_acpm);
    $stmt_acpm->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt_acpm->execute();

    // Obtener los datos de ACPM
    $acpm_data = $stmt_acpm->fetch(PDO::FETCH_ASSOC);

    // Verificar si se obtuvieron datos de ACPM
    $descripcion_acpm = $acpm_data ? htmlspecialchars($acpm_data['descripcion_acpm']) : 'Descripción no disponible';

    // Preparar la consulta para obtener actividades incompletas
    $tabla_actividades = 'actividades_acpm'; // Nombre de la tabla de actividades
    $query_actividades = "
            SELECT 
                * 
            FROM 
                $tabla_actividades 
                INNER JOIN 
                usuarios 
            ON 
                $tabla_actividades.id_usuario_fk = usuarios.id
            WHERE 
                id_acpm_fk = :id_acpm 
                AND estado_actividad LIKE '%Incompleta%'
        ";

    $stmt_actividades = Conexion::conectar()->prepare($query_actividades);
    $stmt_actividades->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt_actividades->execute();

    // Obtener las actividades incompletas
    $actividades = $stmt_actividades->fetchAll(PDO::FETCH_ASSOC);

    // Preparar la consulta para obtener actividades completas
    $tabla_actividades = 'actividades_acpm'; // Nombre de la tabla de actividades
    $query_actividades_completas = "
    SELECT * 
    FROM $tabla_actividades 
    INNER JOIN 
                usuarios 
            ON 
                $tabla_actividades.id_usuario_fk = usuarios.id
    WHERE id_acpm_fk = :id_acpm 
      AND estado_actividad = 'Completa'
";

    $stmt_actividades_completas = Conexion::conectar()->prepare($query_actividades_completas);
    $stmt_actividades_completas->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt_actividades_completas->execute();

    // Obtener las actividades completas
    $actividades_completas = $stmt_actividades_completas->fetchAll(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
} else {
  echo 'ID ACPM no válido.';
}
?>


<!-- Navbar -->
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item En_linea 1" role="presentation">
      <a data-toggle="tab" href="#acpm" class="nav-link">
        <i class="nav-icon far fa-smile-wink"></i>
        <p>Novedades</p>
      </a>
    </li>
    <li class="nav-item En_linea 1" role="presentation">
      <a data-toggle="tab" href="#acpm" class="nav-link">
        <i class="nav-icon far fa-smile-wink"></i>
        <p>Enviar Comentario</p>
      </a>
    </li>
  </ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper -->
<div class="content-wrapper">
  <!-- /.content-header -->
  <!-- Sección de Contenido Principal -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <div class="col-md-12">
              <div class="notification" style="height: 15em; width:60em;">
                <div class="notiglow"></div>
                <div class="notiborderglow"></div>
                <div class="notititle">ACPM: <?php echo htmlspecialchars($id_acpm, ENT_QUOTES, 'UTF-8'); ?></div>
                <div class="notibody">
                  <h5>Descripción de la ACPM</h5>
                  <p><?php echo htmlspecialchars($descripcion_acpm, ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
              </div>
              <hr style="width: 60em; border-radius: 2em; background: white;">

              <div class="row">
                <!-- Tabla de actividades incompletas -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-primary text-white">
                      <h4>Actividades Incompletas</h4>
                    </div>
                    <div class="card-body">
                      <table id="incompletas" class="table table-bordered table-striped dt-responsive display" width="100%">
                        <thead class="bg-dark text-white">
                          <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Descripción Actividad</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                            <th>Subir Evidencia</th>
                            <th>Eliminar Actividad</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Mostrar las actividades incompletas en la primera tabla
                          foreach ($actividades as $index => $actividad) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($actividad['id_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['fecha_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['descripcion_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['estado_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['nombre']) . "</td>";
                            echo "<td><button type='button' class='btn btn-outline-info' data-id_actividad='{$actividad["id_actividad"]}' data-toggle='modal' data-target='#modal-evidencia'>Subir evidencia</button></td>";
                            echo "<td>
                                      <button type='button' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#modalEliminar' data-id='{$actividad["id_actividad"]}'>
                                          Eliminar
                                      </button>
                                    </td>";
                            echo "</tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

                <!-- Tabla de actividades completas -->
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-header bg-success text-white">
                      <h4>Actividades Completas</h4>
                    </div>
                    <div class="card-body">
                      <table class="table table-bordered table-striped dt-responsive display" width="100%">
                        <thead class="bg-dark text-white">
                          <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Descripción Actividad</th>
                            <th>Estado</th>
                            <th>Responsable</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          // Mostrar las actividades completas en la segunda tabla
                          foreach ($actividades_completas as $index => $actividad) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($actividad['id_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['fecha_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['descripcion_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['estado_actividad']) . "</td>";
                            echo "<td>" . htmlspecialchars($actividad['nombre']) . "</td>";
                            echo "</tr>";
                          }
                          ?>
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
                        <!-- Hidden input for activity ID -->
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
                          <textarea class="textarea form-control" id="evidencia" name="evidencia" rows="3" placeholder="Evidencia" required></textarea>
                        </div>

                        <div class="form-group">
                          <label for="recursos">Recursos</label>
                          <select class="form-control" id="recursos" name="recursos" required>
                            <option value="" disabled selected>Seleccione un recurso...</option>
                            <option value="Tecnico">Técnico</option>
                            <option value="Tecnologico">Tecnológico</option>
                            <option value="Humano">Humano</option>
                            <option value="Financiero">Financiero</option>
                            <!-- Agrega más opciones según sea necesario -->
                          </select>
                        </div>
                        <div class="modal-footer">
                          <button type="submit" form="form_evidencia" class="btn btn-primary">Subir Evidencia</button>
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                        <?php
                        $subirEvidencia = new ControladorAcpm();
                        $subirEvidencia->ctrSubirEvidencia();
                        ?>
                      </form>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal -->
             <!-- Modal -->
              <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                          <div class="modal-header bg-danger text-white">
                              <h5 class="modal-title" id="modalEliminarLabel">Confirmar Eliminación</h5>
                              <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body text-center">
                              <p class="mb-4">¿Está seguro de que desea eliminar esta actividad?</p>
                              <form method="POST" enctype="multipart/form-data"> <!-- Cambia 'ruta-a-tu-controlador.php' por la ruta correcta -->
                                  <input type="hidden" name="id_actividad" id="idActividadEliminar">
                                  <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancelar</button>
                                  <button type="submit" class="btn btn-danger">Eliminar</button>
                                  <?php
                                  $eliminarActividad = new ControladorAcpm();
                                  $eliminarActividad->ctrEliminarActividad();
                                  ?>
                              </form>
                          </div>
                      </div>
                  </div>
              </div>

              <?php
              // Reemplaza '123' con la variable correspondiente al ID dinámico de ACPM
              $id_acpm = isset($_GET['id']) ? intval($_GET['id']) : 0;
              $actividadesCompletas = ControladorAcpm::ctrVerificarActividadesCompletas($id_acpm);
              ?>

              <form method="POST"  enctype="multipart/form-data">
                  <input type="hidden" name="id_acpm" value="<?php echo $id_acpm; ?>">

                  <!-- Botón "Enviar a SIG" -->
                  <button id="btnEnviarSig" type="submit" class="btn btn-primary" 
                          <?php echo ($actividadesCompletas ? '' : 'disabled'); ?>>
                      Enviar a SIG
                  </button>
              </form>

              <?php
              // Llama a la función para manejar la solicitud de envío a SIG
              $enviarSig = new ControladorAcpm();
              $enviarSig->ctrEnviarASig();
           
?>


            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<!-- /.content-wrapper -->
<?php require('footer.php'); ?>
<!-- Scripts -->
<script>
  $('#modal-evidencia').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var id_actividad = button.data('id_actividad'); // Extract info from data-* attributes

    // Update the modal's content
    var modal = $(this);
    modal.find('.modal-body #id_actividad_fk').val(id_actividad);
  });

  $('#modalEliminar').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Botón que disparó el modal
    var idActividad = button.data('id'); // Extraer información del atributo data-id

    var modal = $(this);
    modal.find('#idActividadEliminar').val(idActividad); // Pasar el ID de actividad al campo oculto
  });
</script>