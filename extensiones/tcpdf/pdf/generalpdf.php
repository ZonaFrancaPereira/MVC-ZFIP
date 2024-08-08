<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_mantenimiento_general = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'mantenimiento_general'; // Nombre de la tabla
$item = 'id_general'; // Campo por el cual filtrar
$valor = $id_mantenimiento_general; // Valor para filtrar
$consulta = 'mantenimiento_general';

// Llamar a la función para obtener los datos
$datos = ModeloMantenimiento::mdlMostrarMantenimientoGeneralpdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de mantenimiento proporcionado.');
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Mantenimiento');
$pdf->SetSubject('Detalles del Mantenimiento');
$pdf->SetKeywords('Mantenimiento, Soporte');

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

// Obtener la información del primer registro
$row = $datos[0];

$id_proceso_fk = $row["nombre_proceso"];
$fecha_mantenimiento3 = $row["fecha_mantenimiento3"];
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$id_cargo_fk = $row["nombre_cargo"];
$marca_general = $row["marca_general"];
$modelo_general = $row["modelo_general"];
$serial_general = $row["serial_general"];
$articulo = $row["articulo"];
$partes_externas = $row["partes_externas"];
$condiciones_fisicas = $row["condiciones_fisicas"];
$cableado_verificar = $row["cableado_verificar"];
$dispositivo = $row["dispositivo"];
$estado_general = $row["estado_general"];
$firma_general = $row["firma_general"];

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// Contenido del documento
$html = <<<EOF
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 2px solid #004080;
        padding: 10px;
    }
    th {
        background-color: #abc665;
        color: #ffffff;
        text-align: center;
    }
    td {
        background-color: #abc665;
        text-align: left;
    }
    .title {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        color: #abc665;
        margin-bottom: 10px;
    }
    .subtitle {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        background-color: #abc665;
        color: #ffffff;
        padding: 5px;
        margin-bottom: 10px;
    }
    .signature {
        text-align: center;
        padding-top: 20px;
    }
    .signature img {
        border-top: 1px solid #000;
        padding-top: 10px;
    }
</style>

<table>
    <tr>
        <th><img src="$imagenBase64" alt="" width="100"></th>
        <th>
            <h3 class="title">FORMATO # $id_mantenimiento_general</h3>
        </th>
    </tr>
</table>

<table>
    <tr>
        <td colspan="4" class="subtitle">RESPONSABLE DEL ARTICULO</td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td>$nombre_usuario $apellidos_usuario</td>
        <td>Proceso</td>
        <td>$id_proceso_fk</td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td>$id_cargo_fk</td>
        <td>Fecha (DD-MM-AA)</td>
        <td>$fecha_mantenimiento3</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">ARTICULO</td>
    </tr>
    <tr>
        <td>Marca</td>
        <td>$marca_general</td>
        <td>Modelo</td>
        <td>$modelo_general</td>
    </tr>
    <tr>
        <td>Serie</td>
        <td>$serial_general</td>
        <td>Nombre del Articulo</td>
        <td>$articulo</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">DETALLES DEL MANTENIMIENTO</td>
    </tr>
    <tr>
        <td colspan="3"><b>Soplar y limpiar partes externas (Utilizar insumos adecuados para el dispositivo/articulo):</b></td>
        <td colspan="3">$partes_externas</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar las condiciones físicas del dispositivo/articulo:</b></td>
        <td colspan="3">$condiciones_fisicas</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar estado, limpiar y organizar cableado del dispositivo:</b></td>
        <td colspan="3">$cableado_verificar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Soplar y limpiar lugar donde se encuentra ubicado el dispositivo/articulo:</b></td>
        <td colspan="3">$dispositivo</td>
    </tr>
    <tr>
        <td colspan="3"><b>Estado:</b></td>
        <td colspan="3">$estado_general</td>
    </tr>
    <tr>
        <td colspan="3"><b>Firma:</b></td>
        <td colspan="3">$firma_general</td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
