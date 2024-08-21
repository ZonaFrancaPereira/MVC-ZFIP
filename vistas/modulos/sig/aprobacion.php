<!-- Sección de Encabezado de Contenido -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Aprobar ACPM</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Aprobar ACPM</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Contenido Principal -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">ACPM</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-aprobar-sig" class="table table-bordered table-striped dt-responsive" width="100%">
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
                                    <th>Aprobar</th>
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
    <div class="modal fade" id="modal-aprobar">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Aprobar ACPM</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" id="form_aprobar_acpm">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white" hidden>
                                <h5 class="card-title mb-0">ID de Soporte:</h5>
                                <input type="text" class="form-control mb-3" value="" id="id_consecutivo" name="id_consecutivo" readonly>
                            </div>
                            <div class="card-body">
                                <label for="estado_acpm">Estado</label>
                                <select id="estado_acpm" name="estado_acpm" class="form-control">
                                    <option value="Abierta">Abierta</option>
                                    <option value="Rechazada">Rechazar</option>
                                    <!-- Agrega más opciones según sea necesario -->
                                </select>

                                <!-- Textarea para rechazar, inicialmente oculto -->
                                <div id="motivo_rechazo_container" style="display: none; margin-top: 15px;">
                                    <label for="motivo_rechazo">Motivo de Rechazo</label>
                                    <textarea id="motivo_rechazo" name="motivo_rechazo" class="form-control" rows="4" placeholder="Ingrese el motivo del rechazo"></textarea>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            </div>
                        </div>
                        <?php
            $aprobarAcpm = new ControladorAcpm();
            $aprobarAcpm->ctrAprobarAcpm();
            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

