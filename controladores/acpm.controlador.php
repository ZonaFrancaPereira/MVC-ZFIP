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
	MOSTRAR ACPM TECNICO
	=============================================*/

    static public function ctrMostrarAcpmTecnico($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmTecnico($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	MOSTRAR ACPM SIG
	=============================================*/

    static public function ctrMostrarAcpmSig($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmSig($tabla, $item, $valor);

        return $respuesta;
    }

     /*=============================================
	MOSTRAR ACPM ADMINISTRATIVA
	=============================================*/

    static public function ctrMostrarAcpmAdministrativa($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmAdministrativa($tabla, $item, $valor);

        return $respuesta;
    }

    
     /*=============================================
	MOSTRAR ACPM JURIDICA
	=============================================*/

    static public function ctrMostrarAcpmJuridica($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmJuridica($tabla, $item, $valor);

        return $respuesta;
    }

       /*=============================================
	MOSTRAR ACPM TECNOLOGIA
	=============================================*/

    static public function ctrMostrarAcpmTecnologia($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmTecnologia($tabla, $item, $valor);

        return $respuesta;
    }

           /*=============================================
	MOSTRAR ACPM CONTABLE
	=============================================*/

    static public function ctrMostrarAcpmContable($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmContable($tabla, $item, $valor);

        return $respuesta;
    }


           /*=============================================
	MOSTRAR ACPM OPERACIONES
	=============================================*/

    static public function ctrMostrarAcpmOperaciones($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmOperaciones($tabla, $item, $valor);

        return $respuesta;
    }


    /*=============================================
	MOSTRAR ACPM GERENCIA
	=============================================*/

    static public function ctrMostrarAcpmGerencia($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmGerencia($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	MOSTRAR ACPM SEGURIDAD
	=============================================*/

    static public function ctrMostrarAcpmSeguridad($item, $valor)
    {
        $tabla = "acpm";

        $respuesta = ModeloAcpm::mdlMostrarAcpmSeguridad($tabla, $item, $valor);

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
   OBTENER LOS DATOS DE LAS ACPM AM Y AP GENERAL
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


