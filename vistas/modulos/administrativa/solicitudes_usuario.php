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
                        <h4 class="mb-0">Solicitudes de Vacaciones</h4>
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
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $item = "id_usuario_fk"; // o el nombre real del campo en tu tabla
                                                $valor = $_SESSION["id"];
                                                $usuarios = ControladorAdministrativa::ctrMotrarVacacionesUsuarios($item, $valor);

                                                foreach ($usuarios as $key => $usuario) {
                                                    echo '<tr>
                                                    <td>' . $usuario["id_solicitud"] . '</td>
                                                    <td>' . $usuario["fecha_solicitud"] . '</td>
                                                    <td>' . $usuario["descripcion_solicitud"] . '</td>
                                                    <td>' . $usuario["estado_solicitud"] . '</td>
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
            </div>
        </div>
    </div>
</section>