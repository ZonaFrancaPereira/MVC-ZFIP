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
          <form id="form_modificar_tecnica" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header bg-light">
                <p class="mb-1 font-weight-bold">Desea Modificar la fecha de la siguiente ACPM:</p>
                <input type="text" class="form-control" name="id_acpm_fk1" id="id_acpm_fk1" readonly>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="fecha_modificar" class="font-weight-bold">Nueva Fecha de Vencimiento</label>
                  <input type="date" name="modificar_fecha_tecnica" class="form-control" id="fecha_modificar" required>
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
            $cerrar->ctrActualizarFechaAcpm();
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- DONUT CHART -->
<div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>