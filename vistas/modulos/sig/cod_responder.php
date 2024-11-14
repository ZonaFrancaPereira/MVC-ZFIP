<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Responder Solicitud</li>
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
                        <h3 class="card-title">Responder Solicitud</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-cod-responder" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Vigencia</th>
                                        <th>Fecha de Solicitud</th>
                                        <th>Solicitante</th>
                                        <th>Responder</th>
                                        <th>Formato</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /RESPUESTA CODIFICACION -->
<section class="content">
    <div class="modal fade" id="modal-cod_realizadas">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Respuesta a Solicitud de Codificación</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_modificar_sig" method="POST" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-header">
                                <label>¿Desea dar respuesta a la siguiente solicitud de codificación?</label>
                                <input type="text" class="form-control" name="id_codificar" id="id_codificar" readonly>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <select class="form-control select2" style="width: 100%;" id="estado_sig_codificacion" name="estado_sig_codificacion">
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Rechazado">Rechazado</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="date" name="fecha_sig_codificacion" class="form-control" id="fecha_sig_codificacion" required>
                                </div>

                                <div class="form-group">
                                    <label>Responsable</label>
                                    <input type="text" name="responsable_sig_codificacion" class="form-control" id="responsable_sig_codificacion" value="Yuly Viviana Rios" readonly>
                                </div>

                                <!-- Campo Descripción del Rechazo que se oculta por defecto -->
                                <div class="form-group" id="rechazo_section" style="display: none;">
                                    <label>Descripción del Rechazo</label>
                                    <textarea class="form-control" id="causa_rechazo_codificacion" name="causa_rechazo_codificacion" rows="3" placeholder="Descripción"></textarea>
                                </div>

                                <div class="form-group" id="evidencia_difucion_container" style="display: none;">
                                    <label>Evidencia de Difusión</label>
                                    <textarea class="form-control" id="evidencia_difucion" name="evidencia_difucion"></textarea>
                                </div>


                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-info btn-block" id="respuesta_codificacion_sig" name="respuesta_codificacion_sig">Responder</button>
                                </div>
                            </div>
                        </div>
                        <?php

                        $Responder_Solicitud = new ControladorCodificar();
                        $Responder_Solicitud->ctrIngresarRespuestaCodificacion();

                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>