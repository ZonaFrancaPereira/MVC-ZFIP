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
                    <table class="display table table-bordered" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Correo</th>
                                    <th>Asignar Ruta</th>
                                </tr>
                            </thead>
                            <tbody>
                                            <?php
                                            $item = 'id_usuario_fk';
                                            $valor = $_SESSION['id'];
                                            $backup_principal = ControladorBackup::ctrMostraUsuariosRuta($item, $valor);
                                            foreach ($backup_principal as $s) {
                                                $asignar_ruta = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-ruta' data-id_usuario_backup_fk='{$s["id"]}'>Asignar Ruta</button>";
                                                echo "<tr>
                                                        <td>" . $s["id"] . "</td>
                                                        <td>" . $s["nombre"] . "</td>
                                                        <td>" . $s["apellidos_usuario"] . "</td>
                                                        <td>" . $s["correo_usuario"] . "</td>
                                                        <td>" . $asignar_ruta . "</td>
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
</section>


<section class="content">
    <div class="modal fade" id="modal-ruta">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Asignar la ruta al usuario</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group mb-4">
                            <label for="id_usuario_backup_fk" class="font-weight-bold">Id Usuario</label>
                            <input type="text" name="id_usuario_backup_fk" class="form-control" id="id_usuario_backup_fk" placeholder="Ingrese el nombre de usuario" required>
                        </div>
                        <div class="form-group mb-4">
                            <label for="carpeta_backup" class="font-weight-bold">Ruta de la Carpeta</label>
                            <input type="text" name="carpeta_backup" class="form-control" id="carpeta_backup" placeholder="Ingrese la ruta de la carpeta" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary" id="asignar_ruta" name="asignar_ruta">Asignar Ruta</button>
                        </div>
                        <?php
                        $asignarRuta = new ControladorBackup();
                        $asignarRuta->ctrAsignarRuta();
                        ?>
                    </form>
                </div>
            </div>
        </div>
</section>