<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Vacaciones</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Aprobar Vacaciones</h4>
                    </div>
                    <div class="card-body">
                        <div class="row justify-content-center mt-4">
                            <div class="col-md-12">
                                    <div class="card-body">
                                        <table class="display table table-bordered" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha de la Solicitud</th>
                                                    <th>Descripcion de la Solicitud</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $item = null;
                                                $valor = null;
                                                $usuarios = ControladorAdministrativa::ctrMotrarSolicitudesVacaciones($item, $valor);
                                                foreach ($usuarios as $key => $usuario) {
                                                    echo '<tr>
                                                    <td>' . $usuario["id_solicitud"] . '</td>
                                                    <td>' . $usuario["fecha_solicitud"] . '</td>
                                                    <td>' . $usuario["descripcion_solicitud"] . '</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-Aprobar" 
                                                        data-id_solicitud="' . $usuario["id_solicitud"] . '">Aprobar</button>

                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-Rechazar" 
                                                        data-id_solicitud_rechazo="' . $usuario["id_solicitud"] . '" >Rechazar</button>

                                                        <a target="_blank" href="extensiones/tcpdf/pdf/administrativapdf.php?id=' . $usuario["id_solicitud"] . '" class="btn btn-success btn-sm"><i class="fas fa-file-signature"></i> Formato</a>
                                                    </td>
                                                </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Modal Aprobar Solicitud -->
                                    <div class="modal fade" id="modal-Aprobar" tabindex="-1" role="dialog" aria-labelledby="modalAprobarLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-gradient-primary text-white">
                                                    <h5 class="modal-title" id="modalAprobarLabel">
                                                        <i class="fas fa-check-circle mr-2"></i>Confirmar Aprobación
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" id="formAprobarSolicitud" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="" id="id_solicitud" name="id_solicitud">
                                                        <div class="form-group">
                                                            <label for="firma" class="font-weight-bold" hidden>Firma</label>
                                                            <input type="text" class="form-control" id="firma_aprobador" name="firma_aprobador" value="<?php echo $_SESSION['foto']; ?>" required style="background-color: #f8f9fa; border-radius: 5px; border: 1px solid #ced4da;" >
                                                        </div>
                                                        <div class="text-center mb-3">
                                                            <i class="fas fa-user-check fa-3x text-success mb-2"></i>
                                                            <h6 class="font-weight-bold">¿Está seguro que desea aprobar esta solicitud de vacaciones?</h6>
                                                            <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                                                            <i class="fas fa-times mr-1"></i>Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-success px-4">
                                                            <i class="fas fa-check mr-1"></i>Aprobar
                                                        </button>
                                                    </div>
                                                    <?php
                                                    $aprobarVacaciones = new ControladorAdministrativa();
                                                    $aprobarVacaciones->ctrAprobarSolicitud();
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Rechazar Solicitud -->
                                    <div class="modal fade" id="modal-Rechazar" tabindex="-1" role="dialog" aria-labelledby="modalRechazarLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content border-0 shadow-lg">
                                                <div class="modal-header bg-gradient-danger text-white">
                                                    <h5 class="modal-title" id="modalRechazarLabel">
                                                        <i class="fas fa-times-circle mr-2"></i>Confirmar Rechazo
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="POST" id="formRechazarSolicitud" enctype="multipart/form-data" >
                                                    <div class="modal-body">
                                                        <input type="hidden" id="id_solicitud_rechazo" name="id_solicitud_rechazo">
                                                        <div class="text-center mb-3">
                                                            <i class="fas fa-user-times fa-3x text-danger mb-2"></i>
                                                            <h6 class="font-weight-bold">¿Está seguro que desea rechazar esta solicitud de vacaciones?</h6>
                                                            <p class="text-muted mb-0">Esta acción no se puede deshacer.</p>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="observaciones_solicitud" class="font-weight-bold">Motivo del rechazo</label>
                                                            <textarea class="form-control" id="observaciones_solicitud" name="observaciones_solicitud" rows="3" required placeholder="Ingrese el motivo del rechazo"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                                                            <i class="fas fa-times mr-1"></i>Cancelar
                                                        </button>
                                                        <button type="submit" class="btn btn-danger px-4">
                                                            <i class="fas fa-times-circle mr-1"></i>Rechazar
                                                        </button>
                                                    </div>
                                                     <?php
                                                    $RechazarVacaciones = new ControladorAdministrativa();
                                                    $RechazarVacaciones->ctrRechazarSolicitud();
                                                    ?>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                            

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>