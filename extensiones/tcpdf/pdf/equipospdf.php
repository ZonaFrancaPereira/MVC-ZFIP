<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/mantenimiento.controlador.php";
require_once "../../../modelos/mantenimiento.modelo.php";
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
$verificar_contraseñas = $row["verificar_contraseñas"];
$desinstalar_programas = $row["desinstalar_programas"];
$organizar_cableado = $row["organizar_cableado"];
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

// Define the base URL for your hosting environment
$baseUrl = "/MVC-ZFIP/"; // Cambia esto según sea necesario para tu entorno de hosting

// Retrieve the relative path from the database
$rutaRelativa = $row["firma"]; // Esta es la ruta que obtienes de la base de datos

// Construct the full URL
$foto = $baseUrl . $rutaRelativa; // Combina la base URL con la ruta relativa


$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

// Contenido del documento
$html = <<<EOF
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 2px solid #004080;
        padding: 10px;
    }
    th {
        background-color: #abc665;
        color: #ffffff;
        text-align: center;
    }
    td {
        background-color: #abc665;
        text-align: left;
    }
    .title {
        text-align: center;
        font-size: 16px;
        font-weight: bold;
        color: #abc665;
        margin-bottom: 10px;
    }
    .subtitle {
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        background-color: #abc665;
        color: #ffffff;
        padding: 5px;
        margin-bottom: 10px;
    }
    .signature {
        text-align: center;
        padding-top: 20px;
    }
    .signature img {
        border-top: 1px solid #000;
        padding-top: 10px;
    }
</style>

<table>
    <tr>
        <th><img src="$imagenBase64" alt="" width="100"></th>
        <th>
            <h3 class="title">FORMATO # $id_mantenimiento_equipo</h3>
        </th>
    </tr>
</table>

<table>
    <tr>
        <td colspan="4" class="subtitle">RESPONSABLE DEL EQUIPO DE COMPUTO</td>
    </tr>
    <tr>
        <td>Nombre</td>
        <td>$nombre_usuario $apellidos_usuario</td>
        <td>Proceso</td>
        <td>$id_proceso_fk</td>
    </tr>
    <tr>
        <td>Cargo</td>
        <td>$id_cargo_fk</td>
        <td>Fecha (DD-MM-AA)</td>
        <td>$fecha_mantenimiento</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">EQUIPO DE COMPUTO</td>
    </tr>
    <tr>
        <td>Marca</td>
        <td>$marca</td>
        <td>Modelo</td>
        <td>$modelo</td>
    </tr>
    <tr>
        <td>Serie</td>
        <td>$serie</td>
        <td>Nombre Usuario</td>
        <td>$usuario_equipo</td>
    </tr>
</table>
<br>
<table>
    <tr>
        <td colspan="4" class="subtitle">DETALLES DEL MANTENIMIENTO</td>
    </tr>
    <tr>
        <td colspan="3"><b>Soplar partes externas, equipo completo y área de trabajo, teléfono:</b></td>
        <td colspan="3">$soplar_partes_externas</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar usuario estándar y administrador:</b></td>
        <td colspan="3">$verificar_usuario</td>
    </tr>
    <tr>
        <td colspan="3"><b>Liberar espacio en disco:</b></td>
        <td colspan="3">$liberar_espacio</td>
    </tr>
    <tr>
        <td colspan="3"><b>Actualizar logos de perfil de usuarios y cambiar fondos, sincronizar logos y fondos:</b></td>
        <td colspan="3">$actualizar_logos</td>
    </tr>
    <tr>
        <td colspan="3"><b>Lubricar puertos, conectores, contactos y bisagras con CRC o 3 en 3, isopropílico:</b></td>
        <td colspan="3">$lubricar_puertos</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar contraseñas guardadas en los navegadores:</b></td>
        <td colspan="3">$verificar_contraseñas</td>
    </tr>
    <tr>
        <td colspan="3"><b>Desinstalar programas innecesarios y no licenciados:</b></td>
        <td colspan="3">$desinstalar_programas</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar y organizar cableado de red y otros:</b></td>
        <td colspan="3">$organizar_cableado</td>
    </tr>
    <tr>
        <td colspan="3"><b>Limpieza de equipo completo, cables y accesorios:</b></td>
        <td colspan="3">$limpieza_equipo</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar y constatar elementos del formato asignación de equipos:</b></td>
        <td colspan="3">$formato_asignacion_equipo</td>
    </tr>
    <tr>
        <td colspan="3"><b>Desfragmentar todas las unidades de disco:</b></td>
        <td colspan="3">$desfragmentar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Soplar y limpiar partes internas del equipo completo:</b></td>
        <td colspan="3">$limpiar_partes_interna</td>
    </tr>
    <tr>
        <td colspan="3"><b>Depurar temporales, vaciar Visor de Eventos (temp/ %temp%):</b></td>
        <td colspan="3">$depurar_temporales</td>
    </tr>
    <tr>
        <td colspan="3"><b>Verificar actualizaciones pendientes e instalarlas, reiniciar sistema:</b></td>
        <td colspan="3">$verificar_actualizaciones</td>
    </tr>
    <tr>
        <td colspan="3"><b>Usuario:</b></td>
        <td colspan="3">$usuario</td>
    </tr>
    <tr>
        <td colspan="3"><b>Clave:</b></td>
        <td colspan="3">$clave</td>
    </tr>
    <tr>
        <td colspan="3"><b>Estandar:</b></td>
        <td colspan="3">$estandar</td>
    </tr>
    <tr>
        <td colspan="3"><b>Administrador:</b></td>
        <td colspan="3">$administrador</td>
    </tr>
    <tr>
        <td colspan="3"><b>Análisis Completo:</b></td>
        <td colspan="3">$analisis_completo</td>
    </tr>
    <tr>
        <td colspan="3"><b>Bloqueo de memorias USB:</b></td>
        <td colspan="3">$bloqueo_usb</td>
    </tr>
    <tr>
        <td colspan="3"><b>Dentro del Dominio de ZFIP:</b></td>
        <td colspan="3">$dominio_zfip</td>
    </tr>
    <tr>
        <td colspan="3"><b>Apagar pantalla a los 3 min:</b></td>
        <td colspan="3">$apagar_pantalla</td>
    </tr>
    <tr>
        <td colspan="3"><b>Poner el equipo en estado de suspensión 30 minutos:</b></td>
        <td colspan="3">$estado_suspension</td>
    </tr>
    <tr>
        <td colspan="3"><b>Estado:</b></td>
        <td colspan="3">$estado_mantenimiento_equipo</td>
    </tr>
    <tr>
        <td colspan="3" class="signature">
            <b>FIRMA</b>
        </td>
        <td colspan="3" class="signature">
            <img src="$foto" alt="" width="180">
        </td>
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Salida del PDF
$pdf->Output('documento.pdf', 'I');
?>
