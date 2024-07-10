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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Solicitud de Soporte</h3>
                    </div>
                    <div class="card-body">
                        <!-- TABLA PARA MOSTRAR LOS PERFILES CREADOS -->
                        <table id="tabla-soporte-usuarios" class="table table-bordered table-striped dt-responsive " width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Descripcion</th>
                                    <th>Urgencia</th>
                                    <th>Solucion</th>
                                    <th>Fecha de Respuesta</th>
                                    <th>Tecnico</th>
                                </tr>
                            </thead>
                        </table>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div>
    </div>
</section>