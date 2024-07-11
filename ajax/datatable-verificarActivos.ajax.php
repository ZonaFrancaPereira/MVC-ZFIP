<?php
require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
require_once "../controladores/verificacion.controlador.php";
require_once "../modelos/verificacion.modelo.php";
require_once "../controladores/activos.controlador.php";
require_once "../modelos/activos.modelo.php";
session_start();

class TablaVerificacion {

    public function mostrarTablaVerificacion() {
        // Obtener el ID del inventario abierto si existe
        $ctrInventario = new ControladorInventario();
        $id_inventario_abierto = $ctrInventario->ctrVerificarInventarioAbierto();
        $id_inventario = $id_inventario_abierto ? $id_inventario_abierto["id_inventario"] : null;

        // Verificar el tipo específico de solicitud (verificados, noverificados)
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';

        switch ($especifico) {
            case 'verificados':
                $data = $this->obtenerDatosVerificados($id_inventario);
                break;
            case 'noverificados':
                $data = $this->obtenerDatosNoVerificados($id_inventario);
                break;
            default:
                $data = [];
                break;
        }

        echo json_encode(["data" => $data]);
    }

    private function obtenerDatosVerificados($id_inventario) {
        if (!$id_inventario) {
            return [];
        }
    
        $ctrVerificaciones = new ControladorVerificaciones();
        $id_usuario_fk = $_SESSION["id"];
        
        $request = $_REQUEST;

            // Obtener el total de registros verificados
            $totalRenglones = ModeloVerificaciones::mdlContarActivosVerificados($id_inventario, $id_usuario_fk)["contador"];

            // Obtener los registros verificados con paginación y búsqueda
            $Verificaciones = ModeloVerificaciones::mdlMostrarActivosVerificadosServerSide($request, $id_inventario, $id_usuario_fk);

            // Construir la respuesta JSON para DataTables
            $datosJson = [
                "draw" => intval($request["draw"]),
                "recordsTotal" => intval($totalRenglones),
                "recordsFiltered" => intval($totalRenglones),
                "data" => []
            ];

            // Preparar los datos para DataTables
            foreach ($Verificaciones as $v) {
                $estado_activo = $v["estado"];
                switch ($estado_activo) {
                    case 'Bueno':
                        $estado_verificado = "<span class='badge badge-success'>Bueno</span>";
                        break;
                    case 'Dar de Baja':
                        $estado_verificado = "<span class='badge badge-danger'>Dar de Baja</span>";
                        break;
                    case 'Perdido':
                        $estado_verificado = "<span class='badge badge-warning'>Perdido</span>";
                        break;
                    default:
                        $estado_verificado = "<span class='badge badge-secondary'>Desconocido</span>";
                        break;
                }
                $editar = "<button type='button' class='btn btn-outline-warning' data-toggle='modal' data-target='#modal-urgencia' data-id_soporte='{$v["id_verificacion"]}'>
                             <i class='fas fa-edit'></i> Editar</button>";
                $datosJson["data"][] = [
                    $v["id_activo"],
                    $v["nombre_articulo"],
                    $v["observaciones"],
                    $estado_verificado,
                    $editar
                ];
            }

            echo json_encode($datosJson);
            exit;
    }
    

    private function obtenerDatosNoVerificados($id_inventario) {
        if (!$id_inventario) {
            return [];
        }

        $ctrActivos = new ControladorActivos();
        $activos_no_verificados = $ctrActivos->ctrMostrarActivosNoVerificados($id_inventario);
        
        $data = [];
        foreach ($activos_no_verificados as $a) {
            $estado = "<span class='badge badge-danger'>Sin Verificar</span>";
            $verificar = "<button type='button' class='btn btn-outline-success' data-toggle='modal' data-target='#modalVerificacion' data-id_activo='{$a["id_activo"]}' data-nombre_articulo='{$a["nombre_articulo"]}'>
                            <i class='fas fa-check'></i> Verificar
                        </button>";
            $data[] = array(
                $a["id_activo"],
                $a["nombre_articulo"],
                $a["lugar_articulo"],
                $estado,
                $verificar
            );
        }

        return $data;
    }
}


$activarVerificacion = new TablaVerificacion();
$activarVerificacion->mostrarTablaVerificacion();
?>
