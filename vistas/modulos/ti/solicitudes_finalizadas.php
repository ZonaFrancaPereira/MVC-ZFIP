<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Solicitudes Finalizadas de Soporte</li>
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
                        <h3 class="card-title">Solicitudes </h3>
                    </div>
                    <div class="card-body">
                    <table class="display table table-bordered" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Urgencia</th>
                                    <th>Solucion</th>
                                    <th>Fecha de Respuesta</th>
                                    <th>Tecnico</th>
                                </tr>
                            </thead>
                        
                        <tbody>
                                <?php
                                $item = null;
                                $valor = null;
                                $soportes = ControladorSoporte::ctrMostrarSoporteFinalizadas($item, $valor);
                                foreach ($soportes as $key => $value) {
                                    echo '<tr>
                                    <td>' . $value["id_soporte"] . '</td>
                                    <td>' . $value["fecha_soporte"] . '</td>
                                    <td>' . $value["descripcion_soporte"] . '</td>
                                    <td>';
                                    // Evaluamos la urgencia
                                    if ($value["urgencia"] == "Urgente") {
                                        echo '<span class="badge bg-danger">' . $value["urgencia"] . '</span>';
                                    } elseif ($value["urgencia"] == "Urgencia media") {
                                        echo '<span class="badge bg-warning">' . $value["urgencia"] . '</span>';
                                    } elseif ($value["urgencia"] == "Prioridad baja") {
                                        echo '<span class="badge bg-success">' . $value["urgencia"] . '</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">' . $value["urgencia"] . '</span>';
                                    }
                                    echo '</td>
                                    <td>' . $value["solucion_soporte"] . '</td>
                                    <td>' . $value["fecha_solucion"] . '</td>
                                    <td>' . $value["usuario_respuesta"] . '</td>
                                </tr>';
                                }
                                ?>
                            </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>