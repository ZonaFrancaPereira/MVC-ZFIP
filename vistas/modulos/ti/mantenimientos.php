<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">MANTENIMIENTOS</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card-footer">
                    <div class="tab-content card">
                        <div id="panel-ti" class="tab-pane  show active">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#">Realizados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#mantenimientos_equipos">Equipos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#mantenimientos_impresora">Impresoras</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#mantenimientos_generales">General</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- /MANRTENIMIENTOS EQUIPOS -->
                                <div id="mantenimientos_equipos" class="tab-pane fade">
                                    <div class="card card-lightblue">
                                        <div class="card-header">
                                            <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS EQUIPOS DE COMPUTO</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table id="tabla-mantenimiento-equipos" class="table table-bordered table-striped dt-responsive" width="100%">
                                                    <thead class="bg-dark">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha Mantenimiento</th>
                                                            <th>Estado</th>
                                                            <th>Formato</th>
                                                            <th>Firma</th>
                                                        </tr>
                                                    </thead>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- /MANRTENIMIENTOS IMPRESORA -->
                                <div id="mantenimientos_impresora" class="tab-pane fade">
                                    <div class="card card-lightblue">
                                        <div class="card-header">
                                            <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS DE IMPRESORAS</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table id="tabla-mantenimiento-impresora" class="table table-bordered table-striped dt-responsive" width="100%">
                                                    <thead class="bg-dark">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha Mantenimiento</th>
                                                            <th>Estado</th>
                                                            <th>Formato</th>
                                                            <th>Firma</th>
                                                        </tr>
                                                    </thead>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                 <!-- /MANRTENIMIENTOS GENERAL -->
                                 <div id="mantenimientos_generales" class="tab-pane fade">
                                    <div class="card card-lightblue">
                                        <div class="card-header">
                                            <h3 class="card-title" style="font-family: serif;">MANTENIMIENTOS GENERALES</h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-body table-responsive p-0">
                                                <table id="tabla-mantenimiento-general" class="table table-bordered table-striped dt-responsive" width="100%">
                                                    <thead class="bg-dark">
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fecha Mantenimiento</th>
                                                            <th>Estado</th>
                                                            <th>Formato</th>
                                                            <th>Firma</th>
                                                        </tr>
                                                    </thead>
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
        </div>
    </div>
</section>