<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Nuevo Soporte</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Solicitud Legal- Gestion Juridica</h3>
                    </div>
                    <div class="card-body">
                        <form id="solicitud_juridico" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-6">
                                        <label for="nombre_solicitante">Nombre:</label>
                                        <select id="nombre_solicitante" name="nombre_solicitante" class="form-control" required>
                                            <option value="" disabled selected>Seleccione el responsable</option>
                                            <?php
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios(null, null);
                                            foreach ($usuario as $value) {
                                                echo '<option value="' . $value["id"] . '">' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>


                                    <div class="col-6">
                                        <br>
                                        <label for="correo_solicitante">Correo Electrónico</label>
                                        <input type="text" class="form-control" id="correo_solicitante" name="correo_solicitante" required readonly>
                                    </div>

                                    <div class="col-6">
                                        <br>
                                        <label for="id_cargo_fk1">Cargo</label>
                                        <input type="text" class="form-control" id="id_cargo_fk1" name="id_cargo_fk1" required readonly>
                                    </div>

                                    <div class="col-6">
                                        <br>
                                        <label for="id_proceso_fk1">Proceso</label>
                                        <input type="text" class="form-control" id="id_proceso_fk1" name="id_proceso_fk1" required readonly>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <label for="firma_solicitante" class="font-weight-bold">Firma</label>
                                        <input type="text" class="form-control" id="firma_solicitante" name="firma_solicitante" required>
                                    </div>


                                    <div class="col-6">
                                        <br>
                                        <label for="estado_legal">Estado</label>
                                        <input type="text" class="form-control select2" id="estado_legal" name="estado_legal" required style="width: 100%;"
                                            value="Proceso" readonly> <!-- El nombre del usuario logueado -->
                                    </div>

                                    <!-- Tipo de Solicitud: Elaboración de Contrato -->
                                    <div class="col-md-6">
                                        <label for="elaboracion_contrato" class="form-label text-primary fw-bold">
                                            Elaboración de Contrato
                                        </label>
                                        <p class="text-muted small">Indique el tipo de contrato requerido:</p>
                                        <select class="form-control form-select" id="elaboracion_contrato" name="elaboracion_contrato" required>
                                            <?php
                                            $contrato = ControladorSoporteJuridico::ctrMostrarElaboracionContrato($item, $valor);
                                            if (!empty($contrato)) {
                                                foreach ($contrato as $value) {
                                                    echo '<option value="' . $value['tipo_contrato'] . '">' . $value['tipo_contrato'] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay contratos disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Tipo de Solicitud: Formulación de Conceptos -->
                                    <div class="col-md-6">
                                        <label for="formulacion_conceptos" class="form-label text-primary fw-bold">
                                            Formulación de Conceptos e Informes
                                        </label>
                                        <p class="text-muted small">Indique el área de derecho aplicable:</p>
                                        <select class="form-control form-select" id="formulacion_conceptos" name="formulacion_conceptos" required>
                                            <?php
                                            $conceptos = ControladorSoporteJuridico::ctrMostrarFormulacionConceptos($item, $valor);
                                            if (!empty($conceptos)) {
                                                foreach ($conceptos as $value) {
                                                    echo '<option value="' . $value['formulacion_conceptos'] . '">' . $value['formulacion_conceptos'] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay conceptos disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>



                                    <!-- Tipo de Solicitud: Respuesta de Requerimientos -->
                                    <div class="col-md-6">
                                        <label for="respuesta_requerimientos" class="form-label text-primary fw-bold">
                                            Respuesta de Requerimientos
                                        </label>
                                        <p class="text-muted small">Indique la entidad que emite el acto:</p>
                                        <select class="form-control form-select" id="respuesta_requerimientos" name="respuesta_requerimientos" required>
                                            <?php
                                            $requerimientos = ControladorSoporteJuridico::ctrMostrarRespuestaRequerimientos($item, $valor);
                                            if (!empty($requerimientos)) {
                                                foreach ($requerimientos as $value) {
                                                    echo '<option value="' . $value['nombre_requerimiento'] . '">' . $value['nombre_requerimiento'] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">No hay requerimientos disponibles</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <label for="respuesta_requerimientos" class="form-label text-primary fw-bold">
                                            ANEXOS
                                        </label>
                                        <p class="text-muted small"> (información adicional, breve detalle de la información solicitada, documentos adjuntos)</p>
                                        <textarea class="textarea form-control" id="descripcion_solicitud_juridico" name="descripcion_solicitud_juridico" rows="4" placeholder="Descripción"
                                            style=" width: 100%;padding: 15px;border-radius: 8px; border: 2px solid #17a2b8; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); resize: vertical; transition: border-color 0.3s ease, box-shadow 0.3s ease;"></textarea>
                                    </div>
                                    <div class="col-md-12 mt-4">
                                        <label for="respuesta_requerimientos" class="form-label text-primary fw-bold">
                                            OBSERVACIONES Y/O OTRAS
                                        </label>
                                        <p class="text-muted small"> Descripcion (breve detalle de su solicitud)</p>
                                        <textarea class="textarea form-control" id="observaciones" name="observaciones" rows="4" placeholder="Descripción"
                                            style=" width: 100%;padding: 15px;border-radius: 8px; border: 2px solid #17a2b8; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); resize: vertical; transition: border-color 0.3s ease, box-shadow 0.3s ease;"></textarea>
                                    </div>

                                </div> <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-warning btn-block" id="enviar_soporte_juridico" name="enviar_soporte_juridico"><i class="fas fa-paper-plane"></i>Enviar</button>
                                </div>
                                <?php
                                $SoporteJuridico = new ControladorSoporteJuridico();
                                $SoporteJuridico->ctrCrearSoporteJuridico();
                                ?>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
<script>
    $(document).ready(function() {
        $("#nombre_solicitante").change(function() {
            let idUsuario = $(this).val();

            $.ajax({
                type: "POST",
                url: "controladores/juridico.controlador.php", // Llamada directa al controlador
                data: {
                    idUsuario: idUsuario
                },
                dataType: "json",
                success: function(response) {
                    if (response) {
                        $("#correo_solicitante").val(response.correo_usuario);
                        $("#id_cargo_fk1").val(response.id_cargo_fk);
                        $("#id_proceso_fk1").val(response.id_proceso_fk);
                        $("#firma_solicitante").val(response.foto); // La firma está en el campo 'foto'
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la petición AJAX: ", error);
                }
            });
        });
    });

    $(document).ready(function() {
        $("#elaboracion_contrato, #formulacion_conceptos").change(function() {
            let elaboracionContrato = $("#elaboracion_contrato").val();
            let formulacionConceptos = $("#formulacion_conceptos").val();

            if (elaboracionContrato === "Laboral" || formulacionConceptos === "Laboral") {
                $("#estado_legal").val("Revision Gerencia");
                $("#firma_solicitante").val("vistas/img/usuarios/default/sinautorizar.png");
            } else {
                $("#estado_legal").val("Proceso");
            }
        });
    });
</script>