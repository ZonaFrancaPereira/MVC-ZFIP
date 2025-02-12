<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Solicitudes de Soporte</li>
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
                        <h3 class="card-title">Aceptar Solicitudes Legales</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-aceptar-juridico" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Cargo</th>
                                        <th>Fecha</th>
                                        <th>Proceso</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Formato</th>
                                        <th>Aprobar</th>
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



<section class="content">
    <!-- Modal para cambiar estado de soporte jurídico -->
    <div class="modal fade" id="estadoSoporteModal" tabindex="-1" role="dialog" aria-labelledby="estadoSoporteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="estadoSoporteModalLabel">Cambiar Estado del Soporte Jurídico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="juri" method="POST" enctype="multipart/form-data">
                        <input type="hidden" id="aceptar_solicitud" name="aceptar_solicitud" value="<?php echo $id_soporte_juridico; ?>">
                        <div class="form-group">
                            <label for="estado_legal">Seleccione el nuevo estado</label>
                            <select class="form-control" id="estado_legal" name="estado_legal">
                                <option value="Abierto">Abierta</option>
                                <option value="Rechazado">Rechazada</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="guardarEstadoSoporte">Guardar Cambios</button>
                        </div>
                        <?php
                        $AsignarEstadoJuridico = new ControladorSoporteJuridico();
                        $AsignarEstadoJuridico->ctrAsignarEstadoJuridico();
                        ?>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>