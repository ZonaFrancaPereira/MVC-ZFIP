<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">

      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">ACPM ADMINISTRATIVA </li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Nav Tabs -->
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Inicio</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="acpm-administrativa-tab" data-toggle="tab" href="#acpm-administrativa" role="tab" aria-controls="acpm-administrativa" aria-selected="false">ACPM Gestion Administrativa</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="estadisticas-acpm-administrativa-tab" data-toggle="tab" href="#estadisticas-acpm-administrativa" role="tab" aria-controls="estadisticas-acpm-administrativa" aria-selected="false">Estadísticas ACPM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="estadisticas-adicionales-administrativa-tab" data-toggle="tab" href="#estadisticas-adicionales-administrativa" role="tab" aria-controls="estadisticas-adicionales-administrativa" aria-selected="false">Estadísticas Adicionales</a>
  </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="myTabContent">
  <!-- Home Tab -->
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <!-- Content for Home tab can go here -->
  </div>
  <div class="tab-pane fade" id="acpm-administrativa" role="tabpanel" aria-labelledby="acpm-administrativa-tab">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-info">
                <h3 class="card-title">ACPM ADMINISTRATIVA
                </h3>
              </div>
              <div class="card-body">
                <table id="tabla-administrativa-sig" class="table table-bordered table-striped dt-responsive" width="100%">
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
  </div>
  <!-- /.EDITAR FECHA ACPM -->
  <section class="content">
    <div class="modal fade" id="modal-modificar-administrativa">
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
            <form id="form_modificar_administrativa" method="POST" enctype="multipart/form-data">
              <div class="card">
                <div class="card-header bg-light">
                  <p class="mb-1 font-weight-bold">Desea Modificar la fecha de la siguiente ACPM:</p>
                  <input type="text" class="form-control" name="administrativa" id="administrativa" readonly>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="modificar_fecha_administrativa" class="font-weight-bold">Nueva Fecha de Vencimiento</label>
                    <input type="date" name="modificar_fecha_administrativa" class="form-control" id="modificar_fecha_administrativa" required>
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
              $cerrar->ctrActualizarFechaAdministrativa();
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Estadísticas ACPM Tab -->
  <div class="tab-pane fade" id="estadisticas-acpm-administrativa" role="tabpanel" aria-labelledby="estadisticas-acpm-administrativa-tab">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h3 class="card-title">Estadísticas ACPM</h3>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="abiertasadministrativa"></span>
                    <span>ACPM Abiertas</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-success text-lg" id="cerradasadministrativa"></span>
                    <span>ACPM Cerradas</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="verificacionadministrativa"></span>
                    <span>En Verificación</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-warning text-lg" id="procesoadministrativa"></span>
                    <span>Proceso</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAcpmAdministrativa" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Estadísticas Adicionales Tab -->
  <div class="tab-pane fade" id="estadisticas-adicionales-administrativa" role="tabpanel" aria-labelledby="estadisticas-adicionales-administrativa-tab">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Estadísticas Adicionales Card -->
          <div class="col-md-12">
            <div class="card">
              <div class="card-header bg-secondary text-white">
                <h3 class="card-title">Estadísticas Adicionales</h3>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="AM_abiertoadministrativa"></span>
                    <span>ACCIÓN DE MEJORA Abierta</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="AM_cerradoadministrativa"></span>
                    <span>ACCIÓN DE MEJORA Cerrada</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_abiertoadministrativa"></span>
                    <span>ACCIÓN PREVENTIVA Abierta</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_cerradoadministrativa"></span>
                    <span>ACCIÓN PREVENTIVA Cerrada</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAccionesAdministrativa" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function cargarGrafica() {
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAcpmAdministrativa')
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('abiertasadministrativa').textContent = data.abiertas;
            document.getElementById('cerradasadministrativa').textContent = data.cerradas;
            document.getElementById('verificacionadministrativa').textContent = data.verificacion;
            document.getElementById('procesoadministrativa').textContent = data.proceso;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAcpmAdministrativa').getContext('2d');
            var pieData = {
              labels: ['Abiertas', 'Cerradas', 'Verificación', 'Proceso'],
              datasets: [{
                data: [data.abiertas, data.cerradas, data.verificacion, data.proceso],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8'],
                borderColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8']
              }]
            };
            var pieOptions = {
              maintainAspectRatio: false,
              responsive: true,
              plugins: {
                legend: {
                  labels: {
                    color: 'white' // Cambia el color de las etiquetas a blanco
                  }
                }
              }
            };
            new Chart(pieChartCanvas, {
              type: 'pie',
              data: pieData,
              options: pieOptions
            });
          }
        })
        .catch(error => console.error('Error al cargar datos:', error));
    }

    cargarGrafica();
  });

  document.addEventListener('DOMContentLoaded', function() {
    function cargarGrafica() {
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAccionesAdministrativa')
        .then(response => response.json())
        .then(data => {
          console.log('Datos recibidos:', data); // Depuración de la respuesta completa
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('AM_abiertoadministrativa').textContent = data.AM_abierto;
            document.getElementById('AM_cerradoadministrativa').textContent = data.AM_cerrado;
            document.getElementById('AP_abiertoadministrativa').textContent = data.AP_abierto;
            document.getElementById('AP_cerradoadministrativa').textContent = data.AP_cerrado;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAccionesAdministrativa').getContext('2d');
            var pieData = {
              labels: ['AM Abierta', 'AM Cerrada', 'AP Abierta', 'AP Cerrada'],
              datasets: [{
                data: [data.AM_abierto, data.AM_cerrado, data.AP_abierto, data.AP_cerrado],
                backgroundColor: ['#007bff', '#6c757d', '#28a745', '#dc3545'],
                borderColor: ['#007bff', '#6c757d', '#28a745', '#dc3545']
              }]
            };
            var pieOptions = {
              maintainAspectRatio: false,
              responsive: true,
              plugins: {
                legend: {
                  labels: {
                    color: 'white'
                  }
                }
              }
            };
            new Chart(pieChartCanvas, {
              type: 'pie',
              data: pieData,
              options: pieOptions
            });
          }
        })
        .catch(error => console.error('Error al cargar datos:', error));
    }

    cargarGrafica();
  });

</script>