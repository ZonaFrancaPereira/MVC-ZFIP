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
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Notificaciones de Solicitudes Laborales</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display table table-striped table-valign-middle" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Elaboración de Contrato</th>
                                        <th>Formulación de Conceptos e Informes</th>
                                        <th>Descripción</th>
                                        <th>Formato</th>
                                        <th>Firmar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $item = null;
                                    $valor = null;
                                    $contrato = ControladorSoporteJuridico::ctrMostrarSolicitudLaboral($item, $valor);
                                    foreach ($contrato as $row) {
                                        if ($row["estado_legal"] == "Revision Gerencia") {
                                            echo '<tr style="text-align:center">';
                                            echo '<td>' . $row["id_soporte_juridico"] . '</td>';
                                            echo '<td>' . $row["fecha_solicitud"] . '</td>';
                                            echo '<td>' . $row["elaboracion_contrato"] . '</td>';
                                            echo '<td>' . $row["formulacion_conceptos"] . '</td>';
                                            echo '<td>' . $row["descripcion_solicitud_juridico"] . '</td>';
                                            echo '<td><a target="_blank" href="extensiones/tcpdf/pdf/sjuridicopdf.php?id=' . $row["id_soporte_juridico"] . '" class="btn btn-outline-info">
                                                    <i class="fas fa-file-signature"></i> Formato
                                                  </a></td>';
                                            echo '<td>
                                                  <a href="#" data-toggle="modal" data-target="#firmagerente" 
                                                     data-id_soporte_juridico="' . $row["id_soporte_juridico"] . '" 
                                                     class="btn btn-outline-info">
                                                     <i class="fas fa-file-signature"></i> Firmar
                                                  </a>
                                                </td>';
                                            echo '</tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="firmagerente" tabindex="-1" role="dialog" aria-labelledby="firmagerenteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="firmagerenteLabel">Firma Documento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-signature"></i> <strong>Instrucciones:</strong> Por favor, firme el documento para completar el proceso, recuerda que debes de tener la firma subida en la plataforma para poder que esta sea asignada manualmente
                </div>
                <form id="firmagerente" method="POST" enctype="multipart/form-data">
                    <!-- Campo que mantienes como id_mantenimiento_equipo -->
                    <input name="id_soporte_gerente" id="id_soporte_gerente" hidden>
                    <input name="estado_legal_gerencia" id="estado_legal_gerencia" value="Proceso" hidden>
                    <div class="form-group">
                        <label for="firma" class="font-weight-bold" hidden>Firma</label>
                        <input type="text" class="form-control" id="firma_gerente" name="firma_gerente" value="<?php echo $_SESSION['foto']; ?>"  hidden>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-signature"></i> Firmar
                    </button>
                    <?php
                    $FirmaGerente = new ControladorSoporteJuridico();
                    $FirmaGerente->ctrFirmaGerente();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Solicitudes Realizadas</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-realizada-juridico" class="table table-bordered table-striped dt-responsive nowrap" style="width:100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Fecha</th>
                                        <th>Elaboración de Contrato</th>
                                        <th>Formulación de Conceptos e Informes</th>
                                        <th>Respuesta de Requerimientos</th>
                                        <th>Descripción</th>
                                        <th>Fecha Solución</th>
                                        <th>Nombre Solución</th>
                                        <th>Solución Jurídico</th>
                                        <th>Estado</th>
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
