<?php
require_once "../../../configuracion.php";
require_once "../../../controladores/juridico.controlador.php";
require_once "../../../modelos/juridico.modelo.php";
require_once "../../../controladores/codificacion.controlador.php";
require_once "../../../modelos/codificacion.modelo.php";
require_once('tcpdf_include.php');

// Obtener el ID de mantenimiento desde la URL
$id_soporte_juridico = $_GET['id'];

// Obtener los datos del mantenimiento desde la base de datos
$tabla = 'soporte_juridico'; // Nombre de la tabla o configuración
$item = 'id_soporte_juridico'; // Campo por el cual filtrar
$valor = $id_soporte_juridico; // Valor para filtrar
$consulta = 'soporte_juridico';

// Llamar a la función para obtener los datos
$datos = ModeloSoporteJuridico::mdlMostrarSoporteJuridicopdf($tabla, $item, $valor, $consulta);


// Verificar si se obtuvieron datos
if (empty($datos)) {
    die('No se encontraron datos para el ID de Inspección.');
}

//CONSULTA ENCABEZADO DE LAS TABLAS
$tablad = 'version_documentos';
$itemd = 'id_documento';
$valord = '3';  // Asegúrate de que este valor esté correcto y sea válido
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
$nombre_solicitante = $row["nombre_solicitante"];
$id_cargo_fk1 = $row["id_cargo_fk1"];
$fecha_solicitud = $row["fecha_solicitud"];
$id_proceso_fk1 = $row["id_proceso_fk1"];
$elaboracion_contrato = $row["elaboracion_contrato"];
$formulacion_conceptos = $row["formulacion_conceptos"];
$respuesta_requerimientos = $row["respuesta_requerimientos"];
$descripcion_solicitud_juridico = $row["descripcion_solicitud_juridico"];
$observaciones = $row["observaciones"];
$solucion_juridico = $row["solucion_juridico"];
$fecha_solucion_juridico = $row["fecha_solucion_juridico"];


//condicion
// MUESTRA LOS PROCESOS Y LOS MARCA CON UNA X
$id_proceso_fk_checkbox = ($id_proceso_fk1 == "11") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gerencia = ($id_proceso_fk1 == "10") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gestion_tecnica = ($id_proceso_fk1 == "4") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gestion_operaciones = ($id_proceso_fk1 == "7") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_seguridad = ($id_proceso_fk1 == "13") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gestion_ti = ($id_proceso_fk1 == "2") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_sistema_integrado = ($id_proceso_fk1 == "1") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gestion_administrativa = ($id_proceso_fk1 == "5") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_gestion_juridica = ($id_proceso_fk1 == "11") ? '(X)' : '(&nbsp;&nbsp;)';
$id_proceso_fk_checkbox_otro = ($id_proceso_fk1 == "14") ? '(X)' : '(&nbsp;&nbsp;)';


// MUESTRA LA INFORMACION PARA LA ELABORACION DE CONTRATO
$contrato1_checkbox = ($elaboracion_contrato == "Promesa de Compraventa") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato2_checkbox = ($elaboracion_contrato == "Prestacion de Servicios") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato3_checkbox = ($elaboracion_contrato == "Ejecución de obras") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato4_checkbox = ($elaboracion_contrato == "Suministro") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato5_checkbox = ($elaboracion_contrato == "Laboral") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato6_checkbox = ($elaboracion_contrato == "Arrendamiento") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato7_checkbox = ($elaboracion_contrato == "Acuerdo Comercial") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato8_checkbox = ($elaboracion_contrato == "Acuerdo de Confidencialidad") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato9_checkbox = ($elaboracion_contrato == "Convenios") ? '(X)' : '(&nbsp;&nbsp;)';
$contrato10_checkbox = ($elaboracion_contrato == "Otros") ? '(X)' : '(&nbsp;&nbsp;)';

// MUESTRA LA INFORMACION PARA LA FORMULACION DE CONCEPTOS
$conceptos1_checkbox = ($formulacion_conceptos == "Regimen Franco") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos2_checkbox = ($formulacion_conceptos == "Aduanas") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos3_checkbox = ($formulacion_conceptos == "Tributario") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos4_checkbox = ($formulacion_conceptos == "Comercial") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos5_checkbox = ($formulacion_conceptos == "Contractual") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos6_checkbox = ($formulacion_conceptos == "Ambiental") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos7_checkbox = ($formulacion_conceptos == "Administrativo") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos8_checkbox = ($formulacion_conceptos == "Propiedad Horizontal") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos9_checkbox = ($formulacion_conceptos == "Civil") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos10_checkbox = ($formulacion_conceptos == "Laboral") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos11_checkbox = ($formulacion_conceptos == "Penal") ? '(X)' : '(&nbsp;&nbsp;)';
$conceptos12_checkbox = ($formulacion_conceptos == "Otros") ? '(X)' : '(&nbsp;&nbsp;)';

// MUESTRA LA INFORMACION PARA LA RESPUESTA A REQUERIMIENTOS
$requerimientos1_checkbox = ($respuesta_requerimientos == "Dian") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos2_checkbox = ($respuesta_requerimientos == "Carder") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos3_checkbox = ($respuesta_requerimientos == "Superintendencia") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos4_checkbox = ($respuesta_requerimientos == "Ministerios") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos5_checkbox = ($respuesta_requerimientos == "Camara de Comercio") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos6_checkbox = ($respuesta_requerimientos == "Persona Natural") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos7_checkbox = ($respuesta_requerimientos == "Empresa Privada") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos8_checkbox = ($respuesta_requerimientos == "Usuario Calificado ") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos9_checkbox = ($respuesta_requerimientos == "Usuario de Apoyo") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos10_checkbox = ($respuesta_requerimientos == "Admon Municipal") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos11_checkbox = ($respuesta_requerimientos == "Proveedores") ? '(X)' : '(&nbsp;&nbsp;)';
$requerimientos12_checkbox = ($respuesta_requerimientos == "Otros") ? '(X)' : '(&nbsp;&nbsp;)';
//$baseUrl = "https://beta.zonafrancadepereira.com/"; // Cambia esto según sea necesario para tu entorno de hosting
$baseUrl = "/MVC-ZFIP/";

// Construct the full URL
//$firma_recibido = $baseUrl . $rutaRelativa;

$ruta_solicitante = $row["firma_solicitante"];
$firma_solicitante = $baseUrl . $ruta_solicitante;


$ruta_juridica = $row["firma_juridica"];
$firma_juridica = $baseUrl . $ruta_juridica;


$nombreImagen = "images/logo_zf.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));



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
    </table>
    <br>
    <div class="section-title">1.INFORMACION DEL USUARIO</div>

    <table class="content-table">
        <tr>
            <td>Nombre Solicitante: $nombre_solicitante </td>
            <td>Cargo:$id_cargo_fk1</td>
            <td>Fecha:$fecha_solicitud</td>
        </tr>
    </table>
    

<div class="section-title">PROCESO</div>
    <table class="content-table">
        <tr>
            <th colspan="2">Gerencia</th>
            <th colspan="3">$id_proceso_fk_checkbox_gerencia</th>
            <th colspan="2">Gestion Tecnica</th>
            <th colspan="3">$id_proceso_fk_checkbox_gestion_tecnica</th>
            <th colspan="2">Gestion Operaciones</th>
            <th colspan="3">$id_proceso_fk_checkbox_gestion_operaciones</th>
        </tr>
        <tr>
            <th colspan="2">Seguridad</th>
            <th colspan="3">$id_proceso_fk_checkbox_seguridad</th>
            <th colspan="2">Gestion T.I</th>
            <th colspan="3">$id_proceso_fk_checkbox_gestion_ti</th>
            <th colspan="2">Sistema Integrado de Gestion</th>
            <th colspan="3">$id_proceso_fk_checkbox_sistema_integrado</th>
        </tr>
        <tr>
            <th colspan="2">Gestion Administrativa</th>
            <th colspan="3">$id_proceso_fk_checkbox_gestion_administrativa</th>
            <th colspan="2">Gestion Juridica</th>
            <th colspan="3">$id_proceso_fk_checkbox_gestion_juridica</th>
            <th colspan="2">Otro</th>
            <th colspan="3">$id_proceso_fk_checkbox_otro</th>

        </tr>
       
    </table>
    
    <div class="section-title">2.INFORMACION GENERAL DE LA SOLICITUD</div>
    <table class="content-table">
        <tr>
            <td>Elaboracion de Contrato</td>
            <td>Formulación de conceptos e informes</td>
            <td>Respuesta a requerimientos</td>
        </tr>
        <tr>
            <th >Promesa de Compraventa: $contrato1_checkbox</th>
            <th >Regimen Franco:$conceptos1_checkbox </th>
            <th >Dian:$requerimientos1_checkbox </th>
        </tr>
         <tr>
            <th >Prestacion de Servicios: $contrato2_checkbox</th>
            <th >Aduanas:$conceptos2_checkbox </th>
            <th >Carder:$requerimientos2_checkbox </th>
        </tr>
         <tr>
            <th >Ejecución de obras: $contrato3_checkbox</th>
            <th >Tributario: $conceptos3_checkbox</th>
            <th >Superintendencia:$requerimientos3_checkbox </th>
        </tr>
         <tr>
            <th >Suministro: $contrato4_checkbox </th>
            <th >Comercial:$conceptos4_checkbox </th>
            <th >Ministerios:$requerimientos4_checkbox</th>
        </tr>
         <tr>
            <th >Laboral: $contrato5_checkbox</th>
            <th >Contractual: $conceptos5_checkbox</th>
            <th >Camara de Comercio:$requerimientos5_checkbox </th>
        </tr>
         <tr>
            <th >Arrendamiento: $contrato6_checkbox</th>
            <th >Ambiental:$conceptos6_checkbox </th>
            <th >Persona Natural:$requerimientos6_checkbox </th>
        </tr>
         <tr>
            <th >Acuerdo Comercial:$contrato7_checkbox </th>
            <th >Administrativo:$conceptos7_checkbox </th>
            <th >Empresa Privada:$requerimientos7_checkbox </th>
        </tr>
         <tr>
            <th >Acuerdo de Confidencialidad:$contrato8_checkbox </th>
            <th >Propiedad Horizontal:$conceptos8_checkbox </th>
            <th >Usuario Calificado:$requerimientos8_checkbox </th>
        </tr>
           <tr>
            <th >Convenios:$contrato9_checkbox </th>
            <th >Civil:$conceptos9_checkbox </th>
            <th >Usuario de Apoyo:$requerimientos9_checkbox </th>
        </tr>
          <tr>
            <th >Otros: $contrato10_checkbox</th>
            <th >Laboral: $conceptos10_checkbox</th>
            <th >Admon Municipal: $requerimientos10_checkbox</th>
        </tr>
         <tr>
            <th ></th>
            <th >Penal:$conceptos11_checkbox </th>
            <th >Proveedores: $requerimientos11_checkbox</th>
        </tr>
         <tr>
            <th ></th>
            <th >Otros:$conceptos12_checkbox </th>
            <th >Otros:$requerimientos12_checkbox </th>
        </tr>
        
    </table>
    
    <div class="section-title">ANEXOS (información adicional, breve detalle de la información solicitada, documentos adjuntos)</div>
    <table class="content-table">
        <tr>
            <th>$descripcion_solicitud_juridico</th>
        </tr>
    </table>
    <br>
    <div class="section-title">OBSERVACIONES Y/O OTRAS</div>
    <table class="content-table">
        <tr>
            <th>$observaciones</th>
        </tr>
    </table>

        <div class="section-title">3.OBSERVACIONES - SOLUCION</div>
    <table class="content-table">
        <tr>
            <th>$solucion_juridico</th>
        </tr>
    </table>
        <br>
    <div class="section-title">FIRMA</div>
    <table class="content-table">
        <tr>
            <td><img src="$firma_solicitante" alt="Firma" width="120" style="margin-left: 50px;"></td>
            <td>$fecha_solucion_juridico</td>
            <td><img src="$firma_juridica" alt="Firma" width="120" style="margin-left: 50px;"></td>
        </tr>
        <tr>
            <th>FIRMA DEL SOLICITANTE</th>
            <th>FECHA DE RESPUESTA DE REQUERIMIENTO</th>
            <th>FIRMA GESTION JURIDICA</th>
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
