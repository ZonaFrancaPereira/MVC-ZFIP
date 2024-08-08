<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_mantenimiento_impresora = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'mantenimiento_impresora'; // Nombre de la tabla o configuración
$item = 'id_impresora'; // Campo por el cual filtrar
$valor = $id_mantenimiento_impresora; // Valor para filtrar
$consulta = 'mantenimiento_impresora';

// Llamar a la función para obtener los datos
$datos = ModeloMantenimiento::mdlMostrarMantenimientoImpresorapdf($tabla, $item, $valor, $consulta);

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
$fecha_mantenimiento = $row["fecha_mantenimiento_impresora"];
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$id_cargo_fk = $row["nombre_cargo"];
$marca = $row["marca_impresora"];
$modelo = $row["modelo_impresora"];
$serie = $row["serial_impresora"];
$nombre_impresora = $row["nombre_impresora"];
$soplar_exterior = $row["soplar_exterior"];
$isopropilico = $row["isopropilico"];
$toner = $row["toner"];
$alinear = $row["alinear"];
$verificar_cableado = $row["verificar_cableado"];
$rodillos = $row["rodillos"];
$reemplazar = $row["reemplazar"];
$limpiar = $row["limpiar"];
$imprimir = $row["imprimir"];
$verificar = $row["verificar"];
$estado_mantenimiento = $row["estado_mantenimiento_impresora"];

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
            <h3 class="title">FORMATO # $id_mantenimiento_impresora</h3>
        </th>
    </tr>
</table>

<table>
    <tr>
        <td colspan="4" class="subtitle">RESPONSABLE DEL EQUIPO DE COMPUTO</td>
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
        <td>$fecha_mantenimiento</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">IMPRESORA</td>
    </tr>
    <tr>
        <td>Marca</td>
        <td>$marca</td>
        <td>Modelo</td>
        <td>$modelo</td>
    </tr>
    <tr>
        <td>Serie</td>
        <td>$serie</td>
        <td>Nombre Impresora</td>
        <td>$nombre_impresora</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">DETALLES DEL MANTENIMIENTO</td>
    </tr>
    <tr>
        <td colspan="3"><b>Soplar y limpiar el exterior de la impresora:</b></td>
        <td colspan="3">$soplar_exterior</td>
    </tr>
    <tr>
        <td colspan="3"><b>Limpiar el interior de la impresora con alcohol isopropílico:</b></td>
        <td colspan="3">$isopropilico</td>
    </tr>
    <tr>
        <td colspan="3"><b>Revisar los niveles de tinta o tóner:</b></td>
        <td colspan="3">$toner</td>
    </tr>
    <tr>
        <td colspan="3"><b>Alinear el cabezal de impresión y ajustar la calidad de impresión:</b></td>
        <td colspan="3">$alinear</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar que todos los cables estén correctamente conectados y en buen estado:</b></td>
        <td colspan="3">$verificar_cableado</td>
    </tr>
    <tr>
        <td colspan="3"><b>Limpiar los rodillos de alimentación del papel con un paño húmedo:</b></td>
        <td colspan="3">$rodillos</td>
    </tr>
    <tr>
        <td colspan="3"><b>Reemplazar los cartuchos de tinta o tóner según sea necesario:</b></td>
        <td colspan="3">$reemplazar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Ejecutar la función de limpieza del cabezal de impresión para eliminar posibles obstrucciones:</b></td>
        <td colspan="3">$limpiar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Imprimir una página de prueba para verificar que la impresora funcione correctamente:</b></td>
        <td colspan="3">$imprimir</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar el funcionamiento de las funciones adicionales de la impresora, como el escaneo o la copia, si están disponibles en los equipos:</b></td>
        <td colspan="3">$verificar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Estado:</b></td>
        <td colspan="3">$estado_mantenimiento</td>
    </tr>
    <tr>
        <td colspan="3" class="signature">
            <b>FIRMA</b>
        </td>
        <td colspan="3" class="signature">
            <img src="$firmar" alt="" width="180">
        </td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
