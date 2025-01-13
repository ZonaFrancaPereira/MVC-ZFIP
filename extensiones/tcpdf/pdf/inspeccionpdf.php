<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/inspeccion.controlador.php";
require_once "../../../modelos/inspeccion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de Inspección desde la URL
$id_inspeccion = $_GET['id'];

// Obtener los datos de la inspección desde la base de datos
$tabla = 'inspeccion_op';
$item = 'id_inspeccion';
$valor = $id_inspeccion;
$consulta = 'inspeccion_op';
$datos = ModeloInspeccion::mdlMostrarInspeccionpdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de Inspección.');
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Inspección');
$pdf->SetSubject('Detalles de la Inspección');

// Eliminar las líneas de encabezado y pie de página
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Establecer los márgenes
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);

// Establecer el tipo de letra predeterminado
$pdf->SetFont('helvetica', '', 10);

// Añadir una página
$pdf->AddPage();

// Obtener la información del primer registro
$row = $datos[0];

// Asignar variables para el contenido del PDF
$id_cliente_fk = $row["id_cliente_fk"]; 
$ingreso_salida = $row["ingreso_salida"]; 
$id_categoriaop_fk = $row["id_categoriaop_fk"]; 
$otro_operacion = $row["otro_operacion"]; 
$transito = $row["transito"]; 
$fmm = $row["fmm"]; 
$arin = $row["arin"]; 
$documento = $row["documento"]; 
$fisico = $row["fisico"]; 
$estado = $row["estado"]; 
$descripcion_observaciones = $row["descripcion_observaciones"]; 
$nombre_firma = $row["nombre_firma"]; 
$cc_firma = $row["cc_firma"]; 
$firma_recibido = $row["firma_recibido"]; 
$fecha_inspeccion = $row["fecha_inspeccion"]; 
$id_usuario_fk = $row["id_usuario_fk"];    
$nombre_categoriaop = $row["nombre_categoriaop"];       
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$nombre_cliente = $row["nombre_cliente"];
$email_cliente =$row["email_cliente"];

//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/"; 

$rutaRelativa = $row["firma_recibido"]; 

// Construct the full URL
$firma_recibido = $baseUrl . $rutaRelativa;

// Contenido del documento en formato HTML
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
        font-size: 14px;
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
</style>

<div class="title">FORMATO INSPECCIÓN - ID # $id_inspeccion</div>

<div class="section-title">INFORMACIÓN DEL RESPONSABLE</div>
<table class="content-table">
    <tr>
        <th>Nombre</th>
        <td colspan="3">$nombre_usuario $apellidos_usuario</td>
    </tr>

</table>

<div class="section-title">DETALLES DEL CLIENTE</div>
<table class="content-table">
    <tr>
        <th>Id Cliente</th>
        <td>$id_cliente_fk</td>
        <th>Nombre</th>
        <td>$nombre_cliente</td>
    </tr>
     <tr>
        <th>Correo</th>
        <td>$email_cliente</td>
        <th>Fecha de la Inspección</th>
        <td>$fecha_inspeccion</td>
    </tr>
</table>

<div class="section-title">AREA DE OPERACIONES</div>

<table class="content-table">
    <tr>
        <th>Ingreso - Salida</th>
        <td>$ingreso_salida</td>
    </tr>
</table>

<div class="section-title">TIPO DE OPERACION</div>
<table class="content-table">
    <tr>
        <th>Categoría</th>
        <td colspan="3">$nombre_categoriaop</td>
    </tr>
    <tr>
        <th>Otra Operación</th>
        <td>$otro_operacion</td>
        <th>Numero de Tránsito</th>
        <td>$transito</td>
    </tr>
    <tr>
        <th>Numero de FMM</th>
        <td>$fmm</td>
        <th>Numero de Arin</th>
        <td>$arin</td>
    </tr>
</table>

<div class="section-title">CANTIDAD Y ESTADO DE LOS BULTOS</div>
<table class="content-table">
    <tr>
        <th>Documento</th>
        <td>$documento</td>
        <th>Físico</th>
        <td>$fisico</td>
    </tr>
    <tr>
        <th>Estado</th>
        <td colspan="3">$estado</td>
    </tr>
</table>

<div class="section-title">DESCRIPCION Y OBSERVACIONES</div>
<table class="content-table">
    <tr>
        <th>Observaciones</th>
        <td colspan="3">$descripcion_observaciones</td>
    </tr>
</table>

<div class="section-title">FIRMA</div>
<table class="content-table">
    <tr>
        <th>Nombre de la persona que Firma</th>
        <td>$nombre_firma</td>
        <th>CC</th>
        <td>$cc_firma</td>
    </tr>

<tr>
    <td colspan="4" class="signature" style="text-align: center;">
        <div>
            <b>FIRMA</b>
        </div>
        <div>
            <img src="$firma_recibido" alt="Firma" width="120" style="margin-left: 50px;">
        </div>
    </td>
</tr>

</table>


EOF;

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html);

// Salida del PDF
$pdf->Output("Inspeccion_$id_inspeccion.pdf", 'I');
