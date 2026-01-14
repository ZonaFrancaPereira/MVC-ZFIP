<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Nuevo Soporte</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="active nav-link" href="#soporte_ti" data-toggle="tab">Solicitudes de Soporte</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#instrucciones_ti" data-toggle="tab">Tiempos de Respuesta</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- TAB PARA ACTUALIZAR LAS CONTRASEÑAS -->
                            <div class="tab-pane active" id="soporte_ti">
                                <div class="card">
                                    <div class="col-md-12">

                                        <div class="card-header bg-info">
                                            <h3 class="card-title">Solicitud de Soporte</h3>
                                        </div>
                                        <div class="card-body">
                                            <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                                            <table class="display table table-bordered" width="100%">
                                                <thead class="bg-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Fecha</th>
                                                        <th>Descripción</th>
                                                        <th>Urgencia</th>
                                                        <th>Solución</th>
                                                        <th>Fecha de Respuesta</th>
                                                        <th>Técnico</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $item = null;
                                                    $valor = null;
                                                    $soportes = ControladorSoporte::ctrMostrarSoporteFinalizadasUsuario($item, $valor);
                                                    foreach ($soportes as $key => $value) {
                                                        echo '<tr>
                                                                <td>' . $value["id_soporte"] . '</td>
                                                                <td>' . $value["fecha_soporte"] . '</td>
                                                                <td>' . $value["descripcion_soporte"] . '</td>
                                                                <td>
                                                            ';
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

                                        </div><!-- /.card-body -->

                                    </div><!-- /.col -->
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- TAB PARA CONSULTAR LAS CONTRASEÑAS -->
                            <div class="tab-pane" id="instrucciones_ti">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card card-default">
                                                    <div class="card-header bg-gradient-info">
                                                        <h3 class="card-title text-white">
                                                            <i class="fas fa-bullhorn mr-2"></i>
                                                            Escala de Urgencia
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="alert bg-danger text-center">
                                                                    <h4 class="mb-0">1</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="alert bg-danger">
                                                                    <p class="mb-0">Urgente: se tendrá máximo un día para ser atendidas</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="alert bg-warning text-center">
                                                                    <h4 class="mb-0">2</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="alert bg-warning">
                                                                    <p class="mb-0">Urgencia media: tendrán 2 días para ser cerradas</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="alert bg-success text-center">
                                                                    <h4 class="mb-0">3</h4>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="alert bg-success">
                                                                    <p class="mb-0">Prioridad baja: tendrán 4 días para su cierre</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card card-default">
                                                    <div class="card-header bg-gradient-info">
                                                        <h3 class="card-title text-white">
                                                            <i class="fas fa-exclamation-triangle mr-2"></i>
                                                            Respuesta
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="alert bg-danger">
                                                            <h5 class="mb-3"><i class="icon fas fa-ban"></i> Urgente!</h5>
                                                            <p>Solicitudes que requieren atención inmediata debido a que afectan significativamente la productividad del proceso y pueden causar interrupciones graves si no se abordan de inmediato.</p>
                                                        </div>
                                                        <div class="alert bg-warning">
                                                            <h5 class="mb-3"><i class="icon fas fa-info"></i> Urgencia media!</h5>
                                                            <p>Solicitudes que son importantes para mantener la eficiencia del proceso y que, si no se atienden oportunamente, podrían generar problemas a medio plazo.</p>
                                                        </div>
                                                        <div class="alert bg-success">
                                                            <h5 class="mb-3"><i class="icon fas fa-exclamation-triangle"></i> Prioridad baja!</h5>
                                                            <p>Solicitudes que tienen cierta importancia pero que no tienen un impacto inmediato en la productividad del proceso. Se pueden abordar en un plazo razonable sin causar grandes inconvenientes.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>

                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

    </div>
</section>