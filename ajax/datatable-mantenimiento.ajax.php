<?php
require_once "../controladores/mantenimiento.controlador.php";
require_once "../modelos/mantenimiento.modelo.php";
session_start();

class TablaMantenimiento
{
    public function mostrarTablaMantenimiento()
    {
        // Verifica si se especifica en la solicitud AJAX y asegúrate de convertir a string
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';

        switch ($especifico) {
            case 'equipo':
                $consulta = "mantenimientos";
                $item = 'id_usuario_fk';
                break;
            case 'impresora':
                $consulta = "mantenimiento_impresora";
                $item = 'id_usuario_fk2';
                break;
            case 'general':
                $consulta = "mantenimiento_general";
                $item = 'id_usuario_fk3';
                break;
            default:
                $consulta = null;
                $item = null;
                break;
        }

        $data = array();

        // Obtener todos los mantenimientos según el tipo especificado
        if ($consulta) {
            $valor = $_SESSION['id'];
            if ($especifico == 'equipo') {
                $mantenimientos = ControladorMantenimiento::ctrMostrarMantenimiento($item, $valor, $consulta);
                foreach ($mantenimientos as $s) {
                    $formatoequipo = "<a href='extensiones/tcpdf/pdf/equipospdf.php?id=" . $s["id_mantenimiento"] . "' class='btn btn-outline-info'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";
                    $data[] = array(
                        $s["id_mantenimiento"],
                        $s["fecha_mantenimiento"],
                        $s["estado_mantenimiento_equipo"],
                        $formatoequipo,
                        $s["firma"],
                    );
                }
            } elseif ($especifico == 'impresora') {
                $impresora = ControladorMantenimiento::ctrMostrarMantenimientoImpresora($item, $valor, $consulta);
                foreach ($impresora as $s) {
                    $formatoimpresora = "<a href='extensiones/tcpdf/pdf/impresorapdf.php?id=" . $s["id_impresora"] . "' class='btn btn-outline-info'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";
                    $data[] = array(
                        $s["id_impresora"],
                        $s["fecha_mantenimiento_impresora"],
                        $s["estado_mantenimiento_impresora"],
                        $formatoimpresora,
                        $s["firma_impresora"],
                    );
                }
            }
            elseif ($especifico == 'general') {
                $general = ControladorMantenimiento::ctrMostrarMantenimientoGeneral($item, $valor, $consulta);
                foreach ($general as $s) {
                    $formatogeneral = "<a href='extensiones/tcpdf/pdf/generalpdf.php?id=" . $s["id_general"] . "' class='btn btn-outline-info'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";
                    $data[] = array(
                        $s["id_general"],
                        $s["fecha_mantenimiento3"],
                        $s["estado_general"],
                        $formatogeneral,
                        $s["firma_general"],
                    );
                }
            }
        }

        echo json_encode(["data" => $data]);
    }
}

$activarMantenimiento = new TablaMantenimiento();
$activarMantenimiento->mostrarTablaMantenimiento();
?>
