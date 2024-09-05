<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contraseñas</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Administrar Contraseñas</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="active nav-link" href="#ActualizarPw" data-toggle="tab">Actualizar Contraseñas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ConsultarPw" data-toggle="tab">Consultar Actualizaciones</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- TAB PARA ACTUALIZAR LAS CONTRASEÑAS -->
                            <div class="active tab-pane" id="ActualizarPw">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Administrar Contraseñas</h3>
                                    </div>
                                    <form method="POST" enctype="multipart/form-data" id="dynamicForm">
                                        <div class="card-body">
                                            <div id="formFields">
                                                <!-- Sección para los campos dinámicos -->
                                                <div class="form-row align-items-center mb-3">
                                                <input type="hidden" name="form_submitted" value="true">
                                                    <div class="col-md-4 mb-2">
                                                        
                                                        <input type="text" name="nombre_app[]" class="form-control" placeholder="Nombre de la App" required>
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <input type="text" name="nombre_usuario[]" class="form-control" placeholder="Nombre de Usuario" required>
                                                    </div>
                                                    <div class="col-md-3 mb-2 input-group">
                                                        <input type="password" name="pw_app[]" class="form-control password-input" placeholder="Contraseña de la App" required>
                                                        <div class="input-group-append">
                                                            <span class="input-group-text toggle-password">
                                                                <i class="fas fa-eye"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 mb-2 text-center">
                                                        <button type="button" class="btn btn-danger remove-field">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Botones para añadir más campos y enviar el formulario -->
                                            <div class="text-center">
                                                <button type="button" id="addField" class="btn bg-info"><i class="fas fa-plus"></i> Añadir Más</button>
                                            </div>
                                            <div class="text-center pt-5">
                                                <button type="submit" class="btn bg-success btn-block">Enviar</button>
                                            </div>
                                        </div>
                                        <?php
                                        $crearPw = new ControladorPw();
                                        $crearPw->ctrCrearPw();
                                        ?>
                                    </form>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <!-- TAB PARA CONSULTAR LAS CONTRASEÑAS -->
                            <div class="tab-pane" id="ConsultarPw">
                                <table class="display table table-bordered  dt-responsive " width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width:10px">#</th>
                                            <th>Fecha Actualización</th>
                                            <th>Estado</th>
                                            <th>Informe</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $item = null;
                                        $valor = null;

                                        $MostrarPw = ControladorPw::ctrMostrarPwIndividual($item, $valor);

                                        foreach ($MostrarPw as $key => $value) {
                                            $estado=$value["estado_pw"];
                                            switch ($estado) {
                                                case 'Proceso':
                                                    $estado_pw = "<span class='badge badge-info'>Proceso</span>";
                                                    $informe="<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                                                   <i class='far fa-file-pdf'></i>
                                                  </button>";
                                                    $boton="<button type='button' class='btn bg-warning' data-toggle='modal' data-target='#modalCerrarInventario' data-id_inventario='{$i["id_inventario"]}' title='Cerrar Inventario'>
                                                            <i class='far fa-edit'></i>
                                                          </button>";
                                                    break;
                                                case 'Verificado':
                                                    $estado_pw = "<span class='badge badge-success'>Verificado</span>";
                                                    $informe="<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                                                   <i class='far fa-file-pdf'></i>
                                                  </button>";
                                                  $boton="<button type='button' class='btn bg-success'>
                                                    <i class='far fa-calendar-check'></i>
                                                  </button>";
                                                    break;
                                              
                                                default:
                                                    $estado_pw = "<span class='badge badge-secondary'>Desconocido</span>";
                                                    break;
                                            }

                                            echo ' <tr>
                                            <td>' . ($key + 1) . '</td>
                                            <td>' . $value["fecha_pw"] . '</td>
                                            <td>' . $estado_pw . '</td>
                                             <td>'.$informe.'</td>
                                             <td>'.$boton.'</td>
                                             ';

                                        }


                                        ?>

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>




<script>
    // Añadir más campos
    document.getElementById('addField').addEventListener('click', function() {
        const formFields = document.getElementById('formFields');
        const newField = document.createElement('div');
        newField.classList.add('form-row', 'align-items-center', 'mb-3'); // Cambiado a form-row

        newField.innerHTML = `
            <div class="col-md-4 mb-2">
                <input type="text" name="nombre_app[]" class="form-control" placeholder="Nombre de la App" required>
            </div>
            <div class="col-md-4 mb-2">
                <input type="text" name="nombre_usuario[]" class="form-control" placeholder="Nombre de Usuario" required>
            </div>
            <div class="col-md-3 mb-2 input-group">
                <input type="password" name="pw_app[]" class="form-control password-input" placeholder="Contraseña de la App" required>
                <div class="input-group-append">
                    <span class="input-group-text toggle-password">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
            </div>
            <div class="col-md-1 mb-2 text-center">
                <button type="button" class="btn btn-danger remove-field">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;

        formFields.appendChild(newField);
    });

    // Eliminar campos
    document.getElementById('dynamicForm').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-field') || e.target.closest('.remove-field')) {
            e.target.closest('.form-row').remove(); // Cambiado a form-row
        }
    });

    // Alternar visibilidad de la contraseña
    document.getElementById('dynamicForm').addEventListener('click', function(e) {
        if (e.target.closest('.toggle-password')) {
            const passwordInput = e.target.closest('.input-group').querySelector('.password-input');
            const icon = e.target.closest('.toggle-password').querySelector('i');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    });
</script>