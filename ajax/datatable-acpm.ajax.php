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
            case 'actividades':
                $consulta = "actividades";
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
            if ($consulta === 'aprobar' && $s["estado_acpm"] === 'Verificacion') {
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
            } elseif ($consulta === 'abierta' && $s["estado_acpm"] === 'Abierta') {
                // Solo se muestra si el estado es "Abierta"
                $informe_acpm = "<a href='extensiones/tcpdf/pdf/acpmpdf.php?id=" . $s["id_consecutivo"] . "' class='btn btn-outline-success'>
                    <i class='fas fa-file-signature'></i> Formato
                </a>";
                $actividades = "<button type='button' class='btn btn-outline-warning' onclick='cambiarPestana(\"actividades_acpm\", \"" . $s["id_consecutivo"] . "\")'>Actividades</button>";

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
            }elseif ($consulta === 'actividades') {
                // Solo se muestra si el estado es "Abierta"
                $visualizar_actividad = "<a href='' class='btn btn-outline-success'>
                    <i class='fas fa-file-signature'></i> Visualizar
                </a>";
                $subir_evidencia = "<button type='button' class='btn btn-outline-warning'>Subir Evidencia</button>";

                $columns = [
                    $s["id_actividad"],
                    $s["fecha_actividad"],
                    $s["descripcion_actividad"],
                    $s["estado_actividad"],
                    $visualizar_actividad,
                    $subir_evidencia
                ];

                $data[] = $columns;
                } elseif ($consulta !== 'aprobar' && $consulta !== 'abierta' && $s["estado_acpm"] === 'Verificacion') {
                // Otras consultas (que no son 'aprobar' o 'abierta')
                $asignar_actividad = "<button type='button' class='btn btn-outline-danger' data-toggle='modal' data-target='#modal-success' data-id_acpm_fk='{$s["id_consecutivo"]}'>
                    <i class='fas fa-hourglass-half'></i> Asignar Actividad
                </button>";
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
                    $informe_acpm,
                    $asignar_actividad,
                    $s["estado_acpm"]
                ];

                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }
}

$activarAcpm = new TablaAcpm();
$activarAcpm->mostrarTablaAcpm();
