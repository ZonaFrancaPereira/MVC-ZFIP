<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/activos.controlador.php";
require_once "../../../modelos/activos.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_usuario_fk = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'activos'; // Nombre de la tabla o configuración
$item = 'id_usuario_fk'; // Campo por el cual filtrar
$valor = $id_usuario_fk; // Valor para filtrar


// Llamar a la función para obtener los datos
$datos = ModeloActivos::mdlMostrarActivosTI($tabla, $item, $valor);
// Verificar si se obtuvieron datos


// Obtener los datos del mantenimiento desde la base de datos
$tabla_asignacion = 'asignacion_equipos'; // Nombre de la tabla o configuración
$item_asignacion = 'id_usuario_fk'; // Campo por el cual filtrar
$valor_asignacion = $id_usuario_fk; // Valor para filtrar


// Llamar a la función para obtener los datos
$datos_asignacion = ModeloActivos::mdlMostrarAsignaciones($tabla_asignacion, $item_asignacion, $valor_asignacion);


// Obtener la información del primer registro
$rowa = $datos_asignacion[0];
$id_asignacion = $rowa["id_asignacion"];
$fecha_a = $rowa["fecha_asignacion"];
$estado_asignacion = $rowa["estado_asignacion"];
$nombre_proceso = $rowa["nombre_proceso"];
$nombre_usuario = $rowa["nombre"];
$apellidos_usuario = $rowa["apellidos_usuario"];
$nombre_cargo = $rowa["nombre_cargo"];

$fecha_asignacion = date("d/m/Y", strtotime($fecha_a));
//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";


$ruta_firma = $rowa["foto"];

// Construct the full URL
$firma_origen = $baseUrl . $rutaRelativa;


$firma_origen = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $firma_origen = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $firma_origen = $baseUrl . $ruta_firma;
}



// Obtener los datos del mantenimiento desde la base de datos
$tabla_detalles = 'activos'; // Nombre de la tabla o configuración
$item_detalles = 'id_usuario_fk'; // Campo por el cual filtrar
$valor_detalles = $id_usuario_fk; // Valor para filtrar


// Llamar a la función para obtener los datos
$datose = ModeloActivos::mdlMostrarDetallesEquipos($tabla_detalles, $item_detalles, $valor_detalles);
// Verificar si se obtuvieron datos
if (empty($datose)) {
    die('No se encontraron datos para el ID de mantenimiento proporcionado.');
}
// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', array(210, 297), true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de Asignación de Equipos');
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




$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '6';  // Asegúrate de que este valor esté correcto y sea válido
$datosd = ModeloCodificar::mdlMostrarVersionDocumentos($tablad, $itemd, $valord);

// Verificar si se obtuvieron datos
if (empty($datosd)) {
    die('No se encontraron datos para formato');
}
// Obtener la información del primer registro
$rowd = $datosd[0];
$codigo_documento = $rowd["codigo_documento"];
$nombre_documento = $rowd["nombre_documento"];
$fecha_implementacion = $rowd["fecha_implementacion"];
$fecha_actualizacion = $rowd["fecha_actualizacion"];
$version_documento = $rowd["version_documento"];

//PARA QUE SE MUESTREN LOS CHECK
$usuario_checkbox = ($usuario == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';


// Contenido del documento
$html .= <<<EOF
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
        <td colspan="1"><img src="$imagenBase64" alt="Logo" width="100"></td>
        <td colspan="4">
            <center><h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$nombre_documento </h4></center>
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
<div class="section-title"><br>RESPONSABLE<br></div>
<table class="content-table">
   <tr>
        <td>Datos</td>
        <td>Proceso</td>
        <td>$nombre_proceso</td>
        <td>Fecha Asignación</td>
        <td>$fecha_asignacion</td>
    </tr>
    <tr>
        <td colspan="1">Responsable</td>
        <td colspan="2">$nombre_usuario <br> $apellidos_usuario </td>
        <td colspan="1">Cargo </td>
       <td colspan="2">$nombre_cargo</td>
    </tr>
</table>
<br>
<div class="section-title"><br><B>DISPOSIVITOS Y PERIFERICOS </B> <br></div>
<br>
<table class="content-encabezado">
   <tr>
        <td class="section-title"><br><br><B>CÓDIGO</B><br></td>
        <td class="section-title"><br><br><B>FECHA</B><br></td>
        <td class="section-title"><br><br><B>ELEMENTO</B><br></td>
        <td class="section-title"><br><br><B>SERIAL</B><br></td>
        <td class="section-title"><br><br><B>MARCA</B><br></td>
        <td class="section-title"><br><br><B>ESTADO</B><br></td>
    </tr> 
EOF;
$count = 0;
foreach ($datos as $row) {

    $html .= '<tr>
        <td>' . $row['id_activo'] . '</td>
        <td>' . $row['fecha_asignacion'] . '</td>
        <td>' . $row['nombre_articulo'] . '</td>
        <td>' . $row['modelo_articulo'] . '</td>
        <td>' . $row['marca_articulo'] . '</td>
        <td>' . $row['estado_activo'] . '</td>
    </tr>';
    $count++;
};
$html .= <<<EOF
<tr>
<td colspan="4" class="section-title"><br><br>TOTAL ARTÍCULOS<br></td>
<td colspan="2"><br><br>$count<br></td>
</tr>
</table>
<br>


EOF;
foreach ($datose as $rowe) {
    $html .= '
    <div class="section-title">
        <br><b> ' . $rowe['id_activo'] . ' ' . $rowe['nombre_articulo'] . '</b><br>
    </div>
   
    <table class="content-encabezado">
    <tr>
        <td colspan="1" style="text-align: left;">Marca</td>
        <td colspan="1">' . htmlspecialchars($rowe["marca_articulo"]) . '</td>
        <td colspan="1" style="text-align: left;">Modelo</td>
        <td colspan="1">' . htmlspecialchars($rowe["modelo_articulo"]) . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;">Serie</td>
        <td colspan="1">' . htmlspecialchars($rowe["referencia_articulo"]) . '</td>
        <td colspan="1" style="text-align: left;">Ubicación</td>
        <td colspan="1">' . htmlspecialchars($rowe["lugar_articulo"]) . '</td>
    </tr>     
    </table>
    <div class="section-title"><br>SOFTWARE<br></div>
    <table class="content-encabezado">
        <tr>
        <td colspan="1" style="text-align: left;"><b>MSD</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["msd"]) . '</td>
        <td colspan="1" style="text-align: left;"><b>Antivirus</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["antivirus"]) . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Visio Pro</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["visio_pro"]) . '</td>
        <td colspan="1" style="text-align: left;"><b>Mac OSX</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["mac_osx"]) . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Windows</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["windows"]) . '</td>
        <td colspan="1" style="text-align: left;"><b>AutoCAD</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["autocad"]) . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Office</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["office"]) . '</td>
        <td colspan="1" style="text-align: left;"><b>Appolo</b></td>
        <td colspan="1">' . htmlspecialchars($rowe["appolo"]) . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Zeus</b></td>
        <td colspan="3">' . htmlspecialchars($rowe["zeus"]) . '</td>
    </tr>
    <tr>
        <td colspan="2"><b>Otros</b></td>
        <td colspan="2">' . $rowe["otros"] . '</td>
    </tr>
    </table>

    <div class="section-title"><br>HARDWARE<br></div>
    <table class="content-encabezado">
         <tr>
        <td colspan="1" style="text-align: left;"><b>Procesador</b></td>
        <td colspan="3">' . $rowe["procesador"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Disco Duro</b></td>
        <td colspan="3 style="text-align: left;"">' . $rowe["disco_duro"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Memoria RAM</b></td>
        <td colspan="3" >' . $rowe["memoria_ram"] . '</td>
        <td colspan="1" style="text-align: left;"><b>CD/DVD</b></td>
        <td colspan="3" style="text-align: left;">' . $rowe["cd_dvd"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Tarjeta de Video</b></td>
        <td colspan="3" style="text-align: left;">' . $rowe["tarjeta_video"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Tarjeta de Red</b></td>
        <td colspan="3" style="text-align: left;">' . $rowe["tarjeta_red"] . '</td>
    </tr>
    </table>
    <div class="section-title"><br>SEGURIDAD BÁSICA DE EQUIPOS<br></div>
   <table class="content-encabezado">
    <tr>
        <td colspan="1" style="text-align: left;"><b>Tipo de Red</b></td>
        <td colspan="1">' . $rowe["tipo_red"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Tiempo de Bloqueo</b></td>
        <td colspan="1">' . $rowe["tiempo_bloqueo"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Usuario</b></td>
        <td colspan="1">' . $rowe["usuario"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Clave</b></td>
        <td colspan="1">' . $rowe["clave"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Dentro del Dominio de Zona Franca</b></td>
        <td colspan="1">' . $rowe["zfip"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Privilegios</b></td>
        <td colspan="1">' . $rowe["privilegios"] . '</td>
    </tr>
    <tr>
        <td colspan="2" style="text-align: left;"><b>Observaciones del Equipo</b></td>
        <td colspan="2">' . $rowe["observaciones_equipo"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Backup</b></td>
        <td colspan="1">' . $rowe["backup"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Día de Backup</b></td>
        <td colspan="1">' . $rowe["dia_backup"] . '</td>
    </tr>
    <tr>
        <td colspan="1" style="text-align: left;"><b>Realiza Backup</b></td>
        <td colspan="1">' . $rowe["realiza_backup"] . '</td>
        <td colspan="1" style="text-align: left;"><b>Justificación del Backup</b></td>
        <td colspan="1">' . $rowe["justificacion_backup"] . '</td>
    </tr>
</table>
    
    
    
    
    
    <br>';
}

$html .= <<<EOF

<br>


<div class="section-title">FIRMA RECIBIDO</div>
<table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_usuario $apellidos_usuario</td>
        </tr>
        <tr>
            <td colspan="2">
          <img src="$firma_origen" style="width: 100px; height: auto;">
            </td>
     
            
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

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
