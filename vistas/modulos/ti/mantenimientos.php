<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6"></div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">MANTENIMIENTOS</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- Card Footer -->
                <div class="card-footer">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Home</a>
                        </li>
                        <?php
                        $cargosPermitidos = [1, 2];
                        if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], $cargosPermitidos)):
                        ?>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mantenimientos_equipos" role="tab">Equipos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mantenimientos_impresora" role="tab">Impresoras</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#mantenimientos_generales" role="tab">General</a>
                            </li>
                        <?php endif; ?>
                    </ul>


                    <!-- Tab Content -->
                    <div class="tab-content card">
                        <!-- Tab: Home -->
                        <div id="home" class="tab-pane fade show active" role="tabpanel">
                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento Equipos</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-mantenimiento-equipos" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
                                                <th>Firmar</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-success text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento General</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-mantenimiento-general" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
                                                <th>Firmar</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>

                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-info text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento Impresora</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-mantenimiento-impresora" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
                                                <th>Firmar</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Tab: Equipos -->
                        <div id="mantenimientos_equipos" class="tab-pane fade" role="tabpanel">
                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-primary text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento Equipos</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-ti-equipo" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Responsable</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Tab: Impresoras -->
                        <div id="mantenimientos_impresora" class="tab-pane fade" role="tabpanel">
                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-info text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento Impresora</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-ti-impresora" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Responsable</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Tab: Generales -->
                        <div id="mantenimientos_generales" class="tab-pane fade" role="tabpanel">
                            <div class="card card-lightblue">
                                <div class="card-header bg-gradient-success text-white">
                                    <h4 class="card-title m-0" style="font-family: 'Roboto Slab', serif;">Mantenimiento General</h4>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                                            <i class="fas fa-chevron-up"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body table-responsive p-0">
                                    <table id="tabla-ti-general" class="table table-bordered table-striped dt-responsive" width="100%">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Responsable</th>
                                                <th>Fecha Mantenimiento</th>
                                                <th>Estado</th>
                                                <th>Formato</th>
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
</section>

<div class="modal fade" id="firmaModal" tabindex="-1" role="dialog" aria-labelledby="firmaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="firmaModalLabel">Firma Documento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-signature"></i> <strong>Instrucciones:</strong> Por favor, firme el documento para completar el proceso, recuerda que debes de tener la firma subida en la plataforma para poder que esta sea asignada manualmente
                </div>
                <form id="firmaForm" method="POST" enctype="multipart/form-data">
                    <!-- Campo que mantienes como id_mantenimiento_equipo -->
                    <input name="id_mantenimiento" id="id_mantenimiento" type="hidden">
                    <div class="form-group">
                        <label for="firma" class="font-weight-bold" hidden>Firma</label>
                        <input type="text" class="form-control" id="firma" name="firma" value="<?php echo $_SESSION['foto']; ?>" required style="background-color: #f8f9fa; border-radius: 5px; border: 1px solid #ced4da;" hidden>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-signature"></i> Firmar
                    </button>
                    <?php
                    $FirmarMantenimiento = new ControladorMantenimiento();
                    $FirmarMantenimiento->ctrFirmarMantenimiento();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="firmaModalGeneral" tabindex="-1" role="dialog" aria-labelledby="firmaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="firmaModalLabel">Firma Documento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-signature"></i> <strong>Instrucciones:</strong> Por favor, firme el documento para completar el proceso, recuerda que debes de tener la firma subida en la plataforma para poder que esta sea asignada manualmente
                </div>
                <form id="firmaForm" method="POST" enctype="multipart/form-data">
                    <!-- Campo oculto para el ID del mantenimiento -->
                    <input name="id_general" id="id_general" type="hidden" value="<?php echo $id_general; ?>">

                    <div class="form-group" hidden>
                        <label for="firma_general" class="font-weight-bold" hidden>Firma</label>
                        <!-- Campo de texto oculto o con valor predeterminado de la firma -->
                        <input type="text" class="form-control" id="firma_general" name="firma_general" value="<?php echo $_SESSION['foto']; ?>" required style="background-color: #f8f9fa; border-radius: 5px; border: 1px solid #ced4da;">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-signature"></i> Firmar
                    </button>

                    <?php
                    $FirmarGeneral = new ControladorMantenimiento();
                    $FirmarGeneral->ctrFirmarMantenimientoGeneral();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="firmaModalImpresora" tabindex="-1" role="dialog" aria-labelledby="firmaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="firmaModalLabel">Firma Documento</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <i class="fas fa-signature"></i> <strong>Instrucciones:</strong> Por favor, firme el documento para completar el proceso, recuerda que debes de tener la firma subida en la plataforma para poder que esta sea asignada manualmente
                </div>
                <form id="firmaForm" method="POST" enctype="multipart/form-data">
                    <!-- Campo oculto para el ID del mantenimiento -->
                    <input name="id_impresora" id="id_impresora" type="hidden" value="<?php echo $id_impresora; ?>">

                    <div class="form-group" hidden>
                        <label for="firma_impresora" class="font-weight-bold" hidden>Firma</label>
                        <!-- Campo de texto oculto o con valor predeterminado de la firma -->
                        <input type="text" class="form-control" id="firma_impresora" name="firma_impresora" value="<?php echo $_SESSION['foto']; ?>" required style="background-color: #f8f9fa; border-radius: 5px; border: 1px solid #ced4da;">
                    </div>

                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        <i class="fas fa-signature"></i> Firmar
                    </button>

                    <?php
                    $FirmarImpresora = new ControladorMantenimiento();
                    $FirmarImpresora->ctrFirmarMantenimientoImpresora();
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Agregar los estilos CSS para mejorar el modal -->
<style>
    .modal-content {
        border-radius: 8px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .modal-header {
        border-bottom: 2px solid #dee2e6;
    }

    .modal-body {
        padding: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #004085;
    }

    .form-control {
        font-size: 1rem;
        padding: 0.75rem;
    }

    .alert-info {
        font-size: 1rem;
    }

    .nav-tabs {
        margin-bottom: 1rem;
        /* Espaciado entre las pestañas y el contenido */
    }
</style>