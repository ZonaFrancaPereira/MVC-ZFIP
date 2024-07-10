<?php
require_once "../controladores/soporte.controlador.php";
require_once "../modelos/soporte.modelo.php";
session_start();

class TablaSoporte
{
    // Definir una función para determinar el color basado en la escala de urgencia
    private function determinarColor($urgencia)
    {
        switch ($urgencia) {
            case  'Urgente':
                return 'badge-danger'; // Rojo para alta urgencia
            case 'Urgencia media':
                return 'badge-warning'; // Amarillo para media urgencia
            case  'Prioridad baja':
                return 'badge-success'; // Verde para baja urgencia
            default:
                return ''; // Por defecto no se aplica ningún color
        }
    }

  public function mostrarTablaSoporte()
{
    // Verifica si se especifica en la solicitud AJAX y asegúrate de convertir a string
    $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';

    switch ($especifico) {
        case 'usuarios':
            $consulta="usuarios";
            $item = 'id_usuario_fk';
            $valor = $_SESSION['id'];
            break;
        case 'ti':
            $consulta="ti";
            $item = null;
            $valor = null;
            break;
        case 'finalizada':
            $consulta="finalizada";
            $item = null;
            $valor = null;
            break;
        default:
            $consulta=null;
            $item = null;
            $valor = null;
            break;
    }


    // Consulta para obtener todos los soportes
    $soportes = ControladorSoporte::ctrMostrarSoporte($item, $valor, $consulta);

    

    $data = array();

    foreach ($soportes as $s) {
        

        // Determinar la clase de color para la urgencia
        $colorClase = $this->determinarColor($s["urgencia"]);

        $urgencia = "<span class='$colorClase'>{$s["urgencia"]}</span>";
        $urgenciaButton = "<button type='button' class='btn btn-outline-warning' data-toggle='modal' data-target='#modal-urgencia' data-id_soporte='{$s["id_soporte"]}'>
        <i class='fas fa-hourglass-half'></i> Urgencia
        </button>";
        $respuestaButton = "<button type='button' class='btn btn-outline-info respuesta' data-toggle='modal' data-target='#modal-solicitud' data-id_soporte1='{$s["id_soporte"]}'>
        <i class='fas fa-file-signature'></i> Responder
        </button>";

        $data[] = array(
            $s["id_soporte"],
            $s["fecha_soporte"],
            $s["descripcion_soporte"],
            $urgencia, // Aquí se coloca el número de urgencia con su color
            $s["solucion_soporte"],
            $s["fecha_solucion"],
            $s["usuario_respuesta"],
            $urgenciaButton,
            $respuestaButton
        );
    }

    echo json_encode(["data" => $data]);
}


}

$activarSoporte = new TablaSoporte();
$activarSoporte->mostrarTablaSoporte();
