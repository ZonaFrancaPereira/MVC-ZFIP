<?php
require_once "../controladores/tecnica.controlador.php";
require_once "../modelos/tecnica.modelo.php";
session_start();

class TablaSoporteTecnico
{

    public function mostrarTablaTecnico()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'finalizadatecnico':
                $this->mostrarTabla($item, $valor, "finalizadatecnico");
                break;

                case 'solicitudes':
                    $this->mostrarTabla($item, $valor, "solicitudes");
                    break;

                    case 'realizadas':
                        $this->mostrarTabla($item, $valor, "realizadas");
                        break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $finalizadatecnico = ControladorSoporteTecnico::ctrMostrarSoporteTecnico($item, $valor, $consulta);
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
            case 'finalizadatecnico':

                return [
                    $s["id_soporte_tecnico"],
                    $s["fecha_soporte_tecnico"],
                    $s["correo_soporte"],
                    $s["proceso_fk1"],
                    $s["descripcion_soporte_tecnico"],
                    $s["solucion_soporte_tecnico"],
                    $s["fecha_solucion_soporte"],
                    $s["usuario_respuesta"]
                ];
                case 'solicitudes':
                    $respuestaTecnico = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-respuesta' data-id_soporte_tecnico='{$s["id_soporte_tecnico"]}'>
                    <i class='fas fa-file-signature'></i> Responder
                    </button>";
                    return [
                        $s["id_soporte_tecnico"],
                        $s["fecha_soporte_tecnico"],
                        $s["correo_soporte"],
                        $s["proceso_fk1"],
                        $s["descripcion_soporte_tecnico"],
                        $respuestaTecnico
                    ];

                    case 'realizadas':

                        return [
                            $s["id_soporte_tecnico"],
                            $s["fecha_soporte_tecnico"],
                            $s["correo_soporte"],
                            $s["proceso_fk1"],
                            $s["descripcion_soporte_tecnico"],
                            $s["solucion_soporte_tecnico"],
                            $s["fecha_solucion_soporte"],
                            $s["usuario_respuesta"]
                        ];

            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarTecnico = new TablaSoporteTecnico();
$activarTecnico->mostrarTablaTecnico();
