<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/actualizarPw.controlador.php";
require_once "../../../modelos/actualizarPw.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_detalle = $_GET['codigo'];

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Actualizacion de Contraseñas');
$pdf->SetSubject('Detalles del Actualizacion');
$pdf->SetKeywords('Contraseñas');

// Eliminar las líneas de encabezado y pie de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer los márgenes
$pdf->SetMargins(15, 15, 15);

// Establecer el espaciado entre líneas
$pdf->SetAutoPageBreak(TRUE, 10);

// Establecer el tipo de letra predeterminado
$pdf->SetFont('helvetica', '', 10);

// Añadir una página
$pdf->AddPage();

// Contenido del documento
$html = <<<EOF
<style>
    .table-outer {
        border-collapse: collapse;
        width: 100%;
    }
    .table-outer td, .table-outer th {
        border: none; /* No bordes internos */
    }
    .table-outer {
        border: 1px solid #000; /* Borde externo para toda la tabla */
    }
    .table-inner {
        border-collapse: collapse;
        width: 100%;
    }
    .table-inner td, .table-inner th {
        border: none; /* No bordes internos */
    }
    .table-inner {
        border: none; /* Sin bordes internos */
    }
    .subtitle {
        font-weight: bold;
        text-align: center;
    }
    .title {
        text-align: center;
    }
    .bottom-line {
        border-bottom: 1px solid #000; /* Línea en la parte inferior */
    }
</style>

<table class="table-outer">
    <tr>
        <td class="no-border">
            <img src="$imagenBase64" alt="" width="110">
            </td>
               <td class="no-border">
            <h3 class="title">ACTUALIZACIÓN DE CONTRASEÑAS # $id_detalle</h3>
        </td>
    </tr>
</table>

<table class="table-inner" style="margin-top: 10px; border: 1px solid #000;">
  
    <tr>
        <td class="bottom-line">Fecha de actualización de la contraseña</td>
        <td class="bottom-line">1</td>
    </tr>
    <tr>
        <td class="bottom-line">Nombre de quien actualiza la contraseña</td>
        <td class="bottom-line">2</td>
    </tr>
    <tr>
        <td class="bottom-line">Verificación TI</td>
        <td class="bottom-line">20/05/2024</td>
    </tr>
    <tr>
        <td colspan="2" class="bottom-line">Las contraseñas deberán estar compuestas por: mayúsculas, minúsculas, números y caracteres, según los criterios requeridos en el listado a su cargo. A continuación por favor subraye la contraseña de su elección.</td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
