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
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
                case 'equipo':
                    $this->mostrarTabla($item, $valor, "equipo");
                    break;
                default:
                echo json_encode(["data" => []]);
                break;
        }
    }
    private function mostrarTabla($item, $valor, $consulta)
    {
        $mantenimientos = ControladorMantenimiento::ctrMostrarMantenimiento($item, $valor, $consulta);
        $data = [];

        foreach ($mantenimientos as $s) {
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
            case 'equipo':
                $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/equipospdf.php?id=" . $s["id_mantenimiento"] . "' class='btn btn-outline-info'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";
                      $firmar="<button class='btn btn-outline-info' data-toggle='modal' data-target='#firmaModal' data-id='" . $s["id_mantenimiento"] . "'>
                        <i class='fas fa-file-signature'></i> Firmar Documento
                  </button>";
                return [
                    $s["id_mantenimiento"],
                        $s["fecha_mantenimiento"],
                        $s["estado_mantenimiento_equipo"],
                        $formatoequipo,
                        $firmar
                    
                ];

                case 'consumibles-utilizados':
                    return [
                        $s["id_registro"],
                        $s["nombre_impresora"],
                        $s["nombre_consumible"],
                        $s["fecha_instalacion"],
                        $s["cantidad_utilizada"]
                        
                    ];
            default:
                return null;
        }
    }

}

$activarMantenimiento = new TablaMantenimiento();
$activarMantenimiento->mostrarTablaMantenimiento();
?>
