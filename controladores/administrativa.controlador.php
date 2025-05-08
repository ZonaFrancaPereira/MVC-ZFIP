<?php

Class ControladorAdministrativa
{
    // Guardar usuario
    static public function ctrGuardarUsuario()
    {
        if (isset($_POST["nombre_administrativa"])) {
            $tabla = "vacaciones";
            // Validar campos
            $datos = array(
                "nombre_administrativa" => $_POST["nombre_administrativa"],
                "cedula_administrativa" => $_POST["cedula_administrativa"],
                "fecha_ingreso_administrativa" => $_POST["fecha_ingreso_administrativa"],
                "estado_usuario_administrativa" => $_POST["estado_usuario_administrativa"]
            );

            $respuesta = ModeloAdministrativa::mdlGuardarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "El usuario ha sido Agregado con Exito.",
                        "success"
                        ).then(function() {
                        document.getElementById("form_usuario_vacaciones").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La Respuesta no pudo ser guardada!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrMostrarUsuariosAdministrativa($item, $valor)
    {
        $tabla = "vacaciones";
        $respuesta = ModeloAdministrativa::mdlMostrarUsuariosAdministrativa($tabla, $item, $valor);
        return $respuesta;
    }

    static public function ctrGuardarDiasVacaciones()
    {
        if (isset($_POST["periodo_inicio"])) {
            $tabla = "detalle_vacaciones";
            // Validar campos
            $datos = array(
                "periodo_inicio" => $_POST["periodo_inicio"],
                "periodo_fin" => $_POST["periodo_fin"],
                "disfrutadas" => $_POST["disfrutadas"],
                "pendientes_periodo" => $_POST["pendientes_periodo"],
                "observaciones_vacaciones" => $_POST["observaciones_vacaciones"],
                "id_vacaciones_fk" => $_POST["id_vacaciones_fk"],
                "id_usuario_fk" => $_POST["id_usuario_fk"]
            );

            $respuesta = ModeloAdministrativa::mdlGuardarDiasVacaciones($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "Los días de vacaciones han sido guardados con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("form_dias_vacaciones").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡Los días de vacaciones no pudieron ser guardados!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrEditarUsuario()
    {
        if (isset($_POST["editar_nombre"])) {
            $tabla = "vacaciones";
            $datos = array(
                "nombre_administrativa" => $_POST["editar_nombre"],
                "cedula_administrativa" => $_POST["editar_cedula"],
                "fecha_ingreso_administrativa" => $_POST["editar_ingreso"],
                "estado_usuario_administrativa" => $_POST["editar_estado"],
                "id" => $_POST["id_editar"]
            );

            $respuesta = ModeloAdministrativa::mdlEditarUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "El usuario ha sido Modificado.",
                        "success"
                        ).then(function() {
                        document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡El usuario no ha sido eliminado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrActualizarVacaciones()
    {
        if (isset($_POST["editar_disfrutadas"])) {
            $tabla = "detalle_vacaciones";
            $datos = array(
                "disfrutadas" => $_POST["editar_disfrutadas"],
                "pendientes_periodo" => $_POST["editar_pendientes_periodo"],
                "dias_pendientes" => $_POST["editar_dias_pendientes"],
                "observaciones_vacaciones" => $_POST["editar_observaciones_vacaciones"],
                "id_detalle_vacaciones" => $_POST["editar_id_vacacion"]
            );

            $respuesta = ModeloAdministrativa::mdlActualizarVacaciones($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "Las vacaciones han sido actualizadas.",
                        "success"
                        ).then(function() {
                        document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡Las vacaciones no pudieron ser actualizadas!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    
    
}