<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Vacaciones</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Ingresar Usuario</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nombre_administrativa" class="form-label">Nombre</label>
                                    <select id="nombre_administrativa" name="nombre_administrativa" class="form-control" required>
                                        <option value="" disabled selected>Seleccione un usuario</option>
                                        <?php
                                        $item = null;
                                        $valor = null;
                                        $usuario = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
                                        foreach ($usuario as $key => $value) {
                                            echo '<option value="' . $value["id"] . '">' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cedula_administrativa" class="form-label">Cédula</label>
                                    <input type="text" class="form-control" id="cedula_administrativa" name="cedula_administrativa" placeholder="Ingrese la cédula" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="fecha_ingreso_administrativa" class="form-label">Fecha de Ingreso</label>
                                    <input type="date" class="form-control" id="fecha_ingreso_administrativa" name="fecha_ingreso_administrativa" required>
                                </div>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success px-4" id="guardar_administrativa" name="guardar_administrativa">Guardar</button>
                            </div>
                            <?php
                            $guardar_administrativa = new ControladorAdministrativa();
                            $guardar_administrativa->ctrGuardarUsuario();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center mt-4">
            <div class="col-md-10">
                <div class="card shadow-lg rounded-lg">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Usuarios Registrados</h4>
                    </div>
                    <div class="card-body">
                        <table class="display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Cédula</th>
                                    <th>Fecha de Ingreso</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $item = null;
                                $valor = null;
                                $usuarios = ControladorAdministrativa::ctrMostrarUsuariosAdministrativa($item, $valor);
                                foreach ($usuarios as $key => $usuario) {
                                    echo '<tr>
                                            <td>' . $usuario["id"] . '</td>
                                            <td>' . $usuario["nombre_administrativa"] . '</td>
                                            <td>' . $usuario["cedula_administrativa"] . '</td>
                                            <td>' . $usuario["fecha_ingreso_administrativa"] . '</td>
                                            <td>
                                                <button class="btn btn-warning btn-sm">Editar</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-cambiar-estado" data-nombre_administrativa="' . $usuario["nombre_administrativa"] . '">Eliminar</button>
                                                 <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-periodo" data-id_vacaciones_fk="' . $usuario["id"] . '" data-id_usuario_fk="' . $usuario["nombre_administrativa"] . '">Insertar</button>
                                            </td>
                                          </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal-periodo" tabindex="-1" aria-labelledby="periodoLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="periodoLabel"><i class="fas fa-calendar-alt"></i> Ingresar Periodo de Vacaciones</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="row g-3">
                                <div class="col-md-6" hidden>
                                    <label for="id_vacaciones_fk" class="form-label fw-bold">ID VACACIONES</label>
                                    <input type="text" class="form-control border-primary" id="id_vacaciones_fk" name="id_vacaciones_fk" placeholder="Ingrese el periodo" required>
                                </div>
                                <div class="col-md-6" hidden>
                                    <label for="id_usuario_fk" class="form-label fw-bold">ID USUARIO FK</label>
                                    <input type="text" class="form-control border-primary" id="id_usuario_fk" name="id_usuario_fk" placeholder="Ingrese el periodo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="periodo_vacaciones" class="form-label fw-bold">Periodo</label>
                                    <input type="text" class="form-control border-primary" id="periodo_vacaciones" name="periodo_vacaciones" placeholder="Ingrese el periodo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="disfrutadas" class="form-label fw-bold">Disfrutadas</label>
                                    <input type="number" class="form-control border-primary" id="disfrutadas" name="disfrutadas" placeholder="Ingrese el dato" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="pendientes_periodo" class="form-label fw-bold">Pendientes del Periodo</label>
                                    <input type="number" class="form-control border-primary" id="pendientes_periodo" name="pendientes_periodo" placeholder="Ingrese el dato" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="dias_pendientes" class="form-label fw-bold">Días Pendientes</label>
                                    <input type="number" class="form-control border-primary" id="dias_pendientes" name="dias_pendientes" placeholder="Ingrese el dato" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="observaciones_vacaciones" class="form-label fw-bold">Observaciones</label>
                                    <textarea class="form-control border-primary" id="observaciones_vacaciones" name="observaciones_vacaciones" rows="3" placeholder="Ingrese las observaciones" required></textarea>
                                </div>
                            </div>
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-success px-4" id="guardarFormulario" name="guardarFormulario"><i class="fas fa-save"></i> Guardar</button>
                                <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                            </div>
                            <?php
                            $GuardarDiasVacaciones = new ControladorAdministrativa();
                            $GuardarDiasVacaciones->ctrGuardarDiasVacaciones();
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Eliminar -->     
        <div class="modal fade" id="modal-cambiar-estado" tabindex="-1" aria-labelledby="cambiarEstadoLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="cambiarEstadoLabel"><i class="fas fa-exchange-alt"></i> Cambiar Estado del Usuario</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <p>¿Está seguro de cambiar el estado del usuario?</p>
                <form method="POST" enctype="multipart/form-data">
                    <input type="" id="nombre_administrativa" name="nombre_administrativa" value="">
                    <input type="" id="estado_usuario_administrativa" name="estado_usuario_administrativa" value="Inactivo">
                    <div class="text-end mt-4">
                    <button type="submit" class="btn btn-warning px-4" id="cambiarEstadoUsuario" name="cambiarEstadoUsuario"><i class="fas fa-exchange-alt"></i> Cambiar Estado</button>
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    </div>
                    <?php
                    $cambiarEstadoUsuario = new ControladorAdministrativa();
                    $cambiarEstadoUsuario->ctrCambiarEstadoUsuario();
                    ?>
                </form>
                </div>
            </div>
            </div>
        </div>

    </div>
</section>