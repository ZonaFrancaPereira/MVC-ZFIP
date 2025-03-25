<!-- Content Header (Page header) -->
<section class="content-header" id="nuevo_soporte">
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
<section class="content" id="soporte">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Solicitud de Soporte</h3>
                    </div>
                    <div class="card-body">
                        <form id="soporte_ti" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="textarea">Descripción de la solicitud</label>
                                        <textarea class="textarea form-control" id="descripcion_soporte" name="descripcion_soporte" rows="3" placeholder="Descripción"></textarea>
                                    </div>
                                </div>
                                <?php if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], [1, 2])): ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="id_usuario_fk">Nombre:</label>
                                        <select id="id_usuario_fk" name="id_usuario_fk" class="form-control" style="height: auto;">
                                            <option value="" disabled selected>Seleccione el responsable</option>
                                            <?php
                                            $usuario = ControladorUsuarios::ctrMostrarUsuarios(null, null);
                                            foreach ($usuario as $value) {
                                                echo '<option value="' . $value["id"] . '">' . $value["nombre"] . ' ' . $value["apellidos_usuario"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <?php endif; ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-outline-warning btn-block" id="enviar_soporte" name="enviar_soporte">
                                            <i class="fas fa-paper-plane"></i>Enviar
                                        </button>
                                    </div>
                                </div>
                                <?php
                                $crearSoporte = new ControladorSoporte();
                                $crearSoporte->ctrCrearSoporte();
                                ?>
                            </div>
                        </form>
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->