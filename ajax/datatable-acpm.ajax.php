<?php
require_once "../controladores/acpm.controlador.php";
require_once "../modelos/acpm.modelo.php";
session_start();

class TablaAcpm {

    public function mostrarTablaAcpm() {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'acpm':
                $this->mostrarTabla($item, $valor, "acpm");
                break;
            case 'aprobar':
                $this->mostrarTabla($item, $valor, "aprobar");
                break;
            case 'abierta':
                $this->mostrarTabla($item, $valor, "abierta");
                break;
            case 'actividades':
                $this->mostrarTabla($item, $valor, "actividades");
                break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta) {
        $acpm = ControladorAcpm::ctrMostrarAcpm($item, $valor, $consulta);
        $data = [];

        foreach ($acpm as $s) {
            $columns = $this->prepararDatos($s, $consulta);
            if ($columns) {
                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }

    private function prepararDatos($s, $consulta) {
        switch ($consulta) {
            case 'acpm':
                if ($s["estado_acpm"] !== 'Verificacion') return null;
                $asignar_actividades = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id_acpm_fk='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-success'>Asignar actividades</button>";
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $informe_acpm,
                    $asignar_actividades,
                    $s["estado_acpm"]
                ];
            case 'abierta':
                if ($s["estado_acpm"] !== 'Abierta') return null;
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $actividades = "<a target='_blank' class='btn btn-outline-warning' href='index.php?ruta=acpm&id={$s["id_consecutivo"]}'>Gestionar ACPM</a>";
                return [
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
            case 'aprobar':
                if ($s["estado_acpm"] !== 'Verificacion') return null;
                $aprobar = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-aprobar'>Aprobar</button>";
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
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
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarAcpm = new TablaAcpm();
$activarAcpm->mostrarTablaAcpm();
