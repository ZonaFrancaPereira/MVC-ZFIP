<?php
define('ENCRYPTION_KEY', '/*--+159753$$$'); // Usa una clave fuerte

require_once "../../../configuracion.php";
require_once "../../../controladores/actualizarPw.controlador.php";
require_once "../../../modelos/actualizarPw.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_detalle = $_GET['codigo'];
$valor = $id_detalle;

// Obtener datos de las contraseñas
$MostrarPw = ControladorPw::ctrMostrarPwGeneral($valor);
if (empty($MostrarPw)) {
    die('No se encontraron datos para el ID proporcionado.');
}
$row = $MostrarPw[0];
$fecha_pw = $row["fecha_pw"];
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$estado = $row["estado_pw"];
$fecha_verificacion = $row["fecha_verificacion"];
$nombre_ti = $row["nombre_ti"];
$apellidos_ti = $row["apellidos_ti"];
$observacion_verificacion = $row["observacion_verificacion"];


// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Actualización de Contraseñas');
$pdf->SetSubject('Detalles de Contraseñas');
$pdf->SetKeywords('Contraseñas, Actualización, TI');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(15, 15, 15);
$pdf->SetAutoPageBreak(TRUE, 10);
$pdf->SetFont('helvetica', '', 10);
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
$valord = '7';
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

// Contenido inicial del PDF
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
        text-align: center;
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
    /* ESTILO PARA RESALTAR EN AMARILLO */
    .highlight {
        background-color: yellow;
        font-weight: bold;
        color: black;
        padding: 2px;
        border-radius: 3px;
    }
    /* Para dividir el espacio en dos columnas */
    .column {
        width: 50%;
        vertical-align: top;
        padding: 5px;
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
    </tr>
    <tr>
        <td>$codigo_documento</td>
        <td>$fecha_implementacion</td>
        <td>$fecha_actualizacion</td>
        <td>$version_documento</td>
    </tr>
</table>

<div style="height:30px;"></div> <!-- Espacio fijo --> <table class="content-table" >
 <tr > <th >Fecha de actualización de la contraseña</th> 
 <td>$fecha_pw</td> </tr> <tr> <td class="font-weight-bold">Nombre de quien actualiza la contraseña</td>
  <td>$nombre_usuario $apellidos_usuario</td> </tr> <tr> <td class="font-weight-bold">Estado</td>
   <td>$estado</td> </tr> <tr> <td class="font-weight-bold">Verificación TI</td>
    <td>$nombre_ti $apellidos_ti - $fecha_verificacion</td> </tr> 
    <tr> <td class="font-weight-bold">Observación Verificación </td>
     <td>$observacion_verificacion</td> </tr>
    <tr> <td colspan="2" class="">Las contraseñas deberán estar compuestas por: mayúsculas, minúsculas, números y caracteres, según los criterios requeridos en el listado a su cargo. A continuación por favor subraye la contraseña de su elección.</td> </tr> </table>
<div style="height:30px;"></div>
EOF;

// LÍNEAS DE CARACTERES DISPONIBLES

// Tabla de caracteres
$charLines = [
    'A B C D E F G H I J K L M',
    'N O P Q R S T U V W X Y Z',
    'a b c d e f g h i j k l m',
    'n o p q r s t u v w x y z',
    '0 1 2 3 4 5 6 7 8 9 ! ¡ "',
    '# $ % & / ( ) = ? ¿ * + [',
    '] { } > < . _ - \\ @ , ; °'
];


// Construir una tabla principal con dos columnas
$html .= '<table style="width:100%; "><tr>';

// Contador para alternar columnas
$contador = 0;

foreach ($MostrarPw as $value2) {
    // Desencriptar la contraseña
    $pw_desencriptada = openssl_decrypt($value2["pw_app"], "AES-128-ECB", ENCRYPTION_KEY);

    // Inicia la celda de 50%
    $html .= '<td class="column">';



    // Tabla con nombre de aplicación y usuario
    $html .= '<table class="content-table" style="width:100%; border-collapse: collapse; text-align:center; margin-bottom:5px;">
                <tr class="section-title">
                    <th>Contraseña correspondiente a :</th>
                     </tr>
                
                    <tr>
                     <td>' . htmlspecialchars($value2["nombre_app"]) . '</td>
                    </tr>
                  <tr class="section-title">
                      <th>Usuario de inicio de sesión</th>
                    </tr>
                    <tr>
                    <td>' . htmlspecialchars($value2["usuario_app"]) . '</td>
                    
           </tr>
           
        </table>';

    // Convertir la contraseña a array para verificar caracteres
    $chars_in_password = str_split($pw_desencriptada);

    // Tabla de caracteres
    // Construir tabla de caracteres con celdas
    $html .= '<table class="content-table" style="margin-top:5px; width:48%; border-collapse: collapse; text-align:center;">';

    foreach ($charLines as $line) {
        $html .= '<tr>';
        $characters = explode(' ', $line);

        foreach ($characters as $char) {
            // Si el carácter está en la contraseña → resaltarlo
            $highlight = in_array($char, $chars_in_password) ? 'background-color: yellow; font-weight: bold;' : '';
            $html .= '<td style="border:1px solid #004080; width:16%; height:20px; text-align:center; ' . $highlight . '">'
                . htmlspecialchars($char) . '</td>';
        }

        $html .= '</tr>';
        // Contraseña

    }
    $html .= '    <tr><td colspan="' . count($characters) . '" style="border:1px solid #004080; text-align:center; font-weight:bold; background-color:#f2f2f2;">Contraseña: ' . htmlspecialchars($pw_desencriptada) . '</td></tr>
</table>';

    // Cierra la celda
    $html .= '</td>';

    // Controla que se cierren y abran filas cada 2 columnas
    $contador++;
    if ($contador % 2 == 0) {
        $html .= '</tr><tr> <br> '; // Cierra la fila actual y abre una nueva
    }
}

// Cierra la tabla principal
$html .= '</tr>
</table>
<div style="height:20px;"></div> <!-- Espacio fijo -->


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
</table>';

// Generar PDF
$pdf->writeHTML($html, true, false, true, false, '');
ob_end_clean();
$pdf->Output('documento.pdf', 'I');
