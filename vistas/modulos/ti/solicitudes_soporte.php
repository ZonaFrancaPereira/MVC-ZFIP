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
                        <table id="tabla-soporte-ti" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Descripcion</th>
                                    <th>Urgencia</th>
                                    <th>Solucion</th>
                                    <th>Fecha de Respuesta</th>
                                    <th>Tecnico</th>
                                    <th>Asignar Urgencia</th>
                                    <th>Respuesta</th>
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
    <div class="modal fade" id="modal-urgencia">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h4 class="modal-title">Asignar el tipo de Urgencia a la Solicitud</h4>
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="card border-danger">
                            <div class="card-header bg-danger text-white" hidden>
                                <h5 class="card-title mb-0">ID de Soporte:</h5>
                                <input type="text" class="form-control mb-3" value="" id="id_soporte" name="id_soporte" readonly>
                            </div>
                            <div class="card-body">
                                <div class="btn-group btn-group-toggle d-flex justify-content-center" data-toggle="buttons" id="grupo_urgencia">
                                    <label class="btn btn-outline-danger active">
                                        <input type="radio" name="urgencia" value="Urgente" autocomplete="off" checked> 1
                                    </label>
                                    <label class="btn btn-outline-warning">
                                        <input type="radio" name="urgencia" value="Urgencia media" autocomplete="off"> 2
                                    </label>
                                    <label class="btn btn-outline-success">
                                        <input type="radio" name="urgencia" value="Prioridad baja" autocomplete="off"> 3
                                    </label>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <button type="submit" class="btn bg-info text-white btn-block" id="responder_urgencia" name="responder_urgencia">Asignar</button>
                            </div>
                        </div>
                </div>
                <?php
                $asignarUrgencia = new ControladorSoporte();
                $asignarUrgencia->ctrCrearUrgencia();
                ?>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="modal fade" id="modal-solicitud">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white">Responder Solicitud de Soporte</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form  method="POST" enctype="multipart/form-data">
                        <div class="form-group" hidden>
                            <label>Desea Darle Respuesta a esta Solicitud de Soporte:</label><input type="text" class="form-control" value="" name="id_soporte1" id="id_soporte1" readonly>
                        </div>
                        <div class="form-group">
                            <label for="solucion_soporte">Solución</label>
                            <textarea class="form-control" id="solucion_soporte" name="solucion_soporte" rows="3" placeholder="Escribe aquí la solución"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fecha_solucion">Fecha Solución</label>
                            <input type="date" name="fecha_solucion" class="form-control" id="fecha_solucion" required>
                        </div>
                        <div class="form-group">
                            <label for="usuario_respuesta">Nombre de Usuario quien da respuesta a la solicitud</label>
                            <input list="usuario_respuesta_browsers" class="form-control" id="usuario_respuesta" name="usuario_respuesta" placeholder="Nombre de Usuario">
                        </div>
                        <button type="submit" class="btn btn-info btn-block" id="responder_solicitud" name="responder_solicitud">Responder</button>
                        <?php
                $ResponderSolicitud = new ControladorSoporte();
                $ResponderSolicitud->ctrResponderSolicitud();
                ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>