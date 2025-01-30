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
                                        echo '<tr style="text-align:center">';
                                        echo '<td>' . $row["id_soporte_juridico"] . '</td>';
                                        echo '<td>' . $row["fecha_solicitud"] . '</td>';
                                        echo '<td>' . $row["elaboracion_contrato"] . '</td>';
                                        echo '<td>' . $row["formulacion_conceptos"] . '</td>';
                                        echo '<td>' . $row["descripcion_solicitud_juridico"] . '</td>';
                                        echo '<td><a target="_blank" href="extensiones/tcpdf/pdf/sjuridicopdf.php?id=' . $row["id_soporte_juridico"] . '" class="btn btn-outline-info">
                                                <i class="fas fa-file-signature"></i> Formato
                                              </a></td>';
                                              echo '<td><a target="_blank" class="btn btn-outline-info">
                                              <i class="fas fa-file-signature"></i> Firmar
                                            </a></td>';
                                        echo '</tr>';
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
