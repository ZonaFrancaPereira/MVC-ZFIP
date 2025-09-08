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

// ================================
// VALIDACIÓN Y DATOS BASE
// ================================
$tablaActivos = "activos";
$tablaVerificacion = "verificaciones";

// Validar inventario
if (!isset($_GET['cod']) || empty($_GET['cod'])) {
    die("Error: No se proporcionó un ID de inventario.");
}
$id_inventario = $_GET['cod'];

// Obtener datos
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

// ================================
// AGRUPAR DATOS POR USUARIO
// ================================
$usuarios = [];
foreach ($datos as $row) {
    $nombreUsuario = $row['nombre'] . ' ' . $row['apellidos_usuario'];
    $cargoUsuario = $row['cargo_usuario'];

    if (!isset($usuarios[$nombreUsuario])) {
        $usuarios[$nombreUsuario] = [
            "cargo" => $cargoUsuario,
            "activos" => []
        ];
    }

    $usuarios[$nombreUsuario]["activos"][] = [
        "codigo"       => $row['id_activo'],
        "articulo"     => $row['nombre_articulo'],
        "descripcion"  => $row['observaciones'],
        "estado_verificacion" => $row['estado_verificacion']
    ];
}

// ================================
// CLASE PERSONALIZADA TCPDF
// ================================
class MYPDF extends TCPDF
{
    public $headerInfo = [];

    public function Header()
    {
        $info = $this->headerInfo;

        $this->SetFont('helvetica', '', 9);
        $this->SetY(6);

        $html = '
        <table cellpadding="4" cellspacing="0" border="1" width="100%">
            <tr>
                <td width="20%" style="text-align:center;"></td>
                <td width="60%" style="text-align:center;">
                    <h4 style="margin:0;">' . htmlspecialchars($info['nombre_documento']) . '</h4>
                </td>
                <td width="20%" style="text-align:center;">Inventario #: ' . htmlspecialchars($info['id_inventario']) . '</td>
            </tr>
        </table>

        <table cellpadding="4" cellspacing="0" border="1" width="100%" style="margin-top:5px;">
            <tr style="background-color:#004080; color:#fff; font-weight:bold; text-align:center;">
                <th width="20%">CÓDIGO</th>
                <th width="20%">FECHA DE IMPLEMENTACIÓN</th>
                <th width="20%">FECHA DE ACTUALIZACIÓN</th>
                <th width="20%">VERSIÓN</th>
                <th width="20%">PÁGINA</th>
            </tr>
            <tr style="text-align:center; font-size:10px;">
                <td>' . $info['codigo_documento'] . '</td>
                <td>' . $info['fecha_implementacion'] . '</td>
                <td>' . $info['fecha_actualizacion'] . '</td>
                <td>' . $info['version_documento'] . '</td>
                <td>Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages() . '</td>
            </tr>
        </table>
        <hr style="border:1px solid #ddd; margin-top:6px;" />
        ';

        $this->writeHTMLCell(0, 0, '', '', $html, 0, 1, false, true, 'C', true);
        $this->SetY(55);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(
            0,
            10,
            'Zona Franca Internacional de Pereira - Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(),
            0,
            0,
            'C'
        );
    }
}

// ================================
// CREACIÓN DEL PDF
// ================================
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '4';
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

if (empty($datosd)) {
    die('No se encontraron datos para formato');
}

$rowd = $datosd[0];
$pdf->headerInfo = [
    'nombre_documento' => $rowd["nombre_documento"],
    'id_inventario' => $id_inventario,
    'codigo_documento' => $rowd["codigo_documento"],
    'fecha_implementacion' => $rowd["fecha_implementacion"],
    'fecha_actualizacion' => $rowd["fecha_actualizacion"],
    'version_documento' => $rowd["version_documento"],
];

$pdf->SetMargins(15, 65, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);
$pdf->SetAutoPageBreak(TRUE, 25);
$pdf->AddPage();

// ================================
// CONTENIDO DEL PDF
// ================================
$html = "";

// ================================
// GENERAR TABLAS POR USUARIO
// ================================
foreach ($usuarios as $nombre => $info) {
    $cargo = $info["cargo"];

    // Encabezado de usuario
    $html .= "
    <p style='font-size:12px; font-weight:bold; background-color:#004080; color:#ffffff; padding:6px; margin-top:15px;'>
        Responsable: $nombre <br>
        Cargo: $cargo
    </p>
    ";

    // Tabla de activos
    $html .= "
    <table border='1' cellpadding='4' cellspacing='0' width='100%' style='border-collapse:collapse; font-size:10px;'>
        <thead>
            <tr style='background-color:#004080; color:#ffffff; text-align:center; font-weight:bold;'>
                <th width='20%'>Código</th>
                <th width='30%'>Artículo</th>
                <th width='30%'>Descripción</th>
                <th width='20%'>Estado</th>
            </tr>
        </thead>
        <tbody>
    ";

    // Filas de activos
    foreach ($info["activos"] as $activo) {
        $estadoStyle = match ($activo["estado_verificacion"]) {
            "Bueno"       => "color:#1b7e1b; font-weight:bold;",
            "Dar de Baja" => "color:#b71c1c; font-weight:bold;",
            "Perdido"     => "color:#ff9800; font-weight:bold;",
            default       => ""
        };

        $html .= "
        <tr>
            <td style='text-align:center;'>{$activo['codigo']}</td>
            <td style='text-align:left;'>{$activo['articulo']}</td>
            <td style='text-align:left;'>{$activo['descripcion']}</td>
            <td style='{$estadoStyle} text-align:center;'>{$activo['estado_verificacion']}</td>
        </tr>";
    }

    $html .= "</tbody></table>";
}

// ================================
// PIE DE PÁGINA
// ================================
$html .= "
<br><div style='font-size:8px; text-align:justify; margin-top:20px;'>
    Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, 
    usted declara que conoce nuestra política de tratamiento de datos personales disponible en:
    <a href='http://www.politicadeprivacidad.co/politica/zfipusuariooperador' target='_blank'>
    www.politicadeprivacidad.co/politica/zfipusuariooperador</a>. 
    También declara que conoce sus derechos como titular de la información y que autoriza a 
    Zona Franca Internacional de Pereira SAS Usuario Operador de Zonas Francas 
    con NIT 900311215 para gestionar sus datos personales bajo los parámetros indicados.
</div>
";

// ================================
// RENDER PDF
// ================================
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('reporte_inventario.pdf', 'I');
