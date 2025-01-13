<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');




// Obtener los datos del ID de codificación
$id_codificar = $_GET['id'];
$tabla = 'solicitud_codificacion';
$item = 'id_codificacion';
$valor = $id_codificar;
$consulta = 'solicitud_codificacion';
$datos = ModeloCodificar::mdlMostrarCodificacionpdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de ACPM proporcionado.');
}

// Crear una instancia de TCPDF
$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Configurar la información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Zona Franca Internacional de Pereira');
$pdf->SetTitle('Formato de ACPM');
$pdf->SetSubject('Detalles de la ACPM');

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
$vigencia = $row["vigencia"];
$fecha_solicitud_cod = $row["fecha_solicitud_cod"];
$usuario_solicitud_cod = $row["usuario_solicitud_cod"];
$cargo_solicitud_cod = $row["cargo_solicitud_cod"];
$nombre_documento = $row["nombre_documento"];
$codigo = $row["codigo"];
$descripcion_cambio = $row["descripcion_cambio"];
$link_formato_codificacion = $row["link_formato_codificacion"];
$elabora_nombre = $row["elabora_nombre"];
$elabora_correo = $row["elabora_correo"];
$revisa_nombre = $row["revisa_nombre"];
$revisa_correo = $row["revisa_correo"];
$aprueba_nombre = $row["aprueba_nombre"];
$aprueba_correo = $row["aprueba_correo"];
$codigo_doc_afectado = $row["codigo_doc_afectado"];
$nombre_doc_afectado = $row["nombre_doc_afectado"];
$afecta = $row["afecta"];
$todos_colaboradores = $row["todos_colaboradores"];
$solo_lider =  $row["solo_lider"];
$miembros_proceso =  $row["miembros_proceso"];
$colaborador_expecifico = $row["colaborador_expecifico"];
$nombre_interna = $row["nombre_interna"];
$correo_interna = $row["correo_interna"];
$nombre_externa = $row["nombre_externa"];
$correo_externa = $row["correo_externa"];
$enviar_copia = $row["enviar_copia"];
$estado_sig_codificacion = $row['estado_sig_codificacion'];
$fecha_sig_codificacion = $row['fecha_sig_codificacion'];
$responsable_sig_codificacion = $row['responsable_sig_codificacion'];
$causa_rechazo_codificacion = $row['causa_rechazo_codificacion'];
$evidencia_difucion = $row['evidencia_difucion'];
$nombre_proceso_cod = $row['nombre_proceso_cod'];

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

<div class="title">FORMATO DE CODIFICACIÓN - ID # $id_codificar</div>

<div class="section-title">SOLICITUD DE MODIFICACIÓN / CREACIÓN DE DOCUMENTO O FORMATO</div>
<table class="content-table">
    <tr>
        <th>Vigencia</th>
        <td>$vigencia</td>
        <th>Fecha (DD-MM-AA)</th>
        <td>$fecha_solicitud_cod</td>
    </tr>
    <tr>
        <th>Solicitado por</th>
        <td>$usuario_solicitud_cod</td>
        <th>Cargo</th>
        <td>$cargo_solicitud_cod</td>
    </tr>
    <tr>
        <th>Nombre del Documento</th>
        <td>$nombre_documento</td>
        <th>Código</th>
        <td>$codigo</td>
    </tr>
</table>

<div class="section-title">Descripción del Cambio</div>
<table class="content-table">
    <tr>
        <th>$descripcion_cambio</th>
    </tr>
</table>

<div class="section-title">Link del Formato</div>
<table class="content-table">
    <tr>
        <th>$link_formato_codificacion</th>
    </tr>
</table>
<div class="section-title">POLÍTICA DE ELABORACIÓN, REVISIÓN Y APROBACIÓN</div>
<table class="content-table">
    <tr>
        <td>Elabora</td>
        <td>Revisa</td>
        <td>Aprueba</td>
    </tr>
    <tr>
        <td>Nombre: $elabora_nombre</td>
        <td>Nombre: $revisa_nombre</td>
        <td>Nombre: $aprueba_nombre</td>
    </tr>
    <tr>
        <td>Cargo:  $elabora_correo</td>
        <td>Cargo:  $revisa_correo</td>
        <td>Cargo:  $aprueba_correo</td>
    </tr>
</table>
<div class="section-title">DOCUMENTOS RELACIONADOS O ANEXOS</div>
<table class="content-table">
    <tr>
        <th>Enliste a continuación los documentos relacionados o anexos del documento en modificación y determine si el cambio los afecta. 
            En caso positivo, proceda con la actualización adicional aplicable al documento identificado, siguiendo los lineamientos del procedimiento de control de documentos. 
            Anexe tantas celdas como sea necesario y evalúe conscientemente cada documento que cita a continuación.</th>

    </tr>

</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

try {
    // Consultar los documentos relacionados o anexos
    $stmt = Conexion::conectar()->prepare('SELECT * FROM detalle_codificacion WHERE id_codificacion_fk = :id_codificacion');
    $stmt->bindParam(':id_codificacion', $id_codificar, PDO::PARAM_INT);
    $stmt->execute();

    // Comienza el contenido HTML general (se agrega una vez)
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
    EOF;

    // Verificar si hay resultados antes de recorrerlos
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch()) {
            $codigo_doc_afectado = htmlspecialchars($row["codigo_doc_afectado"], ENT_QUOTES, 'UTF-8');
            $nombre_doc_afectado = htmlspecialchars($row["nombre_doc_afectado"], ENT_QUOTES, 'UTF-8');
            $afecta = htmlspecialchars($row["afecta"], ENT_QUOTES, 'UTF-8');

            // Agregar los datos al HTML de actividades
            $html .= <<<EOF
            <table class="content-table">
                <tr><th>Código</th><td>$codigo_doc_afectado</td></tr>
                <tr><th>Nombre</th><td>$nombre_doc_afectado</td></tr>
                <tr><th>¿Se afecta?</th><td>$afecta</td></tr>
            </table>
            EOF;
        }
    } else {
        // Manejar el caso en que no se encuentren resultados
        $html .= "<p>No se encontraron documentos relacionados.</p>";
    }

    // Agregar la sección de política de elaboración, revisión y aprobación
    $html .= <<<EOF
    <div class="section-title">DIFUSIONES - Interna</div>
    <table class="content-table">
        <tr>
            <td>Todos Colaboradores:</td>
            <td>Sólo Líderes de Proceso:</td>
            <td>Sólo Miembros de un Proceso:</td>
            <td>Nombre del Proceso:</td>
            <td>Colaborador (s) Específico:</td>
        </tr>
        <tr>
            <td> $todos_colaboradores</td>
            <td> $solo_lider</td>
            <td> $miembros_proceso  </td>
            <td> $nombre_proceso_cod  </td>
            <td> $colaborador_expecifico  </td>
        </tr>
    </table>
    EOF;
    // Escribir los documentos relacionados en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');

        // Consultar los documentos relacionados o anexos
        $stmt = Conexion::conectar()->prepare('SELECT * FROM detalle_codificacion WHERE id_codificacion_fk = :id_codificacion');
        $stmt->bindParam(':id_codificacion', $id_codificar, PDO::PARAM_INT);
        $stmt->execute();
    
        // Comienza el contenido HTML general (se agrega una vez)
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
         <div class="section-title">Difusiones Externa</div>
        EOF;
    
        // Verificar si hay resultados antes de recorrerlos
        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {
                $nombre_externa = htmlspecialchars($row["nombre_externa"], ENT_QUOTES, 'UTF-8');
                $correo_externa = htmlspecialchars($row["correo_externa"], ENT_QUOTES, 'UTF-8');
                // Agregar los datos al HTML de actividades
                $html .= <<<EOF
                <table class="content-table">
                    <tr><th>Nombre:</th><td>$nombre_externa</td></tr>
                    <tr><th>Correo:</th><td>$correo_externa</td></tr>
                </table>
                EOF;
            }
        } else {
            // Manejar el caso en que no se encuentren resultados
            $html .= "<p>No se encontraron documentos relacionados.</p>";
        }
          // Agregar la sección de política de elaboración, revisión y aprobación
    $html .= <<<EOF
    <div class="section-title">Difusiones Externa</div>
    <table class="content-table">
        <tr>
            <td>¿Se requiere envío de copia NO controlada del Documento, a las partes externas?: $enviar_copia</td>
        </tr>
    </table>
    <div class="section-title">Espacio Reservado para SIG</div>
     <table class="content-table">
        <tr>
            <td>Estado:</td>
            <td>Fecha:</td>
            <td>Responsable:</td>

        </tr>
        <tr>
            <td> $estado_sig_codificacion</td>
            <td> $fecha_sig_codificacion</td>
            <td>  $responsable_sig_codificacion </td>
        </tr>
    </table>
    EOF;
    
    if ($estado_sig_codificacion === 'Rechazado') {
        $html .= <<<EOF
        <div class="section-title">Causa del Rechazo</div>
        <table class="content-table">
            <tr>
                <td>Causa de Rechazo: {$causa_rechazo_codificacion}</td>
            </tr>
        </table>
        EOF;
    } elseif ($estado_sig_codificacion === 'Aprobado') {
        $html .= <<<EOF
        <div class="section-title">Evidencia de Difusión</div>
        <table class="content-table">
            <tr>
                <td>Evidencia: {$evidencia_difucion}</td>
            </tr>
        </table>
        EOF;
    }

    // Escribir la actividad en el PDF
    $pdf->writeHTML($html, true, false, true, false, '');
} catch (PDOException $e) {
    // Manejar la excepción y mostrar un mensaje de error
    echo "Error: " . $e->getMessage();
}

// Salida del PDF
$pdf->Output("ACPM_$id_acpm.pdf", 'I');
