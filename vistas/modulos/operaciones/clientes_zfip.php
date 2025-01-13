<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Administrar Usuarios ZFIP</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Usuarios ZFIP</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="active nav-link" href="#NuevoCliente" data-toggle="tab">Nuevo Usuario ZFIP</a></li>
                            <li class="nav-item"><a class="nav-link " href="#ConsultarClientes" data-toggle="tab">Consultar</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- /.TAB PARA MOSTRAR LOS PERFILES-->
                            <div class="active tab-pane" id="NuevoCliente">
                                <form id="GuardarCliente" role="form" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                        <!-- Campo para el ID del cliente (Identificación) -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoDocumentoId">Identificación</label>
                                                <input type="text" class="form-control" id="nuevoDocumentoId" name="id_cliente" placeholder="Ingresar documento" required>
                                            </div>
                                        </div>

                                        <!-- Campo para el nombre del cliente (Nombre y Apellidos/Razón Social) -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoCliente">Nombres y apellidos / Razón social</label>
                                                <input type="text" class="form-control" id="nuevoCliente" name="nombre_cliente" placeholder="Ingresar Nombres y Apellidos / Razón Social" required>
                                            </div>
                                        </div>

                                        <!-- Campo para el email del cliente -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoEmail">Email</label>
                                                <input type="email" class="form-control" id="nuevoEmail" name="email_cliente" placeholder="Ingresar email" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <!-- Campo para el teléfono del cliente -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevoTelefono">Teléfono</label>
                                                <input type="text" class="form-control" id="nuevoTelefono" name="telefono_cliente" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                                            </div>
                                        </div>
                                        <!-- Campo para la dirección del cliente -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevaDireccion">Dirección</label>
                                                <input type="text" class="form-control" id="nuevaDireccion" name="direccion_cliente" placeholder="Ingresar dirección" required>
                                            </div>
                                        </div>
                                        <!-- Campo para la dirección del cliente -->
                                        <div class="col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <label for="nuevaDireccion">Pertenece a :</label>
                                                <select name="tipo_zf" id="" class="form-control">
                                                    <option value="zfip">Zona Franca Internacional de Pereira</option>
                                                    <option value="clinica">Clínica Hispanoamericana</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn bg-success btn-block" name="crear_cliente">Guardar Cliente</button>
                                            <?php
                                            $crearCliente = new ControladorClientes();
                                            $crearCliente->ctrCrearCliente();
                                            ?>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class=" tab-pane" id="ConsultarClientes">
                                <table class="table display  table-bordered table-striped dt-responsive " width="100%">
                                    <thead>
                                        <tr>
                                            <th>Documento</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Tipo ZFIP</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $clientes_zfip = ControladorClientes::ctrMostrarClientes($item, $valor);
                                        foreach ($clientes_zfip as $key => $value) {
                                            echo '<tr><td>' . $value["id_cliente"] . '</td>';
                                            echo '<td>' . $value["nombre_cliente"] . '</td>';
                                            echo '<td>' . $value["email_cliente"] . '</td>';
                                            echo '<td>' . $value["telefono_cliente"] . '</td>';
                                            echo '<td>' . $value["direccion_cliente"] . '</td>';
                                            echo '<td>' . $value["tipo_zf"] . '</td>';
                                            echo '<td><button class="btn btn-warning btnEditarCliente" idCliente="' . $value["id_cliente"] . '" data-toggle="modal" data-target="#modalEditarCliente"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value[$i]["id_cliente"] . '" ><i class="fas fa-times"></i></button></td>';
                                            echo '</tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>