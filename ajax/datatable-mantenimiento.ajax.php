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
                    case 'general':
                        $this->mostrarTabla($item, $valor, "general");
                        break;
                        case 'impresora':
                            $this->mostrarTabla($item, $valor, "impresora");
                            break;
                            case 'ti-equipo':
                                $this->mostrarTabla($item, $valor, "ti-equipo");
                                break;
                                case 'ti-impresora':
                                    $this->mostrarTabla($item, $valor, "ti-impresora");
                                    break;
                                    case 'ti-general':
                                        $this->mostrarTabla($item, $valor, "ti-general");
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

                case 'general':
                    $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/generalpdf.php?id=" . $s["id_general"] . "' class='btn btn-outline-info'>
                            <i class='fas fa-file-signature'></i> Formato
                          </a>";
                          $firmar="<button class='btn btn-outline-info' data-toggle='modal' data-target='#firmaModalGeneral' data-id='" . $s["id_general"] . "'>
                            <i class='fas fa-file-signature'></i> Firmar Documento
                      </button>";
                    return [
                            $s["id_general"],
                            $s["fecha_mantenimiento3"],
                            $s["estado_general"],
                            $formatoequipo,
                            $firmar
                        
                    ];

                    case 'impresora':
                        $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/impresorapdf.php?id=" . $s["id_impresora"] . "' class='btn btn-outline-info'>
                                <i class='fas fa-file-signature'></i> Formato
                              </a>";
                              $firmar="<button class='btn btn-outline-info' data-toggle='modal' data-target='#firmaModalImpresora' data-id='" . $s["id_impresora"] . "'>
                                <i class='fas fa-file-signature'></i> Firmar Documento
                          </button>";
                        return [
                                $s["id_impresora"],
                                $s["fecha_mantenimiento_impresora"],
                                $s["estado_mantenimiento_impresora"],
                                $formatoequipo,
                                $firmar
                            
                        ];

                case 'ti-equipo':
                    $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/equipospdf.php?id=" . $s["id_mantenimiento"] . "' class='btn btn-outline-info'>
                        <i class='fas fa-file-signature'></i> Formato
                      </a>";
                      $nombreCompleto = $s["nombre"] . " " . $s["apellidos_usuario"];
                    return [
                        $s["id_mantenimiento"],
                        $nombreCompleto,
                        $s["fecha_mantenimiento"],
                        $s["estado_mantenimiento_equipo"],
                        $formatoequipo
                    ];

                    case 'ti-impresora':
                        $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/impresorapdf.php?id=" . $s["id_impresora"] . "' class='btn btn-outline-info'>
                            <i class='fas fa-file-signature'></i> Formato
                          </a>";
                          $nombreCompleto = $s["nombre"] . " " . $s["apellidos_usuario"];
                        return [
                                $s["id_impresora"],
                                $nombreCompleto,
                                $s["fecha_mantenimiento_impresora"],
                                $s["estado_mantenimiento_impresora"],
                                $formatoequipo,
                        ];
                        case 'ti-general':
                            $formatoequipo = "<a target='_blank' href='extensiones/tcpdf/pdf/generalpdf.php?id=" . $s["id_general"] . "' class='btn btn-outline-info'>
                                <i class='fas fa-file-signature'></i> Formato
                              </a>";
                              $nombreCompleto = $s["nombre"] . " " . $s["apellidos_usuario"];
                            return [
                                    $s["id_general"],
                                    $nombreCompleto,
                                    $s["fecha_mantenimiento3"],
                                    $s["estado_general"],
                                    $formatoequipo,
                            ];
            default:
                return null;
        }
    }

}

$activarMantenimiento = new TablaMantenimiento();
$activarMantenimiento->mostrarTablaMantenimiento();
?>
