<?php

if ($_SESSION["perfiles"] == "off") {

    echo '<script>

    window.location = "inicio";

  </script>';

    return;
}

?>
</div>
<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Administrar Perfiles
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Perfiles
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <button type="button" class="btn bg-success" data-toggle="modal" data-target="#modal-perfil">
            Agregar Perfil
        </button>
        <div class="modal fade" id="modal-perfil">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">Crear Perfil</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- #INPUT PARA AGREGAR LA DESCRIPCION DEL PERFIL -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control input-lg" name="nuevoDescripcionPerfil" placeholder="Ejemplo: TI | Usuarios | Super Usuario" required>
                        </div>
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#ti" role="tab" aria-controls="ti" aria-selected="true">TI</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#sig" role="tab" aria-controls="sig" aria-selected="false">SIG</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#ct" role="tab" aria-controls="ct" aria-selected="false">Contabilidad</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="ti" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card-header bg-info">
                                    Configuraciones Tecnología e Informática.
                                </div>
                                <!-- DIV PARA CONTENER LAS OPCIONES -->
                                <div class="pt-2 card">
                                       <!-- Check USUARIOS -->
                                       <div class="checkbox">
                                        <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar usuarios">Usuarios</label>
                                    </div>
                                    <!-- Check Perfiles -->
                                    <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">
                                        <label for="exampleInputEmail1" data-toggle="tooltip" data-placement="top" title="Permisos para administrar perfiles, es importante para limitar permisos dentro de la APP">Perfiles</label>
                                    </div>
                                     <!-- Check Mantenimientos -->
                                     <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">
                                        <label>Mantenimientos</label>
                                    </div>
                                     <!-- Check Inventario TI -->
                                     <div class="checkbox pt-2">
                                        <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">
                                        <label>Inventario TI</label>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="sig" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                Configuraciones Sistema Integrado de Gestión.
                            </div>
                            <div class="tab-pane fade" id="ct" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                                Configuraciones Contabilidad y Finanzas.
                            </div>

                        </div>


                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn bg-success">Guardar</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </section>