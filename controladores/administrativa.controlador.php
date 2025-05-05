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
                "fecha_ingreso_administrativa" => $_POST["fecha_ingreso_administrativa"]
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
        if (isset($_POST["periodo_vacaciones"])) {
            $tabla = "detalle_vacaciones";
            // Validar campos
            $datos = array(
                "periodo_vacaciones" => $_POST["periodo_vacaciones"],
                "disfrutadas" => $_POST["disfrutadas"],
                "pendientes_periodo" => $_POST["pendientes_periodo"],
                "dias_pendientes" => $_POST["dias_pendientes"],
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

    static public function ctrCambiarEstadoUsuario()
    {
        if (isset($_POST["nombre_administrativa"])) {
            $tabla = "vacaciones";
            $datos = array(
                "nombre_administrativa" => $_POST["nombre_administrativa"],
                "estado_usuario_administrativa" => $_POST["estado_usuario_administrativa"]
            );

            $respuesta = ModeloAdministrativa::ctrCambiarEstadoUsuario($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "El usuario ha sido eliminado con Exito.",
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

    
    
}