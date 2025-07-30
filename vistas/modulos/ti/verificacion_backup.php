<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Verificacion Backup</li>
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
                        <h3 class="card-title">Verificacion Backup</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="display table table-bordered" width="100%">
                                <thead class="bg-dark">
                                    <tr>
                                        <th>#</th>
                                        <th>Usuario</th>
                                        <th>Apellidos</th>
                                        <th>Correo</th>
                                        <th>Carpeta</th>
                                        <th>Verificado</th>
                                        <th>Informe</th>
                                        <th>Verificar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                            <?php
                                            $item = 'id_usuario_fk';
                                            $valor = $_SESSION['id'];
                                            $backup_principal = ControladorBackup::ctrAsignarVerificacion($item, $valor);
                                            foreach ($backup_principal as $s) {
                                                $verificar_backup = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-verificar_backup' data-id_usuario_copia='{$s["id"]}' data-carpeta_copia='{$s["carpeta_backup"]}'>Verificar</button>";
                                                $informe = "<a target='_blank' href='extensiones/tcpdf/pdf/backuppdf.php?id={$s["id"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                                                echo "<tr>
                                                        <td>" . $s["id"] . "</td>
                                                        <td>" . $s["nombre"] . "</td>
                                                        <td>" . $s["apellidos_usuario"] . "</td>
                                                        <td>" . $s["correo_usuario"] . "</td>
                                                        <td>" . $s["carpeta_backup"] . "</td>
                                                        <td>" . $s["verificado"] . "</td>
                                                        <td>" . $verificar_backup . "</td>
                                                        <td>" . $informe . "</td>
                                                    </tr>";
                                            }
                                            ?>
                                        </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="content">
    <div class="modal fade" id="modal-verificar_backup">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Verificar la Copia de Seguridad</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-4" hidden>
                            <label for="id_usuario_copia" class="font-weight-bold">Id Usuario</label>
                            <input type="text" name="id_usuario_copia" class="form-control" id="id_usuario_copia" placeholder="Ingrese el nombre de usuario" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="carpeta_copia" class="font-weight-bold">Ruta de la Carpeta</label>
                            <input type="text" name="carpeta_copia" class="form-control" id="carpeta_copia" placeholder="Ingrese la ruta de la carpeta" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="fecha_verificacion" class="font-weight-bold">Fecha</label>
                            <input type="date" name="fecha_verificacion" class="form-control" id="fecha_verificacion" placeholder="Ingrese la fecha de verificacion" required>
                        </div>
                        <div class="form-group">
                            <label>Verificar</label>
                            <select class="form-control select2" style="width: 100%;" id="verificado" name="verificado">
                                <option value="Verificado">Verificado</option>
                                <option value="No verificado">No verificado</option>
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="observaciones_copia" class="font-weight-bold">Observaciones</label>
                            <textarea type="date" name="observaciones_copia" class="form-control" id="observaciones_copia" placeholder="Ingrese la Observacion del Backup" required></textarea>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="verificar_copia" name="verificar_copia">Verificar Copia</button>
                        </div>
                        <?php
                        $verificarCopia = new ControladorBackup();
                        $verificarCopia->ctrVerificarCopia();
                        ?>
                    </form>
                </div>
            </div>
        </div>
</section>