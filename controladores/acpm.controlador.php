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

            if (is_array($respuesta) && $respuesta["status"] === "ok") {
                // Usar el último ID insertado
                $id_acpm_fk = $respuesta["id_acpm_fk"];
            
                // Insertar actividad si el tipo de ACPM es "AC" o "AP"
                if ($_POST["tipo_acpm"] == "AC" || $_POST["tipo_acpm"] == "AP") {
                    $datosActividad = array(
                        "fecha_actividad" => $_POST["fecha_correccion"],
                        "descripcion_actividad" => $_POST["correccion_acpm"],
                        "tipo_actividad" => "Correccion",
                        "estado_actividad" => "Incompleta",
                        "id_usuario_fk" => $_POST["id_usuario_fkacpm"],
                        "id_acpm_fk" => $id_acpm_fk,
                    );
            
                    $respuestaActividad = ModeloAcpm::mdlIngresarActividadCorrecion($datosActividad);
            
                    if ($respuestaActividad === "ok") {
                        echo "La inserción de la actividad fue exitosa.";
                    } else {
                        echo "Error al insertar la actividad.";
                    }
                }
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
	MOSTRAR ACPM
	=============================================*/

    static public function ctrMostrarActividades($item, $valor, $consulta)
    {
        $tabla = "actividades_acpm";

        $respuesta = ModeloAcpm::mdlMostrarActividades($tabla, $item, $valor, $consulta);

        return $respuesta;
    }



   /*=============================================
CREAR ACTIVIDAD
=============================================*/
static public function ctrCrearActividad()
{
    if (isset($_POST["fecha_actividad"])) {
        // Capturamos el ID del usuario desde el formulario
        $id_usuario_fk = $_POST["id_usuario_fk_6"];

        // Datos de la actividad a insertar en la base de datos
        $tabla = "actividades_acpm";
        $datos = array(
            "fecha_actividad" => $_POST["fecha_actividad"],
            "descripcion_actividad" => $_POST["descripcion_actividad"],
            "tipo_actividad" => $_POST["tipo_actividad"],
            "estado_actividad" => $_POST["estado_actividad"],
            "id_usuario_fk" => $id_usuario_fk,
            "id_acpm_fk" => $_POST["id_acpm_fk"]
        );

        $respuesta = ModeloAcpm::mdlIngresarActividad($tabla, $datos);

        if ($respuesta == "ok") {
            echo
            '<script>
            Swal.fire({
                title: "Buen Trabajo!!",
                text: "La actividad fue creada con éxito.",
                icon: "success"
            }).then(function() {
                // Enviar datos por AJAX después de cerrar la alerta
                var datosCorreo = {
                    id_usuario_fk: "' . $id_usuario_fk . '", // Capturando el ID del formulario
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
                $respuestaRechazo = ModeloAcpm::mdlRechazarAcpm($tabla, $datosRechazo);
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

    static public function ctrSubirEvidencia()
    {
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

    /*=============================================
        ELIMINAR ACTIVIDAD
    =============================================*/

    static public function ctrEliminarActividad()
    {
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

    /*=============================================
        VERIFICAR SI TODAS LAS ACTIVIDADES ESTAN COMPLETAS
    =============================================*/
    static public function ctrVerificarActividadesCompletas($id_acpm)
    {
        return ModeloAcpm::mdlVerificarActividadesCompletas($id_acpm);
    }

    /*=============================================
       ACTUALIZAR ESTADO
    =============================================*/

    static public function ctrActualizarEstadoAcpm($id_acpm, $nuevoEstado)
    {
        return ModeloAcpm::mdlActualizarEstadoAcpm($id_acpm, $nuevoEstado);
    }


    /*=============================================
        ENVIAR A SIG
    =============================================*/

    static public function ctrEnviarASig()
    {
        if (isset($_POST['id_acpm'])) {
            $id_acpm = $_POST['id_acpm'];
            $respuesta = self::ctrActualizarEstadoAcpm($id_acpm, 'Proceso');
    
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                            "Enviado!",
                            "La ACPM ha sido enviada satisfactoriamente a SIG.",
                            "success"
                        ).then(function() {
                            // Enviar datos por AJAX después de cerrar la alerta
                            var datosCorreo = {
                                id_usuario_fk: "' . $_SESSION["id"] . '",
                                modulo: "enviar_verificacion_sig",
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
                                    // Redirigir después de que se haya enviado el correo por AJAX
                                    window.location = "sig";
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
                            text: "No se pudo ENVIAR A SIG. Por favor, intente nuevamente.",
                            confirmButtonText: "Cerrar"
                        });
                      </script>';
            }
        }
    }
    

    /*=============================================
    APROBAR Y RECHAZAR ACPM POR PARTE DE SIG
    =============================================*/

    static public function ctrGuardarAccion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["accion_acpm"])) {
            $accion = $_POST["accion_acpm"];

            // Manejo de la acción de "Eficacia"
            if ($accion == "eficacia") {
                $tabla = "acpm";
                $datos = array(
                    "id_consecutivo" => $_POST["id_acpm_fk_sig1"],
                    "riesgo_acpm" => $_POST["riesgo_acpm"],
                    "justificacion_riesgo" => $_POST["justificacion_riesgo"],
                    "cambios_sig" => $_POST["cambios_sig"],
                    "justificacion_sig" => $_POST["justificacion_sig"],
                    "conforme_sig" => $_POST["conforme_sig"],
                    "justificacion_conforme_sig" => $_POST["justificacion_conforme_sig"],
                    "fecha_estado" => $_POST["fecha_estado"]
                );

                $respuesta = ModeloAcpm::mdlActualizarEficacia($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire(
                            "Enviado!",
                            "La Respuesta ha sido Guardada Correctamente.",
                            "success"
                        ).then(function() {
                            window.location = "sig"; // Redirige a la página actual o a la vista correcta
                        });
                      </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "No se pudo Guardar la Respuesta.",
                            confirmButtonText: "Cerrar"
                        });
                      </script>';
                }
            }

            // Manejo de la acción de "Rechazo"
            elseif ($accion == "rechazo") {
                $datosRechazo = array(
                    "id_consecutivo_fk" => $_POST["id_acpm_fk_sig1"],
                    "descripcion_rechazo" => $_POST["descripcion_rechazo"]
                );

                $respuesta = ModeloAcpm::mdlGuardarRechazo($datosRechazo);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire(
                            "Enviado!",
                            "La Respuesta ha sido Guardada Correctamente.",
                            "success"
                        ).then(function() {
                            window.location = "sig"; // Redirige a la página actual o a la vista correcta
                        });
                      </script>';
                } else {
                    echo '<script>
                        Swal.fire({
                            icon: "error",
                            title: "¡Error!",
                            text: "No se pudo Guardar la Respuesta.",
                            confirmButtonText: "Cerrar"
                        });
                      </script>';
                }
            }
        }
    }


    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ACPM TECNICO
    =============================================*/
    public static function ctrActualizarFechaAcpm()
    {
        if (isset($_POST["modificar_fecha_tecnica"])) { // Cambiado a "modificar_fecha_tecnica"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["id_acpm_fk1"],
                "fecha_finalizacion" => $_POST["fecha_modificar"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaAcpm($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_tecnica").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#tecnica").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }


    /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE SIG
    =============================================*/
    public static function ctrActualizarFechaSig()
    {
        if (isset($_POST["modificar_fecha_sig"])) { // Cambiado a "modificar_fecha_sig"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["sig"],
                "fecha_finalizacion" => $_POST["modificar_fecha_sig"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaSig($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_sig").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#sig").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

     /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE ADMINISTRATIVA
    =============================================*/
    public static function ctrActualizarFechaAdministrativa()
    {
        if (isset($_POST["modificar_fecha_administrativa"])) { // Cambiado a "modificar_fecha_administrativa"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["administrativa"],
                "fecha_finalizacion" => $_POST["modificar_fecha_administrativa"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaAdministrativa($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_administrativa").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#gestion_administrativa").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

     /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE CONTABLE
    =============================================*/
    public static function ctrActualizarFechaContable()
    {
        if (isset($_POST["modificar_fecha_contable"])) { // Cambiado a "modificar_fecha_contable"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["contable"],
                "fecha_finalizacion" => $_POST["modificar_fecha_contable"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaContable($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_contable").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#gestion_contable").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

      /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE JURIDICA
    =============================================*/
    public static function ctrActualizarFechaJuridica()
    {
        if (isset($_POST["modificar_fecha_juridica"])) { // Cambiado a "modificar_fecha_juridica"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["juridica"],
                "fecha_finalizacion" => $_POST["modificar_fecha_juridica"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaJuridica($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_juridica").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#gestion_juridica").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

          /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE INFORMATICA
    =============================================*/
    public static function ctrActualizarFechaInformatica()
    {
        if (isset($_POST["modificar_fecha_informatica"])) { // Cambiado a "modificar_fecha_informatica"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["informatica"],
                "fecha_finalizacion" => $_POST["modificar_fecha_informatica"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaInformatica($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_informatica").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#tecnologia_informatica").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }


        /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE OPERACIONES
    =============================================*/
    public static function ctrActualizarFechaOperaciones()
    {
        if (isset($_POST["modificar_fecha_operaciones"])) { // Cambiado a "modificar_fecha_operaciones"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["operaciones"],
                "fecha_finalizacion" => $_POST["modificar_fecha_operaciones"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaOperaciones($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_operaciones").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#operaciones").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

        /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE GERENCIA
    =============================================*/
    public static function ctrActualizarFechaGerencia()
    {
        if (isset($_POST["modificar_fecha_gerencia"])) { // Cambiado a "modificar_fecha_gerencia"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["gerencia"],
                "fecha_finalizacion" => $_POST["modificar_fecha_gerencia"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaGerencia($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_gerencia").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#gerencia").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

       /*=============================================
    ACTUALIZAR FECHA DE FINALIZACIÓN DE SEGURIDAD
    =============================================*/
    public static function ctrActualizarFechaSeguridad()
    {
        if (isset($_POST["modificar_fecha_seguridad"])) { // Cambiado a "modificar_fecha_seguridad"
            // Capturar datos desde el formulario
            $datos = array(
                "id_acpm" => $_POST["seguridad"],
                "fecha_finalizacion" => $_POST["modificar_fecha_seguridad"]
            );

            // Llamar al modelo para actualizar la fecha
            $respuesta = ModeloAcpm::mdlActualizarFechaSeguridad($datos);

            // Manejar la respuesta del modelo
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Actualizado!",
                        "La fecha ha sido actualizada con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("form_modificar_seguridad").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#seguridad").addClass("active");
                    });
                  </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "ERROR!",
                        "Error al actualizar la fecha de la ACPM.",
                        "error"
                    ).then(function() {
                        window.location = ""; // Redirige a la página actual o a la vista correcta
                    });
                  </script>';
            }
        }
    }

      /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpm() 
    {
        $id_usuario_fk = 14; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertas = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradas = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacion = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $proceso = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencida = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertas,
            'cerradas' => $cerradas,
            'verificacion' => $verificacion,
            'proceso' => $proceso,
            'vencida' => $vencida
        ];

        echo json_encode($data);
    }

       /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP TECNICO
    =============================================*/
 

    public static function graficaVerificacionAcciones() 
    {
        $id_usuario_fk = 14; // ID del usuario especificado

        // Obtener datos del modelo
        $mejora_abierta = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
        $mejora_cerrada = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
        $preventiva_abierta = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
        $preventiva_cerrada = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'AM_abierto' => $mejora_abierta,
            'AM_cerrado' => $mejora_cerrada,
            'AP_abierto' => $preventiva_abierta,
            'AP_cerrado' => $preventiva_cerrada
        ];

        echo json_encode($data);
    }

       /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmSig() 
    {
        $id_usuario_fk = 17; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertassig = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradassig = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionsig = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesosig = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidasig = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertassig,
            'cerradas' => $cerradassig,
            'verificacion' => $verificacionsig,
            'proceso' => $procesosig,
            'vencida' => $vencidasig
        ];

        echo json_encode($data);
    }

    /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP SIG
    =============================================*/
    public static function graficaVerificacionAccionesSig() 
    {
        $id_usuario_fk = 17; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertasig = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradasig = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertasig = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradasig = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertasig,
             'AM_cerrado' => $mejora_cerradasig,
             'AP_abierto' => $preventiva_abiertasig,
             'AP_cerrado' => $preventiva_cerradasig
         ];
 
         echo json_encode($data);
    }


    /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmAdministrativa() 
    {
        $id_usuario_fk = 27; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasadministrativa = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasadministrativa = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionadministrativa = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesoadministrativa = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidaadministrativa = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasadministrativa,
            'cerradas' => $cerradasadministrativa,
            'verificacion' => $verificacionadministrativa,
            'proceso' => $procesoadministrativa,
            'vencida' => $vencidaadministrativa
            

        ];

        echo json_encode($data);
    }

    /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP ADMINISTRATIVA
    =============================================*/
    public static function graficaVerificacionAccionesAdministrativa() 
    {
        $id_usuario_fk = 27; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertaadministrativa = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradaadministrativa = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertaadministrativa = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradaadministrativa = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertaadministrativa,
             'AM_cerrado' => $mejora_cerradaadministrativa,
             'AP_abierto' => $preventiva_abiertaadministrativa,
             'AP_cerrado' => $preventiva_cerradaadministrativa
         ];
 
         echo json_encode($data);
    }

    
    /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmContable() 
    {
        $id_usuario_fk = 6; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertascontable = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradascontable = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacioncontable = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesocontable = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidacontable = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertascontable,
            'cerradas' => $cerradascontable,
            'verificacion' => $verificacioncontable,
            'proceso' => $procesocontable,
            'vencida' => $vencidacontable
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP CONTABLE
    =============================================*/
    public static function graficaVerificacionAccionesContable() 
    {
        $id_usuario_fk = 6; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertacontable = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradacontable = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertacontable = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradacontable = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertacontable,
             'AM_cerrado' => $mejora_cerradacontable,
             'AP_abierto' => $preventiva_abiertacontable,
             'AP_cerrado' => $preventiva_cerradacontable
         ];
 
         echo json_encode($data);
    }

     
           /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmJuridica() 
    {
        $id_usuario_fk = 24; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasjuridica = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasjuridica = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionjuridica = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesojuridica = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidacontable = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasjuridica,
            'cerradas' => $cerradasjuridica,
            'verificacion' => $verificacionjuridica,
            'proceso' => $procesojuridica,
            'vencida' => $vencidacontable
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP JURIDICA
    =============================================*/
    public static function graficaVerificacionAccionesJuridica() 
    {
        $id_usuario_fk = 24; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertajuridica = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradajuridica = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertajuridica = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradajuridica = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertajuridica,
             'AM_cerrado' => $mejora_cerradajuridica,
             'AP_abierto' => $preventiva_abiertajuridica,
             'AP_cerrado' => $preventiva_cerradajuridica
         ];
 
         echo json_encode($data);
    }

            /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmInformatica() 
    {
        $id_usuario_fk = 2; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasinformatica = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasinformatica = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacioninformatica = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesoinformatica = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidainformatica = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasinformatica,
            'cerradas' => $cerradasinformatica,
            'verificacion' => $verificacioninformatica,
            'proceso' => $procesoinformatica,
            'vencida' => $vencidainformatica
        ];

        echo json_encode($data);
    }

           /*=============================================
                INFORMATICA
    =============================================*/
    public static function graficaVerificacionAccionesInformatica() 
    {
        $id_usuario_fk = 2; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertainformatica = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradainformatica = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertainformatica = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradainformatica = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertainformatica,
             'AM_cerrado' => $mejora_cerradainformatica,
             'AP_abierto' => $preventiva_abiertainformatica,
             'AP_cerrado' => $preventiva_cerradainformatica
         ];
 
         echo json_encode($data);
    }

                /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmOperaciones() 
    {
        $id_usuario_fk = 7; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasoperaciones = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasoperaciones = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionoperaciones = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesooperaciones = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidaoperaciones = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasoperaciones,
            'cerradas' => $cerradasoperaciones,
            'verificacion' => $verificacionoperaciones,
            'proceso' => $procesooperaciones,
            'vencida' => $vencidaoperaciones
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP ADMINISTRATIVA
    =============================================*/
    public static function graficaVerificacionAccionesOperaciones() 
    {
        $id_usuario_fk = 7; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertaoperaciones = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradaoperaciones = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertaoperaciones = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradaoperaciones = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertaoperaciones,
             'AM_cerrado' => $mejora_cerradaoperaciones,
             'AP_abierto' => $preventiva_abiertaoperaciones,
             'AP_cerrado' => $preventiva_cerradaoperaciones
         ];
 
         echo json_encode($data);
    }

                 /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmGerencia() 
    {
        $id_usuario_fk = 11; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasgerencia = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasgerencia = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificaciongerencia = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesogerencia = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidagerencia = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasgerencia,
            'cerradas' => $cerradasgerencia,
            'verificacion' => $verificaciongerencia,
            'proceso' => $procesogerencia,
            'vencida' => $vencidagerencia
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP ADMINISTRATIVA
    =============================================*/
    public static function graficaVerificacionAccionesGerencia() 
    {
        $id_usuario_fk = 11; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertagerencia = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradagerencia = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertagerencia = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradagerencia = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertagerencia,
             'AM_cerrado' => $mejora_cerradagerencia,
             'AP_abierto' => $preventiva_abiertagerencia,
             'AP_cerrado' => $preventiva_cerradagerencia
         ];
 
         echo json_encode($data);
    }


     /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmSeguridad() 
    {
        $id_usuario_fk = 59; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertasseguridad = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradasseguridad = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionseguridad = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesoseguridad = ModeloAcpm::contarAcpmProceso($id_usuario_fk);
        $vencidaseguridad = ModeloAcpm::contarAcpmAbiertaVencida($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertasseguridad,
            'cerradas' => $cerradasseguridad,
            'verificacion' => $verificacionseguridad,
            'proceso' => $procesoseguridad,
            'vencida' => $vencidaseguridad
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP ADMINISTRATIVA
    =============================================*/
    public static function graficaVerificacionAccionesSeguridad() 
    {
        $id_usuario_fk = 59; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertaseguridad = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradaseguridad = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertaseguridad = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradaseguridad = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertaseguridad,
             'AM_cerrado' => $mejora_cerradaseguridad,
             'AP_abierto' => $preventiva_abiertaseguridad,
             'AP_cerrado' => $preventiva_cerradaseguridad
         ];
 
         echo json_encode($data);
    }

     /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmGeneral() 
    {
        $tabla = "acpm"; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertas = ModeloAcpm::contarAcpmAbiertasGeneral($tabla);
        $cerradas = ModeloAcpm::contarAcpmCerradasGeneral($tabla);
        $verificacion = ModeloAcpm::contarAcpmVerificacionGeneral($tabla);
        $proceso = ModeloAcpm::contarAcpmProcesoGeneral($tabla);
        $vencida = ModeloAcpm::contarAcpmVencidaGeneral($tabla);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertas,
            'cerradas' => $cerradas,
            'verificacion' => $verificacion,
            'proceso' => $proceso,
            'vencida' => $vencida
        ];

        echo json_encode($data);
    }

           /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP ADMINISTRATIVA
    =============================================*/
    public static function graficaVerificacionAccionesGeneral() 
    {
        $tabla = "acpm"; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abierta = ModeloAcpm::contarAcpmMejoraAbiertaGeneral($tabla);
         $mejora_cerrada = ModeloAcpm::contarAcpmMejoraCerradaGeneral($tabla);
         $preventiva_abierta = ModeloAcpm::contarAcpmPreventivaAbiertaGeneral($tabla);
         $preventiva_cerrada = ModeloAcpm::contarAcpmPreventivaCerradaGeneral($tabla);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abierta,
             'AM_cerrado' => $mejora_cerrada,
             'AP_abierto' => $preventiva_abierta,
             'AP_cerrado' => $preventiva_cerrada
         ];
 
         echo json_encode($data);
    }

     /*=============================================
    OBETENER DATOS DE LA GRAFICA CON EL ID DEL USUARIO
    =============================================*/
    public static function graficaVerificacionAcpmUsuario() 
    {
        $id_usuario_fk = $_SESSION["id"]; // ID del usuario especificado

        // Obtener datos del modelo
        $abiertassig = ModeloAcpm::contarAcpmAbiertas($id_usuario_fk);
        $cerradassig = ModeloAcpm::contarAcpmCerradas($id_usuario_fk);
        $verificacionsig = ModeloAcpm::contarAcpmVerificacion($id_usuario_fk);
        $procesosig = ModeloAcpm::contarAcpmProceso($id_usuario_fk);

        // Preparar datos para la vista
        $data = [
            'abiertas' => $abiertassig,
            'cerradas' => $cerradassig,
            'verificacion' => $verificacionsig,
            'proceso' => $procesosig
        ];

        echo json_encode($data);
    }

    /*=============================================
   OBTENER LOS DATOS DE LAS ACPM AM Y AP SIG
    =============================================*/
    public static function graficaVerificacionAccionesUsuario() 
    {
        $id_usuario_fk = $_SESSION["id"]; // ID del usuario especificado

         // Obtener datos del modelo
         $mejora_abiertasig = ModeloAcpm::contarAcpmMejoraAbierta($id_usuario_fk);
         $mejora_cerradasig = ModeloAcpm::contarAcpmMejoraCerrada($id_usuario_fk);
         $preventiva_abiertasig = ModeloAcpm::contarAcpmPreventivaAbierta($id_usuario_fk);
         $preventiva_cerradasig = ModeloAcpm::contarAcpmPreventivaCerrada($id_usuario_fk);
 
         // Preparar datos para la vista
         $data = [
             'AM_abierto' => $mejora_abiertasig,
             'AM_cerrado' => $mejora_cerradasig,
             'AP_abierto' => $preventiva_abiertasig,
             'AP_cerrado' => $preventiva_cerradasig
         ];
 
         echo json_encode($data);
    }

     /*=============================================
            TOTAL DE ACPM PARA EL USUARIO LOGUEADO
    =============================================*/
    public static function ctrContarACPMs($idUsuario) {
        return ModeloACPM::mdlContarACPMs($idUsuario);
    }

    /*=============================================
    TOTAL DE ACPM ABIERTAS PARA EL USUARIO LOGUEADO
    =============================================*/

    public static function ctrContarACPMsAbiertas($idUsuario) {
        return ModeloACPM::mdlContarACPMsAbiertas($idUsuario);
    }

      /*=============================================
    TOTAL DE ACPM ABIERTAS VENCIDAS PARA EL USUARIO LOGUEADO
    =============================================*/

    public static function ctrContarACPMsAbiertaVencida($idUsuario) {
        return ModeloACPM::mdlContarACPMsAbiertaVencida($idUsuario);
    }

    /*=============================================
    TOTAL DE ACPM EN PROCESO PARA EL USUARIO LOGUEADO
    =============================================*/
    public static function ctrContarACPMsProceso($idUsuario) {
        return ModeloACPM::mdlContarACPMsProceso($idUsuario);
    }

    /*=============================================
    TOTAL DE ACPM CERRADAS PARA EL USUARIO LOGUEADO
    =============================================*/
    public static function ctrContarACPMsCerrada($idUsuario) {
        return ModeloACPM::mdlContarACPMsCerrada($idUsuario);
    }

    /*=============================================
    TOTAL DE ACPM VERIFICADAS PARA EL USUARIO LOGUEADO
    =============================================*/
    public static function ctrContarACPMsVerificacion($idUsuario) {
        return ModeloACPM::mdlContarACPMsVerificacion($idUsuario);
    }

    /*=============================================
    TOTAL DE ACPM MEJORA RECHAZADAS PARA EL USUARIO LOGUEADO
    =============================================*/
    public static function ctrContarACPMsRechazada($idUsuario) {
        return ModeloACPM::mdlContarACPMsRechazada($idUsuario);
    }

        /*=============================================
	MOSTRAR ACTIVIDADES VENCIDAS
	=============================================*/

    static public function ctrMostrarActividadesVencidas($item, $valor, $consulta)
    {
        $tabla = "actividades_acpm";

        $respuesta = ModeloAcpm::mdlMostrarActividadesVencidas($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

}


/*=============================================
               USUARIOS
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmUsuario') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmUsuario();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesUsuario') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesUsuario();
}
/*=============================================
               GENERAL
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmGeneral') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmGeneral();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesGeneral') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesGeneral();
}

/*=============================================
                TECNICO
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpm') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpm();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcciones') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcciones();
}

/*=============================================
                SIG
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmSig') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmSig();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesSig') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesSig();
}

/*=============================================
              GESTION ADMINISTRATIVA
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmAdministrativa') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmAdministrativa();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesAdministrativa') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesAdministrativa();
}

/*=============================================
                GESTION CONTABLE
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmContable') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmContable();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesContable') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesContable();
}

/*=============================================
                GESTION JURIDICA
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmJuridica') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmJuridica();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesJuridica') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesJuridica();
}

/*=============================================
                GESTION DE TECNOLOGIA INFORMATICA
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmInformatica') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmInformatica();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesInformatica') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesInformatica();
}


/*=============================================
                OPERACIONES
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmOperaciones') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmOperaciones();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesOperaciones') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesOperaciones();
}


/*=============================================
                GERENCIA
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmGerencia') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmGerencia();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesGerencia') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesGerencia();
}


/*=============================================
                SEGURIDAD
    =============================================*/

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAcpmSeguridad') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAcpmSeguridad();
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionAccionesSeguridad') {
    require_once '../modelos/acpm.modelo.php';
    $controlador = new ControladorAcpm();
    $controlador->graficaVerificacionAccionesSeguridad();
}

