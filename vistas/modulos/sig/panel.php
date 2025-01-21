<?php
// Obtener el ID del usuario desde la sesión
session_start();
$idUsuario = $_SESSION['id'];

// Llamar al método del controlador
$totalACPMs = ControladorACPM::ctrContarACPMs($idUsuario);
$totalACPMsAbiertas = ControladorACPM::ctrContarACPMsAbiertas($idUsuario);
$totalACPMsAbiertaVencida = ControladorACPM::ctrContarACPMsAbiertaVencida($idUsuario);
$totalACPMsProceso = ControladorACPM::ctrContarACPMsProceso($idUsuario);
$totalACPMsCerrada = ControladorACPM::ctrContarACPMsCerrada($idUsuario);
$totalACPMsVerificacion = ControladorACPM::ctrContarACPMsVerificacion($idUsuario);
$totalACPMsRechazada = ControladorACPM::ctrContarACPMsRechazada($idUsuario);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control</title>
</head>

<body>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                ACPM Estadísticas Generales
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-3 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMs; ?>" data-width="90" data-height="90" data-fgColor="#3c8dbc" readonly>

                                    <div class="knob-label">Acpm</div>
                                </div>
                                <!-- ./col -->
                                <div class="col-6 col-md-3 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsAbiertas; ?>" data-width="90" data-height="90" data-fgColor="#00a65a" readonly>

                                    <div class="knob-label">Abierta</div>
                                </div>
                                <div class="col-6 col-md-3 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsAbiertaVencida; ?>" data-min="-150" data-max="150" data-width="90"
                                        data-height="90" data-fgColor="#f56954" readonly>

                                    <div class="knob-label">Abierta Vencida</div>
                                </div>
                                <div class="col-6 col-md-3 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsProceso; ?>" data-width="90" data-height="90" data-fgColor="#fbcb00" readonly>

                                    <div class="knob-label">Proceso</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsCerrada; ?>" data-width="90" data-height="90" data-fgColor="#fb0000" readonly>

                                    <div class="knob-label">Cerrada</div>
                                </div>
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsVerificacion; ?>" data-width="90" data-height="90" data-fgColor="#39CCCC" readonly>

                                    <div class="knob-label">Verificacion</div>
                                </div>
                                <div class="col-4 text-center">
                                    <input type="text" class="knob" value="<?php echo $totalACPMsRechazada; ?>" data-width="90" data-height="90" data-fgColor="#fb00ad" readonly>

                                    <div class="knob-label">Rechazada</div>
                                </div>
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
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Actividades Proximas a Vencer
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                            $actividades = ControladorAcpm::ctrMostrarActividadesVencidas('id_usuario_fk', $_SESSION['id'], 'proximas');

                            if (!empty($actividades)) {
                                echo "<ul class='list-group'>";
                                foreach ($actividades as $actividad) {
                                    echo "
                                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                                        <div>
                                            <i class='fas fa-tasks text-danger'></i>
                                            <strong>{$actividad['descripcion_actividad']}</strong>
                                            <br>
                                            <small class='text-muted'>Fecha Límite: {$actividad['fecha_actividad']}</small>
                                        </div>
                                        <span class='badge badge-danger badge-pill'>Próxima</span>
                                    </li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "
                            <div class='text-center text-muted py-3'>
                                <i class='far fa-folder-open fa-2x'></i>
                                <p class='mt-2'>No hay actividades próximas a vencer.</p>
                            </div>";
                            }
                            ?>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>



</body>

</html>