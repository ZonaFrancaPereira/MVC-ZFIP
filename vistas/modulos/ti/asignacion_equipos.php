<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

                <a target='_blank' href="extensiones/tcpdf/pdf/asignacion_equipos.php?id=<?php echo $_SESSION['id']; ?>" class="btn bg-danger">
                    <i class="fas fa-file-pdf"></i> Descargar Asignación
                </a>


            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ASIGNACIÓN DE EQUIPOS</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header border-0 bg-primary">
                        <h3 class="card-title">Dispositivos (Pantallas, Periféricos, otros)</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body table-responsive p-5">

                        <table class="display table table-striped table-valign-middle" width="100%">
                            <thead>
                                <tr style="text-align:center">
                                    <th>Cod</th>
                                    <th>Articulo</th>
                                    <th>Lugar</th>
                                    <th>Condición Articulo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = "id_usuario_fk";
                                $valor = $_SESSION['id'];
                                $activos = ControladorActivos::ctrMostrarEquipos($item, $valor);
                                foreach ($activos as $row) {
                                    echo '<tr style="text-align:center">';
                                    echo '<td>' . $row["id_activo"] . '</td>';
                                    echo '<td>' . $row["nombre_articulo"] . '</td>';
                                    echo '<td>' . $row["lugar_articulo"] . '</td>';
                                    echo '<td>' . $row["condicion_articulo"] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="card">
                    <div class="card-header border-0 bg-primary">
                        <h3 class="card-title">Equipos de Computo</h3>
                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body table-responsive p-5">

                        <table class="display table table-striped table-valign-middle" width="100%">
                            <thead>
                                <tr style="text-align:center">
                                    <th>Cod</th>
                                    <th>Articulo</th>
                                    <th>Lugar</th>
                                    <th>Condición Articulo</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = "id_usuario_fk";
                                $valor = $_SESSION['id'];
                                $consulta ="tabla";
                                $activos = ControladorActivos::ctrMostrarActivosTI($item, $valor, $consulta);
                                foreach ($activos as $row) {
                                    echo '<tr style="text-align:center">';
                                    echo '<td>' . $row["id_activo"] . '</td>';
                                    echo '<td>' . $row["nombre_articulo"] . '</td>';
                                    echo '<td>' . $row["lugar_articulo"] . '</td>';
                                    echo '<td>' . $row["condicion_articulo"] . '</td>';

                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>


