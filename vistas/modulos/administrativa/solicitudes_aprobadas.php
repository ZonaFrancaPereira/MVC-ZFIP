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
                        <h4 class="mb-0">Solicitudes Aprobadas</h4>
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
                                                    <th hidden>id detalle vacaciones</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $item = null;
                                                $valor = null;
                                                $usuarios = ControladorAdministrativa::ctrMotrarVacacionesAprobadas($item, $valor);
                                                foreach ($usuarios as $key => $usuario) {
                                                    echo '<tr>
                                                    <td>' . $usuario["id_solicitud"] . '</td>
                                                    <td>' . $usuario["fecha_solicitud"] . '</td>
                                                    <td>' . $usuario["descripcion_solicitud"] . '</td>
                                                    <td hidden>' . $usuario["id_detalle_vacaciones_fk"] . '</td>
                                                    <td>
                                                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-Descontar" 
                                                        data-id_descuento="' . $usuario["id_solicitud"] . '" data-id_detalle_vacaciones="' . $usuario["id_detalle_vacaciones_fk"] . '">Descontar Dias</button>

                                                        <a target="_blank" href="extensiones/tcpdf/pdf/administrativapdf.php?id=' . $usuario["id_solicitud"] . '" class="btn btn-success btn-sm"><i class="fas fa-file-signature"></i> Formato</a>
                                                    </td>
                                                </tr>';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Modal Aprobar Solicitud -->
                                    <div class="modal fade" id="modal-Descontar" tabindex="-1" role="dialog" aria-labelledby="modalDescontarLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content border-0 shadow-lg">
                                            <div class="modal-header bg-gradient-primary text-white">
                                                <h5 class="modal-title" id="modalDescontarLabel">
                                                    <i class="fas fa-check-circle mr-2"></i>Descontar Días de Vacaciones
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form method="POST" id="formDescontarDias" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="form-group" hidden>
                                                        <label for="">ID detalle vacaciones</label>
                                                        <input type="text" class="form-control" id="id_detalle_vacaciones" name="id_detalle_vacaciones" placeholder="Ingrese el ID correspondiente" required>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="dias_descuento">Días a descontar</label>
                                                        <input type="number" class="form-control" id="dias_descuento" name="dias_descuento" placeholder="Ingrese los días a descontar" required min="1">
                                                    </div>
                                                </div>

                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn-outline-secondary px-4" data-dismiss="modal">
                                                        <i class="fas fa-times mr-1"></i>Cancelar
                                                    </button>
                                                    <button type="submit" class="btn btn-success px-4">
                                                        <i class="fas fa-check mr-1"></i>Descontar Días
                                                    </button>
                                                </div>

                                                <?php
                                                $descontarDias = new ControladorAdministrativa();
                                                $descontarDias->ctrDescontarDias();
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