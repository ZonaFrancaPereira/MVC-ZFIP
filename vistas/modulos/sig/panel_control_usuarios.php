<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6"></div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
          <li class="breadcrumb-item active">ACPM</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Tab Content -->
<div class="tab-content" id="myTabContent">
  <!-- Estadísticas ACPM Tab -->
  <div class="" id="" aria-labelledby="estadisticas-acpm-sig-tab">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Columna para Estadísticas ACPM -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h3 class="card-title">Estadísticas ACPM</h3>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="abiertasusuario"></span>
                    <span>ACPM Abiertas</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="abiertavencidasusuario"></span>
                    <span>ACPM Abiertas Vencidas</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-success text-lg" id="cerradasusuario"></span>
                    <span>ACPM Cerradas</span>
                  </p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="verificacionusuario"></span>
                    <span>En Verificación</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-warning text-lg" id="procesousuario"></span>
                    <span>Proceso</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAcpmGeneral" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Columna para Estadísticas Adicionales -->
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-secondary text-white">
                <h3 class="card-title">Estadísticas Adicionales</h3>
              </div>
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="AM_abiertousuario"></span>
                    <span>ACCIÓN DE MEJORA Abierta</span>
                  </p>
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg" id="AM_cerradousuario"></span>
                    <span>ACCIÓN DE MEJORA Cerrada</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_abiertousuario"></span>
                    <span>ACCIÓN PREVENTIVA Abierta</span>
                  </p>
                  <p class="d-flex flex-column text-right">
                    <span class="text-info text-lg" id="AP_cerradousuario"></span>
                    <span>ACCIÓN PREVENTIVA Cerrada</span>
                  </p>
                </div>
                <div class="mt-3">
                  <canvas id="graficaVerificacionAccionesGeneral" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
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
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAcpmGeneral')
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('abiertasusuario').textContent = data.abiertas;
            document.getElementById('cerradasusuario').textContent = data.cerradas;
            document.getElementById('verificacionusuario').textContent = data.verificacion;
            document.getElementById('procesousuario').textContent = data.proceso;
            document.getElementById('abiertavencidasusuario').textContent = data.vencida;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAcpmGeneral').getContext('2d');
            var pieData = {
              labels: ['Abiertas', 'Cerradas', 'Verificación', 'Proceso'],
              datasets: [{
                data: [data.abiertas, data.cerradas, data.verificacion, data.proceso, data.vencida],
                backgroundColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#17a2b8'],
                borderColor: ['#007bff', '#28a745', '#ffc107', '#17a2b8', '#17a2b8']
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
      fetch('controladores/acpm.controlador.php?action=graficaVerificacionAccionesGeneral')
        .then(response => response.json())
        .then(data => {
          console.log('Datos recibidos:', data); // Depuración de la respuesta completa
          if (data.error) {
            console.error('Error en los datos:', data.error);
          } else {
            // Actualizar los elementos HTML con los valores obtenidos
            document.getElementById('AM_abiertousuario').textContent = data.AM_abierto;
            document.getElementById('AM_cerradousuario').textContent = data.AM_cerrado;
            document.getElementById('AP_abiertousuario').textContent = data.AP_abierto;
            document.getElementById('AP_cerradousuario').textContent = data.AP_cerrado;

            // Crear la gráfica
            var pieChartCanvas = document.getElementById('graficaVerificacionAccionesGeneral').getContext('2d');
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