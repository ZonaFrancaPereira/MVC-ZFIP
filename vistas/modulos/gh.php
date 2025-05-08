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
                $tabla_vacaciones dv
            INNER JOIN 
                usuarios u 
            ON 
                dv.id_usuario_fk = u.id
            INNER JOIN 
                vacaciones v
            ON 
                dv.id_usuario_fk = v.nombre_administrativa
            WHERE 
                dv.id_usuario_fk = :id_gh
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
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Información</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Periodos Vacacionales</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Solicitar Vacaciones</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg" alt="user image">
                                            <span class="username">
                                                <a href="#">Jonathan Burke Jr.</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Shared publicly - 7:30 PM today</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore the hate as they create awesome
                                            tools to help create filler text for everyone from bacon lovers
                                            to Charlie Sheen fans.
                                        </p>

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post clearfix">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                                            <span class="username">
                                                <a href="#">Sarah Ross</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Sent you a message - 3 days ago</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <p>
                                            Lorem ipsum represents a long-held tradition for designers,
                                            typographers and the like. Some people hate it and argue for
                                            its demise, but others ignore the hate as they create awesome
                                            tools to help create filler text for everyone from bacon lovers
                                            to Charlie Sheen fans.
                                        </p>

                                        <form class="form-horizontal">
                                            <div class="input-group input-group-sm mb-0">
                                                <input class="form-control form-control-sm" placeholder="Response">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-danger">Send</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.post -->

                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                                            <span class="username">
                                                <a href="#">Adam Jones</a>
                                                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                            </span>
                                            <span class="description">Posted 5 photos - 5 days ago</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                                        <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col-sm-6">
                                                        <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                                        <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.row -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->

                                        <p>
                                            <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments (5)
                                                </a>
                                            </span>
                                        </p>

                                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
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
                                                                class="btn btn-primary btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#editVacationModal"
                                                                data-editar_disfrutadas="<?php echo htmlspecialchars($vacacion['disfrutadas']); ?>"
                                                                data-editar_pendientes_periodo="<?php echo htmlspecialchars($vacacion['pendientes_periodo']); ?>"
                                                                data-editar_observaciones_vacaciones="<?php echo htmlspecialchars($vacacion['observaciones_vacaciones']); ?>"
                                                                data-editar_id_vacacion="<?php echo htmlspecialchars($vacacion['id_detalle_vacaciones']); ?>">
                                                                Editar
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
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
                              
                                    <!-- Modal Editar Vacaciones -->
                                    <div class="modal fade" id="editVacationModal" tabindex="-1" aria-labelledby="editVacationModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title" id="editVacationModalLabel"><i class="fas fa-edit"></i> Editar Vacaciones</h5>
                                                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="editVacationForm" method="POST" enctype="multipart/form-data">
                                                        <div class="row g-3">
                                                            <input type="hidden" name="editar_id_vacacion" id="editar_id_vacacion">
                                                            <div class="col-md-6">
                                                                <label for="editar_disfrutadas" class="form-label fw-bold">Disfrutadas</label>
                                                                <input type="number" class="form-control border-primary" id="editar_disfrutadas" name="editar_disfrutadas" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="editar_pendientes_periodo" class="form-label fw-bold">Pendientes</label>
                                                                <input type="number" class="form-control border-primary" id="editar_pendientes_periodo" name="editar_pendientes_periodo" required>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <label for="editar_observaciones_vacaciones" class="form-label fw-bold">Observaciones</label>
                                                                <textarea class="form-control border-primary" id="editar_observaciones_vacaciones" name="editar_observaciones_vacaciones" rows="3" placeholder="Ingrese las observaciones" required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="text-end mt-4">
                                                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save"></i> Guardar Cambios</button>
                                                            <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                                                        </div>

                                                        <?php
                                                        $ActualizarVacaciones = new ControladorAdministrativa();
                                                        $ActualizarVacaciones-> ctrActualizarVacaciones();
                                                        ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputName" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
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