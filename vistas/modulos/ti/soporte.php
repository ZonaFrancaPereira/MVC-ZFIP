<section class="content">
    <div class="container-fluid">
        <div class="tab-content card">
            <div id="realizar_solicitud" class="tab-pane">
                <div class="card card-custom">
                    <div class="card-header bg-warning">
                        <center>
                            <h3 class="card-title">¡Haz tu Solicitud de Soporte Aquí!</h3>
                        </center>
                    </div>
                    <!-- /.FORMULARIO PARA REALIZAR SOLICITUD DE SOPORTE -->
                    <div id="realizar_solicitud" class="tab-pane">
                        <div class="card card-custom">
                            <form id="soporte_ti" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="correo">Correo</label>
                                            <input list="correo_soporte_browsers" class="form-control" value="<?php echo $_SESSION['correo_usuario'] ?>" id="correo_soporte" name="correo_soporte" placeholder="Correo">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="id_usuario_soporte">id usuario</label>
                                            <input type="text" class="form-control" id="id_usuario_fk" value="<?php echo $_SESSION['id'] ?>" name="id_usuario_fk" placeholder="ID de Usuario">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="usuario_soporte">Nombre de Usuario</label>
                                            <input type="text" class="form-control" id="usuario_soporte" value="<?php echo $_SESSION['nombre'] . " " . $_SESSION['apellidos_usuario'] ?>" name="usuario_soporte" placeholder="Nombre de Usuario">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="proceso_soporte">Proceso</label>
                                            <input type="text" class="form-control" id="proceso_soporte" value="<?php echo $_SESSION['id_proceso_fk'] ?>" name="proceso_soporte" placeholder="Proceso">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="textarea">Descripción de la solicitud</label>
                                            <textarea class="form-control" id="descripcion_soporte" name="descripcion_soporte" rows="3" placeholder="Descripción"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-outline-warning btn-block" id="enviar_soporte" name="enviar_soporte"><i class="fas fa-paper-plane"></i>Enviar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>