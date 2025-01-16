<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-sm-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Impresoras</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Gestión de Impresoras</h3>
                    </div>
                    <div class="card-body">
                        <p>Bienvenido al sistema de gestión de impresoras. Este sistema te permitirá:</p>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check-circle"></i> Ver todas las impresoras registradas.</li>
                            <li><i class="fas fa-plus-circle"></i> Agregar nuevas impresoras a la base de datos.</li>
                            <li><i class="fas fa-cogs"></i> Gestionar la ubicación y modelo de cada impresora.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Lista de Impresoras</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-impresoras-consumibles" class="table table-bordered table-striped dt-responsive" width="100%">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Modelo</th>
                                        <th>Serial</th>
                                        <th>Ubicación</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h3 class="card-title">Agregar Nueva Impresora</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_impresora">Nombre de Impresora</label>
                                    <input type="text" class="form-control" id="nombre_impresora" name="nombre_impresora" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="modelo_impresora">Modelo</label>
                                    <input type="text" class="form-control" id="modelo_impresora" name="modelo_impresora" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="serial_impresora">Serial</label>
                                    <input type="text" class="form-control" id="serial_impresora" name="serial_impresora" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ubicacion_impresora">Ubicación</label>
                                    <input type="text" class="form-control" id="ubicacion_impresora" name="ubicacion_impresora" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success" id="guardar_impresora">Guardar Impresora</button>
                            <?php
                            $crearImpresora = new ControladorConsumibles();
                            $crearImpresora->ctrCrearImpresora();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>