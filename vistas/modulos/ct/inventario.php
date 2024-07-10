<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Inventario</li>
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
                    <div class="card-header bg-info">
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
                             }else{ ?>
                        <div id="nuevo_inventario" class="card col-md-12">
                            <form method="post">
                                <label for="fecha_apertura">Fecha de Apertura:</label>
                                <input type="date" class="form-control" id="fecha_apertura" name="fecha_apertura" required>

                                <br>
                                <button type="submit" class="btn bg-success" name="abrir_inventario">Abrir Inventario</button>
                            </form>
                            <?php
                            if (isset($_POST['abrir_inventario'])) {
                                $crearInventario = new ControladorInventario();
                                $crearInventario->ctrAbrirInventario();
                            } 
                            ?>
                        </div>
                        <?php } ?>
                        <div class="card col-md-6">
                            <div class="card-header border-0">
                                <h3 class="card-title">Inventario</h3>

                            </div>
                            <div class="card-body table-responsive p-0">
                                <table id="tabla-inventario" class="table table-striped table-valign-middle">
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
                                <div class="d-flex">
                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg">400</span>
                                        <span>Cantidad por Verificar</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up"></i> 100
                                        </span>
                                        <span class="text-muted">Verificados</span>
                                    </p>
                                </div>
                                <!-- /.d-flex -->

                                <div class="position-relative mb-4">
                                    <canvas id="sales-chart" height="200"></canvas>
                                </div>

                                <div class="d-flex flex-row justify-content-end">
                                    <span class="mr-2">
                                        <i class="fas fa-square text-primary"></i> Activos
                                    </span>

                                    <span>
                                        <i class="fas fa-square text-success"></i> Verificados
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->