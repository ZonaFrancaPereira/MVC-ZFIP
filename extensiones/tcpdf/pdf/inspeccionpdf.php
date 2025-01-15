<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/inspeccion.controlador.php";
require_once "../../../modelos/inspeccion.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
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

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '1';  // Asegúrate de que este valor esté correcto y sea válido
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

// Verificar si se obtuvieron datos
if (empty($datosd)) {
    die('No se encontraron datos para formato');
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


// Establecer la fuente a una que soporte caracteres Unicode
$pdf->SetFont('dejavusans', '', 10, '', true);

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
$email_cliente = $row["email_cliente"];


//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";

$rutaRelativa = $row["firma_recibido"];

// Construct the full URL
$firma_recibido = $baseUrl . $rutaRelativa;

$rutaFirmaZfip = $row["foto"];

// Construct the full URL
$firma_zfip = $baseUrl . $rutaFirmaZfip;

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// Generar los valores de los checkboxes
$ingreso_salida_checkbox = ($ingreso_salida == "ingreso") ? '(X)' : '(&nbsp;&nbsp;)';
$salida_checkbox = ($ingreso_salida == "salida") ? '(X)' : '(&nbsp;&nbsp;)';

$estado_inspeccion = strtoupper($estado);

// Obtener la información del primer registro
$rowd = $datosd[0];
$codigo_documento = $rowd["codigo_documento"];
$nombre_documento = $rowd["nombre_documento"];
$fecha_implementacion = $rowd["fecha_implementacion"];
$fecha_actualizacion = $rowd["fecha_actualizacion"];
$version_documento = $rowd["version_documento"];


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
                <h4>$nombre_documento</h4>
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
            <td>1 de 1</td>
        </tr>
        <br>
        <tr>
            <td colspan="2">USUARIO : $id_cliente_fk <br> $nombre_cliente</td>
            <td colspan="1">FECHA: $fecha_inspeccion</td>
            <td colspan="2">CONSECUTIVO : $id_inspeccion</td>
            
        </tr>
    </table>
    <br>
    <div class="section-title">AREA DE OPERACIONES</div>

    <table class="content-table">
        <tr>
            <td>INGRESO: $ingreso_salida_checkbox </td>
            <td>SALIDA:$salida_checkbox</td>
        </tr>
    </table>

    <div class="section-title">TIPO DE OPERACIÓN</div>
    <table class="content-table">
        <tr>
            <th colspan="2">CATEGORÍA</th>
            <th colspan="3">$nombre_categoriaop</th>
        </tr>
        <tr>
            <th colspan="2">OTRO CUAL</th>
            <th colspan="3">$otro_operacion</th>
        </tr>
        <tr>
            <th colspan="2">NÚMERO DE TRÁNSITO</th>
            <td colspan="3" >$transito</td>
        </tr>
        <tr>
            <th colspan="2">NÚMERO DE FMM</th>
            <td colspan="3">$fmm</td>
        </tr>
        <tr>
            <th colspan="2">NÚMERO DE ARIN</th>
            <td colspan="3">$arin</td>
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
            <td colspan="3">$estado_inspeccion</td>
        </tr>
    </table>
    
    <div class="section-title">DESCRIPCION Y OBSERVACIONES</div>
    <table class="content-table">
        <tr>
            <th>Observaciones</th>
            <td colspan="3">$descripcion_observaciones</td>
        </tr>
    </table>
    <br>
    <div class="section-title">FIRMA USUARIO OPERADOR</div>
    <table class="content-table">
        <tr>
            <th>Nombre</th>
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

        <br>
    <div class="section-title">FIRMA USUARIO ZONA FRANCA</div>
    <table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_usuario $apellidos_usuario</td>
            <th>CC</th>
            <td>$id_usuario_fk</td>
        </tr>

    <tr>
        <td colspan="4" class="signature" style="text-align: center;">
            <div>
                <b>FIRMA</b>
            </div>
            <div>
                <img src="$firma_zfip" alt="Firma" width="120" style="margin-left: 50px;">
            </div>
        </td>
    </tr>

    </table>



<table class="content-table">
    <tr>
        <th colspan="5"><p style="text-align: justify;">Al registrar y entregar sus datos personales mediante este mecanismo de recolección de información, 
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

// Escribir el contenido HTML en el PDF
$pdf->writeHTML($html);

// Salida del PDF
$pdf->Output("Inspeccion_$id_inspeccion.pdf", 'I');
