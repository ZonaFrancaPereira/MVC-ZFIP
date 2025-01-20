<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Inspecciones Realizas por Mes</h5>

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
                                <canvas id="graficaInspecciones" height="100" style="height: 100px;"></canvas>

                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                            <p class="text-center">
                                <strong>Usuarios por ZFIP</strong>
                            </p>
                            <?php
                            // Llamar al controlador para obtener los datos
                            $datosUsuarios = ControladorInspeccion::ctrContarUsuariosPorTipoZF();
                            $datoszf = ControladorInspeccion::ctrContarInspeccionesPorTipoZF();
                            ?>
                            <div class="container mt-5">

                                <?php foreach ($datosUsuarios as $usuario): ?>
                                    <?php
                                    $tipoZF = $usuario['tipo_zf']; // Tipo de ZF (zfip o clinica)
                                    $totalUsuarios = $usuario['total_usuarios']; // Total de usuarios actuales
                                    $totalReferencia = $totalesReferencia[$tipoZF] ?? 100; // Referencia por tipo
                                    $porcentaje = ($totalUsuarios / $totalReferencia) * 100; // Cálculo del porcentaje
                                    $nombreZona = ($tipoZF === "zfip")
                                        ? "Zona Franca Internacional de Pereira"
                                        : "Clínica Hispanoamericana";
                                    ?>
                                    <div class="progress-group mb-4">
                                        <div class="d-flex justify-content-between">
                                            <span><?php echo $nombreZona; ?></span>
                                            <span class="float-right">
                                                <b><?php echo $totalUsuarios; ?></b>/<?php echo $totalReferencia; ?>
                                            </span>
                                        </div>
                                        <div class="progress progress-sm">
                                            <div
                                                class="progress-bar <?php echo ($tipoZF === 'zfip') ? 'bg-primary' : 'bg-warning'; ?>"
                                                style="width: <?php echo $porcentaje; ?>%">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <!-- /.progress-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">
                        <div class="row">

                            <div class="col-sm-3 col-md-12">
                                <p class="text-center">
                                    <strong>Cantidad de Inpecciones al </strong>
                                    <?php
                                    // Configurar la localización a español
                                    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'esp');
                                    // Obtener la fecha actual en formato día mes año
                                    echo strftime('%d de %B de %Y');
                                    ?>
                                </p>
                            </div>
                            <?php foreach ($datoszf as $zf): ?>
    <?php
    $tipoZF = $zf['tipo_zf']; // Tipo de ZF (ZFIP o Clínica)
    $totalInspecciones = $zf['total_inspecciones']; // Total de inspecciones por tipo
    $totalReferencia = $totalesReferencia[$tipoZF] ?? 100; // Referencia por tipo (puedes definir un valor base de referencia)
    $porcentaje = ($totalInspecciones / $totalReferencia) * 100; // Cálculo del porcentaje
    $nombreZona = ($tipoZF === "zfip")
        ? "Zona Franca Internacional de Pereira"
        : "Clínica Hispanoamericana";

    // Asignar la clase de color de fondo al encabezado según el tipo de zona
    $h2BgColorClass = ($tipoZF === "zfip") ? "bg-primary" : "bg-warning";
    ?>
    <div class="col-sm-3 col-md-6">
        <div class="description-block border-right">
            <h2 class="text-white <?php echo $h2BgColorClass; ?>"><?php echo number_format($totalInspecciones); ?></h2>
            <span class="description-text"><?php echo "Total Inspecciones: " . $nombreZona; ?></span>
        </div>
        <!-- /.description-block -->
    </div>
<?php endforeach; ?>





                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>

</section>
<!-- /.content -->



<script>
    document.addEventListener('DOMContentLoaded', function() {
        fetch('controladores/inspeccion.controlador.php?action=graficaInspecciones')
            .then(response => response.json())
            .then(data => {
                const labels = data.labels; // Los nombres de los meses
                const zfipData = data.zfipData; // Inspecciones de ZFIP
                const clinicaData = data.clinicaData; // Inspecciones de Clínica

                const ctx = document.getElementById("graficaInspecciones").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                                label: "ZFIP",
                                data: zfipData,
                                backgroundColor: "rgb(0, 123, 255)", // Color de las barras ZFIP
                            },
                            {
                                label: "Clínica",
                                data: clinicaData,
                                backgroundColor: "rgb(255, 193, 7)", // Color de las barras Clínica
                            },
                        ],
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    color: "white", // Color de las leyendas
                                    font: {
                                        size: 14, // Tamaño de la fuente
                                    },
                                },
                            },
                            tooltip: {
                                titleColor: "white", // Color del título del tooltip
                                bodyColor: "white", // Color del texto del tooltip
                                backgroundColor: "rgba(0, 0, 0, 0.8)", // Fondo del tooltip
                            },
                        },
                        scales: {
                            x: {
                                ticks: {
                                    color: "white", // Color de las etiquetas en el eje X
                                    font: {
                                        size: 12,
                                    },
                                },
                                title: {
                                    display: true,
                                    text: "Mes",
                                    color: "white", // Color del título del eje X
                                    font: {
                                        size: 14,
                                        weight: "bold",
                                    },
                                },
                            },
                            y: {
                                ticks: {
                                    color: "white", // Color de las etiquetas en el eje Y
                                    font: {
                                        size: 12,
                                    },
                                },
                                title: {
                                    display: true,
                                    text: "Total Inspecciones",
                                    color: "white", // Color del título del eje Y
                                    font: {
                                        size: 14,
                                        weight: "bold",
                                    },
                                },
                            },
                        },
                    },
                });
            })
            .catch(error => console.error("Error al obtener los datos:", error));
    });
</script>