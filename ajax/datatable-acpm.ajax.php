<?php
require_once "../controladores/acpm.controlador.php";
require_once "../modelos/acpm.modelo.php";
session_start();

class TablaAcpm
{

  public function mostrarTablaAcpm()
{
    // Verifica si se especifica en la solicitud AJAX y asegúrate de convertir a string
    $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';

    switch ($especifico) {
        case 'acpm':
            $consulta="acpm";
            $item = 'id_usuario_fk';
            $valor = $_SESSION['id'];
            break;
        case 'aprobar':
            $consulta="aprobar";
            $item = 'id_usuario_fk';
            $valor = $_SESSION['id'];
            break;
        default:
            $consulta=null;
            $item = null;
            $valor = null;
            break;
    }

    // Consulta para obtener todos los soportes
    $acpm = ControladorAcpm::ctrMostrarAcpm($item, $valor, $consulta);

    $data = array();

    foreach ($acpm as $s) {

        $asignar_actividad = "<button type='button' class='btn btn-outline-danger'  data-toggle='modal' data-target='#modal-success'  data-id_acpm_fk='{$s["id_consecutivo"]}'>
        <i class='fas fa-hourglass-half'></i> Asignar Actividad
        </button>";
        $informe_acpm = "<a href='extensiones/tcpdf/pdf/acpmpdf.php?id=" . $s["id_consecutivo"] . "' class='btn btn-outline-success'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";


        $data[] = array(
            $s["id_consecutivo"],
            $s["nombre"],
            $s["origen_acpm"],
            $s["fuente_acpm"],
            $s["tipo_acpm"],
            $s["descripcion_acpm"],
            $s["fecha_finalizacion"],
            $informe_acpm,
            $asignar_actividad,
            $s["estado_acpm"]
        );
    }

    echo json_encode(["data" => $data]);
}


}

$activarAcpm = new TablaAcpm();
$activarAcpm->mostrarTablaAcpm();