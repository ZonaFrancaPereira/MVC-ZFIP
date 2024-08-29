<?php


class ControladorAcpm
{

     /*=============================================
	CREAR ACPM
	=============================================*/
    
    static public function ctrCrearAcpm() 
    {

        if (isset($_POST["fecha_finalizacion"])) {
            //...
            $tabla = "acpm";
            $datos = array(
                "origen_acpm" => $_POST["origen_acpm"],
                "fuente_acpm" => $_POST["fuente_acpm"],
                "descripcion_fuente" => $_POST["descripcion_fuente"],
                "tipo_acpm" => $_POST["tipo_acpm"],
                "descripcion_acpm" => $_POST["descripcion_acpm"],
                "causa_acpm" => $_POST["causa_acpm"],
                "nc_similar" => $_POST["nc_similar"],
                "descripcion_nsc" => $_POST["descripcion_nsc"],
                "fecha_correccion" => $_POST["fecha_correccion"],
                "correccion_acpm" => $_POST["correccion_acpm"],
                "estado_acpm" => $_POST["estado_acpm"],
                "riesgo_acpm" => $_POST["riesgo_acpm"],
                "justificacion_riesgo" => $_POST["justificacion_riesgo"],
                "fecha_finalizacion" => $_POST["fecha_finalizacion"],
                "id_usuario_fk" => $_POST["id_usuario_fkacpm"]
            );

            $respuesta = ModeloAcpm::mdlIngresarAcpm($tabla, $datos);
            
            if ($respuesta == "ok") {
                echo '<script>
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    title: "OJO!",
                    text: "Por favor, describe las actividades de tu ACPM, en la pestaña ACCIONES EN VERIFICACIÓN, de lo contrario tu ACCIÓN SERÁ RECHAZADA.",
                    icon: "success"
                }).then(function() {
                    // Enviar datos por AJAX después de cerrar la alerta
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "acpm",
                        id_consulta: "' . $respuesta . '",
                        destinatario: "ninguno"
                    };
                    $.ajax({
                        url: "ajax/enviarCorreo.php",
                        method: "POST",
                        data: JSON.stringify(datosCorreo),
                        cache: false,
                        contentType: "application/json",
                        processData: false,
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                        }
                    });
                    // Resetear el formulario y agregar la clase al elemento después del AJAX
                    document.getElementById("acpm").reset();
                    $("#acpm").addClass("active");
                });
              </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al crear el ACPM: ' . $respuesta . '",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#acpm").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

     /*=============================================
	MOSTRAR ACPM
	=============================================*/

    static public function ctrMostrarAcpm($item, $valor, $consulta)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpm($tabla, $item, $valor, $consulta);

        return $respuesta;
    }
    

     /*=============================================
	CREAR ACTIVIDAD
	=============================================*/
    static public function ctrCrearActividad() 
    {
        if (isset($_POST["fecha_actividad"])) {
            //...
            $tabla = "actividades_acpm";
            $datos = array(
                "fecha_actividad" => $_POST["fecha_actividad"],
                "descripcion_actividad" => $_POST["descripcion_actividad"],
                "tipo_actividad" => $_POST["tipo_actividad"],
                "estado_actividad" => $_POST["estado_actividad"],
                "id_usuario_fk" => $_POST["id_usuario_fk_6"],
                "id_acpm_fk" => $_POST["id_acpm_fk"]
            );
    
            $respuesta = ModeloAcpm::mdlIngresarActividad($tabla, $datos);
            
            if ($respuesta == "ok") {
                echo 
                '<script>
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    title: "Buen Trabajo!!",
                    text: "La actividad fue creada con éxito.",
                    icon: "success"
                }).then(function() {
                    // Enviar datos por AJAX después de cerrar la alerta
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "acciones_verificacion",
                        id_consulta: "' . $respuesta . '",
                        destinatario: "ninguno"
                    };
                    $.ajax({
                        url: "ajax/enviarCorreo.php",
                        method: "POST",
                        data: JSON.stringify(datosCorreo),
                        cache: false,
                        contentType: "application/json",
                        processData: false,
                        success: function(respuesta) {
                            console.log("respuesta", respuesta);
                        }
                    });
                    // Resetear el formulario y agregar la clase al elemento después del AJAX
                    document.getElementById("form_actividades").reset();
                    $("#acciones_verificacion").addClass("active");
                });
              </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al crear la actividad.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#acciones_verificacion").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }
    

   /*=============================================
    APROBAR Y RECHAZAR ACPM
    =============================================*/

    public static function ctrAprobarAcpm() 
    {
        if (isset($_POST["id_consecutivo"])) {
            $tabla = "acpm";
            $datos = array(
                "id_consecutivo" => $_POST["id_consecutivo"],
                "estado_acpm" => $_POST["estado_acpm"]
            );
    
            $respuesta = ModeloAcpm::mdlAprobarAcpm($tabla, $datos);
    
            if ($_POST["estado_acpm"] == "Rechazada" && isset($_POST["motivo_rechazo"])) {
                $tabla = "acpm_rechazada";
                $datosRechazo = array(
                 
                    "descripcion_rechazo" => $_POST["motivo_rechazo"],
                    "id_consecutivo_fk" => $_POST["id_consecutivo"]
                );
                $respuestaRechazo = ModeloAcpm::mdlRechazarAcpm($tabla,$datosRechazo);
            }
    
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "Su respuesta se ha registrado con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("form_aprobar_acpm").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#aprobacion").addClass("active");
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
                            $("#aprobacion").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }
    
   /*=============================================
        SUBIR EVIDENCIA
    =============================================*/

    static public function ctrSubirEvidencia() {
        if (isset($_POST["fecha_evidencia"])) { // Verificar si el formulario ha sido enviado
            $tablaEvidencia = "detalle_actividad";
            $datosEvidencia = array(
                "fecha_evidencia" => $_POST["fecha_evidencia"],
                "evidencia" => $_POST["evidencia"],
                "recursos" => $_POST["recursos"],
                "id_actividad_fk" => $_POST["id_actividad_fk"],
                "id_usuario_e_fk" => $_POST["id_usuario_e_fk"]
            );

            // Guardar la evidencia
            $respuestaEvidencia = ModeloAcpm::mdlIngresarEvidenciaActividad($tablaEvidencia, $datosEvidencia);

            if ($respuestaEvidencia == "ok") {
                // Cambiar el estado de la actividad a "Completa"
                $estadoRespuesta = ModeloAcpm::mdlActualizarEstadoActividad($_POST["id_actividad_fk"], "Completa");

                if ($estadoRespuesta == "ok") {
                    echo '<script>
                            Swal.fire(
                                "Buen Trabajo!",
                                "Su evidencia y el estado de la actividad se han actualizado con éxito.",
                                "success"
                            ).then(function() {
                            window.location = ""; // Redirige a la página actual o a la vista correcta
                        });
                        </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡El estado de la actividad no pudo ser actualizado!",
                            text: "Por favor, intente nuevamente.",
                            confirmButtonText: "Cerrar"
                        }).then(function() {
                            window.location = ""; // Redirige a la página actual o a la vista correcta
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡La evidencia no pudo ser guardada!",
                        text: "Por favor, intente nuevamente.",
                        confirmButtonText: "Cerrar"
                    }).then(function() {
                            window.location = ""; // Redirige a la página actual o a la vista correcta
                        });
                </script>';
            }
        }
    }

    static public function ctrEliminarActividad() {
        if (isset($_POST["id_actividad"])) {
            $idActividad = $_POST["id_actividad"];
    
            // Llamar al modelo para eliminar la actividad
            $respuesta = ModeloAcpm::mdlEliminarActividad($idActividad);
    
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                            "Eliminado!",
                            "La actividad ha sido eliminada con éxito.",
                            "success"
                        ).then(function() {
                            window.location = ""; // Redirige a la página actual o a la vista correcta
                        });
                      </script>';
            } else {
                echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "No se pudo eliminar la actividad. Por favor, intente nuevamente.",
                            confirmButtonText: "Cerrar"
                        });
                      </script>';
            }
        }
    }
    
    
    
    
     
}
    


