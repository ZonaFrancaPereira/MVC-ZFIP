<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/acpm.controlador.php";
require_once "../../../modelos/acpm.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de ACPM desde la URL
$id_acpm = $_GET['id'];
echo $id_acpm;
// Obtener los datos del ACPM desde la base de datos
$tabla = 'acpm';
$item = 'id_consecutivo';
$valor = $id_acpm;
$consulta = 'acpm';
$datos = ModeloAcpm::mdlMostrarAcpmpdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de ACPM proporcionado.');
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de ACPM');
$pdf->SetSubject('Detalles de la ACPM');

// Eliminar las líneas de encabezado y pie de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer los márgenes
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);

// Establecer el tipo de letra predeterminado
$pdf->SetFont('helvetica', '', 10);

// Añadir una página
$pdf->AddPage();

// Obtener la información del primer registro
$row = $datos[0];

// Asignar variables para el contenido HTML
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$fecha_acpm = $row["fecha_acpm"];
$nombre_proceso = $row["nombre_proceso"];
$nombre_cargo = $row["nombre_cargo"];
$origen_acpm = $row["origen_acpm"];
$fuente_acpm = $row["fuente_acpm"];
$descripcion_fuente = $row["descripcion_fuente"];
$tipo_acpm = $row["tipo_acpm"];
$causa_acpm = $row["causa_acpm"];
$nc_similar = $row["nc_similar"];
$descripcion_nsc = $row["descripcion_nsc"];
$estado_acpm = $row["estado_acpm"];
$riesgo_acpm = $row["riesgo_acpm"];
$justificacion_riesgo = $row["justificacion_riesgo"];
$cambios_sig = $row["cambios_sig"];
$justificacion_sig = $row["justificacion_sig"];
$conforme_sig = $row["conforme_sig"];
$justificacion_conforme_sig = $row["justificacion_conforme_sig"];
$fecha_estado = $row["fecha_estado"];
$fecha_finalizacion = $row["fecha_finalizacion"];

// Contenido del documento en formato HTML
$html = <<<EOF
<style>
    .title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 15px;
        color: #004080;
    }
    .section-title {
        font-size: 14px;
        font-weight: bold;
        background-color: #004080;
        color: #ffffff;
        text-align: center;
        padding: 5px;
        margin-top: 20px;
    }
    .content-table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
    }
    .content-table th, .content-table td {
        border: 1px solid #004080;
        padding: 8px;
        text-align: left;
    }
    .content-table th {
        background-color: #004080;
        color: #ffffff;
    }
    .content-table td {
        background-color: #f2f2f2;
    }
</style>

<div class="title">FORMATO ACPM - ID # $id_acpm</div>

<div class="section-title">INFORMACIÓN DEL RESPONSABLE</div>
<table class="content-table">
    <tr>
        <th>Nombre</th>
        <td>$nombre_usuario $apellidos_usuario</td>
        <th>Proceso</th>
        <td>$nombre_proceso</td>
    </tr>
    <tr>
        <th>Cargo</th>
        <td>$nombre_cargo</td>
        <th>Fecha (DD-MM-AA)</th>
        <td>$fecha_acpm</td>
    </tr>
</table>

<div class="section-title">DETALLES DEL ACPM</div>
<table class="content-table">
    <tr>
        <th>Origen ACPM</th>
        <td>$origen_acpm</td>
        <th>Fuente ACPM</th>
        <td>$fuente_acpm</td>
    </tr>
    <tr>
        <th>Descripción de la Fuente</th>
        <td colspan="3">$descripcion_fuente</td>
    </tr>
    <tr>
        <th>Tipo ACPM</th>
        <td>$tipo_acpm</td>
        <th>Fecha ACPM</th>
        <td>$fecha_acpm</td>
    </tr>
    <tr>
        <th>Causa ACPM</th>
        <td>$causa_acpm</td>
        <th>NC Similar</th>
        <td>$nc_similar</td>
    </tr>
    <tr>
        <th>Descripción del NC Similar</th>
        <td colspan="3">$descripcion_nsc</td>
    </tr>
    <tr>
        <th>Estado ACPM</th>
        <td>$estado_acpm</td>
        <th>Riesgo ACPM</th>
        <td>$riesgo_acpm</td>
    </tr>
    <tr>
        <th>Justificación del Riesgo</th>
        <td colspan="3">$justificacion_riesgo</td>
    </tr>
    <tr>
        <th>Cambios SIG</th>
        <td>$cambios_sig</td>
        <th>Justificación SIG</th>
        <td>$justificacion_sig</td>
    </tr>
    <tr>
        <th>Conforme SIG</th>
        <td>$conforme_sig</td>
        <th>Justificación Conforme SIG</th>
        <td>$justificacion_conforme_sig</td>
    </tr>
    <tr>
        <th>Fecha de Estado</th>
        <td>$fecha_estado</td>
        <th>Fecha de Finalización</th>
        <td>$fecha_finalizacion</td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Consultar las actividades relacionadas con el ACPM
try {
    $stmt2 = Conexion::conectar()->prepare('SELECT * FROM actividades_acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id WHERE a.id_acpm_fk = :id_acpm');
    $stmt2->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {
        while ($row2 = $stmt2->fetch()) {
            $id_actividad = $row2['id_actividad'];
            $fecha_actividad = $row2["fecha_actividad"];
            $descripcion_actividad = $row2["descripcion_actividad"];
            $estado_actividad = $row2["estado_actividad"];
            $tipo_actividad = $row2["tipo_actividad"];
            $responsable = $row2["nombre"];
            $apellido_responsable = $row2["apellidos_usuario"];

            $nombre_actividad = ($tipo_actividad == "Correccion") ? $tipo_actividad . " Inmediata" : $tipo_actividad;

            $actividad_html = <<<EOF
            <style>
                .title {
                    text-align: center;
                    font-size: 18px;
                    font-weight: bold;
                    margin-bottom: 15px;
                    color: #004080;
                }
                .section-title {
                    font-size: 14px;
                    font-weight: bold;
                    background-color: #004080;
                    color: #ffffff;
                    text-align: center;
                    padding: 5px;
                    margin-top: 20px;
                }
                .content-table {
                    border-collapse: collapse;
                    width: 100%;
                    margin-top: 10px;
                }
                .content-table th, .content-table td {
                    border: 1px solid #004080;
                    padding: 8px;
                    text-align: left;
                }
                .content-table th {
                    background-color: #004080;
                    color: #ffffff;
                }
                .content-table td {
                    background-color: #f2f2f2;
                }
            </style>

            <!-- Título de la Actividad -->
            <div class="section-title">$nombre_actividad - # $id_actividad</div>

            <!-- Tabla con Detalles de la Actividad -->
            <table class="content-table">
                <tr>
                    <th>Fecha de Cumplimiento</th>
                    <td>$fecha_actividad</td>
                </tr>
                <tr>
                    <th>Descripción</th>
                    <td>$descripcion_actividad</td>
                </tr>
                <tr>
                    <th>Estado</th>
                    <td>$estado_actividad</td>
                </tr>
                <tr>
                    <th>Responsable</th>
                    <td>$responsable $apellido_responsable</td>
                </tr>
            </table>
            EOF;


            // Escribir la actividad en el PDF
            $pdf->writeHTML($actividad_html, true, false, true, false, '');

            // Consultar evidencias relacionadas con la actividad
            try {
                $stmt3 = Conexion::conectar()->prepare('SELECT * FROM detalle_actividad WHERE id_actividad_fk = :id_actividad');
                $stmt3->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
                $stmt3->execute();

                if ($stmt3->rowCount() > 0) {
                    while ($row3 = $stmt3->fetch()) {
                        $fecha_evidencia = $row3["fecha_evidencia"];
                        $evidencia = $row3["evidencia"];
                        $recursos = $row3["recursos"];

                        $detalle_html = <<<EOF
                        <style>
                            .title {
                                text-align: center;
                                font-size: 18px;
                                font-weight: bold;
                                margin-bottom: 15px;
                                color: #004080;
                            }
                            .section-title {
                                font-size: 14px;
                                font-weight: bold;
                                background-color: #004080;
                                color: #ffffff;
                                text-align: center;
                                padding: 5px;
                                margin-top: 20px;
                            }
                            .content-table {
                                border-collapse: collapse;
                                width: 100%;
                                margin-top: 10px;
                            }
                            .content-table th, .content-table td {
                                border: 1px solid #004080;
                                padding: 8px;
                                text-align: left;
                            }
                            .content-table th {
                                background-color: #004080;
                                color: #ffffff;
                            }
                            .content-table td {
                                background-color: #f2f2f2;
                            }
                        </style>

                        <!-- Título de la Sección de Detalle -->
                        <div class="section-title">Detalle de Evidencia</div>

                        <!-- Tabla con Detalles de Evidencia -->
                        <table class="content-table">
                            <tr>
                                <th>Fecha Evidencia</th>
                                <td>$fecha_evidencia</td>
                            </tr>
                            <tr>
                                <th>Evidencia</th>
                                <td>$evidencia</td>
                            </tr>
                            <tr>
                                <th>Recursos</th>
                                <td>$recursos</td>
                            </tr>
                        </table>
                        EOF;


                        // Escribir el detalle de la evidencia en el PDF
                        $pdf->writeHTML($detalle_html, true, false, true, false, '');
                    }
                }
            } catch (PDOException $e) {
                die('Error al consultar las evidencias: ' . $e->getMessage());
            }
        }
    }
} catch (PDOException $e) {
    die('Error al consultar las actividades: ' . $e->getMessage());
}

// Salida del PDF
$pdf->Output("ACPM_$id_acpm.pdf", 'I');
