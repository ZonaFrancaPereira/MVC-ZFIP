<?php



class ControladorVerificaciones
{
    /*=============================================
    CREAR Verificación
    =============================================*/
    public function ctrCrearVerificacion()
    {
        if (isset($_POST["id_activo_fk"]) && isset($_POST["id_usuario_fk"]) && isset($_POST["estado"]) && isset($_POST["observaciones"])) {

            // Verificar si hay un inventario abierto
            $inventarioAbierto = ControladorInventario::ctrVerificarInventarioAbierto();

            if ($inventarioAbierto) {
                $datos = array(
                    "id_inventario_fk" => $inventarioAbierto["id_inventario"],
                    "id_activo_fk" => $_POST["id_activo_fk"],
                    "id_usuario_fk" => $_POST["id_usuario_fk"],
                    "estado" => $_POST["estado"],
                    "observaciones" => $_POST["observaciones"],
                    "fecha_verificacion" => date("Y-m-d H:i:s")
                );

                $respuesta = ModeloVerificaciones::mdlCrearVerificacion("verificaciones", $datos);

                if ($respuesta === "ok") {
                    echo json_encode(array("status" => "success"));
                } else {
                    echo json_encode(array("status" => "error", "msg" => "Error al crear la verificación"));
                }
            } else {
                echo json_encode(array("status" => "error", "msg" => "No hay inventario abierto"));
            }
        }
    }

    /*=============================================
    MOSTRAR Verificaciones por Inventario
    =============================================*/
    public function ctrMostrarVerificacionesPorInventario($id_inventario)
    {
        $verificaciones = ModeloVerificaciones::mdlMostrarVerificacionesPorInventario("verificaciones", $id_inventario);

        return $verificaciones;
    }
}
?>
