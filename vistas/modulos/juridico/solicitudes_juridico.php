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
                        <h3 class="card-title">Solicitudes</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-soporte-juridico" class="table table-bordered table-striped dt-responsive" width="100%">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Cargo</th>
                                        <th>Fecha</th>
                                        <th>Proceso</th>
                                        <th>Elaboración de Contrato</th>
                                        <th>Formulación de Conceptos e Informes</th>
                                        <th>Respuesta de Requerimientos</th>
                                        <th>Descripción</th>
                                        <th>Estado</th>
                                        <th>Responder</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Aquí van los datos de la tabla -->
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
    <div class="modal fade" id="modal-juridico">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title text-white">Responder Solicitud Legal</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form  method="POST" enctype="multipart/form-data">
                        <div class="form-group" hidden>
                            <label>Desea Darle Respuesta a esta Solicitud:</label><input type="text" class="form-control" value="" name="id_soporte_juridico" id="id_soporte_juridico" readonly>
                        </div>
                        <div class="form-group">
                            <label for="fecha_solucion_juridico">Fecha Solución</label>
                            <input type="date" name="fecha_solucion_juridico" class="form-control" id="fecha_solucion_juridico" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="nombre_solucion">Nombre de Usuario quien da respuesta a la solicitud</label>
                            <input type="text" class="form-control select2" id="nombre_solucion" name="nombre_solucion" required style="width: 100%;"
                                            value="<?php echo $_SESSION["nombre"]; ?>" readonly> <!-- El correo del usuario logueado -->
                        </div>
                        <div class="form-group">
                            <label for="estado_legal_cerrado">Nombre de Usuario quien da respuesta a la solicitud</label>
                            <input type="text" class="form-control select2" id="estado_legal_cerrado" name="estado_legal_cerrado" required style="width: 100%;"
                                            value="Cerrado" readonly> <!-- El correo del usuario logueado -->
                        </div>
                        <div class="form-group">
                            <label for="solucion_juridico">Solución</label>
                            <textarea class="form-control" id="solucion_juridico" name="solucion_juridico" rows="3" placeholder="Escribe aquí la solución"></textarea>
                        </div>
                        <div class="col-md-12 mt-4">
                                        <label for="firma_juridica" class="font-weight-bold">Firma</label>
                                        <input type="text" class="form-control" id="firma_juridica" name="firma_juridica" value="<?php echo $_SESSION['foto']; ?>" required >
                                    </div>
                        <button type="submit" class="btn btn-info btn-block" id="responder_solicitud" name="responder_solicitud">Responder</button>
                        <?php
                            $ResponderSolicitudJuridica = new ControladorSoporteJuridico();
                            $ResponderSolicitudJuridica->ctrResponderSolicitudJuridico();
                            ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>