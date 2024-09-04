<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ACPM TECNICA </li>
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
                        <h3 class="card-title">ACPM TECNICA
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-tecnica-sig" class="table table-bordered table-striped dt-responsive" width="100%">
                            <thead class="bg-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Nombre del responsable</th>
                                    <th>Origen ACPM</th>
                                    <th>Fuente</th>
                                    <th>Tipo de Reporte</th>
                                    <th>Descripción ACPM</th>
                                    <th>Fecha Finalización</th>
                                    <th>Estado</th>
                                    <th>Informe</th>
                                    <th>Modificar Fecha</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.EDITAR FECHA ACPM -->
<section class="content">
            <div class="modal fade" id="modal-modificar">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header btn bg-info btn-block">
                    <h4 class="modal-title">Modificar Fecha</h4>
                  </div>
                  <div class="modal-body">
                    <div class="row">
                      <form id="form_modificar_sig" method="POST">
                        <div class="card">
                          <div class="card-header">
                            <label>Desea Modificar la fecha de la siguiente ACPM:</label><input type="text" class="form-control" value="" name="id_acpm_fk1" id="id_acpm_fk1" readonly>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="col-md-12 col-xs-12 col-sm-12">
                                <label for="fecha_modificar">Modificar fecha de vencimiento de la ACPM</label>
                                <input type="date" name="fecha_modificar" class="form-control" id="fecha_modificar" required>
                              </div>
                              <div class="col-md-12 col-xs-12 col-sm-12"><br>
                                <br>
                                <button type="button" class="btn bg-info btn-block" id="modificar_fecha" name="modificar_fecha">Actualizar Fecha</button>
                              </div>
                            </div>
                      </form>
                      <!-- /.modal-content -->
                      <!-- /.card-body -->
                    </div>
                  </div>
                  <!-- /.modal-dialog -->
                </div>
              </div>
              <!-- /.modal -->
          </section>