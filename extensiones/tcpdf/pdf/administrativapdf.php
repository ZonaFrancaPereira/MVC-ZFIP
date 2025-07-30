<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/administrativa.controlador.php";
require_once "../../../modelos/administrativa.modelo.php";
require_once('tcpdf_include.php');

$idVacaciones = $_GET['id'];

// Obtener los datos
$tabla = 'vacaciones_solicitudes';
$item = 'id_solicitud';
$valor = $idVacaciones;
$datos = ModeloAdministrativa::mdlMostrarVacacionespdf($tabla, $item, $valor);

if (empty($datos)) {
    die("No se encontraron datos para el ID de las Vacaciones proporcionado. ID: $idVacaciones");
}

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Vacaciones');
$pdf->SetSubject('Detalles de solicitud de vacaciones');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);
$pdf->AddPage();

$row = $datos[0];

// Variables
$nombre = $row["nombre"];
$apellidos = $row["apellidos_usuario"];
$proceso = $row["nombre_proceso"];
$cedula = $row["cedula_administrativa"];
$fecha_ingreso = $row["fecha_ingreso_administrativa"];
$estado_usuario = $row["estado_usuario_administrativa"];
$inicio = $row["periodo_inicio"];
$fin = $row["periodo_fin"];
$disfrutadas = $row["disfrutadas"];
$pendientes = $row["pendientes_periodo"];
$obs_vacaciones = $row["observaciones_vacaciones"];
$fecha_solicitud = $row["fecha_solicitud"];
$estado_solicitud = $row["estado_solicitud"];
$obs_solicitud = $row["observaciones_solicitud"];


//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";

$rutaRelativa = $row["firma_aprobador"];


$ruta_firma = $row["firma_aprobador"];
$firma_aprobador = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_aprobador = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_aprobador = $baseUrl . $ruta_firma;
}

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

$html = <<<EOF
<style>
    .title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        color: #004080;
        margin-bottom: 20px;
    }
    .section-title {
        background-color: #004080;
        color: #ffffff;
        padding: 6px;
        font-size: 14px;
        font-weight: bold;
        margin-top: 15px;
        text-align: center;
    }
    .content-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
        text-align: center;
    }
    .content-table th, .content-table td {
        border: 1px solid #004080;
        padding: 6px;
    }
    .content-table th {
        background-color: #004080;
        color: white;
        text-align: left;
        width: 30%;
    }
    .content-table td {
        background-color: #f9f9f9;
    }
        

</style>
<table class="content-table">
    <tr>
        <td style="width: 120px;">
            <img src="$imagenBase64" alt="Logo" width="100">
        </td>
        <td style="width: 390px;">
        <BR>
            <div class="title">FORMATO DE SOLICITUD DE VACACIONES</div>
        </td>
    </tr>
</table>

<div class="section-title">INFORMACIÓN DEL USUARIO</div>
<table class="content-table">
    <tr><th>Nombre</th><td>$nombre $apellidos</td></tr>
    <tr><th>Cédula</th><td>$cedula</td></tr>
    <tr><th>Proceso</th><td>$proceso</td></tr>
    <tr><th>Fecha de Ingreso</th><td>$fecha_ingreso</td></tr>
    <tr><th>Estado del Usuario</th><td>$estado_usuario</td></tr>
</table>

<div class="section-title">DETALLES DEL PERIODO VACACIONAL</div>
<table class="content-table">
    <tr><th>Periodo Inicio</th><td>$inicio</td></tr>
    <tr><th>Periodo Fin</th><td>$fin</td></tr>
    <tr><th>Días Disfrutados</th><td>$disfrutadas</td></tr>
    <tr><th>Días Pendientes</th><td>$pendientes</td></tr>
    <tr><th>Observaciones</th><td>$obs_vacaciones</td></tr>
</table>

<div class="section-title">SOLICITUD</div>
<table class="content-table">
    <tr><th>Fecha de Solicitud</th><td>$fecha_solicitud</td></tr>
    <tr><th>Estado de Solicitud</th><td>$estado_solicitud</td></tr>
    <tr><th>Observaciones</th><td>$obs_solicitud</td></tr>
</table>

<div class="section-title">FIRMA APROBADA</div>
<table class="content-table">
        <tr>
            <td colspan="2"><img src="$firma_aprobador" alt="Firma" width="120" style="margin-left: 70px;"></td>
        </tr>
  
</table>

<table class="content-table">
    <tr>
        <th colspan="5">
            <p style="text-align: justify;">Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, 
            usted declara que conoce nuestra política de tratamiento de datos personales disponible en: 
            <a href="http://www.politicadeprivacidad.co/politica/zfipusuariooperador" target="_blank">www.politicadeprivacidad.co/politica/zfipusuariooperador</a>, 
            también declara que conoce sus derechos como titular de la información y que autoriza de manera libre, 
            voluntaria, previa, explícita, informada e inequívoca a ZONA FRANCA INTERNACIONAL DE PEREIRA SAS USUARIO OPERADOR DE ZONAS FRANCAS 
            con NIT 900311215 para gestionar sus datos personales bajo los parámetros indicados en dicha política de tratamiento.
            </p>
        </th>
    </tr>
</table>
EOF;

$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output("Solicitud_Vacaciones_$idVacaciones.pdf", 'I');
