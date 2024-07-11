<?php



class ControladorVerificaciones
{
     /*=============================================
    CREAR Verificación
    =============================================*/
    public function ctrCrearVerificacion()
    {
        if (isset($_POST["id_activo_fk"]) && isset($_POST["id_usuario_fk"]) && isset($_POST["estado"]) && isset($_POST["observaciones"])) {

            $id_inventario_fk = $_POST["id_inventario_fk"];
            $id_activo_fk = $_POST["id_activo_fk"];

            // Verificar si ya existe una verificación para este activo en el inventario actual
            $existeVerificacion = ModeloVerificaciones::mdlExisteVerificacion("verificaciones", $id_activo_fk, $id_inventario_fk);

            if ($existeVerificacion) {
                echo '<script>
                    Swal.fire(
                        "Error",
                        "Ya existe una verificación para este activo en el inventario actual.",
                        "error"
                    );
                </script>';
            } else {
                $datos = array(
                    "id_inventario_fk" => $_POST["id_inventario_fk"],
                    "id_activo_fk" => $_POST["id_activo_fk"],
                    "id_usuario_fk" => $_POST["id_usuario_fk"],
                    "estado" => $_POST["estado"],
                    "observaciones" => $_POST["observaciones"]
                );

                $respuesta = ModeloVerificaciones::mdlCrearVerificacion("verificaciones", $datos);

                if ($respuesta === "ok") {
                    echo '<script>
                        Swal.fire(
                            "Buen Trabajo!",
                            "La Verificación se realizó con éxito.",
                            "success"
                        ).then(function() {
                            // Limpiar el formulario
                            $("#verificarActivo")[0].reset(); // Resetea el formulario
                            $("#panelcontabilidad").addClass("active");
                        });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire(
                            "Error",
                            "Hubo un problema al crear la verificación.",
                            "error"
                        ).then(function() {
                            $("#panelcontabilidad").addClass("active");
                        });
                    </script>';
                }
            }
        }
    }

    /*=============================================
    MOSTRAR Verificaciones por Inventario
    =============================================*/
    public function ctrMostrarVerificacionesPorInventario($id_inventario, $id_usuario_fk)
    {
        $tablaActivos = "activos";
        $tablaVerificacion = "verificaciones";
        
        // Llama al método estático del modelo para obtener las verificaciones por inventario y usuario
        $verificaciones = ModeloVerificaciones::mdlMostrarVerificacionesPorInventario($tablaVerificacion, $tablaActivos, $id_inventario, $id_usuario_fk);

        return $verificaciones;
    }
    
}
?>
