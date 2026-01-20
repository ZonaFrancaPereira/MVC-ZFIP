<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Recursos TI</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="active nav-link" href="#asignacion_ti" data-toggle="tab">Asignación de Equipos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ver_detalles_ti" data-toggle="tab">Características Equipos</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- TAB PARA ACTUALIZAR LAS CONTRASEÑAS -->
                            <div class="tab-pane active" id="asignacion_ti">
                                <div class="card">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-lg">
                                            Nueva Asignación
                                        </button>
                                        <div class="row">

                                            <!-- =======================
       USUARIOS SIN ASIGNACIÓN
       ======================= -->
                                            <div class="col-md-4">
                                                <?php
                                                $item  = null;
                                                $valor = null;

                                                // Usuarios activos sin asignación
                                                $usuariosSinAsignacion = ControladorActivos::ctrMostrarAsignaciones($item, $valor);
                                                ?>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Usuarios activos sin asignación</h3>
                                                        <div class="card-tools">
                                                            <span class="badge badge-danger">
                                                                <?= count($usuariosSinAsignacion) ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="card-body p-0">
                                                        <?php if (empty($usuariosSinAsignacion)): ?>
                                                            <div class="p-3">
                                                                <span class="badge badge-success">OK</span>
                                                                Todos los usuarios activos tienen asignación.
                                                            </div>
                                                        <?php else: ?>
                                                            <ul class="products-list product-list-in-card pl-2 pr-2">
                                                                <?php foreach ($usuariosSinAsignacion as $u): ?>
                                                                    <li class="item">
                                                                        <div class="product-info">
                                                                            <span class="product-title">
                                                                                <?= htmlspecialchars($u['nombre']) ?>
                                                                                <?= htmlspecialchars($u['apellidos_usuario']) ?>
                                                                                <span class="badge badge-warning float-right">
                                                                                    SIN ASIGNAR
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- =======================
       USUARIOS CON ASIGNACIÓN
       ======================= -->
                                            <div class="col-md-8">
                                                <?php
                                                $usuarios = ControladorActivos::ctrUsuariosActivosConAsignacionEquipos();
                                                ?>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Usuarios activos con asignación de equipo</h3>
                                                        <div class="card-tools">
                                                            <span class="badge badge-info">
                                                                <?= count($usuarios) ?>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="card-body table-responsive p-0">
                                                        <table class="table table-hover text-nowrap mb-0" style="width:100%;">
                                                            <thead class="bg-navy">
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>Usuario</th>
                                                                    <th>Asignaciones</th>
                                                                    <th>Última asignación</th>
                                                                    <th>PDF</th>
                                                                </tr>
                                                            </thead>

                                                            <tbody>
                                                                <?php if (empty($usuarios)): ?>
                                                                    <tr>
                                                                        <td colspan="5" class="text-center text-muted p-3">
                                                                            No hay usuarios activos con asignación activa.
                                                                        </td>
                                                                    </tr>
                                                                <?php else: ?>
                                                                    <?php foreach ($usuarios as $u): ?>
                                                                        <tr>
                                                                            <td><?= (int)$u['id'] ?></td>
                                                                            <td><?= htmlspecialchars($u['usuario']) ?></td>
                                                                            <td>
                                                                                <span class="badge badge-success">
                                                                                    <?= (int)$u['num_asignaciones'] ?>
                                                                                </span>
                                                                            </td>
                                                                            <td>
                                                                                <?= htmlspecialchars($u['ultima_asignacion'] ?? '') ?>
                                                                            </td>
                                                                            <td>
                                                                                <a
                                                                                    class="btn btn-sm btn-danger"
                                                                                    target="_blank"
                                                                                    href="extensiones/tcpdf/pdf/asignacion_equipos.php?id=<?= (int)$u['id'] ?>">
                                                                                    <i class="fas fa-file-pdf"></i> Ver
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal fade" id="modal-lg">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Asignación de Recursos Tecnológicos</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data" id="formAsignacion">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label for="">Fecha</label>
                                                                    <input type="date" class="form-control" id="fecha_asignacion" name="fecha_asignacion" required>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="">Usuario</label>
                                                                    <input list="usuario1" class="form-control" id="id_usuario_fk1" name="id_usuario_fk" required style="width: 100%;">
                                                                    <datalist id="usuario1">
                                                                        <?php
                                                                        $item = null;
                                                                        $valor = null;

                                                                        // Llamada al método del controlador para obtener los usuarios
                                                                        $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                                                                        // Verificar si $usuarios es un array válido
                                                                        if (!empty($usuarios) && is_array($usuarios)) {
                                                                            foreach ($usuarios as $value) {
                                                                                echo '<option value="' . htmlspecialchars($value["id"]) . '">' . htmlspecialchars($value["nombre"] . ' ' . $value["apellidos_usuario"]) . '</option>';
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </datalist>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn bg-success" name="guardar_asignacion">Guardar Cambios</button>
                                                            </div>
                                                            <?php
                                                            $crearAsignacion = new ControladorActivos();
                                                            $crearAsignacion->ctrCrearAsignacion();
                                                            ?>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- TAB PARA CONSULTAR LAS CONTRASEÑAS -->
                            <div class="tab-pane" id="ver_detalles_ti">
                                <div class="card">
                                    <div class="card-header">
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-equipos_ti">
                                            Características Equipo
                                        </button>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $detalles = ModeloActivos::mdlMostrarDetallesEquipos("activos", $item, $valor);
                                        ?>
                                        <div class="card-body table-responsive pt-2">
                                            <table class="display table table-hover text-nowrap mb-0" style="width:100%;">
                                                <thead class="bg-navy">
                                                    <tr>
                                                        <th>ID Detalle</th>
                                                        <th>ID Activo</th>
                                                        <th>Equipo</th>
                                                        <th>Usuario</th>
                                                        <th>Acciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (empty($detalles)): ?>
                                                        <tr>
                                                            <td colspan="5" class="text-center text-muted p-3">No hay detalles registrados.</td>
                                                        </tr>
                                                    <?php else: ?>
                                                        <?php foreach ($detalles as $d): ?>
                                                            <?php if ((int)$d["id_detalle"] === 0) {
                                                                continue;
                                                            } ?>
                                                            <tr>
                                                                <td><?= (int)$d["id_detalle"] ?></td>
                                                                <td><?= (int)$d["id_activo"] ?></td>
                                                                <td><?= htmlspecialchars($d["nombre_articulo"]) ?></td>
                                                                <td><?= htmlspecialchars($d["nombre"] . " " . $d["apellidos_usuario"]) ?></td>
                                                                <td>
                                                                    <button
                                                                        class="btn btn-warning btnEditarDetalleEquipo"
                                                                        data-toggle="modal"
                                                                        data-target="#modal-editar-detalles"
                                                                        data-id_detalle="<?= (int)$d["id_detalle"] ?>"
                                                                        data-id_activo_fk="<?= (int)$d["id_activo_fk"] ?>"
                                                                        data-msd="<?= htmlspecialchars($d["msd"]) ?>"
                                                                        data-antivirus="<?= htmlspecialchars($d["antivirus"]) ?>"
                                                                        data-visio_pro="<?= htmlspecialchars($d["visio_pro"]) ?>"
                                                                        data-mac_osx="<?= htmlspecialchars($d["mac_osx"]) ?>"
                                                                        data-windows="<?= htmlspecialchars($d["windows"]) ?>"
                                                                        data-autocad="<?= htmlspecialchars($d["autocad"]) ?>"
                                                                        data-office="<?= htmlspecialchars($d["office"]) ?>"
                                                                        data-appolo="<?= htmlspecialchars($d["appolo"]) ?>"
                                                                        data-zeus="<?= htmlspecialchars($d["zeus"]) ?>"
                                                                        data-otros="<?= htmlspecialchars($d["otros"] ?? "", ENT_QUOTES) ?>"
                                                                        data-procesador="<?= htmlspecialchars($d["procesador"] ?? "", ENT_QUOTES) ?>"
                                                                        data-disco_duro="<?= htmlspecialchars($d["disco_duro"] ?? "", ENT_QUOTES) ?>"
                                                                        data-memoria_ram="<?= htmlspecialchars($d["memoria_ram"] ?? "", ENT_QUOTES) ?>"
                                                                        data-cd_dvd="<?= htmlspecialchars($d["cd_dvd"] ?? "", ENT_QUOTES) ?>"
                                                                        data-tarjeta_video="<?= htmlspecialchars($d["tarjeta_video"] ?? "", ENT_QUOTES) ?>"
                                                                        data-tarjeta_red="<?= htmlspecialchars($d["tarjeta_red"] ?? "", ENT_QUOTES) ?>"
                                                                        data-tipo_red="<?= htmlspecialchars($d["tipo_red"]) ?>"
                                                                        data-tiempo_bloqueo="<?= htmlspecialchars($d["tiempo_bloqueo"]) ?>"
                                                                        data-usuario="<?= htmlspecialchars($d["usuario"]) ?>"
                                                                        data-clave="<?= htmlspecialchars($d["clave"]) ?>"
                                                                        data-zfip="<?= htmlspecialchars($d["zfip"]) ?>"
                                                                        data-privilegios="<?= htmlspecialchars($d["privilegios"]) ?>"
                                                                        data-observaciones_equipo="<?= htmlspecialchars($d["observaciones_equipo"]) ?>"
                                                                        data-backup="<?= htmlspecialchars($d["backup"]) ?>"
                                                                        data-dia_backup="<?= htmlspecialchars($d["dia_backup"]) ?>"
                                                                        data-realiza_backup="<?= htmlspecialchars($d["realiza_backup"]) ?>"
                                                                        data-justificacion_backup="<?= htmlspecialchars($d["justificacion_backup"] ?? "", ENT_QUOTES) ?>"
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="modal fade" id="modal-equipos_ti">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Detalles Equipos Tecnológicos</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post" enctype="multipart/form-data" id="formDetallesEquipo">
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <label for="">Selecciona Equipo</label>
                                                                    <input list="equipo" class="form-control form-control-border" id="id_activo_fk" name="id_activo_fk" required style="width: 100%;">
                                                                    <datalist id="equipo">
                                                                        <?php
                                                                        $item = null;
                                                                        $valor = null;

                                                                        // Llamada al método del controlador para obtener los equipos que aun no cuentan con caracteristicas
                                                                        $equiposd = ControladorActivos::ctrMostrarEquipos($item, $valor);

                                                                        // Verificar si $usuarios es un array válido
                                                                        if (!empty($equiposd) && is_array($equiposd)) {
                                                                            foreach ($equiposd as $valued) {
                                                                                echo '<option value="' . htmlspecialchars($valued["id_activo"]) . '">' . htmlspecialchars($valued["nombre_articulo"] . ' - ' . $valued["nombre"] . ' ' . $valued["apellidos_usuario"]) . '</option>';
                                                                            }
                                                                        }

                                                                        ?>
                                                                    </datalist>
                                                                    <br>
                                                                </div>
                                                                <!-- CARACTERISTICAS DE SOFTWARE -->
                                                                <div class="card-header bg-navy col-md-12">
                                                                    <h3 class="card-title">Software</h3>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="msd" class="form-label">MSD</label>
                                                                    <input type="text" class="form-control form-control-border" id="msd" name="msd" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="antivirus" class="form-label">Antivirus</label>
                                                                    <input type="text" class="form-control form-control-border" id="antivirus" name="antivirus" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="visio_pro" class="form-label">Visio Pro</label>
                                                                    <input type="text" class="form-control form-control-border" id="visio_pro" name="visio_pro" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="mac_osx" class="form-label">Mac OSX</label>
                                                                    <input type="text" class="form-control form-control-border" id="mac_osx" name="mac_osx" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="windows" class="form-label">Windows</label>
                                                                    <input type="text" class="form-control form-control-border" id="windows" name="windows" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="autocad" class="form-label">AutoCAD</label>
                                                                    <input type="text" class="form-control form-control-border" id="autocad" name="autocad" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="office" class="form-label">Microsoft Office</label>
                                                                    <input type="text" class="form-control form-control-border" id="office" name="office" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="appolo" class="form-label">Appolo ZF</label>
                                                                    <input type="text" class="form-control form-control-border" id="appolo" name="appolo" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label for="zeus" class="form-label">Zeus Tecnologia</label>
                                                                    <input type="text" class="form-control form-control-border" id="zeus" name="zeus" placeholder="N/A">
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <label for="otros" class="form-label">Otros</label>
                                                                    <textarea class="form-control textarea" id="otros" name="otros" rows="3">
                                                                    </textarea>
                                                                    <br>
                                                                </div>
                                                                <!-- CARACTERISTICAS DE HADWARE -->
                                                                <div class="card-header bg-navy col-md-12">
                                                                    <h3 class="card-title">Hardware</h3>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="procesador" class="form-label">Procesador</label>
                                                                    <textarea class="form-control textarea" id="procesador" name="procesador" rows="3">
                                                                        Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="disco_duro" class="form-label">Disco Duro</label>
                                                                    <textarea class="form-control textarea" id="disco_duro" name="disco_duro" rows="3">Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="memoria_ram" class="form-label">Memoria RAM</label>
                                                                    <textarea class="form-control textarea" id="memoria_ram" name="memoria_ram" rows="3">Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="cd_dvd" class="form-label">CD/DVD</label>
                                                                    <textarea class="form-control textarea" id="cd_dvd" name="cd_dvd" rows="3">Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="tarjeta_video" class="form-label">Tarjeta de Video</label>
                                                                    <textarea class="form-control textarea" id="tarjeta_video" name="tarjeta_video" rows="3">Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label for="tarjeta_red" class="form-label">Tarjeta de Red</label>
                                                                    <textarea class="form-control textarea" id="tarjeta_red" name="tarjeta_red" rows="3">Características:  <hr>
                                                                        Tipo:  <hr>
                                                                        Estado:  <hr>
                                                                    </textarea>
                                                                </div>
                                                                <!-- CARACTERISTICAS DE SEGURIDAD -->
                                                                <div class="card-header bg-navy col-md-12">
                                                                    <h3 class="card-title">Seguridad Básica de Equipos</h3>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="tipo_red">Tipo de Red</label>
                                                                    <select class="custom-select form-control-border" id="tipo_red" name="tipo_red">
                                                                        <option value="Cableada">Cableada</option>
                                                                        <option value="Wifi">Wifi</option>
                                                                    </select>
                                                                </div>


                                                                <div class="form-group col-md-4">
                                                                    <label for="usuario">Usuario</label>
                                                                    <select class="custom-select form-control-border" id="usuario" name="usuario">
                                                                        <option value="Si">Si</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="clave">Clave</label>
                                                                    <select class="custom-select form-control-border" id="clave" name="clave">
                                                                        <option value="Si">Si</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="tiempo_bloqueo">Tiempo de Bloqueo</label>
                                                                    <select class="custom-select form-control-border" id="tiempo_bloqueo" name="tiempo_bloqueo">
                                                                        <option value="Si">Si</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-md-4">
                                                                    <label for="privilegios">Privilegios</label>
                                                                    <select class="custom-select form-control-border" id="privilegios" name="privilegios">
                                                                        <option value="Estandar">Estandar</option>
                                                                        <option value="Administrador">Administrador</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-4">
                                                                    <label for="zfip">Dentro de ZFIP</label>
                                                                    <select class="custom-select form-control-border" id="zfip" name="zfip">
                                                                        <option value="Si">Si</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <label for="observaciones_equipo" class="form-label">Observaciones del Equipo</label>
                                                                    <textarea class="form-control textarea" id="observaciones_equipo" name="observaciones_equipo" rows="3"></textarea>
                                                                </div>
                                                                <!-- CARACTERISTICAS DE COPIAS DE SEGURIDAD -->
                                                                <div class="card-header bg-navy col-md-12">
                                                                    <h3 class="card-title">Copias de Seguridad </h3>
                                                                </div>
                                                                <div class="form-group col-md-12">
                                                                    <label for="backup">Ruta Carpeta en Red</label>
                                                                    <input type="text" class="form-control form-control-border" name="backup">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="dia_backup">Día de Backup</label>
                                                                    <input type="text" class="form-control form-control-border" id="dia_backup" name="dia_backup">
                                                                </div>

                                                                <div class="form-group col-md-6">
                                                                    <label for="realiza_backup">¿Realiza Backup en otro equipo?</label>
                                                                    <select class="custom-select form-control-border" id="realiza_backup" name="realiza_backup">
                                                                        <option value="Si">Si</option>
                                                                        <option value="No">No</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-md-12">
                                                                    <label for="justificacion_backup">¿Donde y Por qué?</label>
                                                                    <textarea class="form-control form-control-border textarea" id="justificacion_backup" name="justificacion_backup" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn bg-success" name="guardar_detalles">Guardar Cambiosaa</button>
                                                            </div>
                                                            <?php
                                                            $crearDetalleEquipo = new ControladorActivos();
                                                            $crearDetalleEquipo->ctrCrearDetallesEquipo();
                                                            ?>
                                                        </form>
                                                    </div>

                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<div class="modal fade" id="modal-editar-detalles">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Detalles Equipos Tecnológicos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data" id="formEditarDetallesEquipo">
                    <input type="hidden" id="editar_id_detalle" name="editar_id_detalle">
                    <div class="row">
                        <!-- SOFTWARE -->
                        <div class="col-md-4">
                            <label for="editar_msd" class="form-label">MSD</label>
                            <input type="text" class="form-control form-control-border" id="editar_msd" name="msd" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_antivirus" class="form-label">Antivirus</label>
                            <input type="text" class="form-control form-control-border" id="editar_antivirus" name="antivirus" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_visio_pro" class="form-label">Visio Pro</label>
                            <input type="text" class="form-control form-control-border" id="editar_visio_pro" name="visio_pro" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_mac_osx" class="form-label">Mac OSX</label>
                            <input type="text" class="form-control form-control-border" id="editar_mac_osx" name="mac_osx" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_windows" class="form-label">Windows</label>
                            <input type="text" class="form-control form-control-border" id="editar_windows" name="windows" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_autocad" class="form-label">AutoCAD</label>
                            <input type="text" class="form-control form-control-border" id="editar_autocad" name="autocad" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_office" class="form-label">Microsoft Office</label>
                            <input type="text" class="form-control form-control-border" id="editar_office" name="office" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_appolo" class="form-label">Appolo ZF</label>
                            <input type="text" class="form-control form-control-border" id="editar_appolo" name="appolo" placeholder="N/A">
                        </div>
                        <div class="col-md-4">
                            <label for="editar_zeus" class="form-label">Zeus Tecnologia</label>
                            <input type="text" class="form-control form-control-border" id="editar_zeus" name="zeus" placeholder="N/A">
                        </div>
                        <div class="col-md-12">
                            <label for="editar_otros" class="form-label">Otros</label>
                            <textarea class="form-control textarea" id="editar_otros" name="otros" rows="3"></textarea>
                            <br>
                        </div>

                        <!-- HARDWARE -->
                        <div class="card-header bg-navy col-md-12">
                            <h3 class="card-title">Hardware</h3>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_procesador" class="form-label">Procesador</label>
                            <textarea class="form-control textarea" id="editar_procesador" name="procesador" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_disco_duro" class="form-label">Disco Duro</label>
                            <textarea class="form-control textarea" id="editar_disco_duro" name="disco_duro" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_memoria_ram" class="form-label">Memoria RAM</label>
                            <textarea class="form-control textarea" id="editar_memoria_ram" name="memoria_ram" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_cd_dvd" class="form-label">CD/DVD</label>
                            <textarea class="form-control textarea" id="editar_cd_dvd" name="cd_dvd" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_tarjeta_video" class="form-label">Tarjeta de Video</label>
                            <textarea class="form-control textarea" id="editar_tarjeta_video" name="tarjeta_video" rows="3"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="editar_tarjeta_red" class="form-label">Tarjeta de Red</label>
                            <textarea class="form-control textarea" id="editar_tarjeta_red" name="tarjeta_red" rows="3"></textarea>
                        </div>

                        <!-- SEGURIDAD -->
                        <div class="card-header bg-navy col-md-12">
                            <h3 class="card-title">Seguridad Básica de Equipos</h3>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_tipo_red">Tipo de Red</label>
                            <select class="custom-select form-control-border" id="editar_tipo_red" name="tipo_red">
                                <option value="Cableada">Cableada</option>
                                <option value="Wifi">Wifi</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_usuario">Usuario</label>
                            <select class="custom-select form-control-border" id="editar_usuario" name="usuario">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_clave">Clave</label>
                            <select class="custom-select form-control-border" id="editar_clave" name="clave">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_tiempo_bloqueo">Tiempo de Bloqueo</label>
                            <select class="custom-select form-control-border" id="editar_tiempo_bloqueo" name="tiempo_bloqueo">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_privilegios">Privilegios</label>
                            <select class="custom-select form-control-border" id="editar_privilegios" name="privilegios">
                                <option value="Estandar">Estandar</option>
                                <option value="Administrador">Administrador</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="editar_zfip">Dentro de ZFIP</label>
                            <select class="custom-select form-control-border" id="editar_zfip" name="zfip">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label for="editar_observaciones_equipo" class="form-label">Observaciones del Equipo</label>
                            <textarea class="form-control textarea" id="editar_observaciones_equipo" name="observaciones_equipo" rows="3"></textarea>
                        </div>

                        <!-- COPIAS DE SEGURIDAD -->
                        <div class="card-header bg-navy col-md-12">
                            <h3 class="card-title">Copias de Seguridad</h3>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="editar_backup">Ruta Carpeta en Red</label>
                            <input type="text" class="form-control form-control-border" id="editar_backup" name="backup">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editar_dia_backup">Día de Backup</label>
                            <input type="text" class="form-control form-control-border" id="editar_dia_backup" name="dia_backup">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="editar_realiza_backup">¿Realiza Backup en otro equipo?</label>
                            <select class="custom-select form-control-border" id="editar_realiza_backup" name="realiza_backup">
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="editar_justificacion_backup">¿Donde y Por qué?</label>
                            <textarea class="form-control form-control-border textarea" id="editar_justificacion_backup" name="justificacion_backup" rows="3"></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-success" name="editar_detalles">Guardar Cambios</button>
                    </div>
                    <?php
                    $editarDetalleEquipo = new ControladorActivos();
                    $editarDetalleEquipo->ctrEditarDetallesEquipo();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    document.getElementById("id_activo_fk").addEventListener("change", function() {
        var input = this;
        var datalist = document.getElementById("equipo");
        var opciones = Array.from(datalist.options).map(option => option.value);

        if (!opciones.includes(input.value)) {
            Swal.fire({
                title: "Error",
                text: "El activo seleccionado no es válido.",
                imageUrl: "vistas/img/ti.png",
                imageWidth: 150,
                imageHeight: 150,
                imageAlt: "Error"
            });
            input.value = ""; // Borra el valor no válido
        }
    });
</script>

<script>
    $(document).on('click', '.btnEditarDetalleEquipo', function() {
        $('#modal-editar-detalles').modal('show');
    });

    $('#modal-editar-detalles').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);

        $('#editar_id_detalle').val(button.data('id_detalle'));
        $('#editar_msd').val(button.data('msd'));
        $('#editar_antivirus').val(button.data('antivirus'));
        $('#editar_visio_pro').val(button.data('visio_pro'));
        $('#editar_mac_osx').val(button.data('mac_osx'));
        $('#editar_windows').val(button.data('windows'));
        $('#editar_autocad').val(button.data('autocad'));
        $('#editar_office').val(button.data('office'));
        $('#editar_appolo').val(button.data('appolo'));
        $('#editar_zeus').val(button.data('zeus'));
        $('#editar_otros').summernote('code', button.data('otros') || '');
        $('#editar_procesador').summernote('code', button.data('procesador') || '');
        $('#editar_disco_duro').summernote('code', button.data('disco_duro') || '');
        $('#editar_memoria_ram').summernote('code', button.data('memoria_ram') || '');
        $('#editar_cd_dvd').summernote('code', button.data('cd_dvd') || '');
        $('#editar_tarjeta_video').summernote('code', button.data('tarjeta_video') || '');
        $('#editar_tarjeta_red').summernote('code', button.data('tarjeta_red') || '');
        $('#editar_tipo_red').val(button.data('tipo_red'));
        $('#editar_tiempo_bloqueo').val(button.data('tiempo_bloqueo'));
        $('#editar_usuario').val(button.data('usuario'));
        $('#editar_clave').val(button.data('clave'));
        $('#editar_zfip').val(button.data('zfip'));
        $('#editar_privilegios').val(button.data('privilegios'));
        $('#editar_observaciones_equipo').val(button.data('observaciones_equipo'));
        $('#editar_backup').val(button.data('backup'));
        $('#editar_dia_backup').val(button.data('dia_backup'));
        $('#editar_realiza_backup').val(button.data('realiza_backup'));
        $('#editar_justificacion_backup').summernote('code', button.data('justificacion_backup') || '');
        
    });
</script>