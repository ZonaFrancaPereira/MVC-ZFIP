<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Aceptar ACPM </li>
                </ol>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Aceptar ACPM
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-aceptar-sig" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre del responsable</th>
                                    <th>Origen ACPM</th>
                                    <th>Fuente</th>
                                    <th>Tipo de Reporte</th>
                                    <th>Descripción ACPM</th>
                                    <th>Fecha Finalización</th>
                                    <th>Estado</th>
                                    <th>Informe</th>
                                    <th>Respuesta</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="modal fade" id="modal-unificado">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h4 class="modal-title">
                        <i class="fas fa-tasks"></i> Acción ACPM
                    </h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body p-4">
                    <form method="POST" enctype="multipart/form-data" id="form_acpm_accion">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-exchange-alt text-danger"></i> Seleccione una Acción</h5>
                                <select id="accion_acpm" name="accion_acpm" class="form-control w-50">
                                    <option value="">Seleccione una Opción</option>
                                    <option value="eficacia">Eficacia</option>
                                    <option value="rechazo">Rechazo</option>
                                </select>
                            </div>
                            <div class="card-body">

                                <!-- Sección de Eficacia -->
                                <div id="seccion-eficacia" class="p-3 border rounded bg-light" style="display: none;">
                                    <h5 class="text-info"><i class="fas fa-check-circle"></i> Eficacia</h5>
                                    <hr>
                                    <input type="text" name="id_acpm_fk_sig1" id="id_acpm_fk_sig1" hidden>
                                    <div class="form-group">
                                        <label>¿Es Conforme?</label>
                                        <select class="form-control" id="riesgo_acpm" name="riesgo_acpm" >
                                            <option value="">Selecciona una Opción</option>
                                            <option value="Si">SI</option>
                                            <option value="No">NO</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Justifique por qué es o no es conforme</label>
                                        <textarea id="justificacion_riesgo" name="justificacion_riesgo" class="form-control" rows="3" ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>¿Existe la necesidad de actualizar los riesgos y oportunidades actuales?</label>
                                        <select class="form-control" id="cambios_sig" name="cambios_sig" >
                                            <option value="">Selecciona una Opción</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>¿Cuáles riesgos u oportunidades se deben contemplar?</label>
                                        <textarea id="justificacion_sig" name="justificacion_sig" class="form-control" rows="3" ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>¿Es necesario hacer cambios al sistema de gestión?</label>
                                        <select class="form-control" id="conforme_sig" name="conforme_sig" >
                                            <option value="">Selecciona una Opción</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>¿Qué cambios se deben contemplar y documentar?</label>
                                        <textarea id="justificacion_conforme_sig" name="justificacion_conforme_sig" class="form-control" rows="3" ></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fecha_estado_sig">Fecha de Verificación</label>
                                        <input type="date" name="fecha_estado" class="form-control" id="fecha_estado_sig" >
                                    </div>
                                </div>

                                <!-- Sección de Rechazo -->
                                <div id="seccion-rechazo" class="p-3 border rounded bg-light" style="display: none;">
                                    <h5 class="text-danger"><i class="fas fa-times-circle"></i> Rechazo</h5>
                                    <hr>
                                    <input type="text" name="id_acpm_fk_sig1" id="id_acpm_fk_sig1" hidden>
                                    <div class="form-group">
                                        <label>Describa el porqué del rechazo</label>
                                        <textarea id="descripcion_rechazo" name="descripcion_rechazo" class="form-control" rows="4" ></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end bg-light">
                                <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                        <?php
                        $cerrar = new ControladorAcpm();
                        $cerrar->ctrGuardarAccion();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script>

</script>