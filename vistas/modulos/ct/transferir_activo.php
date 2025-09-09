<div class="row">
    <div class="col-lg-12 ">
        <div class="card">
            <div class="card-header border-0 bg-success">
                <h3 class="card-title">Panel de Transferencia de Activos</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body table-responsive pt-2">

                <?php
                $usuarioSeleccionado = isset($_GET["usuario"]) && $_GET["usuario"] !== "" ? $_GET["usuario"] : null;
                $item = null;
                $valor = null;

                // Obtener usuarios
                $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                // Obtener activos solo si se seleccionó un usuario
                $activos = ($usuarioSeleccionado) ? ControladorActivos::obtenerActivosConUsuariosBaja($usuarioSeleccionado) : [];
                ?>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">

                                <!-- Nav Tabs -->
                                <ul class="nav nav-tabs" id="custom-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="traslado-tab" data-toggle="tab" href="#traslado" role="tab" aria-controls="traslado" aria-selected="true">
                                            Gestionar Activos
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="global-tab" data-toggle="tab" href="#global" role="tab" aria-controls="global" aria-selected="false">
                                            Trasferencia Global
                                        </a>
                                    </li>
                                </ul>

                                <!-- Contenido de Tabs -->
                                <div class="tab-content" id="custom-tabs-content">

                                    <!-- Tab de Traslado de Activos -->
                                    <div class="tab-pane fade show active" id="traslado" role="tabpanel" aria-labelledby="traslado-tab">
                                        <div class="card mt-3">
                                            <div class="card-header bg-primary text-white">
                                                <h5 class="mb-0">Traslado de Activos / Baja de Activos</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container mt-4">

                                                    <!-- Formulario para seleccionar usuario -->
                                                    <form method="GET" class="mb-4">
                                                        <div class="form-group">
                                                            <label for="usuario">Seleccionar Usuario:</label>
                                                            <select name="usuario" id="usuario" class="form-control">
                                                                <option value="">-- Seleccione un usuario --</option>
                                                                <?php foreach ($usuarios as $usuario): ?>
                                                                    <option value="<?= $usuario["id"] ?>" <?= ($usuario["id"] == $usuarioSeleccionado) ? "selected" : "" ?>>
                                                                        <?= "{$usuario["nombre"]} {$usuario["apellidos_usuario"]}" ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary mt-2">Filtrar</button>
                                                    </form>

                                                    <!-- Formulario para dar de baja activos -->
                                                    <form method="POST" id="formDarBaja" action="">
                                                        <div class="row">
                                                            <div class="col-md-12 mb-3">
                                                                <label for="activos_baja" class="form-label">Selecciona los activos:</label>
                                                                <select id="activos_baja" name="id_activo[]" multiple class="select2 form-control">
                                                                    <?php foreach ($activos as $activo): ?>
                                                                        <option value="<?= $activo["id_activo"] ?>" data-usuario="<?= $activo["id_usuario_fk"] ?>">
                                                                            <?= "{$activo["id_activo"]} - {$activo["nombre_articulo"]} - {$activo["nombre_usuario"]} {$activo["apellidos_usuario"]}" ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label for="tipo_acta_select" class="form-label">Tipo de Acta:</label>
                                                                <select class="form-control" name="tipo_acta_select" id="tipo_acta_select">
                                                                    <option value="Asignacion">Asignacion permanente del activo</option>
                                                                    <option value="Traslado">Traslado de un activo de un área a otra</option>
                                                                    <option value="Mantenimiento">Traslado por Mantenimiento</option>
                                                                    <option value="Prestamo">Préstamo temporal del activo</option>
                                                                    <option value="Baja">Baja del activo</option>

                                                                </select>
                                                            </div>

                                                            <div class="col-md-12 mb-3">
                                                                <label for="usuario_destino" class="form-label">Usuario Destino:</label>
                                                                <select name="usuario_destino" id="usuario_destino" class="form-control" required>
                                                                    <option value="">-- Seleccione un usuario --</option>
                                                                    <?php foreach ($usuarios as $usuario): ?>
                                                                        <option value="<?= $usuario["id"] ?>">
                                                                            <?= "{$usuario["nombre"]} {$usuario["apellidos_usuario"]}" ?>
                                                                        </option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>

                                                            <!-- Observaciones -->
                                                            <div class="col-md-12 mb-3">
                                                                <label for="observaciones" class="form-label">Observaciones:</label>
                                                                <textarea name="observaciones" class="form-control" required></textarea>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button type="button" id="btnDarBaja" value="1" class="btn bg-success">Terminar Proceso</button>
                                                            </div>
                                                        </div>
                                                    </form>

                                                    <?php
                                                    $transferirActivo = new ControladorActivos();
                                                    $transferirActivo->ctrTransferirActivo();
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tab de Formulario Global -->
                                    <div class="tab-pane fade" id="global" role="tabpanel" aria-labelledby="global-tab">

                                        <div class="card mt-3">
                                            <div class="card-header bg-info text-white">
                                                <h5 class="mb-0">Transferencia Masiva de Activos</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="container mt-4">

                                                    <!-- Formulario Global -->
                                                    <form id="formGlobal" method="post" action="">
                                                        <div class="card card-primary">


                                                            <!-- Cuerpo del formulario -->
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <!-- Usuario Origen -->
                                                                    <div class="form-group col-12 col-md-6">
                                                                        <label for="global_origen">Usuario Origen</label>
                                                                        <select name="global_origen" id="global_origen" class="form-control select2bs4" required>
                                                                            <option value="">-- Seleccione un usuario --</option>
                                                                            <?php foreach ($usuarios as $usuario): ?>
                                                                                <option value="<?= $usuario["id"] ?>">
                                                                                    <?= "{$usuario["nombre"]} {$usuario["apellidos_usuario"]}" ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Usuario Destino -->
                                                                    <div class="form-group col-12 col-md-6">
                                                                        <label for="global_destino">Usuario Destino</label>
                                                                        <select name="global_destino" id="global_destino" class="form-control select2bs4" required>
                                                                            <option value="">-- Seleccione un usuario --</option>
                                                                            <?php foreach ($usuarios as $usuario): ?>
                                                                                <option value="<?= $usuario["id"] ?>">
                                                                                    <?= "{$usuario["nombre"]} {$usuario["apellidos_usuario"]}" ?>
                                                                                </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <!-- Observaciones -->
                                                                <div class="form-group">
                                                                    <label for="observaciones_global">Observaciones</label>
                                                                    <textarea
                                                                        class="form-control"
                                                                        id="observaciones_global"
                                                                        name="observaciones_global"
                                                                        rows="3"
                                                                        placeholder="Agrega observaciones sobre la transferencia"></textarea>
                                                                </div>
                                                            </div>

                                                            <input type="text" name="masivo" value="1">

                                                            <!-- resto del formulario -->
                                                            <div class="card-footer text-right">
                                                                <button type="submit" class="btn bg-primary">
                                                                    <i class="fas fa-exchange-alt"></i> Transferir Activos
                                                                </button>
                                                            </div>


                                                        </div>
                                                    </form>
                                                    <?php
                                                    if (isset($_POST['masivo'])) {
                                                        $transferenciaM = new ControladorActivos();
                                                        $transferenciaM->ctrTransferirActivosUsuarioMasivo();
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- /.tab-content -->
                            </div>
                        </div><!-- /.row -->
                    </div><!-- /.container-fluid -->
                </section><!-- /.content -->

            </div><!-- /.card-body -->
        </div><!-- /.card -->
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->

<script>
    $(document).ready(function() {
        // Inicializar Select2
        $('.select2').select2({
            placeholder: "Selecciona activos",
            allowClear: true,
            width: '100%'
        });
        $("#tipo_acta_select").on("change", function() {
            if ($(this).val() === "Baja") {
                // Ocultar campo de usuario destino
                $("#usuario_destino").closest(".col-md-12").hide();
                $("#usuario_destino").prop("required", false);
            } else {
                // Mostrarlo si es otro tipo de acta
                $("#usuario_destino").closest(".col-md-12").show();
                $("#usuario_destino").prop("required", true);
            }
        }).trigger("change"); // Ejecuta al cargar por si ya viene con valor


        // Evento del botón
        $("#btnDarBaja").on("click", function(e) {
            e.preventDefault();

            let activosSeleccionados = $('#activos_baja').val();
            console.log("Activos seleccionados:", activosSeleccionados);

            if (!activosSeleccionados || activosSeleccionados.length === 0) {
                Swal.fire({
                    icon: "warning",
                    title: "Atención",
                    text: "Debes seleccionar al menos un activo.",
                    confirmButtonColor: "#007bff"
                });
                return;
            }

            // Validar que todos los activos pertenezcan al mismo usuario
            let usuarios = new Set();
            $("#activos_baja option:selected").each(function() {
                let usuario = $(this).attr("data-usuario");
                usuario = usuario ? usuario.toString().trim() : "";
                usuarios.add(usuario);
            });

            console.log("Usuarios detectados:", Array.from(usuarios));

            if (usuarios.size > 1) {
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Todos los activos seleccionados deben pertenecer al mismo usuario.",
                    confirmButtonColor: "#dc3545"
                });
                return;
            }

            // Confirmación con SweetAlert
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta creara un acta para realizar seguimiento a los activos.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, Continuar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formDarBaja").off("submit").submit();
                    // 👆 importante: quitamos el preventDefault antes de enviar
                }
            });
        });

        /** ============================
         *  Inicializar Select2
         *  ============================ */


        /** ============================
         *  Evitar seleccionar el mismo usuario
         *  ============================ */
        $('#global_origen, #global_destino').on('change', function() {
            let origen = $('#global_origen').val();
            let destino = $('#global_destino').val();

            if (origen && destino && origen === destino) {
                Swal.fire({
                    icon: "error",
                    title: "Usuarios inválidos",
                    text: "El usuario de origen y destino no pueden ser el mismo.",
                    confirmButtonColor: "#dc3545"
                });

                // Limpiar automáticamente el campo destino
                $('#global_destino').val(null).trigger('change');
            }
        });

        /** ============================
         *  Validación y confirmación al enviar
         *  ============================ */
        $("#formGlobal").on("submit", function(e) {
            e.preventDefault();

            let usuarioOrigen = $("#global_origen").val();
            let usuarioDestino = $("#global_destino").val();
            let observaciones = $("#observaciones_global").val().trim();

            if (!usuarioOrigen) {
                Swal.fire({
                    icon: "warning",
                    title: "Atención",
                    text: "Debes seleccionar un usuario de origen.",
                    confirmButtonColor: "#007bff"
                });
                return;
            }

            if (!usuarioDestino) {
                Swal.fire({
                    icon: "warning",
                    title: "Atención",
                    text: "Debes seleccionar un usuario de destino.",
                    confirmButtonColor: "#007bff"
                });
                return;
            }

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Se transferirán los activos seleccionados al usuario destino.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Sí, transferir",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#formGlobal")[0].submit();
                }
            });
        });
    });
</script>