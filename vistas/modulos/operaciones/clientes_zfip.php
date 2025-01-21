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
                                            echo '<td><button class="btn btn-warning btnEditarCliente" idCliente="' . $value["id_cliente"] . '" 
                                            data-toggle="modal" data-target="#modalEditarCliente"
                                            data-id_cliente="' . $value["id_cliente"] . '" 
                                            data-nombre_cliente="' . $value["nombre_cliente"] . '" 
                                            data-email_cliente="' . $value["email_cliente"] . '"
                                            data-telefono_cliente="' . $value["telefono_cliente"] . '" 
                                            data-direccion_cliente="' . $value["direccion_cliente"] . '" 
                                            data-tipo_zf="' . $value["tipo_zf"] . '">
                                            <i class="fas fa-edit"></i></button>

                                            <button class="btn btn-danger btnEliminarCliente" idCliente="' . $value["id_cliente"] . '" ><i class="fas fa-times"></i></button></td>';
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

<div id="modalEditarCliente" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- CABEZA DEL MODAL -->
            <div class="modal-header bg-primary">
                <h4 class="modal-title"><strong>Editar Datos del Cliente</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- CUERPO DEL MODAL -->
            <div class="modal-body">
                <form role="form" method="post" enctype="multipart/form-data" id="editarClientes">
                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE DEL CLIENTE -->
                        <div class="form-group">
                            <label for="editarNombreCliente"><strong>Nombre del Cliente</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editarNombreCliente" name="editarNombreCliente" value="" required>
                                <input type="hidden" class="form-control input-lg" id="editarIdCliente" name="editarIdCliente" value="" required>

                            </div>
                        </div>

                        <!-- ENTRADA PARA EL EMAIL DEL CLIENTE -->
                        <div class="form-group">
                            <label for="editarEmailCliente"><strong>Email del Cliente</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input type="email" class="form-control input-lg" id="editarEmailCliente" name="editarEmailCliente" value="" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA EL TELÉFONO DEL CLIENTE -->
                        <div class="form-group">
                            <label for="editarTelefonoCliente"><strong>Teléfono del Cliente</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editarTelefonoCliente" name="editarTelefonoCliente" value="" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA DIRECCIÓN DEL CLIENTE -->
                        <div class="form-group">
                            <label for="editarDireccionCliente"><strong>Dirección del Cliente</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-home"></i></span>
                                </div>
                                <input type="text" class="form-control input-lg" id="editarDireccionCliente" name="editarDireccionCliente" value="" required>
                            </div>
                        </div>

                        <!-- ENTRADA PARA SELECCIONAR EL TIPO DE ZONA FRANCA -->
                        <div class="form-group">
                            <label for="editarTipoZF"><strong>Tipo de Zona Franca</strong></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-building"></i></span>
                                </div>
                                <select class="form-control input-lg" name="editarTipoZF" id="editarTipoZF">
                                    <option value="zfip">Zona Franca Internacional de Pereira</option>
                                    <option value="clinica">Clínica Hispanoamericana</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- PIE DEL MODAL -->
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn bg-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn bg-success" name="editarCliente">Guardar Cambios</button>
                        <?php
                                            $editarCliente = new ControladorClientes();
                                            $editarCliente->ctrEditarCliente();
                                            ?>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
      // Capturar el evento cuando se abre el modal
$('#modalEditarCliente').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Botón que abrió el modal
    var id_cliente = button.data('id_cliente');
    var nombre_cliente = button.data('nombre_cliente');
    var email_cliente = button.data('email_cliente');
    var telefono_cliente = button.data('telefono_cliente');
    var direccion_cliente = button.data('direccion_cliente');
    var tipo_zf = button.data('tipo_zf');

    // Modal donde se mostrarán los datos
    var modal = $(this);

    // Establecer los valores en los campos correspondientes del modal
    modal.find('.modal-title').text( id_cliente + ' - ' + nombre_cliente); // Mostrar el nombre del cliente en el título
    modal.find('.modal-body #editarIdCliente').val(id_cliente);
    modal.find('.modal-body #editarNombreCliente').val(nombre_cliente);
    modal.find('.modal-body #editarEmailCliente').val(email_cliente);
    modal.find('.modal-body #editarTelefonoCliente').val(telefono_cliente);
    modal.find('.modal-body #editarDireccionCliente').val(direccion_cliente);
    modal.find('.modal-body #editarTipoZF').val(tipo_zf); // Asignar el tipo de zona franca al campo select
});
</script>