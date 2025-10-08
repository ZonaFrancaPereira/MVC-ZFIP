<?php
// Incluir archivo de conexión y CSS
include 'conexion.php'; // Asegúrate de que el archivo de conexión está en la ruta correcta

// Obtener el ID de ACPM desde la URL
$id_gh = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verificar si el ID es válido
if ($id_gh > 0) {
    try {
        $tabla_vacaciones = 'detalle_vacaciones';
        $query_vacaciones = "
    SELECT 
        dv.*, 
        u.nombre, 
        u.apellidos_usuario,
        v.*
    FROM 
        usuarios u
    LEFT JOIN 
        $tabla_vacaciones dv ON dv.id_usuario_fk = u.id
    LEFT JOIN 
        vacaciones v ON v.nombre_administrativa = u.id
    WHERE 
        u.id = :id_gh
";

        $stmt = Conexion::conectar()->prepare($query_vacaciones);
        $stmt->bindParam(':id_gh', $id_gh, PDO::PARAM_INT);
        $stmt->execute();

        // Obtener todas las filas
        $vacaciones_data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo 'ID no válido.';
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
</div>
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="vistas/img/logo2.png"
                                    alt="User profile picture">
                            </div>

                            <?php if (!empty($vacaciones_data)) : ?>
                                <h3 class="profile-username text-center"><?php echo htmlspecialchars($vacaciones_data[0]['nombre']); ?></h3>
                            <?php else : ?>
                                <h3 class="profile-username text-center">Nombre no disponible</h3>
                            <?php endif; ?>

                            <p class="text-muted text-center">
                                <?php echo !empty($vacaciones_data) ? htmlspecialchars($vacaciones_data[0]['apellidos_usuario']) : 'Apellido no disponible'; ?>
                            </p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Cedula</b> <a class="float-right"> <?php echo !empty($vacaciones_data) ? htmlspecialchars($vacaciones_data[0]['cedula_administrativa']) : 'Cedula no disponible'; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Fecha Ingreso</b> <a class="float-right"> <?php echo !empty($vacaciones_data) ? htmlspecialchars($vacaciones_data[0]['fecha_ingreso_administrativa']) : 'Fecha no disponible'; ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Estado</b> <a class="float-right"> <?php echo !empty($vacaciones_data) ? htmlspecialchars($vacaciones_data[0]['estado_usuario_administrativa']) : 'Estado no disponible'; ?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#informacion" data-toggle="tab">Información</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Periodos Vacacionales</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">

                                <div class="active tab-pane" id="informacion">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="profile-user-img img-fluid img-circle" src="vistas/img/logo2.png" alt="User profile picture">
                                            <span class="username">
                                                <a href="#">CIRCULAR No. 006</a>
                                            </span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="post-content">
                                            <p>
                                                <strong>DE:</strong> Gestión Humana y Administración.<br>
                                                <strong>PARA:</strong> Colaboradores de la Zona Franca Internacional de Pereira.<br>
                                                <strong>FECHA:</strong> Julio 27 de 2017.<br>
                                            </p>
                                            <p>
                                                Comprometidos con la mejora continua de los procesos que conlleven a la eficacia en los resultados esperados por la organización,
                                                comedidamente les comparto los tiempos de respuesta definidos por el proceso para los trámites que sean solicitados por los colaboradores como clientes internos:
                                            </p>
                                            <div class="table-responsive">
                                                <table class="table table-hover table-striped">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Trámite Solicitado</th>
                                                            <th>Tiempo de Respuesta</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Permisos ordinarios</td>
                                                            <td>2 días hábiles</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Periodo de Vacaciones completo</td>
                                                            <td>15 días</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Periodo de Vacaciones parcial</td>
                                                            <td>5 días</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Certificados laborales</td>
                                                            <td>1 día</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Trámites de seguridad social (EPS, AFP)</td>
                                                            <td>8 días</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Reporte de novedades laborales (horas extras)</td>
                                                            <td>2 días previos a la quincena</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Requerimientos de personal</td>
                                                            <td>30 días</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Requerimiento de reemplazos temporales (cirugías, licencias, otros)</td>
                                                            <td>30 días</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Servicios de mensajería</td>
                                                            <td>1 día antes hasta las 5:00 PM (mañana para trámite en la tarde)</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Requerimiento de información laboral</td>
                                                            <td>2 días</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <p>
                                                El objetivo siempre será prestar a nuestros colaboradores un servicio oportuno procurando la satisfacción de sus necesidades.
                                                Es importante aclarar que los tiempos definidos pueden ser acortados o ampliados.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- /.post -->
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <?php if (!empty($vacaciones_data)) : ?>
                                                <?php foreach ($vacaciones_data as $vacacion) : ?>
                                                    <?php if ((int)$vacacion['pendientes_periodo'] > 0) : ?>
                                                        <div class="time-label">
                                                            <span class="bg-danger">
                                                                <?php echo htmlspecialchars($vacacion['periodo_inicio']) . ' - ' . htmlspecialchars($vacacion['periodo_fin']); ?>
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <i class="fas fa-envelope bg-primary"></i>

                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header"><a href="#">Vacaciones del Periodo:</a> En la parte de abajo podra visualizar los dias de vacaciones que se tiene de este periodo.</h3>

                                                                <div class="timeline-body">
                                                                    <input type="hidden" value="<?php echo htmlspecialchars($vacacion['id_detalle_vacaciones']); ?>">
                                                                    Disfrutadas: <?php echo htmlspecialchars($vacacion['disfrutadas']); ?><br>
                                                                    Pendientes: <?php echo htmlspecialchars($vacacion['pendientes_periodo']); ?><br>
                                                                    Observaciones: <?php echo htmlspecialchars($vacacion['observaciones_vacaciones']); ?><br>
                                                                </div>
                                                                <div class="timeline-footer">
                                                                    <button
                                                                        class="btn btn-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-target="#vacacionesModal"
                                                                        data-id_detalle_vacaciones_fk="<?php echo htmlspecialchars($vacacion['id_detalle_vacaciones']); ?>"
                                                                        data-id_usuario_detalle_fk="<?php echo htmlspecialchars($id_gh); ?>"
                                                                        data-id_vacaciones_detalle_fk="<?php echo htmlspecialchars($vacacion['id_vacaciones_fk']); ?>">
                                                                        Solicitar Vacaciones
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <div class="time-label">
                                                    <span class="bg-danger">No hay periodos disponibles</span>
                                                </div>
                                            <?php endif; ?>

                                        <!-- END timeline item -->
                                        <div>
                                            <i class="far fa-clock bg-gray"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->


                                <!-- /.modal -->
                                <div class="modal fade" id="vacacionesModal" tabindex="-1" aria-labelledby="vacacionesModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="vacacionesModalLabel"><i class="fas fa-calendar-alt"></i> Solicitar Vacaciones</h5>
                                                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="vacacionesForm" method="POST" enctype="multipart/form-data">
                                                    <div class="row g-4">
                                                        <input type="hidden" name="id_detalle_vacaciones_fk" id="id_detalle_vacaciones_fk">
                                                        <input type="hidden" name="id_usuario_detalle_fk" id="id_usuario_detalle_fk">
                                                         <input type="hidden" name="id_vacaciones_detalle_fk" id="id_vacaciones_detalle_fk">
                                                        <div class="col-md-12 mb-3">
                                                            <label for="correo_aprobador" class="form-label fw-bold text-primary">
                                                                Seleccione al Jefe Inmediato
                                                            </label>
                                                            <select id="correo_aprobador" name="correo_aprobador" class="form-select border-primary" required>
                                                                <option value="" disabled selected>Seleccione un usuario</option>
                                                                <?php
                                                                $item = null;
                                                                $valor = null;
                                                                $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                                                foreach ($usuario as $key => $value) {
                                                                    echo '<option value="' . htmlspecialchars($value["correo_usuario"]) . '">' . htmlspecialchars($value["nombre"] . ' ' . $value["apellidos_usuario"]) . '</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <label for="descripcion_solicitud" class="form-label fw-bold text-primary">
                                                                Describa su solicitud
                                                            </label>
                                                            <textarea class="form-control border-primary" id="descripcion_solicitud" name="descripcion_solicitud" rows="4" placeholder="Ingrese los detalles de su solicitud..." required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-end gap-2 mt-4">
                                                        <button type="submit" class="btn btn-primary px-4">
                                                            <i class="fas fa-paper-plane"></i> Solicitar Vacaciones
                                                        </button>
                                                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                                            <i class="fas fa-times"></i> Cerrar
                                                        </button>
                                                    </div>
                                                    <?php
                                                    $EnviarVacaciones = new ControladorAdministrativa();
                                                    $EnviarVacaciones->ctrEnviarVacaciones();
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
    </section>
</div>
</form>