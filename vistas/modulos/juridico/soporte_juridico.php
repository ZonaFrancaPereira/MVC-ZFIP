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
                        <h3 class="card-title">Solicitud Legal- Gestion Juridica</h3>
                    </div>
                    <div class="card-body">
                        <form id="solicitud_juridico" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="nombre_solicitante">Nombre</label>
                                        <input type="text" class="form-control select2" id="nombre_solicitante" name="nombre_solicitante" required style="width: 100%;"
                                            value="<?php echo $_SESSION["nombre"]; ?>" readonly> <!-- El nombre del usuario logueado -->
                                    </div>
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="correo_solicitante">Correo Electronico</label>
                                        <input type="text" class="form-control select2" id="correo_solicitante" name="correo_solicitante" required style="width: 100%;"
                                            value="<?php echo $_SESSION["correo_usuario"]; ?>" readonly> <!-- El nombre del usuario logueado -->
                                    </div>
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="id_cargo_fk1">Cargo</label>
                                        <input type="text" class="form-control select2" id="id_cargo_fk1" name="id_cargo_fk1" required style="width: 100%;"
                                            value="<?php echo $_SESSION["id_cargo_fk"]; ?>" readonly> <!-- El nombre del usuario logueado -->
                                    </div>
                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="id_proceso_fk1">Proceso</label>
                                        <input type="text" class="form-control select2" id="id_proceso_fk1" name="id_proceso_fk1" required style="width: 100%;"
                                            value="<?php echo $_SESSION["id_proceso_fk"]; ?>" readonly> <!-- El nombre del usuario logueado -->
                                    </div>

                                    <div class="col-6" hidden>
                                        <br>
                                        <label for="estado_legal">Estado</label>
                                        <input type="text" class="form-control select2" id="estado_legal" name="estado_legal" required style="width: 100%;"
                                            value="Proceso" readonly> <!-- El nombre del usuario logueado -->
                                    </div>

                                    <div class="col-6">
                                        <label for="tipo_solicitud" class="form-label mt-2" style="font-weight: bold; font-size: 1.2rem; ">
                                            Tipo de Solicitud
                                        </label>
                                        <input type="text" class="form-control select2" id="tipo_solicitud" name="tipo_solicitud" required
                                            style=" width: 100%;padding: 10px 15px; border-radius: 8px; border: 2px solid #17a2b8; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); transition: border-color 0.3s ease, box-shadow 0.3s ease;">
                                    </div>

                                    <div class="col-md-12 mt-4">
                                        <label for="descripcion_solicitud_juridico" class="form-label" style="font-weight: bold; font-size: 1.2rem;">
                                            Descripción de la solicitud
                                        </label>
                                        <textarea class="textarea form-control" id="descripcion_solicitud_juridico" name="descripcion_solicitud_juridico" rows="4" placeholder="Descripción"
                                            style=" width: 100%;padding: 15px;border-radius: 8px; border: 2px solid #17a2b8; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); resize: vertical; transition: border-color 0.3s ease, box-shadow 0.3s ease;"></textarea>
                                    </div>
                                </div> <br>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-outline-warning btn-block" id="enviar_soporte_juridico" name="enviar_soporte_juridico"><i class="fas fa-paper-plane"></i>Enviar</button>
                                </div>
                                <?php
                                $SoporteJuridico = new ControladorSoporteJuridico();
                                $SoporteJuridico->ctrCrearSoporteJuridico();
                                ?>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
<style>
    #tipo_solicitud:focus,
    #descripcion_solicitud_juridico:focus {
        border-color: #007bff;
        box-shadow: 0 6px 12px rgba(0, 123, 255, 0.3);
        outline: none;
    }
</style>