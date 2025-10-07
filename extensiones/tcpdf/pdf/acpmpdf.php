<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/acpm.controlador.php";
require_once "../../../modelos/acpm.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de ACPM desde la URL (seguro)
$id_acpm = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id_acpm <= 0) {
    die('ID de ACPM inválido.');
}

// -------------------------
// Obtener datos del ACPM
// -------------------------
$tabla = 'acpm';
$item = 'id_consecutivo';
$valor = $id_acpm;
$consulta = 'acpm';
$datos = ModeloAcpm::mdlMostrarAcpmpdf($tabla, $item, $valor, $consulta);
if (empty($datos)) {
    die('No se encontraron datos para el ID de ACPM proporcionado.');
}
$row = $datos[0];

// Asignar variables
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$fecha_acpm = $row["fecha_acpm"];
$nombre_proceso = $row["nombre_proceso"];
$nombre_cargo = $row["nombre_cargo"];
$origen_acpm = $row["origen_acpm"];
$descripcion_fuente = $row["descripcion_fuente"];
$descripcion_acpm = $row["descripcion_acpm"];
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
$riesgos_sig = $row["riesgos_sig"];
$jriesgos_sig = $row["jriesgos_sig"];

if (empty($descripcion_nsc)) $descripcion_nsc = "<p style='text-align:center;'><b>No Aplica</b></p>";
if (empty($justificacion_riesgo)) $justificacion_riesgo = "<p style='text-align:center;'><b>No Aplica</b></p>";

// Mapear tipo y fuente
switch ($row["tipo_acpm"]) {
    case "AM":
        $tipo_acpm = "Acción de Mejora (AM)";
        break;
    case "AC":
        $tipo_acpm = "Acción Correctiva (AC)";
        break;
    case "AP":
        $tipo_acpm = "Acción Preventiva (AP)";
        break;
    default:
        $tipo_acpm = "No Aplica";
}
switch ($row["fuente_acpm"]) {
    case "AI":
        $fuente_acpm = "Auditoría Interna (AI)";
        break;
    case "AE":
        $fuente_acpm = "Auditoría Externa (AE)";
        break;
    case "Otros":
        $fuente_acpm = "Otros";
        break;
    default:
        $fuente_acpm = "No Aplica";
}

// Logo
$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "";
if (file_exists($nombreImagen)) {
    $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
}

// Datos versión documento
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '8';
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);
if (empty($datosd)) {
    die('No se encontraron datos para formato');
}
$rowd = $datosd[0];
$codigo_documento = $rowd["codigo_documento"];
$nombre_documento = $rowd["nombre_documento"];
$fecha_implementacion = $rowd["fecha_implementacion"];
$fecha_actualizacion = $rowd["fecha_actualizacion"];
$version_documento = $rowd["version_documento"];

// -------------------------
// Crear PDF (TCPDF) - configuración
// -------------------------
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de ACPM');
$pdf->SetSubject('Detalles de la ACPM');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

// -------------------------
// CSS + HTML principal (CSS incluida UNA vez aquí)
// -------------------------
$logoHtml = ($imagenBase64 !== "") ? "<img src=\"$imagenBase64\" alt=\"Logo\" width=\"100\">" : "";

$css_and_main = <<<HTML
<style>
    .title { text-align:center; font-size:18px; font-weight:bold; color:#004080; margin-bottom:10px;}
    .section-title {
        font-weight:bold;
        background-color:#004080;
        color:#ffffff;
        text-align:center;
        padding:5px;
        margin-top:10px;
        margin-bottom:6px;
    }
    .content-table { border-collapse:collapse; width:100%; margin-top:6px; }
    .content-table th, .content-table td { border:1px solid #004080; padding:6px; text-align:left; vertical-align:top; }
    .content-table th { background-color:#004080; color:#ffffff; }
    .content-encabezado { border-collapse:collapse; width:100%; margin-top:10px; text-align:center; }
    .content-encabezado th, .content-encabezado td { border:1px solid #004080; padding:8px; text-align:center; }
    .external-border-table { border:1px solid #004080; border-collapse:collapse; width:100%; }
    .external-border-table td { padding:6px; }
    .evidence-wrapper { margin-top:6px; margin-bottom:6px; }
    table { border-collapse:collapse; }
    td, th { border:1px solid #004080; padding:6px; vertical-align:top; }
</style>

<table class="external-border-table">
    <tr>
        <td colspan="1">{$logoHtml}</td>
        <td colspan="3" style="text-align:center; font-weight:bold;">
            <h4>{$nombre_documento} : # {$id_acpm}</h4>
        </td>
    </tr>
</table>

<table class="content-encabezado">
    <tr>
        <th colspan="1">CÓDIGO</th>
        <th colspan="1">FECHA DE IMPLEMENTACIÓN</th>
        <th colspan="1">FECHA DE ACTUALIZACIÓN</th>
        <th colspan="1">VERSIÓN</th>
    </tr>
    <tr>
        <td colspan="1">{$codigo_documento}</td>
        <td colspan="1">{$fecha_implementacion}</td>
        <td colspan="1">{$fecha_actualizacion}</td>
        <td colspan="1">{$version_documento}</td>
    </tr>
</table>

<div class="section-title">Líder del Proceso</div>
<table class="content-table">
    <tr>
        <th colspan="1">Nombre</th>
        <td colspan="3">{$nombre_usuario} {$apellidos_usuario}</td>
    </tr>
    <tr>
        <th colspan="1">Cargo</th>
        <td colspan="1">{$nombre_cargo}</td>
        <th colspan="1">Proceso</th>
        <td colspan="1">{$nombre_proceso}</td>
    </tr>
</table>

<div class="section-title">Información ACPM</div>
<table class="content-table">
    <tr>
        <th scolspan="1">Tipo</th>
        <td colspan="3">{$tipo_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Fecha de Registro</th>
        <td colspan="3">{$fecha_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Origen</th>
        <td colspan="3" style="text-align: justify;">{$origen_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Fuente</th>
        <td colspan="3">{$fuente_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Descripción de la Fuente</th>
        <td colspan="3" style="text-align: justify;">{$descripcion_fuente}</td>
    </tr>
    <tr>
        <th colspan="1">NC Similares / Afecten otro Proceso</th>
        <td colspan="3">{$nc_similar}</td>
    </tr>
    <tr>
        <th colspan="1">Describe Cuales y en que Proceso</th>
        <td colspan="3" style="text-align: justify;">{$descripcion_nsc}</td>
    </tr>
    <tr>
        <th colspan="1">Se identificó peligros de SST nuevos o que han cambiado</th>
        <td colspan="3">{$riesgo_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Describa cuales son los riesgos</th>
        <td colspan="3" style="text-align: justify;">{$justificacion_riesgo}</td>
    </tr>
    <tr>
        <th colspan="1">Estado</th>
        <td colspan="3">{$estado_acpm}</td>
    </tr>
    <tr>
        <th colspan="1">Fecha de Finalización</th>
        <td colspan="3">{$fecha_finalizacion}</td>
    </tr>
</table>

<div class="section-title">Descripción ACPM</div>
<table class="content-table">
    <tr><td style="text-align: justify;">{$descripcion_acpm}</td></tr>
</table>

<div class="section-title">Causa ACPM</div>
<table class="content-table">
    <tr><td style="text-align: justify;">{$causa_acpm}</td></tr>
</table>

<div class="section-title">Espacio Exclusivo del SIG</div>
<table class="content-table">
    <tr><th>¿Es Conforme?</th><td colspan="3">{$conforme_sig}</td></tr>
    <tr><th>Justifique por qué es o no es conforme</th><td colspan="3">{$justificacion_conforme_sig}</td></tr>
    <tr><th>¿Existe la necesidad de actualizar los riesgos y oportunidades?</th><td colspan="3">{$riesgos_sig}</td></tr>
    <tr><th>¿Cuáles riesgos u oportunidades se deben contemplar?</th><td colspan="3">{$jriesgos_sig}</td></tr>
    <tr><th>¿Es necesario hacer cambios al sistema de gestión?</th><td colspan="3">{$cambios_sig}</td></tr>
    <tr><th>¿Qué cambios se deben contemplar y documentar?</th><td colspan="3">{$justificacion_sig}</td></tr>
    <tr><th>Fecha Verificación</th><td colspan="3">{$fecha_estado}</td></tr>
</table>
HTML;

$pdf->writeHTML($css_and_main, true, false, true, false, '');

// -------------------------
// Consultar actividades relacionadas con el ACPM
// -------------------------
try {
    $sqlAct = 'SELECT a.*, u.nombre as nombre_responsable, u.apellidos_usuario as apellido_responsable
               FROM actividades_acpm a
               INNER JOIN usuarios u ON a.id_usuario_fk = u.id
               WHERE a.id_acpm_fk = :id_acpm';
    $stmt2 = Conexion::conectar()->prepare($sqlAct);
    $stmt2->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {

        while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {

            $css_actividad = <<<HTML
                <style>
                    .title { text-align:center; font-size:18px; font-weight:bold; color:#004080; margin-bottom:10px;}
                    .section-title {
                        font-weight:bold;
                        background-color:#004080;
                        color:#ffffff;
                        text-align:center;
                        padding:5px;
                        margin-top:10px;
                        margin-bottom:6px;
                    }
                    .content-table { border-collapse:collapse; width:100%; margin-top:6px; }
                    .content-table th, .content-table td { border:1px solid #004080; padding:6px; text-align:left; vertical-align:top; }
                    .content-table th { background-color:#004080; color:#ffffff; }
                    .content-encabezado { border-collapse:collapse; width:100%; margin-top:10px; text-align:center; }
                    .content-encabezado th, .content-encabezado td { border:1px solid #004080; padding:8px; text-align:center; }
                    .external-border-table { border:1px solid #004080; border-collapse:collapse; width:100%; }
                    .external-border-table td { padding:6px; }
                    .evidence-wrapper { margin-top:6px; margin-bottom:6px; }
                    table { border-collapse:collapse; }
                    td, th { border:1px solid #004080; padding:6px; vertical-align:top; }
                </style>
            HTML;
            $id_actividad = $row2['id_actividad'];
            $fecha_actividad = $row2["fecha_actividad"];
            $descripcion_actividad = $row2["descripcion_actividad"];
            $estado_actividad = $row2["estado_actividad"];
            $tipo_actividad = $row2["tipo_actividad"];
            $responsable = $row2["nombre_responsable"];
            $apellido_responsable = $row2["apellido_responsable"];

            $nombre_actividad = ($tipo_actividad === "Correccion") ? $tipo_actividad . " Inmediata" : $tipo_actividad;

            // Actividad HTML (sin volver a declarar CSS)
            $actividad_html = '<div  class="section-title">' . htmlspecialchars($nombre_actividad . ' - # ' . $id_actividad) . '</div>';
            $actividad_html .= '<table class="content-table">';
            $actividad_html .= '<tr><th style="width:30%;">Fecha de Cumplimiento</th><td style="width:20%;">' . htmlspecialchars($fecha_actividad) . '</td><th style="width:15%;">Estado</th><td style="width:35%;">' . htmlspecialchars($estado_actividad) . '</td></tr>';
            $actividad_html .= '<tr><th>Descripción</th><td colspan="3" style="text-align: justify;">' . $descripcion_actividad . '</td></tr>';
            $actividad_html .= '<tr><th>Responsable</th><td colspan="3">' . htmlspecialchars($responsable . ' ' . $apellido_responsable) . '</td></tr>';
            $actividad_html .= '</table>';

            $pdf->writeHTML($css_actividad . $actividad_html, true, false, true, false, '');

            // Consultar evidencias
            try {
                $stmt3 = Conexion::conectar()->prepare('SELECT * FROM detalle_actividad WHERE id_actividad_fk = :id_actividad');
                $stmt3->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
                $stmt3->execute();

                if ($stmt3->rowCount() > 0) {
                    $css_evidencia = <<<HTML
                        <style>
                            .title { text-align:center; font-size:18px; font-weight:bold; color:#004080; margin-bottom:10px;}
                            .section-title {
                                font-weight:bold;
                                background-color:#004080;
                                color:#ffffff;
                                text-align:center;
                                padding:5px;
                                margin-top:10px;
                                margin-bottom:6px;
                            }
                            .content-table { border-collapse:collapse; width:100%; margin-top:6px; }
                            .content-table th, .content-table td { border:1px solid #004080; padding:6px; text-align:left; vertical-align:top; }
                            .content-table th { background-color:#004080; color:#ffffff; }
                            .content-encabezado { border-collapse:collapse; width:100%; margin-top:10px; text-align:center; }
                            .content-encabezado th, .content-encabezado td { border:1px solid #004080; padding:8px; text-align:center; }
                            .external-border-table { border:1px solid #004080; border-collapse:collapse; width:100%; }
                            .external-border-table td { padding:6px; }
                            .evidence-wrapper { margin-top:6px; margin-bottom:6px; }
                            table { border-collapse:collapse; }
                            td, th { border:1px solid #004080; padding:6px; vertical-align:top; }
                        </style>
                    HTML;
                    $pdf->writeHTML($css_evidencia, true, false, false, false, '');
                    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {

                        $fecha_evidencia = $row3["fecha_evidencia"];
                        $evidencia = $row3["evidencia"];
                        $recursos = $row3["recursos"];

                        // Detalle de evidencia (tabla con fecha y recursos)
                        $detalle_html = <<<DET
                        <div class="section-title">Detalle de Evidencia</div>
                        <table class="content-table">
                            <tr>
                                <th style="width:20%;">Fecha Evidencia</th>
                                <td style="width:30%;">{$fecha_evidencia}</td>
                                <th style="width:20%;">Recursos</th>
                                <td style="width:30%;">{$recursos}</td>
                            </tr>
                        </table>
                        DET;

                        // Importante: reseth = false para no reiniciar estilos
                        $pdf->writeHTML($css_evidencia . $detalle_html, true, false, false, false, '');

                        // -------------------------
                        // Manejo de la variable $evidencia (puede contener HTML, enlaces, tablas, etc.)
                        // -------------------------
                        // Normalizar: si $evidencia viene vacío, mostrar "No Aplica"
                        if (trim(strip_tags($evidencia)) === '') {
                            $evidenciaHtml = '<div class="evidence-wrapper"><p><b>No Aplica</b></p></div>';
                            $pdf->writeHTML($css_evidencia . $evidenciaHtml, true, false, false, false, '');
                            continue;
                        }

                        // Detectar enlaces <a> y mostrarlos como clicables con Write (más fiable)
                        if (preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>(.*?)<\/a>/i', $evidencia, $matches)) {
                            // Mostrar el contenido fuera de enlaces si existe
                            $sinEnlaces = preg_replace('/<a[^>]*>.*?<\/a>/i', '', $evidencia);
                            $sinEnlaces = trim(strip_tags($sinEnlaces));
                            if ($sinEnlaces !== '') {


                                // Luego imprime el contenido normalmente
                                $htmlEvidencia = <<<HTML
<div style="margin-top:6px; margin-bottom:6px; color:black;text-align: justify;border:1px solid #004080; padding:6px;">
    <p>{$sinEnlaces}</p>
    
</div>
HTML;

                                $pdf->writeHTML($htmlEvidencia, true, false, false, false, '');
                            }

                            // Mostrar cada enlace con formato clicable
                            $pdf->Ln(2);
                            $pdf->SetFont('helvetica', '', 10);
                            for ($i = 0; $i < count($matches[0]); $i++) {
                                $url = trim($matches[1][$i]);
                                $texto = strip_tags($matches[2][$i]);
                                if (!preg_match('/^https?:\/\//i', $url)) {
                                    $url = "https://$url";
                                }
                                // Write crea un enlace clicable en TCPDF
                                $pdf->SetTextColor(0, 0, 255);
                                $pdf->SetFont('', 'U'); // subrayado
                                $pdf->Write(6, $texto, $url, 0, 'L', true, 0, false, false, 0);
                                $pdf->SetFont('', '');
                                $pdf->SetTextColor(0, 0, 0);
                            }

                            // Si hay texto adicional ya mostrado, continuar con la siguiente evidencia
                            continue;
                        }


                        // $sinEnlaces viene de: $sinEnlaces = preg_replace(...); $sinEnlaces = trim(strip_tags($sinEnlaces));
                        // Para seguridad, escapamos el texto plano
                        $sinEnlacesEsc = htmlspecialchars($sinEnlaces);

                        // Construir HTML con estilos inline (lista para TCPDF)
                        $htmlEvidencia = <<<HTML
<div style="margin-top:6px; margin-bottom:6px; color:#000000; text-align: justify; border:1px solid #004080; padding:6px;">
    <p>{$sinEnlacesEsc}</p>
</div>
HTML;

                        // Escribir en el PDF (reseth = false para no reiniciar estilos)
                        $pdf->writeHTML($htmlEvidencia, true, false, false, false, '');
                    } // end while row3
                } // end if stmt3 rowCount
            } catch (PDOException $e) {
                // No detener todo el PDF por un error en evidencias — mostrar mensaje y seguir
                $errorMsg = htmlspecialchars($e->getMessage());
                $pdf->writeHTML("<p><b>Error al consultar las evidencias:</b> {$errorMsg}</p>", true, false, true, false, '');
            }
        } // end while actividades
    } // end if actividades
} catch (PDOException $e) {
    die('Error al consultar las actividades: ' . $e->getMessage());
}

// -------------------------
// Salida del PDF
// -------------------------
$pdf->Output("ACPM_{$id_acpm}.pdf", 'I');
