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

<!-- Sección de información sobre la verificación -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Importante: Verificación de Backup</h3>
                    </div>
                    <div class="card-body">
                        <div class="alert bg-info">
                            <h5><strong>Verificación de Backup</strong></h5>
                            <p>
                                La verificación de los backups se realiza cada 8 días por el área de TI para asegurar que todos los sistemas estén respaldados correctamente. Si no cuentas con la verificación correspondiente a esta semana, por favor sigue los siguientes pasos:
                            </p>
                            <ul>
                                <li><strong>1.</strong> Verifica si la fecha de verificación en la tabla está actualizada.</li>
                                <li><strong>2.</strong> Si no tienes la verificación de esta semana, realiza una solicitud de soporte.</li>
                                <li><strong>3.</strong> Selecciona la opción <strong>"Solicitud de soporte"</strong> en la barra de navegación y describe el problema.</li>
                                <li><strong>4.</strong> Un técnico de TI se pondrá en contacto contigo para resolverlo.</li>
                            </ul>
                            <div class="alert alert-danger">
                                <strong>Recuerda:</strong> Es importante tener la verificación al día para garantizar la seguridad de los datos. Si tienes alguna duda, no dudes en contactarnos.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                    <th class="d-none">is usuario</th>
                                    <th>Carpeta</th>
                                    <th>Fecha Verificacion</th>
                                    <th>Verificado</th>
                                    <th>Observaciones</th>
                                    <th>Informe</th>
                                </tr>
                            </thead>
                            <?php
                            $item = 'id_usuario_fk';
                            $valor = $_SESSION['id'];
                            $backup_principal = ControladorBackup::ctrMostrarBackupUsuarios($item, $valor);
                            foreach ($backup_principal as $s) {
                                $informe = "<a target='_blank' href='extensiones/tcpdf/pdf/backuppdf.php?id={$s["id_usuario_backup_fk"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                                echo "<tr>
                                        <td>" . $s["id_backup"] . "</td>
                                        <td class='d-none'>" . $s["id_usuario_backup_fk"] . "</td>
                                        <td>" . $s["carpeta_backup"] . "</td>
                                        <td>" . $s["fecha_verificacion"] . "</td>
                                        <td>" . $s["verificado"] . "</td>
                                        <td>" . $s["observaciones_copia"] . "</td>
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
