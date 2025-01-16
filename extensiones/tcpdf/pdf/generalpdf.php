<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
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
//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/"; 

$rutaRelativa = $row["firma_general"]; 

// Construct the full URL
$firma_general = $baseUrl . $rutaRelativa;

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '2';  // Asegúrate de que este valor esté correcto y sea válido
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

// Verificar si se obtuvieron datos
if (empty($datosd)) {
    die('No se encontraron datos para formato');
}
// Obtener la información del primer registro
$rowd = $datosd[0];
$codigo_documento = $rowd["codigo_documento"];
$nombre_documento = $rowd["nombre_documento"];
$fecha_implementacion = $rowd["fecha_implementacion"];
$fecha_actualizacion = $rowd["fecha_actualizacion"];
$version_documento = $rowd["version_documento"];

// Contenido del documento
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

    .content-encabezado {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        text-align: center;
    }
    .content-encabezado th, .content-table td {
     font-weight: bold; /* Aplica negrita */
            border: 1px solid #004080;
            border-collapse: collapse; /* Evita bordes duplicados */
        padding: 8px;
       text-align: center;
    }
    .content-encabezado th {
        background-color: #004080;
        color: #ffffff;
    }
    .content-encabezado td {
         border: 1px solid #004080;
            border-collapse: collapse; /* Evita bordes duplicados */
        text-align: center;
    }

      .external-border-table {
           border: 1px solid #004080;
            border-collapse: collapse; /* Evita bordes duplicados */
            width: 100%; /* Ajusta el ancho según necesidad */
        }
        .external-border-table th {
            padding: 10px; /* Espaciado dentro de las celdas */
            text-align: center;
        }

</style>

<table class="external-border-table">
    <tr>
        <td colspan="2"><img src="$imagenBase64" alt="Logo" width="100"></td>
        <td colspan="3">
            <h4>$nombre_documento : #  $id_mantenimiento_general</h4>
        </td>
    </tr>
</table>
<table class="content-encabezado">
    <tr>
        <th>CÓDIGO</th>
        <th>FECHA DE IMPLEMENTACIÓN</th>
        <th>FECHA DE ACTUALIZACIÓN</th>
        <th>VERSIÓN</th>
        <th>PAGINA</th>
    </tr>
    <tr>
        <td>$codigo_documento</td>
        <td>$fecha_implementacion</td>
        <td>$fecha_actualizacion</td>
        <td>$version_documento</td>
        <td>3 de 4</td>
    </tr>
</table>
<br>



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
        <td colspan="3" class="signature">
            <b>FIRMA</b>
        </td>
        <td colspan="3" class="signature">
            <img src="$firma_general" alt="" width="180">
        </td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
