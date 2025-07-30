<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_mantenimiento_impresora = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'mantenimiento_impresora'; // Nombre de la tabla o configuración
$item = 'id_impresora'; // Campo por el cual filtrar
$valor = $id_mantenimiento_impresora; // Valor para filtrar
$consulta = 'mantenimiento_impresora';

// Llamar a la función para obtener los datos
$datos = ModeloMantenimiento::mdlMostrarMantenimientoImpresorapdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de mantenimiento proporcionado.');
}

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '2';  // Asegúrate de que este valor esté correcto y sea válido
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

// Verificar si se obtuvieron datos
if (empty($datosd)) {
    die('No se encontraron datos para formato');
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
$fecha_mantenimiento = $row["fecha_mantenimiento_impresora"];
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$id_cargo_fk = $row["nombre_cargo"];
$marca = $row["marca_impresora"];
$modelo = $row["modelo_impresora"];
$serie = $row["serial_impresora"];
$nombre_impresora = $row["nombre_impresora"];
$soplar_exterior = $row["soplar_exterior"];
$isopropilico = $row["isopropilico"];
$toner = $row["toner"];
$alinear = $row["alinear"];
$verificar_cableado = $row["verificar_cableado"];
$rodillos = $row["rodillos"];
$reemplazar = $row["reemplazar"];
$limpiar = $row["limpiar"];
$imprimir = $row["imprimir"];
$verificar = $row["verificar"];
$estado_mantenimiento = $row["estado_mantenimiento_impresora"];

//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/"; 

$rutaRelativa = $row["firma_impresora"]; 

// Construct the full URL
$firma_impresora = $baseUrl . $rutaRelativa;


$ruta_firma = $row["firma_impresora"];
$firma_impresora = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_impresora = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_impresora = $baseUrl . $ruta_firma;
}

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// Obtener la información para el encabezado del formato
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
                <h4>$nombre_documento # $id_mantenimiento_impresora</h4>
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
            <td>2 de 4</td>
        </tr>

    </table>
   
 <br>
    <div class="section-title">RESPONSABLE DEL DISPOSITIVO</div>

<table class="content-table">
   <tr>
        <td>Datos</td>
        <td>Proceso</td>
        <td>$id_proceso_fk</td>
        <td>AA-MM-DD</td>
        <td>$fecha_mantenimiento</td>
    </tr>
    <tr>
        <td colspan="1">Responsable</td>
        <td colspan="2">$nombre_usuario $apellidos_usuario</td>
        <td colspan="1">Cargo Funcionario</td>
       <td colspan="2">$id_cargo_fk</td>
    </tr>
   
</table>
<br>
<div class="section-title">IMPRESORA</div>
<table class="content-table">
    
    <tr>
        <td>Marca</td>
        <td>$marca</td>
        <td>Modelo</td>
        <td>$modelo</td>
    </tr>
    <tr>
        <td>Serie</td>
        <td>$serie</td>
        <td>Nombre Impresora</td>
        <td>$nombre_impresora</td>
    </tr>
</table>
<br>
<div class="section-title">ITEMS</div>
<table class="content-table">
  
    <tr>
        <td colspan="3"><b>Soplar y limpiar el exterior de la impresora:</b></td>
        <td colspan="3">$soplar_exterior</td>
    </tr>
    <tr>
        <td colspan="3"><b>Limpiar el interior de la impresora con alcohol isopropílico:</b></td>
        <td colspan="3">$isopropilico</td>
    </tr>
    <tr>
        <td colspan="3"><b>Revisar los niveles de tinta o tóner:</b></td>
        <td colspan="3">$toner</td>
    </tr>
    <tr>
        <td colspan="3"><b>Alinear el cabezal de impresión y ajustar la calidad de impresión:</b></td>
        <td colspan="3">$alinear</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar que todos los cables estén correctamente conectados y en buen estado:</b></td>
        <td colspan="3">$verificar_cableado</td>
    </tr>
    <tr>
        <td colspan="3"><b>Limpiar los rodillos de alimentación del papel con un paño húmedo:</b></td>
        <td colspan="3">$rodillos</td>
    </tr>
    <tr>
        <td colspan="3"><b>Reemplazar los cartuchos de tinta o tóner según sea necesario:</b></td>
        <td colspan="3">$reemplazar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Ejecutar la función de limpieza del cabezal de impresión para eliminar posibles obstrucciones:</b></td>
        <td colspan="3">$limpiar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Imprimir una página de prueba para verificar que la impresora funcione correctamente:</b></td>
        <td colspan="3">$imprimir</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar el funcionamiento de las funciones adicionales de la impresora, como el escaneo o la copia, si están disponibles en los equipos:</b></td>
        <td colspan="3">$verificar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Estado:</b></td>
        <td colspan="3">$estado_mantenimiento</td>
    </tr>
  
</table>
    <div class="section-title">FIRMA RECIBIDO</div>
    <table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_usuario $apellidos_usuario</td>
            
        </tr>

    <tr>
        <td colspan="4" class="signature" style="text-align: center;">
            <div>
                <b>FIRMA</b>
            </div>
            <div>
                <img src="$firma_impresora" alt="Firma" width="120" style="margin-left: 50px;">
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

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
