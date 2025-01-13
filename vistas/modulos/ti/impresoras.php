<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Gestión de Impresoras</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Impresoras</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inicio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="impresoras_consumibles-tab" data-toggle="tab" href="#impresoras_consumibles" role="tab" aria-controls="impresoras_consumibles" aria-selected="false">Impresoras</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="ingresar_impresora-tab" data-toggle="tab" href="#ingresar_impresora" role="tab" aria-controls="ingresar_impresora" aria-selected="false">Ingresar Impresora</a>
  </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="myTabContent">
  
  <!-- Pestaña de Impresoras -->
  <div class="tab-pane fade" id="impresoras_consumibles" role="tabpanel" aria-labelledby="impresoras_consumibles-tab">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Impresoras</h3>
                        </div>
                        <div class="card-body">
                            <table id="tabla-impresoras-consumibles" class="table table-bordered table-striped dt-responsive" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Modelo</th>
                                        <th>Serial</th>
                                        <th>Ubicación</th>
                                        
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>

  <!-- Pestaña de Ingresar Impresora -->
  <div class="tab-pane fade" id="ingresar_impresora" role="tabpanel" aria-labelledby="ingresar_impresora-tab">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Formulario para Ingresar Impresora</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" enctype="multipart/form-data" >
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre_impresora">Nombre de Impresora</label>
                                            <input type="text" class="form-control" id="nombre_impresora" name="nombre_impresora" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="modelo_impresora">Modelo</label>
                                            <input type="text" class="form-control" id="modelo_impresora" name="modelo_impresora" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="serial_impresora">Serial</label>
                                            <input type="text" class="form-control" id="serial_impresora" name="serial_impresora" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ubicacion_impresora">Ubicación</label>
                                            <input type="text" class="form-control" id="ubicacion_impresora" name="ubicacion_impresora" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary" id="guardar_impresora">Guardar Impresora</button>
                                </div>
                                <?php
                                    $crearImpresora = new ControladorConsumibles();
                                    $crearImpresora ->ctrCrearImpresora();
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
  
  <!-- Pestaña de Inicio -->
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Card de Bienvenida -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <h3 class="card-title">Bienvenido a la Gestión de Impresoras</h3>
                        </div>
                        <div class="card-body">
                            <p>Bienvenido al sistema de gestión de impresoras. Este sistema te permitirá:</p>
                            <ul>
                                <li>Ver todas las impresoras registradas en el sistema.</li>
                                <li>Agregar nuevas impresoras a la base de datos.</li>
                                <li>Gestionar la ubicación y modelo de cada impresora.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Card de Impresoras -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h3 class="card-title">Impresoras</h3>
                        </div>
                        <div class="card-body">
                            <p>En esta pestaña, podrás visualizar todas las impresoras registradas en el sistema, incluyendo su nombre, modelo, número de serie y ubicación.</p>
                            <p>Además, podrás realizar búsquedas y filtrados para encontrar las impresoras rápidamente.</p>
                            <a href="#impresoras_consumibles" class="btn btn-info" data-toggle="tab">Ver Impresoras</a>
                        </div>
                    </div>
                </div>

                <!-- Card de Ingresar Impresora -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title">Ingresar Impresora</h3>
                        </div>
                        <div class="card-body">
                            <p>Si deseas agregar una nueva impresora al sistema, puedes hacerlo desde esta sección.</p>
                            <p>Completa los campos con la información de la impresora, como nombre, modelo, serial y ubicación, y luego haz clic en "Guardar Impresora".</p>
                            <a href="#ingresar_impresora" class="btn btn-success" data-toggle="tab">Agregar Impresora</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

</div>
