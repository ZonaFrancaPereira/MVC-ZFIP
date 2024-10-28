<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Nuevo Soporte</li>
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
                        <h3 class="card-title">Solicitud de Soporte - Gestion Tecnica</h3>
                    </div>
                    <div class="card-body">
                        <form id="soporte_tecnico" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="correo_soporte">CORREO</label>
                                        <input type="text" class="form-control select2" id="correo_soporte" name="correo_soporte" required style="width: 100%;"
                                            value="<?php echo $_SESSION["correo_usuario"]; ?>" readonly> <!-- El correo del usuario logueado -->
                                    </div>

                                    <div class="col-md-12">
                                        <label for="textarea">Descripción de la solicitud</label>
                                        <textarea class="textarea form-control" id="descripcion_soporte_tecnico" name="descripcion_soporte_tecnico" rows="3" placeholder="Descripción"></textarea>
                                    </div>
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="proceso_fk1">PROCESO</label>
                                        <input type="text" class="form-control select2" id="proceso_fk1" name="proceso_fk1" required style="width: 100%;"
                                            value="<?php echo $_SESSION["id_proceso_fk"]; ?>" readonly> <!-- El proceso del usuario logueado -->
                                    </div>
                                </div> <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-warning btn-block" id="enviar_soporte" name="enviar_soporte"><i class="fas fa-paper-plane"></i>Enviar</button>
                                </div>
                                <?php
                                $SoporteTecnico = new ControladorSoporteTecnico();
                                $SoporteTecnico->ctrCrearSoporteTecnico();
                                ?>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->