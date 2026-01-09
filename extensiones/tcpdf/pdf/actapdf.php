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

$row = $activos[0];
$fecha_acta = $row["fecha_acta"];
$tipo_acta = $row["tipo_acta"];
$usuario_origen = $row["usuario_origen"];
$nombre_proceso_origen = $row["nombre_proceso_origen"];
$centro_costos_origen = $row["centro_costos_origen"];
$cedula_origen = $row["cedula_origen"];
$usuario_destino = $row["usuario_destino"];
$nombre_proceso_destino = $row["nombre_proceso_destino"];
$centro_costos_destino = $row["centro_costos_destino"];
$cedula_destino = $row["cedula_destino"];
$observaciones_acta = $row["observaciones_acta"];
$estado_aprobacion = $row["estado_aprobacion"];
$bloqueFirmas = '';






//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";


$ruta_firma = $row["firma_origen"];

// Construct the full URL
$firma_origen = $baseUrl . $rutaRelativa;


$firma_origen = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_origen = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_origen = $baseUrl . $ruta_firma;
}

$ruta_destino = $row["firma_destino"];
// Construct the full URL
$firma_destino = $baseUrl . $rutaRelativa;


$firma_destino = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_destino = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_destino = $baseUrl . $ruta_destino;
}

// Tipo de movimiento
switch ($tipo_acta) {
    case 'Asignacion':
        $movimiento = 'Asignación Permanente de Activo';
        break;
    case 'Traslado':
        $movimiento = 'Traslado de un activo de un área a otra';
        break;
    case 'Mantenimiento':
        $movimiento = 'Traslado por mantenimiento';
        break;
    case 'Baja':
        $movimiento = 'Dar de baja un activo';
        break;
    case 'Préstamo':
        $movimiento = 'Préstamo temporal de un activo';
        break;
    default:
        $movimiento = 'TIPO DE MOVIMIENTO DESCONOCIDO';
        break;
}

// Si el usuario de origen y destino son el mismo, limpiar los datos del destino
if ($row["usuario_origen"] === $row["usuario_destino"]) {
    $usuario_destino = "";
    $nombre_proceso_destino = "";
    $centro_costos_destino = "";
    $cedula_destino = "";
    $firma_destino = "";
}

// Obtener lista de activos vinculados al acta
$activosList = ModeloActivos::mdlObtenerActivosPorActa($id_acta);
// Validar que se obtuvieron resultados
if (empty($activosList)) {
    die('No se encontraron datos para el ID de acta proporcionado.');
}


if ($estado_aprobacion === 'Aprobado') {

    $bloqueFirmas = <<<EOF
    <br><br>
    <table class="content-table" border="1" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr class="section-title">
                <th>FIRMA RESPONSABLE ACTIVOS FIJOS</th>
                <th>FIRMA NUEVO RESPONSABLE</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td>
                    <img src="$firma_origen" style="width: 100px; height: auto;">
                </td>
                <td>
                    <img src="$firma_destino" style="width: 100px; height: auto;">
                </td>
            </tr>
        </tbody>
    </table>
EOF;
}else{
    $bloqueFirmas = <<<EOF
    <br><br>
    <table class="content-table" border="1" cellpadding="4" cellspacing="0" width="100%">
        <thead>
            <tr class="section-title">
                <th>FIRMA RESPONSABLE ACTIVOS FIJOS</th>
                <th>FIRMA NUEVO RESPONSABLE</th>
            </tr>
        </thead>
        <tbody>
            <tr style="text-align: center;">
                <td>
                    <p style="font-size:8px;">Acta no aprobada</p>
                </td>
                <td>
                    <p style="font-size:8px;">Acta no aprobada</p>
                </td>
            </tr>
        </tbody>
    </table>
EOF;
}
// Crear instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configuración del PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Acta de Movimiento de Activos Fijos');
$pdf->SetSubject('Detalle del acta');
$pdf->SetKeywords('Activos, Movimientos, Acta');

// Sin header ni footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Márgenes y fuente
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);

// Página nueva
$pdf->AddPage();

// Imagen logo
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

// Construcción del HTML
$html = <<<EOF
<style>
    .title {
        text-align: center;
        font-size: 9px;
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
        text-align: center;
    }
    .content-table th {
        background-color: #004080;
        color: #ffffff;
        font-weight: bold;
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
        
    </tr>
    <tr>
        <td>$codigo_documento</td>
        <td>$fecha_implementacion</td>
        <td>$fecha_actualizacion</td>
        <td>$version_documento</td>
        
    </tr>
</table>
<br>
<br>
<!-- Sección RESPONSABLE DEL DISPOSITIVO -->
<table width="100%" style="border-collapse:collapse; font-size:9px; margin-bottom:10px; border:1px solid #004080;">
  

    <!-- Fila principal -->
    <tr>
      
        <td style="width:25%; text-align:center; font-weight:bold; border:1px solid #004080; padding:4px;">Fecha</td>
        <td style="width:25%; text-align:center; font-weight:bold; border:1px solid #004080; padding:4px;">$fecha_acta</td>
        <td style="width:25%; text-align:center; font-weight:bold; border:1px solid #004080; padding:4px;">ACTA N°</td>
        <td style="width:25%; text-align:center; font-weight:bold; border:1px solid #004080; padding:4px;">$id_acta</td>
    </tr>

    <!-- Fila Responsable -->
    <tr>
        <td style="width:25%; text-align:center; font-weight:bold; border:1px solid #004080; padding:4px;">Tipo de movimiento</td>
        <td colspan="3" style="border:1px solid #004080; padding:4px;text-align:center; ">$movimiento</td>
    </tr>
</table>
<br> <br>

<!-- Origen y Destino -->
<table width="100%" style="border-collapse:collapse; font-size:9px;">
    <tr >
        <td width="50%" style="border:1px solid #004080; vertical-align:top;">
            <table width="100%" style="border-collapse:collapse;" >
                <tr>
                    <th colspan="2" style="background-color:#004080; color:#ffffff; text-align:center; font-weight:bold;">ORIGEN / ASIGNACIÓN</th>
                </tr>
                <tr>
                    <td>Responsable</td>
                    <td>$usuario_origen</td>
                </tr>
                <tr>
                    <td>Documento</td>
                    <td>$cedula_origen</td>
                </tr>
                <tr>
                    <td>Dependencia</td>
                    <td>$nombre_proceso_origen</td>
                </tr>
                <tr>
                    <td>Centro de costo</td>
                    <td>$centro_costos_origen</td>
                </tr>
            </table>
        </td>

        <td width="50%" style="border:1px solid #004080; vertical-align:top;">
            <table width="100%" style="border-collapse:collapse;">
              <tr style="background-color:#004080; color:#ffffff; text-align:center; font-weight:bold;">
        <td colspan="2" style="padding:4px;">DESTINO</td>
    </tr>
                
                <tr>
                    <td>Responsable</td>
                    <td>$usuario_destino</td>
                </tr>
                <tr>
                    <td>Documento</td>
                    <td>$cedula_destino</td>
                </tr>
                <tr>
                    <td>Dependencia</td>
                    <td>$nombre_proceso_destino</td>
                </tr>
                <tr>
                    <td>Centro de costo</td>
                    <td>$centro_costos_destino</td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br><br>

<!-- Tabla de Activos -->
<table class="content-table">
    <thead>
      <!-- Encabezado -->
    <tr class="section-title">
        <th colspan="6" ><br><br> INFORMACIÓN DE LOS ACTIVOS FIJOS<br></th>
    </tr>
    
        <tr style=" text-align:center; font-weight:bold;">
            <th>Código</th>
            <th>Placa</th>
            <th>Descripción</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Serie</th>
        </tr>
    </thead>
    <tbody>
EOF;

// Insertar activos dinámicamente
foreach ($activosList as $item) {
    $html .= "
        <tr>
            <td>{$item['cod_renta']}</td>
            <td>{$item['id_activo']}</td>
            <td>{$item['nombre_articulo']}</td>
            <td>{$item['marca_articulo']}</td>
            <td>{$item['mmodelo_articulo']}</td>
            <td>{$item['referencia_articulo']}</td>
        </tr>";
}

// Cierre final de HTML
$html .= <<<EOF
    </tbody>
</table>
<br><br>
<table class="content-table">
    <tr class="section-title">
        <th><b>OBSERVACIONES DEL ACTA</b></th>
    </tr>
    <tr>
        <td><p style="text-align: justify; font-size: 8px;">$observaciones_acta</p>
        </td>
    </tr>
</table>

<br><br>
EOF;

$html .= $bloqueFirmas;

$html .= <<<EOF
<table class="content-table">
    <tr>
        <td><p style="text-align:justify; font-size:8px;">Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información,
                usted declara que conoce nuestra política de tratamiento de datos personales disponible en:
                <a href="http://www.politicadeprivacidad.co/politica/zfipusuariooperador" target="_blank">
                www.politicadeprivacidad.co/politica/zfipusuariooperador</a>, 
                también declara que conoce sus derechos como titular de la información y que autoriza de manera libre,
                voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS
                para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
            </p>
        </td>
    </tr>
</table>
EOF;

// Escribir HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('acta_movimiento.pdf', 'I');
