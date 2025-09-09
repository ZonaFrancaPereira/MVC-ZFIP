<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/activos.controlador.php";
require_once "../../../modelos/activos.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de acta desde la URL
if (!isset($_GET['cod']) || empty($_GET['cod'])) {
    die('No se proporcionó un código válido.');
}

$id_acta = $_GET['cod'];

// Obtener datos del acta
$item = "id_acta";
$valor = $id_acta;
$activos = ControladorActivos::ctrMostrarActas($item, $valor);

// Validar que se obtuvieron resultados
if (empty($activos)) {
    die('No se encontraron datos para el ID de acta proporcionado.');
}

$row = $activos[0]; // Cambié $datos por $activos
$fecha_acta = $row["fecha_acta"];
$tipo_acta = $row["tipo_acta"];
$usuario_origen = $row["usuario_origen"];
$usuario_destino = $row["usuario_destino"];
$observaciones_acta = $row["observaciones_acta"];


// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configurar información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Mantenimiento');
$pdf->SetSubject('Detalles del Mantenimiento');
$pdf->SetKeywords('Mantenimiento, Soporte');

// Eliminar encabezado y pie de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Márgenes y fuente
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);

// Añadir una página
$pdf->AddPage();

// Rutas de firma
$baseUrl = "/MVC-ZFIP/";
$ruta_firma = $row["firma_general"];

if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_general = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_general = $baseUrl . $ruta_firma;
}

// Imagen logo en base64
$nombreImagen = "images/logo_zf.png";
if (!file_exists($nombreImagen)) {
    die('No se encontró la imagen del logo.');
}
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '5';
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

if (empty($datosd)) {
    die('No se encontraron datos para formato.');
}

$rowd = $datosd[0];
$codigo_documento = $rowd["codigo_documento"];
$nombre_documento = $rowd["nombre_documento"];
$fecha_implementacion = $rowd["fecha_implementacion"];
$fecha_actualizacion = $rowd["fecha_actualizacion"];
$version_documento = $rowd["version_documento"];

// Contenido HTML
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
    .content-encabezado th, .content-encabezado td {
        font-weight: bold;
        border: 1px solid #004080;
        padding: 8px;
        text-align: center;
    }
    .external-border-table {
        border: 1px solid #004080;
        border-collapse: collapse;
        width: 100%;
    }
    .external-border-table th {
        padding: 10px;
        text-align: center;
    }
        
</style>

<table class="external-border-table">
    <tr>
        <td colspan="2"><img src="$imagenBase64" alt="Logo" width="100"></td>
        <td colspan="3">
            <h4>$nombre_documento </h4>
        </td>
    </tr>
</table>

<table class="content-encabezado">
    <tr>
        <th>CÓDIGO</th>
        <th>FECHA DE IMPLEMENTACIÓN</th>
        <th>FECHA DE ACTUALIZACIÓN</th>
        <th>VERSIÓN</th>
        <th>PÁGINA</th>
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


<table class="content-table">
    <tr>
        <th colspan="5"><p style="text-align: justify;">Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, 
                usted declara que conoce nuestra política de tratamiento de datos personales disponible en: 
                <a href="http://www.politicadeprivacidad.co/politica/zfipusuariooperador" target="_blank">
                www.politicadeprivacidad.co/politica/zfipusuariooperador</a>, 
                también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, 
                voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS 
                con NIT 900311215 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
            </p>
        </th>
    </tr>
</table>
EOF;

// Escribir HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
