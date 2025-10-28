<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ACPM</li>
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
                    <div class="card-body">
                        <!-- DIV DONDE SE MOSTRARA EL FORMULARIO PARA UNA NUEVA ACPM -->
                        <div class="tab-pane ">
                            <form method="POST" enctype="multipart/form-data"  id="acpm">
                                <div class="card card-navy">
                                    <div class="card-header">
                                        <center>
                                            <h4>Nueva Accion Correctiva, Preventiva o de Mejora</h4>
                                        </center>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                                                <label>Nombre del Resposable</label>
                                                <input type="text" name="" value="<?php echo $_SESSION['nombre']?>" class="form-control" readonly>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                                                <label>Cargo</label>
                                                <input type="text" name="" value="<?php echo $_SESSION['id_cargo_fk'] ?>" class="form-control">
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12" hidden>
                                                <label>Origen ACPM</label>
                                                <input class="form-control" id="origen_acpm" name="origen_acpm" rows="3" value="N/A" required></input>
                                            </div>
                                            <div class="col-2 col-xs-12 col-sm-12">
                                                <label>Fuente</label>
                                                <select class="form-control" id="fuente_acpm" name="fuente_acpm" required>
                                                    <option value="AI">Auditoria Interna</option>
                                                    <option value="AE">Auditoria Externa</option>
                                                    <option value="Otros">Otros</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12" id="fuente">
                                                <label>Descripcion Fuente</label>
                                                <textarea class="form-control" id="descripcion_fuente" name="descripcion_fuente" rows="3"></textarea>
                                            </div>
                                            <div class="col-2 col-xs-12 col-sm-12">
                                                <label>Tipo de Reporte</label>
                                                <select class="form-control" id="tipo_acpm" name="tipo_acpm" required>
                                                    <option value="AM">Acción de Mejora</option>
                                                    <option value="AC">Acción Correctiva</option>
                                                    <option value="AP">Acción Preventiva</option>

                                                </select>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <label>Descripción ACPM</label>
                                                <textarea class="form-control" id="descripcion_acpm" name="descripcion_acpm" rows="3" required></textarea>
                                            </div>
                                            <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                                                <center>
                                                    <h5>Análisis del Hallazgo</h5>
                                                </center>

                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <label>Análisis de Causa (Técnicas de los por ques, espina de pescado, lluvia de ideas, etc)</label>
                                                <textarea class="form-control" id="causa_acpm" name="causa_acpm" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <label>¿Se identifican No Conformidades similares o que potencialmente puedan ocurrir en otro proceso?</label>
                                                <select class="form-control" id="nc_similar" name="nc_similar" required>
                                                    <option>Selecciona una Opcion</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12" id="similares">
                                                <label>Describe cuales y en que proceso</label>
                                                <textarea class="form-control" id="descripcion_nsc" name="descripcion_nsc" rows="3"></textarea>
                                            </div>
                                            <div class="col-12 bg-navy pt-2 mt-3 col-xs-12 col-sm-12">
                                                <center>
                                                    <h5>Plan de Mejora</h5>
                                                </center>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12" id="correccion">
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <label>Fecha Correcion</label>
                                                    <input type="date" name="fecha_correccion" class="form-control" id="fecha_correccion" >
                                                </div>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <label>Corrección ACPM</label>
                                                    <textarea class="form-control" id="correccion_acpm" name="correccion_acpm" rows="3" ></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                                                <label>Estado ACPM</label>
                                                <input type="text" name="estado_acpm" value="verificacion" class="form-control" readonly>
                                            </div>

                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <label>Se identificó peligros de SST nuevos o que han cambiado, o la necesidad de generar controles nuevos o modificar los existentes</label>
                                                <select class="form-control" id="riesgo_acpm" name="riesgo_acpm" required>
                                                    <option>Selecciona una Opcion</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12" id="riesgos">
                                                <label>Describa cuales son los riegos</label>
                                                <textarea class="form-control" id="justificacion_riesgo" name="justificacion_riesgo" rows="3"></textarea>
                                            </div>
                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <label>Fecha Finalización (Fecha en la cual la acción debe estar cerrada)</label>
                                                <input type="date" name="fecha_finalizacion" class="form-control" id="fecha_finalizacion" required>
                                            </div>
                                            <div class="col-md-6 col-xs-6 col-sm-6" hidden>
                                                <label>Id Usuario</label>
                                                <input type="text" name="id_usuario_fkacpm" id="id_usuario_fkacpm" value="<?php echo $_SESSION['id'] ?>" class="form-control" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <button type="submit" class="btn btn-success btn-block ">Radicar ACPM</button>
                                    </div>
                                </div>
                                <?php
                                $CrearAcpm = new ControladorAcpm();
                                $CrearAcpm->ctrCrearAcpm();
                                ?>
                            </form>
                        </div>
                        <!-- DIV DONDE TERMINA EL FORMULARIO DE ACPM-->
                    </div><!-- /.card-body -->
                </div><!-- /.card -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section><!-- /.content -->
