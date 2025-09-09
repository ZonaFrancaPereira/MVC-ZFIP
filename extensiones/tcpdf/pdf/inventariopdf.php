
<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/activos.controlador.php";
require_once "../../../modelos/activos.modelo.php";
require_once "../../../controladores/inventario.controlador.php";
require_once "../../../modelos/inventario.modelo.php";
require_once "../../../controladores/verificacion.controlador.php";
require_once "../../../modelos/verificacion.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// ==========================================
// VALIDACIÓN DE ENTRADA
// ==========================================
if (!isset($_GET['cod']) || empty($_GET['cod'])) {
    die("Error: No se proporcionó un ID de inventario.");
}
$id_inventario = $_GET['cod'];

// ==========================================
// VARIABLES DE TABLAS
// ==========================================
$tablaActivos = "activos";
$tablaVerificacion = "verificaciones";

// ==========================================
// OBTENER DATOS
// ==========================================
$id_usuario_fk = null;
$datos = ModeloVerificaciones::mdlMostrarVerificacionesPorInventario(
    $tablaVerificacion,
    $tablaActivos,
    $id_inventario,
    $id_usuario_fk
);

if (empty($datos)) {
    die("No se encontraron datos para este inventario.");
}

// ==========================================
// AGRUPAR DATOS POR USUARIO
// ==========================================
$usuarios = [];
foreach ($datos as $row) {
    $nombreUsuario = $row['nombre_usuario'] . ' ' . $row['apellidos_usuario'];
    $cargoUsuario = $row['nombre_cargo'];
    $procesoUsuario = $row['nombre_proceso'];
    $nombre_usuario_apertura = $row['nombre_usuario_apertura'] . ' ' . $row['apellidos_usuario_apertura'];
    $nombre_usuario_cierre = $row['nombre_usuario_cierre'] . ' ' . $row['apellidos_usuario_cierre'];

    

    

    if (!isset($usuarios[$nombreUsuario])) {
        $usuarios[$nombreUsuario] = [
            "cargo" => $cargoUsuario,
            "proceso" => $procesoUsuario,
            "activos" => []
        ];
    }

    $usuarios[$nombreUsuario]["activos"][] = [
        "codigo"             => $row['id_activo'],
        "articulo"           => $row['nombre_articulo'],
        "descripcion"        => $row['observaciones'],
        "estado_verificacion"=> $row['estado_verificacion']
    ];
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
$valord = '4';
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
$html .= <<<EOF
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
    }}
</style>
EOF;
$html .= <<<EOF
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
<br><br>
<table class="content-table">
    <tr class="section-title">
        <th> Inventario Número</th>
        <th>Fecha de Creación</th>
        <th>Creado Por</th>
    </tr>
    <tr>
        <td>$id_inventario</td>
        <td>{$datos[0]['fecha_apertura']}</td>
        <td>$nombre_usuario_apertura</td>
    </tr>
    <tr class="section-title">
        <th>Estado</th>
        <th>Fecha de Cierre</th>
        <th>Cerrado Por</th>
    </tr>
    <tr>
        <td>{$datos[0]['estado_inventario']}</td>
        <td>{$datos[0]['fecha_cierre']}</td>
        <td>$nombre_usuario_cierre</td>
    </tr>
</table>

EOF;
// ==========================================
// TABLAS POR USUARIO
// ==========================================
foreach ($usuarios as $nombre => $info) {
  $html .= <<<EOF
  <div style="height:30px;"></div> <!-- Espacio fijo -->

<table class="table content-table" style="width: 100%; margin-bottom: 10px; border: 1px solid #004080; border-collapse: collapse;">
<tr>
        <th colspan="2" style="background-color: #004080; color: #ffffff; text-align: center; padding: 8px;"><B>{$info['proceso']}</B></th>
    </tr>
    <tr>
        <td >Responsable</td>
        <td >$nombre</td>
    </tr>
    <tr>
        <td >Cargo</td>
        <td >{$info['cargo']}</td>
    </tr>
</table>

EOF;
    // Encabezado usuario
     $html .= <<<EOF
    <table class="content-table">
        <thead style="background-color: #004080; color: #ffffff;">
        <tr class="section-title">
            <th >Código</th>
            <th >Artículo</th>
            <th >Descripción</th>
            <th >Estado</th>
        </tr>
        </thead>
        <tbody>
    EOF;
   // Filas de activos
    foreach ($info["activos"] as $activo) {
        $codigo_activo = $activo["codigo"];
        $nombre_activo = $activo["articulo"];
        $descripcion_v = $activo["descripcion"];
        $estado_v = $activo["estado_verificacion"];       

      $html .= "<tr>
            <td>{$codigo_activo}</td>
            <td>{$nombre_activo}</td>
            <td>{$descripcion_v}</td>
            <td>{$estado_v}</td>
          </tr>";
    
}
 $html .= <<<EOF
    
<tbody></table>

EOF;
}
$html .= <<<EOF
<div style="height:30px;"></div> <!-- Espacio fijo -->
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
// Limpia buffer
if (ob_get_length()) {
    ob_end_clean();
}

// Genera PDF
$pdf->Output('acta_movimiento.pdf', 'I');
