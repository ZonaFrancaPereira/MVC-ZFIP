<?php
require_once "../controladores/acpm.controlador.php";
require_once "../modelos/acpm.modelo.php";
session_start();

class TablaAcpm {

    public function mostrarTablaAcpm() {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';

        switch ($especifico) {
            case 'acpm':
                $consulta = "acpm";
                $item = 'id_usuario_fk';
                $valor = $_SESSION['id'];
                $this->mostrarTabla($item, $valor, $consulta);
                break;
            case 'aprobar':
                $consulta = "aprobar";
                $item = 'id_usuario_fk';
                $valor = $_SESSION['id'];
                $this->mostrarTabla($item, $valor, $consulta);
                break;
            case 'abierta':
                $consulta = "abierta";
                $item = 'id_usuario_fk';
                $valor = $_SESSION['id'];
                $this->mostrarTabla($item, $valor, $consulta);
                break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta) {
        $acpm = ControladorAcpm::ctrMostrarAcpm($item, $valor, $consulta);
        
        $data = array();

        foreach ($acpm as $s) {
            if ($consulta === 'acpm') {
                // Solo se muestra si el estado es "En Verificación"
                $asignar_actividades = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-aprobar'>Aprobar</button>";
                $informe_acpm = "<a href='extensiones/tcpdf/pdf/acpmpdf.php?id=" . $s["id_consecutivo"] . "' class='btn btn-outline-success'>
                    <i class='fas fa-file-signature'></i> Formato
                </a>";

                $columns = [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $asignar_actividades
                ];

                $data[] = $columns;
            } elseif ($consulta === 'abierta' && $s["estado_acpm"] === 'Abierta') {
                // Solo se muestra si el estado es "Abierta"
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id=" . $s["id_consecutivo"] . "' class='btn btn-outline-success'>
                    <i class='fas fa-file-signature'></i> Formato
                </a>";

                $actividades = "<a target='_blank'  class='btn btn-outline-warning' href='index.php?ruta=acpm&id=" . $s["id_consecutivo"] . "'>Gestionar ACPM</a>";
                $columns = [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $actividades
                ];

                $data[] = $columns;
            }
            elseif ($consulta === 'aprobar' && $s["estado_acpm"] === 'Verificacion') {
                // Solo se muestra si el estado es "En Verificación"
                $aprobar = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-aprobar'>Aprobar</button>";
                $informe_acpm = "<a href='extensiones/tcpdf/pdf/acpmpdf.php?id=" . $s["id_consecutivo"] . "' class='btn btn-outline-success'>
                    <i class='fas fa-file-signature'></i> Formato
                </a>";

                $columns = [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $aprobar
                ];

                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }
}

$activarAcpm = new TablaAcpm();
$activarAcpm->mostrarTablaAcpm();
