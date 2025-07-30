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


    static public function ctrEnviarVacaciones()
    {
        if (isset($_POST["id_detalle_vacaciones_fk"])) {

            $tabla = "vacaciones_solicitudes";
            $datos = array(
                "correo_aprobador" => $_POST["correo_aprobador"],
                "descripcion_solicitud" => $_POST["descripcion_solicitud"],
                "id_detalle_vacaciones_fk" => $_POST["id_detalle_vacaciones_fk"],
                "id_usuario_fk" => $_POST["id_usuario_detalle_fk"],
                "id_vacaciones_fk" => $_POST["id_vacaciones_detalle_fk"],
                "estado_solicitud" =>"Pendiente"
            );

            $respuesta = ModeloAdministrativa::mdlEnviarVacaciones($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Buen Trabajo!",
                        "Las vacaciones han sido enviadas.",
                        "success"
                    ).then(function() {
                        var datosCorreo = {
                            id_usuario_fk: "' . $_SESSION["id"] . '",
                            modulo: "vacaciones",
                            id_consulta: "' . $_POST["id_detalle_vacaciones_fk"] . '",
                            destinatario: "' . $_POST["correo_aprobador"] . '"
                        };

                        $.ajax({
                            url: "ajax/enviarCorreo.php",
                            method: "POST",
                            data: JSON.stringify(datosCorreo),
                            cache: false,
                            contentType: "application/json",
                            processData: false,
                            success: function(respuesta) {
                                console.log("Correo enviado:", respuesta);
                            }
                        });
                        
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Las vacaciones no pudieron ser enviadas!",
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        }
    }


    static public function ctrMotrarSolicitudesVacaciones()
    {
        // Verifica que haya sesión iniciada y que el correo esté disponible
        if (isset($_SESSION["correo_usuario"])) {
            $tabla = "vacaciones_solicitudes";
            $item = "correo_aprobador";
            $valor = $_SESSION["correo_usuario"];

            $respuesta = ModeloAdministrativa::mdlMostrarSolicitudesVacaciones($tabla, $item, $valor);
            return $respuesta;
        } else {
            return []; // O manejar error por falta de sesión
        }
    }

    static public function ctrMotrarVacacionesAprobadas($item, $valor)
    {
        $tabla = "vacaciones_solicitudes";
        $respuesta = ModeloAdministrativa::mdlMotrarVacacionesAprobadas($tabla, $item, $valor);
        return $respuesta;
    }
    static public function ctrAprobarSolicitud()
    {
        if (isset($_POST["id_solicitud"])) {
            $tabla = "vacaciones_solicitudes";
            $datos = array(
                "id_solicitud" => $_POST["id_solicitud"],
                "firma_aprobador" => $_POST["firma_aprobador"],
                "estado_solicitud" => "Proceso"
            );

            $respuesta = ModeloAdministrativa::mdlAprobarSolicitud($tabla, $datos);

            if ($respuesta == "ok") {
                 echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "La solicitud ha sido Aprobada.",
                        "success"
                        ).then(function() {
                            document.getElementById("formAprobarSolicitud").reset();
                            window.location.href = "administrativa";
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La solicitud no pudo ser aprobada!",
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

    static public function ctrRechazarSolicitud()
    {
        if (isset($_POST["id_solicitud_rechazo"])) {
            $tabla = "vacaciones_solicitudes";
            $datos = array(
                "id_solicitud" => $_POST["id_solicitud_rechazo"],
                "observaciones_solicitud" => $_POST["observaciones_solicitud"],
                "estado_solicitud" => "Rechazada"
            );

            $respuesta = ModeloAdministrativa::mdlRechazarSolicitud($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "La solicitud ha sido rechazada.",
                        "success"
                        ).then(function() {
                            document.getElementById("formRechazarSolicitud").reset();
                            window.location.href = "administrativa";
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La solicitud no pudo ser rechazada!",
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
    
    static public function ctrMotrarVacacionesUsuarios($item, $valor)
    {
        $tabla = "vacaciones_solicitudes";
        $respuesta = ModeloAdministrativa::mdlMostrarVacacionesUsuarios($tabla, $item, $valor);
        return $respuesta;
    }
    
   static public function ctrDescontarDias()
    {
    if (isset($_POST["id_detalle_vacaciones"]) && isset($_POST["dias_descuento"])) {
        $tabla = "detalle_vacaciones";
        $datos = array(
            "id_detalle_vacaciones" => $_POST["id_detalle_vacaciones"],
            "estado_solicitud" => "Aprobada",
            "dias_descuento" => intval($_POST["dias_descuento"])
        );

        $respuesta = ModeloAdministrativa::mdlDescontarDias($tabla, $datos);

        if ($respuesta == "ok") {
            echo '<script>
                Swal.fire(
                    "Buen trabajo!",
                    "Se han descontado los días con éxito.",
                    "success"
                ).then(function() {
                    document.getElementById("formDescontarDias").reset();
                    window.location.href = "administrativa";
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡La solicitud no pudo ser aprobada!",
                    text: "' . $respuesta . '"
                });
            </script>';
        }
    }
}

 static public function ctrObtenerNombrePorId($id)
{
    $tabla = "usuarios";
    $item = "id";
    $valor = $id;
    $respuesta = ModeloUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);
    return $respuesta ? $respuesta["nombre"] : "No encontrado";
}






}