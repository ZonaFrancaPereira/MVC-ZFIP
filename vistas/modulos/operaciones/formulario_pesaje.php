<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Nuevo Servicio</li>
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
                        <h3 class="card-title">Servicio de Báscula</h3>
                    </div>
                    <div class="card-body">
                        <form  id="GuardarPesaje" role="form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="placa">Placa</label>
                                        <input type="text" class="form-control" id="placa" name="placa" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="peso_uno">Peso Uno</label>
                                        <input type="number" class="form-control" id="peso_uno" name="peso_uno" required>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <label for="id_cliente_fk">ID Cliente</label>
                                        <input list="clientes" class="form-control select2 seleccionarCliente" id="seleccionarCliente" name="id_cliente_fk" required style="width: 100%;">
                                        <datalist id="clientes">
                                            <?php
                                            if ($cliente["id"] <> 0) {
                                                echo '<option value="' . $cliente["id"] . '"> ' . $cliente["nombre"] . '</option>';
                                            }
                                            $item = null;
                                            $valor = null;
                                            $clientes = ControladorClientes::ctrMostrarClientes($item, $valor);

                                            foreach ($clientes as $key => $value) {
                                                echo '<option value="' . $value["id"] . '">' . $value["id"] . " - " . $value["nombre"] . '</option>';
                                            }
                                            ?>
                                        </datalist>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn bg-success btn-block">Guardar Perfil</button>
                                    <?php
                                    $crearBascula = new ControladorBascula();
                                    $crearBascula->ctrCrearBascula();
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->