<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">ACPM GERENCIA </li>
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
    <a class="nav-link" id="acpm-gerencia-tab" data-toggle="tab" href="#acpm-gerencia" role="tab" aria-controls="acpm-gerencia" aria-selected="false">ACPM Gerencia</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="estadisticas-acpm-gerencia-tab" data-toggle="tab" href="#estadisticas-acpm-gerencia" role="tab" aria-controls="estadisticas-acpm-gerencia" aria-selected="false">Estadísticas ACPM</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="estadisticas-adicionales-gerencia-tab" data-toggle="tab" href="#estadisticas-adicionales-gerencia" role="tab" aria-controls="estadisticas-adicionales-gerencia" aria-selected="false">Estadísticas Adicionales</a>
  </li>
</ul>
<!-- Tab Content -->
<div class="tab-content" id="myTabContent">
  <!-- Home Tab -->
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <!-- Content for Home tab can go here -->
  </div>

  <div class="tab-pane fade" id="acpm-gerencia" role="tabpanel" aria-labelledby="acpm-gerencia-tab">
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <h3 class="card-title">ACPM GERENCIA 
                        </h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla-gerencia-sig" class="table table-bordered table-striped dt-responsive" width="100%">
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
  <div class="modal fade" id="modal-modificar-gerencia">
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
          <form id="form_modificar_gerencia" method="POST" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header bg-light">
                <p class="mb-1 font-weight-bold">Desea Modificar la fecha de la siguiente ACPM:</p>
                <input type="text" class="form-control" name="gerencia" id="gerencia" readonly>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label for="modificar_fecha_gerencia" class="font-weight-bold">Nueva Fecha de Vencimiento</label>
                  <input type="date" name="modificar_fecha_gerencia" class="form-control" id="modificar_fecha_gerencia" required>
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
            $cerrar->ctrActualizarFechaGerencia();
            ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
 <!-- Estadísticas ACPM Tab -->
 <div class="tab-pane fade" id="estadisticas-acpm-gerencia" role="tabpanel" aria-labelledby="estadisticas-acpm-gerencia-tab">
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
                    <span class="text-bold text-lg" id="abiertasgerencia"></span>
                    <span>ACPM Abiertas</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-success text-lg" id="cerradasgerencia"></span>
                    <span>ACPM Cerradas</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="verificaciongerencia"></span>
                    <span>En Verificación</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-warning text-lg" id="procesogerencia"></span>
                    <span>Proceso</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column text-right">
                    <span class="text-warning text-lg" id="vencidagerencia"></span>
                    <span>Abierta Vencida</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAcpmGerencia " style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

   <!-- Estadísticas Adicionales Tab -->
   <div class="tab-pane fade" id="estadisticas-adicionales-gerencia" role="tabpanel" aria-labelledby="estadisticas-adicionales-gerencia-tab">
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
                    <span class="text-bold text-lg" id="AM_abiertogerencia"></span>
                    <span>ACCIÓN DE MEJORA Abierta</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="AM_cerradogerencia"></span>
                    <span>ACCIÓN DE MEJORA Cerrada</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_abiertogerencia"></span>
                    <span>ACCIÓN PREVENTIVA Abierta</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_cerradogerencia"></span>
                    <span>ACCIÓN PREVENTIVA Cerrada</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAccionesGerencia" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAcpmGerencia ')
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('abiertasgerencia').textContent = data.abiertas;
            document.getElementById('cerradasgerencia').textContent = data.cerradas;
            document.getElementById('verificaciongerencia').textContent = data.verificacion;
            document.getElementById('procesogerencia').textContent = data.proceso;
            document.getElementById('vencidagerencia').textContent = data.vencida;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAcpmGerencia ').getContext('2d');
            var pieData = {
              labels: ['Abiertas', 'Cerradas', 'Verificación', 'Proceso', 'Vencida'],
              datasets: [{
                data: [data.abiertas, data.cerradas, data.verificacion, data.proceso, data.vencida],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#dc3545'],
                borderColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#dc3545']
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
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAccionesGerencia')
        .then(response => response.json())
        .then(data => {
          console.log('Datos recibidos:', data); // Depuración de la respuesta completa
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('AM_abiertogerencia').textContent = data.AM_abierto;
            document.getElementById('AM_cerradogerencia').textContent = data.AM_cerrado;
            document.getElementById('AP_abiertogerencia').textContent = data.AP_abierto;
            document.getElementById('AP_cerradogerencia').textContent = data.AP_cerrado;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAccionesGerencia').getContext('2d');
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