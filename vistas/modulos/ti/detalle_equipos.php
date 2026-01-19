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
                                        <?php
                                        $item = null;
                                        $valor = null;

                                        // Llamada al método del controlador para obtener los usuarios
                                        $equipos = ControladorActivos::ctrMostrarAsignaciones($item, $valor);

                                        // Verificar si $usuarios es un array válido

                                        foreach ($equipos as $key => $value) {
                                            echo '<option value="' . htmlspecialchars($value["id"]) . '">' . htmlspecialchars($value["nombre"] . ' ' . $value["apellidos_usuario"]) . '</option>';
                                        }

                                        ?>

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
                                                                    <textarea class="form-control textarea" id="procesador" name="procesador" rows="3">Características:  <hr>
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
                                                                    <label for="justificacion_backup">¿Donde y Por qué</label>
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