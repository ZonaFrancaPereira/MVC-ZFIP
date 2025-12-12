<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_mantenimiento_equipo = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'mantenimientos'; // Nombre de la tabla o configuración
$item = 'id_mantenimiento'; // Campo por el cual filtrar
$valor = $id_mantenimiento_equipo; // Valor para filtrar
$consulta = 'mantenimientos';

// Llamar a la función para obtener los datos
$datos = ModeloMantenimiento::mdlMostrarMantenimientopdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de mantenimiento proporcionado.');
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
$fecha_mantenimiento = $row["fecha_mantenimiento"];
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$id_cargo_fk = $row["nombre_cargo"];
$marca = $row["marca"];
$modelo = $row["modelo"];
$serie = $row["serie"];
$usuario_equipo = $row["usuario_equipo"];
$soplar_partes_externas = $row["soplar_partes_externas"];
$verificar_usuario = $row["verificar_usuario"];
$liberar_espacio = $row["liberar_espacio"];
$actualizar_logos = $row["actualizar_logos"];
$lubricar_puertos = $row["lubricar_puertos"];
$verificar_contraseñas = $row["contra"];
$desinstalar_programas = $row["desinstalar_programas"];
$limpieza_equipo = $row["limpieza_equipo"];
$formato_asignacion_equipo = $row["formato_asignacion_equipo"];
$desfragmentar = $row["desfragmentar"];
$limpiar_partes_interna = $row["limpiar_partes_interna"];
$depurar_temporales = $row["depurar_temporales"];
$verificar_actualizaciones = $row["verificar_actualizaciones"];
$usuario = $row["usuario"];
$clave = $row["clave"];
$estandar = $row["estandar"];
$administrador = $row["administrador"];
$analisis_completo = $row["analisis_completo"];
$bloqueo_usb = $row["bloqueo_usb"];
$dominio_zfip = $row["dominio_zfip"];
$apagar_pantalla = $row["apagar_pantalla"];
$estado_suspension = $row["estado_suspension"];
$estado_mantenimiento_equipo = $row["estado_mantenimiento_equipo"];

$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
//$baseUrl = "/MVC-ZFIP/";

$rutaRelativa = $row["firma"];


$ruta_firma = $row["firma"];
$foto = $baseUrl . $ruta_firma;
if (is_null($ruta_firma) || empty($ruta_firma)) {
    $foto = $baseUrl . 'vistas/img/usuarios/default/sinautorizar.png';
} else {
    $foto = $baseUrl . $ruta_firma;
}

$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '2';  // Asegúrate de que este valor esté correcto y sea válido
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
$clave_checkbox = ($clave == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$estandar_checkbox = ($estandar == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$administrador_checkbox = ($administrador == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$analisis_completo_checkbox = ($analisis_completo == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$bloqueo_usb_checkbox = ($bloqueo_usb == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$dominio_zfip_checkbox = ($dominio_zfip == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$apagar_pantalla_checkbox = ($apagar_pantalla == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';
$estado_suspension_checkbox = ($estado_suspension == "SI") ? '|&nbsp;X&nbsp;|' : '|&nbsp;&nbsp;&nbsp;|';

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
            <h4>$nombre_documento : # $id_mantenimiento_equipo</h4>
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
        <td>1 de 4</td>
    </tr>
</table>
<br>
<div class="section-title">Responsable del Dispositivo</div>
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
<div class="section-title">Equipo de Computo</div>

<table class="content-table">
    <tr>
        <td colspan="1">Marca</td>
        <td colspan="2">$marca</td>
        <td colspan="1">Modelo</td>
        <td colspan="1">$modelo</td>
    </tr>
    <tr>
        <td colspan="1">Serie</td>
        <td colspan="2">$serie</td>
        <td colspan="1">Nombre Usuario</td>
        <td colspan="1">$usuario_equipo</td>
    </tr>
</table>

<div class="section-title">Detalles del Mantenimiento</div>
<table class="content-table">
    <tr>
        <th colspan="4">Soplar partes externas, equipo completo y área de trabajo, teléfono:</th>
        <td colspan="1">$soplar_partes_externas</td>
    </tr>
    <tr>
        <th colspan="4">Lubricar puertos, conectores, contactos y bisagras con CRC o 3 en 3, isopropílico:</th>
        <td colspan="1">$lubricar_puertos</td>
    </tr>
    <tr>
        <th colspan="4">Limpieza de equipo completo, cables y accesorios:</th>
        <td colspan="1">$limpieza_equipo</td>
    </tr>
      <tr>
        <th colspan="4">Soplar y limpiar partes internas del equipo completo:</th>
        <td colspan="1">$limpiar_partes_interna</td>
    </tr>
    <tr>
        <th colspan="4">Verificar usuario estándar y administrador:</th>
        <td colspan="1">$verificar_usuario</td>
    </tr>
    <tr>
        <th colspan="4">Verificar contraseñas guardadas en los navegadores:</th>
        <td colspan="1">$verificar_contraseñas</td>
    </tr>
    <tr>
        <th colspan="4">Verificar y constatar elementos del formato asignación de equipos:</th>
        <td colspan="1">$formato_asignacion_equipo</td>
    </tr>
     <tr>
        <th colspan="4">Depurar temporales, vaciar Visor de Eventos (temp/ %temp%):</th>
        <td colspan="1">$depurar_temporales</td>
    </tr>
     <tr>
        <th colspan="4">Liberar espacio en disco:</th>
        <td colspan="1">$liberar_espacio</td>
    </tr>
     <tr>
        <th colspan="4">Desinstalar programas innecesarios y no licenciados:</th>
        <td colspan="1">$desinstalar_programas</td>
    </tr>
     <tr>
        <th colspan="4">Desfragmentar todas las unidades de disco:</th>
        <td colspan="1">$desfragmentar</td>
    </tr>
    <tr>
        <th colspan="4">Verificar actualizaciones pendientes e instalarlas, reiniciar sistema:</th>
        <td colspan="1">$verificar_actualizaciones</td>
    </tr>
    <tr>
        <th colspan="4">Actualizar logos de perfil de usuarios y cambiar fondos, sincronizar logos y fondos:</th>
        <td colspan="1">$actualizar_logos</td>
    </tr>
    <tr>
        <th colspan="4">Verificar y organizar cableado de red y otros.</th>
        <td colspan="1">No esta en la BD</td>
    </tr>
</table>

<div class="section-title">Software Licenciado</div>
<table class="content-table">
    <tr>
        <td>Windows</td>
        <th>Traer de Activos</th>
        <td>Microsoft Office</td>
        <th>Traer de Activos</th>
    </tr>
       <tr>
       <td>MAC</td>
        <th>Traer de Activos</th>
        <td>AutoCAD</td>
        <th>Traer de Activos</th>
    </tr>
       <tr>
        
         <td>Zeus</td>
        <th>Traer de Activos</th>
        <td>Appolo</td>
        <th>Traer de Activos</th>
    </tr>
</table>

<div class="section-title">Hadware</div>
<table class="content-table">
    <tr>
        <td>Procesador</td>
        <th>Traer de Activos</th>
        <td>Disco Duro</td>
        <th>Traer de Activos</th>
    </tr>
       <tr>
       <td>Memoria RAM</td>
        <th>Traer de Activos</th>
        <td>CD-DVD</td>
        <th>Traer de Activos</th>
    </tr>
       <tr>
        <td>Tarjeta Video </td>
        <th>Traer de Activos</th>
        <td>Tarjeta Red </td>
        <th>Traer de Activos</th>
    </tr>
</table>

<div class="section-title">Seguridad Básica de Equipos </div>
<table class="content-table">
    <tr>
        <td>Tipo de Red </td>
        <th>Usuario :<b>$usuario_checkbox</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Clave <b>$clave_checkbox</b></th>
        <td>Privilegios </td>
    </tr>
    <tr>
        <th>&nbsp;&nbsp;Wi-Fi : <b>$usuario_checkbox</b> &nbsp;&nbsp;&nbsp;&nbsp; Cableada <b>$clave_checkbox</b></th>
        <th>Dentro del Dominio de ZFIP: <b>$dominio_zfip_checkbox</b></th>
        <th>Administrador : <b>$administrador_checkbox</b> &nbsp;&nbsp; Estandar <b>$estandar_checkbox</b></th>
    </tr>
    <tr>
        <td>Tiempo de desatención </td>
        <th>Apagar pantalla a los 3 min:&nbsp; <b>$apagar_pantalla_checkbox</b></th>
        <th>Poner el equipo en estado de suspensión 10 minutos:<b> $estado_suspension_checkbox</b> </th>
    </tr>
    <tr>
        <td>Antivirus </td>
        <th>Análisis Completo:&nbsp; <b>$analisis_completo_checkbox</b></th>
        <th>Bloqueo de memorias USB:<b> $bloqueo_usb_checkbox</b> </th>
    </tr>
   
</table>

<div class="section-title">FIRMA RECIBIDO</div>
<table class="content-table">
        <tr>
            <th>Nombre</th>
            <td>$nombre_usuario $apellidos_usuario</td>
        </tr>
        <tr>
            <td colspan="2"><img src="$foto" alt="Firma" width="120" style="margin-left: 50px;"></td>
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
