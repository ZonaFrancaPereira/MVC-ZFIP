<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../../../configuracion.php";
require_once "../../../controladores/actualizarPw.controlador.php";
require_once "../../../modelos/actualizarPw.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_detalle = $_GET['codigo'];

// Codificar la imagen en base64
$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
$item = null;
$valor = $id_detalle;

$MostrarPw = ControladorPw::ctrMostrarPwGeneral($item,$valor);

foreach ($MostrarPw as $key => $value) {
    $estado = $value["estado_pw"];
    $fecha_pw = $value["fecha_pw"];
    $nombre = $value["usuario_principal_nombre"];
    $apellidos_usuario = $value["usuario_principal_apellidos"];
}
// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Actualización de Contraseñas');
$pdf->SetSubject('Detalles de la Actualización');
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

// Contenido del documento con estilo Bootstrap
$html = <<<EOF
<style>
    /* Simplificación de los estilos de Bootstrap para TCPDF */
    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
        border-collapse: separate; /* Cambiado a separate para soportar el padding */
        border-spacing: 0; /* Eliminar el espacio entre celdas */
    }
    .table th, .table td {
        padding: 15px; /* Incrementar el padding para crear espacio dentro de las celdas */
        vertical-align: top;
        border-top: 1px solid #dee2e6;
        line-height: 1.8; /* Ajustar el line-height para aumentar el espacio vertical */
    }
    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }
    .table tbody + tbody {
        border-top: 2px solid #dee2e6;
    }
    .table-bordered {
        border: 1px solid #dee2e6;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #dee2e6;
    }
    .text-center {
        text-align: center;
    }
    .font-weight-bold {
        font-weight: bold;
    }
    .bottom-line {
        border-bottom: 1px solid #000; /* Línea en la parte inferior */
    }
</style>

<table class="table table-bordered">
    <tr>
        <td style="border: none;">
            <img src="$imagenBase64" alt="" width="110">
        </td>
        <td style="border: none;">
            <h3 class="text-center font-weight-bold">ACTUALIZACIÓN DE CONTRASEÑAS N° $id_detalle</h3>
        </td>
    </tr>
</table>

<table class="table table-bordered" style="margin-top: 10px;">
    <tr>
        <td class="font-weight-bold">Fecha de actualización de la contraseña</td>
        <td>$fecha_pw</td>
    </tr>
    <tr>
        <td class="font-weight-bold">Nombre de quien actualiza la contraseña</td>
        <td>$nombre $apellidos_usuario</td>
    </tr>
    <tr>
        <td class="font-weight-bold">Verificación TI</td>
        <td>$estado</td>
    </tr>
    <tr>
        <td colspan="2" class="font-weight-bold">Las contraseñas deberán estar compuestas por: mayúsculas, minúsculas, números y caracteres, según los criterios requeridos en el listado a su cargo. A continuación por favor subraye la contraseña de su elección.</td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
