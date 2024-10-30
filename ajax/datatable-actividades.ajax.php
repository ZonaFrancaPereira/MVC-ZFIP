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
                case 'actividadesCompletas':
                    $this->mostrarTabla($item, $valor, "actividadesCompletas");
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
                if ($s["estado_actividad"] !== 'Incompleta') return null;
                $subir_evidencia = "<button type='button' class='btn btn-outline-info' data-id_actividad='{$s["id_actividad"]}' data-toggle='modal' data-target='#modal-evidencia'>Subir evidencia</button></td>";
                return [
                    $s["id_actividad"],
                    $s["fecha_actividad"],
                    $s["descripcion_actividad"],
                    $s["estado_actividad"],
                    $subir_evidencia
                ];
                case 'actividadesCompletas':
                    if ($s["estado_actividad"] !== 'Completa') return null;
                    $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_acpm_fk"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                    return [
                        $s["id_actividad"],
                        $s["fecha_actividad"],
                        $s["descripcion_actividad"],
                        $s["estado_actividad"],
                        $informe_acpm
                    ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarActividades = new TablaActividades();
$activarActividades->mostrarTablaAcpm();
