<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/acpm.controlador.php";
require_once "../../../modelos/acpm.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de ACPM desde la URL
$id_acpm = $_GET['id'];

// Obtener los datos del ACPM desde la base de datos
$tabla = 'acpm';
$item = 'id_consecutivo';
$valor = $id_acpm;
$consulta = 'acpm';
$datos = ModeloAcpm::mdlMostrarAcpmpdf($tabla, $item, $valor, $consulta);

// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de ACPM proporcionado.' );
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
$nombre_usuario = $row["nombre"];
$apellidos_usuario = $row["apellidos_usuario"];
$fecha_acpm = $row["fecha_acpm"];
$nombre_proceso = $row["nombre_proceso"];
$nombre_cargo = $row["nombre_cargo"];
$origen_acpm = $row["origen_acpm"];
$fuente_acpm = $row["fuente_acpm"];
$descripcion_fuente = $row["descripcion_fuente"];
$tipo_acpm = $row["tipo_acpm"];
$causa_acpm = $row["causa_acpm"];
$nc_similar = $row["nc_similar"];
$descripcion_nsc = $row["descripcion_nsc"];
$estado_acpm = $row["estado_acpm"];
$riesgo_acpm = $row["riesgo_acpm"];
$justificacion_riesgo = $row["justificacion_riesgo"];
$cambios_sig = $row["cambios_sig"];
$justificacion_sig = $row["justificacion_sig"];
$conforme_sig = $row["conforme_sig"];
$justificacion_conforme_sig = $row["justificacion_conforme_sig"];
$fecha_estado = $row["fecha_estado"];
$fecha_finalizacion = $row["fecha_finalizacion"];
$riesgos_sig = $row["riesgos_sig"];
$jriesgos_sig = $row["jriesgos_sig"];



$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '8';  // Asegúrate de que este valor esté correcto y sea válido
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
        <td colspan="4" style="text-align: center;  font-weight: bold;">
            <h4>$nombre_documento : # $id_acpm</h4>
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
<div class="section-title">Líder del Proceso</div>
<table class="content-table">
    <tr >
        <th colspan="1">Nombre</th>
        <td colspan="3">$nombre_usuario $apellidos_usuario</td>
        
    </tr>
    <tr>
        <th>Cargo</th>
        <td>$nombre_cargo</td>
        <th>Proceso</th>
        <td>$nombre_proceso</td>>
    </tr>
</table>
<br>
<div class="section-title">Información ACPM</div>
<table class="content-table">
        <tr>
        <th colspan="1">Tipo </th>
        <td colspan="2">$tipo_acpm</td>
       
    </tr>
    <tr>
        <th colspan="1">Fecha de Registro</th>
        <td colspan="2">$fecha_acpm</td>
    </tr>
    <tr>
        <th colspan="1">Origen </th>
        <td colspan="2" style="text-align: justify;" >$origen_acpm</td>
        
    </tr>
    <tr>
        <th colspan="1">Fuente </th>
        <td colspan="2">$fuente_acpm</td>
    </tr>    
    <tr>
        <th colspan="1">Descripción de la Fuente</th>
        <td colspan="2" style="text-align: justify;" >$descripcion_fuente</td>
    </tr>
     <tr>
        <th colspan="1">NC Similares / Afecten otro Proceso</th>
        <td colspan="2" >$nc_similar</td>
    </tr>
    <tr>
        <th colspan="1">Describe Cuales y en que Proceso</th>
        <td colspan="2" style="text-align: justify;">$descripcion_nsc</td>
    </tr>
    
    <tr>
        <th colspan="1">Se identificó peligros de SST nuevos o que han cambiado, o la necesidad de generar controles nuevos o modificar los existentes </th>
        <td colspan="2">$riesgo_acpm</td>
    </tr>
    <tr>
        <th>Describa cuales son los riegos</th>
        <td colspan="3" style="text-align: justify;">$justificacion_riesgo</td>
    </tr>
    <tr>
        <th colspan="1">Estado </th>
        <td colspan="2">$estado_acpm</td>
        
    </tr>
    <tr>
     <th colspan="1">Fecha de Finalización</th>
        <td colspan="2">$fecha_finalizacion</td>
    </tr>    
    <tr>
        <div class="section-title">Causa ACPM</div>
    </tr>
    <tr>
        <td colspan="3" style="text-align: justify;" >$causa_acpm</td>
    </tr>
  
    <tr>
       <div class="section-title">Espacio Exclusivo del SIG</div>
    </tr>
  <tr>
        <th colspan="1">¿Es Conforme?</th>
        <td colspan="3">$conforme_sig</td>
       
    </tr>
    <tr>
     <th colspan="1">Justifique por qué es o no es conforme </th>
        <td colspan="3">$justificacion_conforme_sig</td>
    </tr>


    <tr>
        <th colspan="1">¿Existe la necesidad de actualizar los riesgos y oportunidades actuales para el SIG?</th>
        <td colspan="3">$riesgos_sig</td>
      
    </tr>
    <tr>
       <th colspan="1"> ¿Cuáles riesgos u oportunidades se deben contemplar?</th>
        <td colspan="3">$jriesgos_sig</td>
    </tr>


    <tr>
        <th colspan="1">¿Es necesario hacer cambios al sistema de gestión?</th>
        <td colspan="3">$cambios_sig</td>
      
    </tr>
    <tr>
       <th colspan="1">¿Qué cambios se deben contemplar y documentar? </th>
        <td colspan="3">$justificacion_sig</td>
    </tr>
  
    <tr>
        <th colspan="1">Fecha Verificación </th>
        <td colspan="3">$fecha_estado</td>
       
    </tr>
</table>
EOF;

// Escribir el contenido HTML en el documento PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Consultar las actividades relacionadas con el ACPM
try {
    $stmt2 = Conexion::conectar()->prepare('SELECT * FROM actividades_acpm a INNER JOIN usuarios u ON a.id_usuario_fk = u.id WHERE a.id_acpm_fk = :id_acpm');
    $stmt2->bindParam(':id_acpm', $id_acpm, PDO::PARAM_INT);
    $stmt2->execute();

    if ($stmt2->rowCount() > 0) {
        while ($row2 = $stmt2->fetch()) {
            $id_actividad = $row2['id_actividad'];
            $fecha_actividad = $row2["fecha_actividad"];
            $descripcion_actividad = $row2["descripcion_actividad"];
            $estado_actividad = $row2["estado_actividad"];
            $tipo_actividad = $row2["tipo_actividad"];
            $responsable = $row2["nombre"];
            $apellido_responsable = $row2["apellidos_usuario"];

            $nombre_actividad = ($tipo_actividad == "Correccion") ? $tipo_actividad . " Inmediata" : $tipo_actividad;

            $actividad_html = <<<EOF
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
            </style>

            <!-- Título de la Actividad -->
            <div class="section-title">$nombre_actividad - # $id_actividad</div>

            <!-- Tabla con Detalles de la Actividad -->
            <table class="content-table">
                <tr>
                     <th colspan="1">Fecha de Cumplimiento</th>
                    <td colspan="1">$fecha_actividad</td>
                     <th colspan="1">Estado</th>
                    <td colspan="1">$estado_actividad</td>
                </tr>
                <tr>
                     <th colspan="1">Descripción</th>
                     <td colspan="3">$descripcion_actividad</td>
                </tr>
               
                <tr>
                    <th colspan="1">Responsable</th>
                     <td colspan="3">$responsable $apellido_responsable</td>
                </tr>
            </table>
            EOF;


            // Escribir la actividad en el PDF
            $pdf->writeHTML($actividad_html, true, false, true, false, '');

            // Consultar evidencias relacionadas con la actividad
            try {
                $stmt3 = Conexion::conectar()->prepare('SELECT * FROM detalle_actividad WHERE id_actividad_fk = :id_actividad');
                $stmt3->bindParam(':id_actividad', $id_actividad, PDO::PARAM_INT);
                $stmt3->execute();

                if ($stmt3->rowCount() > 0) {
                    while ($row3 = $stmt3->fetch()) {
                        $fecha_evidencia = $row3["fecha_evidencia"];
                        $evidencia = $row3["evidencia"];
                        $recursos = $row3["recursos"];

                        $detalle_html = <<<EOF
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
                        </style>

                        <!-- Título de la Sección de Detalle -->
                        <div class="section-title">Detalle de Evidencia</div>
                        <!-- Tabla con Detalles de Evidencia -->
                        <table class="content-table">
                            <tr>
                               <th colspan="1">Fecha Evidencia</th>
                                 <td colspan="1">$fecha_evidencia</td>
                                 <th colspan="1">Recursos</th>
                                 <td colspan="1">$recursos</td>
                            </tr>
                            <tr>
                               <th colspan="1">Evidencia</th>
                                 <td colspan="3">$evidencia</td>
                            </tr>
                        </table>
                        EOF;


                        // Escribir el detalle de la evidencia en el PDF
                        $pdf->writeHTML($detalle_html, true, false, true, false, '');
                    }
                }
            } catch (PDOException $e) {
                die('Error al consultar las evidencias: ' . $e->getMessage());
            }
        }
    }
} catch (PDOException $e) {
    die('Error al consultar las actividades: ' . $e->getMessage());
}

// Salida del PDF
$pdf->Output("ACPM_$id_acpm.pdf", 'I');
