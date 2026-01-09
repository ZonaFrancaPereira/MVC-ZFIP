<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/orden.controlador.php";
require_once "../../../modelos/orden.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Validar ID
$id_orden = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id_orden === 0) {
    die('ID de orden inválido');
}

// Obtener datos
$item  = "id_orden";
$valor = $id_orden;

$orden = ControladorOrden::ctrMostrarOrdenesPdf($item, $valor);

if (!$orden) {
    die('No se encontraron datos para la orden.');
}

// Variables
$fecha_orden        = $orden["fecha_orden"];
$forma_pago         = $orden["forma_pago"];
$total_orden        = number_format($orden["total_orden"]);
$estado_orden       = $orden["estado_orden"];
$id_proveedor      = $orden["id_proveedor"];
$nombre_proveedor   = $orden["nombre_proveedor"];
$contacto_proveedor = $orden["contacto_proveedor"];
$telefono_proveedor = $orden["telefono_proveedor"];
$observaciones_orden = $orden["observaciones_orden"];
$forma_pago        = $orden["forma_pago"];
$tiempo_entrega     = $orden["tiempo_entrega"];
$porcentaje_anticipo  = $orden["porcentaje_anticipo"];
$comentario_orden   = $orden["comentario_orden"];
$condiciones_negociacion = $orden["condiciones_negociacion"];
$presupuestado      = $orden["presupuestado"];
$fecha_aprobacion   = $orden["fecha_aprobacion"];
//DATOS COTIZANTE Y GERENTE
$nombre_usuario      = $orden["nombre_usuario"] . ' ' . $orden["apellidos_usuario"];
$nombre_gerente      = $orden["nombre_gerente"] . ' ' . $orden["apellidos_gerente"];
$cargo_gerente      = $orden["cargo_gerente"];
$cargo_usuario      = $orden["cargo_usuario"];
$firma_cotizante       = $orden["firma_usuario"];
$firma_gerente      = $orden["firma_gerente"];


// Obtener lista de activos vinculados al acta
$ordenList = ModeloOrden::mdlObtenerArticulosOrden($id_orden);
// Validar que se obtuvieron resultados
if (empty($ordenList)) {
    die('No se encontraron datos para el ID de  proporcionado.');
}

//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";


$ruta_firma = $firma_cotizante;

// Construct the full URL
$firma_origen = $baseUrl . $rutaRelativa;


$firma_origen = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_origen = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_origen = $baseUrl . $ruta_firma;
}

$ruta_destino = $firma_gerente;
// Construct the full URL
$firma_destino = $baseUrl . $rutaRelativa;


$firma_destino = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_destino = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_destino = $baseUrl . $ruta_destino;
}

// Crear instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configuración del PDF
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Orden de Compra');
$pdf->SetSubject('Detalle de la Orden de Compra');
$pdf->SetKeywords('TCPDF, PDF, orden de compra');

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
$valord = '10';
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
        color: #22404b;
    }
    .section-title {
        font-weight: bold;
        background-color: #22404b;
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
        border: 1px solid #22404b;
        padding: 8px;
        text-align: center;
    }
    .content-table th {
        background-color: #22404b;
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
        border: 1px solid #22404b;
        padding: 8px;
        text-align: center;
    }
    .external-border-table {
        border: 1px solid #22404b;
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
            <h4>$nombre_documento Nº $id_orden</h4>
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
<table width="100%" style="border-collapse:collapse; font-size:9px; margin-bottom:10px; border:1px solid #22404b;">
    <!-- Encabezado -->
    <tr class="section-title">
        <th colspan="4" ><br><br> Datos del Proveedor<br></th>
    </tr>
    <!-- DATOS DEL PROVEEDOR -->
    <tr>
        <td style="width:15%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Fecha</td>
        <td style="width:35%; text-align:center;  border:1px solid #22404b; padding:4px;">$fecha_orden</td>
        <td style="width:15%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Proveedor</td>
        <td style="width:35%; text-align:center;  border:1px solid #22404b; padding:4px;">$id_proveedor - $nombre_proveedor</td>
    </tr>
    <!-- Fila principal -->
    <tr>
        <td style="width:15%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Contacto</td>
        <td style="width:35%; text-align:center;  border:1px solid #22404b; padding:4px;">$contacto_proveedor</td>
        <td style="width:15%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Telefono</td>
        <td style="width:35%; text-align:center;  border:1px solid #22404b; padding:4px;">$telefono_proveedor</td>
    </tr>
</table>
<br> <br>

<!-- Detalle Orden de Compra -->
<table class="content-table">
    <thead>
      <!-- Encabezado -->
    <tr class="section-title">
        <th colspan="6" ><br>Detalle Orden de Compra<br></th>
    </tr>
    
        <tr style=" text-align:center; font-weight:bold;">
            <th>Artículo </th>
            <th>Cantidad</th>
            <th>Valor Unitario Sin IVA </th>
            <th>Valor  IVA </th>
            <th>Total </th>
            <th>Observaciones</th>
        </tr>
    </thead>
    <tbody>
EOF;

// Insertar articulos dinámicamente
foreach ($ordenList as $item) {

    $valorNeto  = number_format($item['valor_neto'], 0, ',', '.');
    $valorIva   = number_format($item['valor_iva'], 0, ',', '.');
    $valorTotal = number_format($item['valor_total'], 0, ',', '.');

    $html .= "
        <tr>
            <td>{$item['articulo_compra']}</td>
            <td>{$item['cantidad_orden']}</td>
            <td>$ {$valorNeto}</td>
            <td>$ {$valorIva}</td>
            <td>$ {$valorTotal}</td>
            <td>{$item['observaciones_articulo']}</td>
        </tr>";
}

// Cierre final de HTML
$html .= <<<EOF
<tr>
<td colspan="4" style="text-align:center; font-weight:bold; ">Total</td>
<td colspan="2" style="text-align:center; font-weight:bold;">$ $total_orden</td>
</tr>
</tbody>
</table>
<br><br>
<table class="content-table">
    <tr class="section-title">
        <th><b>¿La orden de compra se encuentra dentro del presupuesto aprobado? : $presupuestado</b></th>
    </tr>
   
</table>
<br><br>
<!--DETALLES DE FORMA DE PAGO-->
<table width="100%" style="border-collapse:collapse; font-size:9px; margin-bottom:10px; border:1px solid #22404b;">
    <!-- Encabezado -->
    <tr class="section-title">
        <th colspan="4" ><br><br> Detalles Forma de Pago <br></th>
    </tr>
    <tr>
        <td style="width:33.33%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Forma de Pago : $forma_pago</td>
        <td style="width:33.33%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Tiempo (Dias) : $tiempo_entrega</td>
        <td style="width:33.33%; text-align:center;  font-weight:bold; border:1px solid #22404b; padding:4px;">Porcentaje Anticipo : $porcentaje_anticipo %</td>
    </tr>
    <!-- Fila principal -->
    <tr>
        <td style="width:33.333%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">Otras condiciones de negociación</td>
        <td style="width:66.66%; text-align:center; font-weight:bold; border:1px solid #22404b; padding:4px;">$condiciones_negociacion</td>
    
    </tr>
</table>
<br>
<table class="content-table">
    <tr class="section-title">
        <th><b>Comentarios</b></th>
    </tr>
    <tr>
        <td><p style="text-align: justify; ">$comentario_orden</p></td>
    </tr>
</table>

<br>

<table class="content-table" border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
        <tr class="section-title">
            <th colspan="2">Cotizado Por :</th>
        </tr>
    </thead>
    <tbody>
        <tr style="text-align: left;">
             <td>Tiempo de Entrega  </td>
             <td>$tiempo_entrega dia(s)</td>
        </tr>
        <tr style="text-align: left;">
             <td>Firma </td>
             <td><img src="$firma_origen" alt="Firma Cotizante OC" style="width: 100px; height: auto;"></td>
        </tr>
      <tr style="text-align: left;">
             <td>Cotizado por  </td>
             <td>$nombre_usuario </td>
        </tr>
         <tr style="text-align: left;">
             <td>Cargo  </td>
             <td>$cargo_usuario </td>
        </tr>
       
    </tbody>
</table>
<br>

<table class="content-table" border="1" cellpadding="4" cellspacing="0" width="100%">
    <thead>
        <tr class="section-title">
            <th colspan="2">Autorizado Por :</th>
        </tr>
    </thead>
    <tbody>
        <tr style="text-align: left;">
             <td>Fecha Aprobación </td>
             <td>$fecha_aprobacion </td>
        </tr>
        <tr style="text-align: left;">
             <td>Firma </td>
             <td><img src="$firma_destino" alt="Firma Nuevo Responsable" style="width: 100px; height: auto;"></td>
        </tr>
      <tr style="text-align: left;">
             <td>Aprobó  </td>
             <td>$nombre_gerente</td>
        </tr>
         <tr style="text-align: left;">
             <td>Cargo  </td>
             <td>$cargo_gerente</td>
        </tr>
        
    </tbody>
</table>


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
