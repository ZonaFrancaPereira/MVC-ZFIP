<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ACPM INFORMATICA </li>
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
                        <h3 class="card-title">ACPM INFORMATICA
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-informatica-sig" class="table table-bordered table-striped dt-responsive" width="100%">
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
  <div class="modal fade" id="modal-modificar-informatica">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Modificar Fecha de Vencimiento</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <!-- Modal Body -->
        <div class="modal-body">
          <form id="form_modificar_informatica" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header bg-light">
                <p class="mb-1 font-weight-bold">Desea Modificar la fecha de la siguiente ACPM:</p>
                <input type="text" class="form-control" name="informatica" id="informatica" readonly>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="modificar_fecha_informatica" class="font-weight-bold">Nueva Fecha de Vencimiento</label>
                  <input type="date" name="modificar_fecha_informatica" class="form-control" id="modificar_fecha_informatica" required>
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-info" id="modificar_fecha" name="modificar_fecha">
                    <i class="fas fa-calendar-alt"></i> Actualizar Fecha
                  </button>
                </div>
              </div>
            </div>
            <?php
            $cerrar = new ControladorAcpm();
            $cerrar->ctrActualizarFechaInformatica();
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>