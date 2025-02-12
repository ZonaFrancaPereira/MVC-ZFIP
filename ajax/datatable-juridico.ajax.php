
<?php
require_once "../controladores/juridico.controlador.php";
require_once "../modelos/juridico.modelo.php";
session_start();

class TablaSoporteJuridico
{

    public function mostrarTablaJuridico()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'solicitudjuridico':
                $this->mostrarTabla($item, $valor, "solicitudjuridico");
                break;

                case 'solicitudjuridicofinalizada':
                    $this->mostrarTabla($item, $valor, "solicitudjuridicofinalizada");
                    break;

                    case 'solicitudjuridicorealizada':
                        $this->mostrarTabla($item, $valor, "solicitudjuridicorealizada");
                        break;

                        case 'solicitudjuridicoaceptar':
                            $this->mostrarTabla($item, $valor, "solicitudjuridicoaceptar");
                            break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $finalizadatecnico = ControladorSoporteJuridico::ctrMostrarSoporteJuridico($item, $valor, $consulta);
        $data = [];

        foreach ($finalizadatecnico as $s) {
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
            case 'solicitudjuridico':
                if ($s["estado_legal"] !== 'Abierto') return null;
                $respuestaJuridico = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-juridico' data-id_soporte_juridico='{$s["id_soporte_juridico"]}'>
                    <i class='fas fa-file-signature'></i> Responder
                    </button>";

                $formato_abierto ="<a target='_blank' href='extensiones/tcpdf/pdf/sjuridicopdf.php?id={$s["id_soporte_juridico"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";

                return [
                    $s["id_soporte_juridico"],
                    $s["nombre_solicitante"],
                    $s["id_cargo_fk1"],
                    $s["fecha_solicitud"],
                    $s["id_proceso_fk1"],
                    $s["descripcion_solicitud_juridico"],
                    $s["estado_legal"],
                    $formato_abierto,
                    $respuestaJuridico
                ];
                case 'solicitudjuridicofinalizada':
                    if ($s["estado_legal"] !== 'Rechazado' && $s["estado_legal"] !== 'Cerrado') return null;
                    return [
                    $s["id_soporte_juridico"],
                    $s["nombre_solicitante"],
                    $s["id_cargo_fk1"],
                    $s["fecha_solicitud"],
                    $s["id_proceso_fk1"],
                    $s["descripcion_solicitud_juridico"],
                    $s["fecha_solucion_juridico"],
                    $s["nombre_solucion"],
                    $s["solucion_juridico"],
                    $s["estado_legal"]


                    ];

                    case 'solicitudjuridicorealizada':
                        
                        return [
                            $s["id_soporte_juridico"],
                            $s["fecha_solicitud"],
                            $s["elaboracion_contrato"],
                            $s["formulacion_conceptos"],
                            $s["respuesta_requerimientos"],
                            $s["descripcion_solicitud_juridico"],
                            $s["fecha_solucion_juridico"],
                            $s["nombre_solucion"],
                            $s["solucion_juridico"],
                            $s["estado_legal"]

                        ];

                        case 'solicitudjuridicoaceptar':
                            if ($s["estado_legal"] !== 'Proceso') return null;
                            $aceptar = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#estadoSoporteModal' data-aceptar_solicitud='{$s["id_soporte_juridico"]}'>
                    <i class='fas fa-file-signature'></i> Responder
                    </button>";

                    $formato_legal ="<a target='_blank' href='extensiones/tcpdf/pdf/sjuridicopdf.php?id={$s["id_soporte_juridico"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                                       return [
                                $s["id_soporte_juridico"],
                                $s["nombre_solicitante"],
                                $s["id_cargo_fk1"],
                                $s["fecha_solicitud"],
                                $s["id_proceso_fk1"],
                                $s["descripcion_solicitud_juridico"],
                                $s["estado_legal"],
                                $formato_legal,
                                $aceptar
                            ];

            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarJuridico = new TablaSoporteJuridico();
$activarJuridico->mostrarTablaJuridico();
