<ul class="nav nav-tabs" id="actasTabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pendientes-tab" data-toggle="tab" href="#pendientes" role="tab">
            🟡 Actas por Aprobar
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="aprobadas-tab" data-toggle="tab" href="#aprobadas" role="tab">
            🟢 Actas Aprobadas
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="aprobadas-CT" data-toggle="tab" href="#aprobadasCT" role="tab">
            🟢 Actas ZFIP
        </a>
    </li>
</ul>
<div class="tab-content mt-3">

    <!-- TAB PENDIENTES -->
    <div class="tab-pane fade show active" id="pendientes" role="tabpanel">
        <?php
        $item = "usuario_destino";
        $valor = $_SESSION['id']; // o ID si lo manejas así
        $estado = "Pendiente";

        $activosPendientes = ControladorActivos::ctrMostrarActasPorEstado($item, $valor, $estado);
        ?>

        <!-- AQUÍ VA LA TABLA DE ACTAS PENDIENTES -->
        <table class="display table table-striped table-valign-middle" width="100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Observaciones</th>
                    <th>Acta PDF</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activosPendientes as $rowp): ?>
                    <tr style="text-align:center">
                        <td><?= $rowp["id_acta"] ?></td>
                        <td><?= $rowp["fecha_acta"] ?></td>
                        <td><?= $rowp["tipo_acta"] ?></td>
                        <td><?= $rowp["usuario_origen"] ?></td>
                        <td><?= $rowp["usuario_destino"] ?></td>
                        <td><?= $rowp["observaciones_acta"] ?></td>
                        <td>
                            <a href="extensiones/tcpdf/pdf/actapdf.php?cod=<?= $rowp["id_acta"] ?>" target="_blank">
                                <i class="fas fa-file-pdf fa-2x text-danger"></i>
                            </a>
                        <td>
                            <form method="post" class="formAprobarActa" style="display:inline">
                                <input type="hidden" name="idActa" value="<?= $rowp['id_acta'] ?>">
                                <input type="hidden" name="aprobarActa" value="1">

                                <button type="submit" class="btn btn-success btn-sm" title="Aprobar">
                                    <i class="fas fa-check"></i>
                                </button>
                                <?php
                                $aprobarActa = new ControladorActivos();
                                $aprobarActa->ctrAprobarActa();
                                ?>
                            </form>


                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <!-- TAB APROBADAS -->
    <div class="tab-pane fade" id="aprobadas" role="tabpanel">

        <!-- AQUÍ VA LA TABLA DE ACTAS APROBADAS -->

        <!-- Main content -->
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
                                <div class="table-responsive">
                                    <table class="display table table-striped table-valign-middle" width="100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha</th>
                                                <th>Tipo</th>
                                                <th>Origen</th>
                                                <th>Destino</th>
                                                <th>Observaciones</th>
                                                <th>Estado</th>
                                                <th>Acta PDF</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $item = "id_usuario_fk";
                                            $valor = $_SESSION['id'];
                                            $activos = ControladorActivos::ctrMostrarActas($item, $valor);

                                            foreach ($activos as $row) {

                                                $estado = $row["estado_aprobacion"];

                                                switch ($estado) {
                                                    case 'Pendiente':
                                                        $badge = '<span class="badge badge-warning">Pendiente</span>';
                                                        break;

                                                    case 'Aprobado':
                                                        $badge = '<span class="badge badge-success">Aprobado</span>';
                                                        break;

                                                    case 'Rechazado':
                                                        $badge = '<span class="badge badge-danger">Rechazado</span>';
                                                        break;

                                                    default:
                                                        $badge = '<span class="badge badge-secondary">Desconocido</span>';
                                                        break;
                                                }

                                                echo '<tr style="text-align:center">';
                                                echo '<td>' . $row["id_acta"] . '</td>';
                                                echo '<td>' . $row["fecha_acta"] . '</td>';
                                                echo '<td>' . $row["tipo_acta"] . '</td>';
                                                echo '<td>' . $row["usuario_origen"] . '</td>';
                                                echo '<td>' . $row["usuario_destino"] . '</td>';
                                                echo '<td>' . $row["observaciones_acta"] . '</td>';
                                                echo '<td>' . $badge . '</td>';


                                                echo '<td>
                                                    <a href="extensiones/tcpdf/pdf/actapdf.php?cod=' . $row["id_acta"] . '" target="_blank">
                                                        <i class="fas fa-file-pdf fa-2x text-danger"></i>
                                                    </a>
                                                  </td>';


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



        <!-- /.content -->
    </div>
    <!-- TAB APROBADAS -->
    <div class="tab-pane fade" id="aprobadasCT" role="tabpanel">

        <!-- AQUÍ VA LA TABLA DE ACTAS APROBADAS -->
        <?php
        $cargosLideres = [1, 2, 12, 13];

        if (in_array($_SESSION['id_cargo_fk'], $cargosLideres)) {
            // aquí va el botón, acción o contenido

        ?>
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
                                                                <th>Estado</th>
                                                                <th>Acta PDF</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $item = null;
                                                            $valor = null;
                                                            $activos = ControladorActivos::ctrMostrarActas($item, $valor);

                                                            foreach ($activos as $row) {
                                                                $estado = $row["estado_aprobacion"];

                                                                switch ($estado) {
                                                                    case 'Pendiente':
                                                                        $badge = '<span class="badge badge-warning">Pendiente</span>';
                                                                        break;

                                                                    case 'Aprobado':
                                                                        $badge = '<span class="badge badge-success">Aprobado</span>';
                                                                        break;

                                                                    case 'Rechazado':
                                                                        $badge = '<span class="badge badge-danger">Rechazado</span>';
                                                                        break;

                                                                    default:
                                                                        $badge = '<span class="badge badge-secondary">Desconocido</span>';
                                                                        break;
                                                                }
                                                                echo '<tr style="text-align:center">';
                                                                echo '<td>' . $row["id_acta"] . '</td>';
                                                                echo '<td>' . $row["fecha_acta"] . '</td>';
                                                                echo '<td>' . $row["tipo_acta"] . '</td>';
                                                                echo '<td>' . $row["usuario_origen"] . '</td>';  // Ahora muestra el nombre
                                                                echo '<td>' . $row["usuario_destino"] . '</td>'; // Ahora muestra el nombre
                                                                echo '<td>' . $row["observaciones_acta"] . '</td>';
                                                                echo '<td>' . $badge . '</td>';
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
        <?php
        }
        ?>
    </div>

</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Default Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<script>
    document.querySelectorAll('.formAprobarActa').forEach(form => {

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: '¿Aprobar acta?',
                text: 'Esta acción no se puede deshacer',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, aprobar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

    });
</script>