
<style>
#graficaTI {
    min-height: 300px !important;
}
</style>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">

            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="inicio">Inicio</a></li>
                    <li class="breadcrumb-item active">INVENTARIO</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Recursos Tecnológicos</h5>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>

                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <p class="text-center">
                                <strong><?php echo date('Y'); ?></strong>
                            </p>

                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="graficaTI" height="100" style="height: 100px;"></canvas>

                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                         <div class="col-md-4">
                         <div id="tablaCategorias"></div>
                         </div>
                        
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

</section>
<!-- /.content -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('controladores/activos.controlador.php?action=graficaCategorias')
        .then(response => response.json())
        .then(data => {
            if (!data || data.length === 0) {
                console.error("No hay datos disponibles para la gráfica.");
                return;
            }

            // Obtener etiquetas y valores
            const labels = data.map(item => item.categoria);
            const valores = data.map(item => item.total);

            // Obtener el contexto del canvas
            const ctx = document.getElementById("graficaTI").getContext("2d");

            // Configuración de la gráfica
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Cantidad de Activos por Categoría",
                        data: valores,
                        backgroundColor: "#8bc34a",
                        borderColor: "rgb(255, 255, 255)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            ticks: { color: "#ffffff" }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: { color: "#ffffff" },
                            grid: { color: "rgb(255, 255, 255)" }
                        }
                    },
                    plugins: {
                        legend: { labels: { color: "#ffffff" } },
                        tooltip: {
                            backgroundColor: "rgba(0, 0, 0, 0.8)",
                            titleColor: "#ffffff",
                            bodyColor: "#ffffff"
                        }
                    }
                }
            });

            // Calcular el total de activos
            const totalActivos = valores.reduce((acc, curr) => acc + curr, 0);

            // Generar la tabla con los datos
            generarTablaCategorias(data, totalActivos);
        })
        .catch(error => console.error("Error al obtener los datos:", error));
});

// Función para generar la tabla de categorías
function generarTablaCategorias(data, total) {
    let tablaHTML = `
        <table class="table table-dark table-striped mt-3">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
    `;

    data.forEach(item => {
        tablaHTML += `
            <tr>
                <td>${item.categoria}</td>
                <td>${item.total}</td>
            </tr>
        `;
    });

    // Agregar fila con la suma total
    tablaHTML += `
            <tr class="bg-primary text-dark">
                <td><strong>Total</strong></td>
                <td><strong>${total}</strong></td>
            </tr>
        </tbody>
    </table>`;

    document.getElementById("tablaCategorias").innerHTML = tablaHTML;
}
</script>

