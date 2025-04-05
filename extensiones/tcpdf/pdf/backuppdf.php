<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/backup.controlador.php";
require_once "../../../modelos/backup.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de ACPM desde la URL
$copias = $_GET['id'];

// Obtener los datos del ACPM desde la base de datos
$tabla = 'copias_seguridad';
$item = 'id_usuario_backup_fk';
$valor = $copias;
$consulta = 'copias_seguridad';
$datos = ModeloBackup::mdlMostrarBackuppdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de ACPM proporcionado.' );
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de BACKUP');
$pdf->SetSubject('Detalles de las Copias de Seguridad');

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

// Asignar variables para el contenido HTML
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$nombre_proceso = $row["nombre_proceso"];
$id_backup = $row["id_backup"];
$carpeta_backup = $row["carpeta_backup"];
$fecha_veririfacion = $row["fecha_verificacion"];
$verificado = $row["verificado"];
$observaciones_copia = $row["observaciones_copia"];


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

<div class="title">ID FORMATO USUARIO # $copias</div>

<div class="section-title">INFORMACIÓN DEL RESPONSABLE</div>
<table class="content-table">
    <tr>
        <th>Nombre</th>
        <td>$nombre_usuario $apellidos_usuario</td>
        <th>Proceso</th>
        <td>$nombre_proceso</td>
    </tr>
</table>

EOF;
// Consultar los documentos relacionados o anexos
try {
    $conexion = Conexion::conectar();
    $stmt = $conexion->prepare('SELECT * FROM copias_seguridad WHERE id_usuario_backup_fk = :copias');
    $stmt->bindParam(':copias', $copias, PDO::PARAM_INT);
    $stmt->execute();

    // Verificar si hay resultados antes de recorrerlos
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $id_backup = htmlspecialchars($row["id_backup"], ENT_QUOTES, 'UTF-8');
            $carpeta_backup = htmlspecialchars($row["carpeta_backup"], ENT_QUOTES, 'UTF-8');
            $fecha_veririfacion = htmlspecialchars($row["fecha_verificacion"], ENT_QUOTES, 'UTF-8');
            $verificado = htmlspecialchars($row["verificado"], ENT_QUOTES, 'UTF-8');
            $observaciones_copia = htmlspecialchars($row["observaciones_copia"], ENT_QUOTES, 'UTF-8');
            
            // Agregar los datos al HTML de actividades
            $html .= <<<EOF
            <div class="section-title">VERIFICACION BACKUP</div>
            <table class="content-table">
                <tr><th>Numero de Backup:</th><td>$id_backup</td></tr>
                <tr><th>Carpeta:</th><td>$carpeta_backup</td></tr>
                <tr><th>Fecha de Verificación:</th><td>$fecha_veririfacion</td></tr>
                <tr><th>Verificación:</th><td>$verificado</td></tr>
                <tr><th>Observaciones:</th><td>$observaciones_copia</td></tr>
            </table>
            EOF;
        }
    } else {
        // Manejar el caso en que no se encuentren resultados
        $html .= "<p>No se encontraron documentos relacionados.</p>";
    }
} catch (Exception $e) {
    die('Error en la consulta: ' . $e->getMessage());
}

// Escribir los documentos relacionados en el PDF
$pdf->writeHTML($html, true, false, true, false, '');


// Salida del PDF
$pdf->Output("BACKUP_$backup.pdf", 'I');
