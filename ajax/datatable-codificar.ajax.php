<?php
require_once "../controladores/codificacion.controlador.php";
require_once "../modelos/codificacion.modelo.php";
session_start();

class TablaCodificar
{

    public function mostrarTablaCodificar()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'cod_responder':
                $this->mostrarTabla($item, $valor, "cod_responder");
                break;
                case 'cod_terminadas':
                    $this->mostrarTabla($item, $valor, "cod_terminadas");
                    break;
                    case 'cod_realizadas':
                        $this->mostrarTabla($item, $valor, "cod_realizadas");
                        break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $cod_realizadas = ControladorCodificar::ctrMostrarCodificacion($item, $valor, $consulta);
        $data = [];

        foreach ($cod_realizadas as $s) {
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
            
            case 'cod_responder':
                // Verificar si el campo está vacío o es null
                if ($s["fecha_sig_codificacion"] === '' || $s["fecha_sig_codificacion"] === null) {
                    // Si el campo está vacío o es null, puedes mostrar los datos
                    // Aquí puedes definir cómo mostrar los datos o qué hacer
                    $formato = "<a target='_blank' href='extensiones/tcpdf/pdf/codificarpdf.php?id={$s["id_codificacion"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                    $responder = "<button type='button' class='btn btn-outline-info' data-id_codificar='{$s["id_codificacion"]}' data-toggle='modal' data-target='#modal-cod_realizadas'>Responder</button></td>";
                    return [
                        $s["id_codificacion"],
                        $s["vigencia"],
                        $s["fecha_solicitud_cod"],
                        $s["usuario_solicitud_cod"],
                        $responder,
                        $formato
                    ];
                }
                return null;

                case 'cod_terminadas':
                   if ($s["estado_sig_codificacion"] !== 'Aprobado' && $s["estado_sig_codificacion"] !== 'Rechazado' ) return null;
                    // Crear enlaces para el informe y el botón de respuesta
                   $formato = "<a target='_blank' href='extensiones/tcpdf/pdf/codificarpdf.php?id={$s["id_codificacion"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                    return [
                        $s["id_codificacion"],
                        $s["vigencia"],
                        $s["fecha_solicitud_cod"],
                        $s["usuario_solicitud_cod"],
                        $s["estado_sig_codificacion"],
                        $formato
                    ];

                    case 'cod_realizadas':
                        //if ($s["estado_sig_codificacion"] !== 'Aprobado') return null;
                        $formato = "<a target='_blank' href='extensiones/tcpdf/pdf/codificarpdf.php?id={$s["id_codificacion"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                         return [
                             $s["id_codificacion"],
                             $s["vigencia"],
                             $s["fecha_solicitud_cod"],
                             $s["usuario_solicitud_cod"],
                             $s["fecha_sig_codificacion"],
                             $s["estado_sig_codificacion"],
                             $formato
                         ];
            default:
                return null;
        }
    }
    
}

// Inicialización y llamada a la función para mostrar la tabla
$codificar = new TablaCodificar();
$codificar->mostrarTablaCodificar();
