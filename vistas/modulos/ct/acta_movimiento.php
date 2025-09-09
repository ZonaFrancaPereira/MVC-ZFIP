<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pt-4">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Acta de Movimiento de Activos Fijos</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">

                                    <div class="card-body table-responsive ">

                                        <table class="display table table-striped table-valign-middle" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo de Movimiento</th>
                                                    <th>Origen / Asignación </th>
                                                    <th>Destino </th>
                                                    <th>Observaciones</th>
                                                    <th>Acta PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $item = "id_usuario_fk";
                                                $valor = $_SESSION['id'];
                                                $activos = ControladorActivos::ctrMostrarActas($item, $valor);

                                                foreach ($activos as $row) {
                                                    echo '<tr style="text-align:center">';
                                                    echo '<td>' . $row["id_acta"] . '</td>';
                                                    echo '<td>' . $row["fecha_acta"] . '</td>';
                                                    echo '<td>' . $row["tipo_acta"] . '</td>';
                                                    echo '<td>' . $row["usuario_origen"] . '</td>';  // Ahora muestra el nombre
                                                    echo '<td>' . $row["usuario_destino"] . '</td>'; // Ahora muestra el nombre
                                                    echo '<td>' . $row["observaciones_acta"] . '</td>';
                                                    echo '<td><a href="extensiones/tcpdf/pdf/actapdf.php?cod=' . $row["id_acta"] . '" target="_blank"><i class="fas fa-file-pdf fa-2x text-danger"></i></a></td>';
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
            </div>
        </div>
    </div>
</section>

solo para el area contable y financiera
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 pt-4">
                <div class="card">
                    <div class="card-header bg-success">
                        <h3 class="card-title">Acta de Movimiento de Activos Fijos - General</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="card">

                                    <div class="card-body table-responsive ">

                                        <table class="display table table-striped table-valign-middle" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Fecha</th>
                                                    <th>Tipo de Movimiento</th>
                                                    <th>Origen / Asignación </th>
                                                    <th>Destino </th>
                                                    <th>Observaciones</th>
                                                    <th>Acta PDF</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $item =null;
                                                $valor = null;
                                                $activos = ControladorActivos::ctrMostrarActas($item, $valor);

                                                foreach ($activos as $row) {
                                                    echo '<tr style="text-align:center">';
                                                    echo '<td>' . $row["id_acta"] . '</td>';
                                                    echo '<td>' . $row["fecha_acta"] . '</td>';
                                                    echo '<td>' . $row["tipo_acta"] . '</td>';
                                                    echo '<td>' . $row["usuario_origen"] . '</td>';  // Ahora muestra el nombre
                                                    echo '<td>' . $row["usuario_destino"] . '</td>'; // Ahora muestra el nombre
                                                    echo '<td>' . $row["observaciones_acta"] . '</td>';
                                                    echo '<td><a href="extensiones/tcpdf/pdf/actapdf.php?cod=' . $row["id_acta"] . '" target="_blank"><i class="fas fa-file-pdf fa-2x text-danger"></i></a></td>';
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
            </div>
        </div>
    </div>
</section>
<!-- /.content -->