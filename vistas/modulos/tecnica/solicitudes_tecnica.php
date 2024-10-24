<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">Solicitudes de Soporte</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">Solicitudes </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-soporte-tecnico" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Correo</th>
                                    <th>Proceso</th>
                                    <th>Descripcion</th>
                                    <th>Solucion</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="modal fade" id="modal-respuesta">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white">Responder Solicitud de Soporte</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form  method="POST" enctype="multipart/form-data">
                        <div class="form-group" hidden>
                            <label>Desea Darle Respuesta a esta Solicitud de Soporte:</label><input type="text" class="form-control" value="" name="id_soporte_tecnico" id="id_soporte_tecnico" readonly>
                        </div>
                        <div class="form-group">
                            <label for="solucion_soporte_tecnico">Solución</label>
                            <textarea class="form-control" id="solucion_soporte_tecnico" name="solucion_soporte_tecnico" rows="3" placeholder="Escribe aquí la solución"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fecha_solucion_soporte">Fecha Solución</label>
                            <input type="date" name="fecha_solucion_soporte" class="form-control" id="fecha_solucion_soporte" required>
                        </div>
                        <div class="form-group">
                            <label for="usuario_respuesta">Nombre de Usuario quien da respuesta a la solicitud</label>
                            <input type="text" class="form-control select2" id="usuario_respuesta" name="usuario_respuesta" required style="width: 100%;"
                                            value="<?php echo $_SESSION["nombre"]; ?>" readonly> <!-- El correo del usuario logueado -->
                        </div>

                        <button type="submit" class="btn btn-info btn-block" id="responder_solicitud" name="responder_solicitud">Responder</button>
                        <?php
                            $ResponderSolicitudTecnica = new ControladorSoporteTecnico();
                            $ResponderSolicitudTecnica->ctrResponderSolicitudTecnico();
                            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>