<?php
require_once "../controladores/acpm.controlador.php";
require_once "../modelos/acpm.modelo.php";
session_start();

class TablaActividades
{

    public function mostrarTablaAcpm()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'actividadesAbiertas':
                $this->mostrarTabla($item, $valor, "actividadesAbiertas");
                break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $actividadesAbiertas = ControladorAcpm::ctrMostrarActividades($item, $valor, $consulta);
        $data = [];

        foreach ($actividadesAbiertas as $s) {
            $columns = $this->prepararDatos($s, $consulta);
            if ($columns) {
                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }

    private function prepararDatos($s, $consulta)
    {
        switch ($consulta) {

            case 'actividadesAbiertas':
                $asignar_actividades = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id_acpm_fk='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-success'>Asignar actividades</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $asignar_actividades
                ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarActividades = new TablaActividades();
$activarActividades->mostrarTablaAcpm();
