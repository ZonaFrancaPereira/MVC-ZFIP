<!-- Main content -->
<section class="content pt-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h3 class="card-title">Inventario de Activos Fijos</h3>
                    </div>
                    <div class="card-body row">
                        <?php
                        $ctrInventario = new ControladorInventario();

                        // Obtener todas las verificaciones asociadas al inventario abierto actualmente
                        $id_inventario_abierto = $ctrInventario->ctrVerificarInventarioAbierto();

                        if ($id_inventario_abierto) {
                            echo '<div class="alert alert-warning alert-dismissible col-md-12">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-exclamation-triangle"></i> Atención!</h5>
                                Actualmente, existe un inventario en proceso. Debe finalizar el inventario actual antes de poder iniciar uno nuevo. Por favor, complete todas las verificaciones y cierre el inventario en curso para proceder con la apertura de un nuevo inventario. Si necesita ayuda, consulte con el administrador del sistema..
                                </div>';
                        } else { ?>
                            <div id="nuevo_inventario" class="col-md-12">
                                <div class="alert bg-navy text-center shadow-sm">
                                    <h5 class="mb-3">
                                        <i class="fas fa-exclamation-triangle text-warning"></i>
                                        <strong>No hay inventarios abiertos</strong>
                                    </h5>
                                    <p class="mb-3">
                                        Puede iniciar un nuevo inventario completando el siguiente formulario:
                                    </p>

                                    <!-- Formulario -->
                                    <form method="post" id="formNuevoInventario" class="form-row justify-content-center">

                                        <!-- Fecha de apertura -->
                                        <div class="col-md-4 col-sm-12 mb-2">
                                            <label for="fecha_apertura" class="sr-only">Fecha de Apertura</label>
                                            <input
                                                type="date"
                                                class="form-control"
                                                id="fecha_apertura"
                                                name="fecha_apertura"
                                                required>
                                        </div>

                                        <!-- Botón -->
                                        <div class="col-md-2 col-sm-12 mb-2">
                                            <button type="submit" class="btn bg-success btn-block" name="abrir_inventario">
                                                <i class="fas fa-folder-open"></i> Abrir Inventario
                                            </button>
                                        </div>
                                    </form>

                                    <?php
                                    if (isset($_POST['abrir_inventario'])) {
                                        $crearInventario = new ControladorInventario();
                                        $crearInventario->ctrAbrirInventario();
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php } ?>

                        <div class="card col-md-6">
                            <div class="card-header border-0">
                                <h3 class="card-title">Inventario</h3>

                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="" class="display table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>Inventario</th>
                                            <th>Fecha Apertura</th>
                                            <th>Fecha Cierre</th>
                                            <th>Estado</th>
                                            <th>Informe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;

                                        $inventario = ControladorInventario::ctrMostrarInventario($item, $valor);


                                        $data = array();

                                        foreach ($inventario as $i) {

                                            $estado = $i["estado_inventario"];
                                            switch ($estado) {
                                                case 'Abierto':
                                                    $id_inventario_abierto = "true";
                                                    $estado_inventario = "<span class='badge badge-success'>Abierto</span>";
                                                    $informe = "<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                                                                 <i class='far fa-file-pdf'></i>
                                                                </button>";
                                                    $boton = "<button type='button' class='btn bg-warning' data-toggle='modal' data-target='#modalCerrarInventario' data-id_inventario='{$i["id_inventario"]}' title='Cerrar Inventario'>
                                                                 <i class='far fa-check-circle'></i>
                                                                 </button>";
                                                    break;
                                                case 'Cerrado':
                                                    $estado_inventario = "<span class='badge badge-danger'>Cerrado</span>";
                                                    $informe = "<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                                                                 <i class='far fa-file-pdf'></i>
                                                                 </button>";
                                                    $boton = "<button type='button' class='btn bg-success'>
                                                                  <i class='far fa-calendar-check'></i>
                                                               </button>";
                                                    break;

                                                default:
                                                    $estado = "<span class='badge badge-secondary'>Desconocido</span>";
                                                    break;
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $i["id_inventario"]; ?></td>
                                                <td><?php echo $i["fecha_apertura"]; ?></td>
                                                <td><?php echo $i["fecha_cierre"]; ?></td>
                                                <td><?php echo $estado_inventario; ?></td>
                                                <td><?php echo $informe; ?></td>
                                                <td><?php echo $boton; ?></td>
                                            </tr>
                                        <?php } ?>

                                    </tbody>
                                </table>

                            </div>
                        </div>

                        <div class="card col-md-6">

                            <div class="card-header border-0">
                                <div class="d-flex justify-content-between">
                                    <h3 class="card-title">Estadísticas</h3>
                                </div>
                            </div>
                            <div class="card-body">

                                <!-- /.d-flex -->

                                <?php if ($id_inventario_abierto == "true") { ?>
                                    <div class="d-flex">
                                        <p class="d-flex flex-column">
                                            <span class="text-bold text-lg" id="no_verificados"></span>
                                            <span>Cantidad por Verificar</span>
                                        </p>
                                        <p class="ml-auto d-flex flex-column text-right">
                                            <span class="text-success text-lg" id="verificados">
                                                <i class="fas fa-arrow-up"></i>
                                            </span>
                                            <span class="text-muted">Verificados</span>
                                        </p>
                                    </div>
                                    <div class="position-relative mb-4">
                                        <canvas id="graficaVerificacion" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                    </div>
                                <?php } else { ?>
                                    <div class="alert alert-info">
                                        <h5><i class="icon fas fa-info-circle"></i> Información</h5>
                                        Debe abrir un inventario para visualizar la gráfica de verificación.
                                    </div>
                                <?php } ?>


                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->

<div class="modal fade" id="modalCerrarInventario" tabindex="-1" role="dialog" aria-labelledby="modalCerrarInventarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCerrarInventarioLabel">Cerrar Inventario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCerrarInventario" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="id_inventario">ID de Inventario</label>
                        <input type="text" class="form-control" id="id_inventario" name="id_inventario" readonly hidden>
                    </div>
                    <div class="form-group">
                        <label for="fecha_cierre">Fecha de Cierre</label>
                        <input type="date" class="form-control" id="fecha_cierre" name="fecha_cierre">
                    </div>

                    <button type="submit" class="btn bg-success" name="cerrarInventario">Cerrar Inventario</button>
                    <?php
                    if (isset($_POST['cerrarInventario'])) {
                        $cerrarInventario = new ControladorInventario();
                        $cerrarInventario->ctrCerrarInventario();
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function cargarGrafica() {
            fetch('controladores/activos.controlador.php?action=graficaVerificacionActivos')
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error en los datos:', data.error);
                    } else if (data.verificados !== undefined && data.no_verificados !== undefined) {
                        // Actualizar los elementos HTML con los valores obtenidos
                        document.getElementById('verificados').textContent = data.verificados;
                        document.getElementById('no_verificados').textContent = data.no_verificados;

                        // Crear la gráfica
                        var pieChartCanvas = document.getElementById('graficaVerificacion').getContext('2d');
                        var pieData = {
                            labels: ['Verificados', 'No Verificados'],
                            datasets: [{
                                data: [data.verificados, data.no_verificados],
                                backgroundColor: ['#28a745', '#dc3545'],
                                borderColor: ['#28a745', '#dc3545']
                            }]
                        };
                        var pieOptions = {
                            maintainAspectRatio: false,
                            responsive: true,
                            plugins: {
                                legend: {
                                    labels: {
                                        color: 'white' // Cambia el color de las etiquetas a blanco
                                    }
                                }
                            }
                        };
                        new Chart(pieChartCanvas, {
                            type: 'pie',
                            data: pieData,
                            options: pieOptions
                        });
                    } else {
                        console.error('Datos no válidos:', data);
                    }
                })
                .catch(error => console.error('Error al cargar datos:', error));
        }

        cargarGrafica();
    });
</script>