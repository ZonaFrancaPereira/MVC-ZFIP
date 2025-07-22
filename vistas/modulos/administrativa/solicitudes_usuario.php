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
<!-- Bootstrap Icons CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<div class="container my-4">

    <!-- Título principal -->
    <h4 class="text-center fw-bold text-primary position-relative d-inline-block mx-auto mb-5" style="font-size: 1.8rem;">
        <i class="bi bi-diagram-3-fill me-2"></i> Estados del Proceso
        <span class="d-block mx-auto mt-2" style="width: 80px; height: 4px; background: linear-gradient(to right, #007bff, #00c6ff); border-radius: 4px;"></span>
    </h4>

    <!-- Tarjetas de estado -->
    <div class="row g-4">

        <!-- Tarjeta Pendiente -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-warning border-3 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-hourglass-split text-warning fs-1"></i>
                    <h5 class="card-title mt-2 text-warning">Pendiente</h5>
                    <p class="card-text text-muted">La solicitud ha sido recibida, pero aún no se ha iniciado el proceso.</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta En Proceso -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-info border-3 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-arrow-repeat text-info fs-1"></i>
                    <h5 class="card-title mt-2 text-info">En Proceso</h5>
                    <p class="card-text text-muted">La solicitud ha sido aceptada por parte del jefe inmediato.</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Aprobada -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-success border-3 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill text-success fs-1"></i>
                    <h5 class="card-title mt-2 text-success">Aprobada</h5>
                    <p class="card-text text-muted">Se han descontado los dias solicitados en la plataforma y en nomina.</p>
                </div>
            </div>
        </div>

        <!-- Tarjeta Rechazada -->
        <div class="col-md-6 col-lg-3">
            <div class="card border-danger border-3 shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="bi bi-x-circle-fill text-danger fs-1"></i>
                    <h5 class="card-title mt-2 text-danger">Rechazada</h5>
                    <p class="card-text text-muted">La solicitud fue evaluada y no cumple con los criterios para su aprobación.</p>
                </div>
            </div>
        </div>


    </div>

    <br>
    <div class="row g-4">
        <div class="col-md-6 col-lg-3">
            <div class="card border-primary border-3 shadow-sm h-100">
                <div class="card-body text-center d-flex flex-column justify-content-between">
                    <div>
                        <i class="bi bi-plus-circle-fill text-primary fs-1"></i>
                        <h5 class="card-title mt-2 text-primary">Solicitar Vacaciones</h5>
                        <p class="card-text text-muted">Haz clic para realizar una solicitud de vacaciones</p>
                    </div>
                    <?php
                    $idUsuario = $_SESSION["id"];
                    ?>

                    <div class="mt-3">
                        <a href="index.php?ruta=gh&id=<?php echo $idUsuario; ?>" target="_blank" class="btn btn-danger btn-sm w-100">
                            <i class="bi bi-pencil-square me-1"></i> Realizar Solicitud
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>



<!-- Bootstrap Icons (CDN, si no lo has incluido aún) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    .custom-table thead {
        background: linear-gradient(to right, #007bff, #00c6ff);
        color: white;
    }

    .estado-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .estado-pendiente {
        background-color: rgb(169, 137, 32);
        color: rgb(246, 246, 246);
    }

    .estado-proceso {
        background-color: #d1ecf1;
        color: rgb(17, 207, 241);
    }

    .estado-aprobada {
        background-color: #d4edda;
        color: rgb(35, 137, 59);
    }

    .estado-rechazada {
        background-color: #f8d7da;
        color: rgb(233, 14, 36);
    }
</style>

<div class="container my-5">
    <div class="card shadow-lg border-0 rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="bi bi-calendar-check-fill me-2"></i>Solicitudes de Vacaciones</h4>
        </div>
        <div class="card-body px-4">
            <div class="table-responsive">
                <table class="table custom-table align-middle text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $item = "id_usuario_fk";
                        $valor = $_SESSION["id"];
                        $usuarios = ControladorAdministrativa::ctrMotrarVacacionesUsuarios($item, $valor);

                        foreach ($usuarios as $usuario) {
                            $estado = strtolower($usuario["estado_solicitud"]);
                            $tagClass = '';
                            $icon = '';

                            switch ($estado) {
                                case 'pendiente':
                                    $tagClass = 'estado-tag estado-pendiente';
                                    $icon = 'bi-hourglass-split';
                                    break;
                                case 'en proceso':
                                    $tagClass = 'estado-tag estado-proceso';
                                    $icon = 'bi-arrow-repeat';
                                    break;
                                case 'aprobada':
                                    $tagClass = 'estado-tag estado-aprobada';
                                    $icon = 'bi-check-circle-fill';
                                    break;
                                case 'rechazada':
                                    $tagClass = 'estado-tag estado-rechazada';
                                    $icon = 'bi-x-circle-fill';
                                    break;
                                default:
                                    $tagClass = 'estado-tag bg-secondary text-white';
                                    $icon = 'bi-question-circle-fill';
                                    break;
                            }

                            echo '
              <tr>
                <td>' . $usuario["id_solicitud"] . '</td>
                <td>' . $usuario["fecha_solicitud"] . '</td>
                <td class="text-start">' . $usuario["descripcion_solicitud"] . '</td>
                <td>
                  <span class="' . $tagClass . '">
                    <i class="bi ' . $icon . '"></i> ' . ucfirst($estado) . '
                  </span>
                </td>
              </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>