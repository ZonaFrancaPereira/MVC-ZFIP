<?php


class ControladorCodificar
{


    /*=============================================
	INGRESAR SOLICITUD DE CODIFICACION
	=============================================*/

    static public function ctrIngresarCodificacion()
    {

        if (isset($_POST["vigencia"])) {
            //... // Capturamos el ID del usuario desde el formulario
        
            $tabla = "solicitud_codificacion";
            $datos = array(

                "vigencia" => $_POST["vigencia"],
                "fecha_solicitud_cod" => $_POST["fecha_solicitud_cod"],
                "usuario_solicitud_cod" => $_POST["usuario_solicitud_cod"],
                "cargo_solicitud_cod" => $_POST["cargo_solicitud_cod"],
                "nombre_documento" => $_POST["nombre_documento"],
                "codigo" => $_POST["codigo"],
                "descripcion_cambio" => $_POST["descripcion_cambio"],
                "link_formato_codificacion" => $_POST["link_formato_codificacion"],
                "elabora_nombre" => $_POST["elabora_nombre"],
                "elabora_correo" => $_POST["elabora_correo"],
                "revisa_nombre" => $_POST["revisa_nombre"],
                "revisa_correo" => $_POST["revisa_correo"],
                "aprueba_nombre" => $_POST["aprueba_nombre"],
                "aprueba_correo" => $_POST["aprueba_correo"],
                "codigo_doc_afectado" => $_POST["codigo_doc_afectado"],
                "nombre_doc_afectado" => $_POST["nombre_doc_afectado"],
                "afecta" => $_POST["afecta"],
                "todos_colaboradores" => isset($_POST["todos_colaboradores"]) ? $_POST["todos_colaboradores"] : "No",
                "solo_lider" => isset($_POST["solo_lider"]) ? $_POST["solo_lider"] : "No",
                "miembros_proceso" => isset($_POST["miembros_proceso"]) ? $_POST["miembros_proceso"] : "No",
                "nombre_proceso_cod" => $_POST["nombre_proceso_cod"],
                "colaborador_expecifico" => isset($_POST["colaborador_expecifico"]) ? $_POST["colaborador_expecifico"] : "No",
                "nombre_interna" => $_POST["nombre_interna"],
                "correo_interna" => $_POST["correo_interna"],
                "nombre_externa" => $_POST["nombre_externa"],
                "correo_externa" => $_POST["correo_externa"],
                "enviar_copia" => isset($_POST["enviar_copia"]) ? $_POST["enviar_copia"] : "No"
            );

            $respuesta = ModeloCodificar::mdlIngresarCodificacion($tabla, $datos);

            if (is_array($respuesta) && $respuesta["status"] === "ok") {
                // Usar el último ID insertado
                $id_codificacion_fk = $respuesta["id_codificacion_fk"];

                $datosCodificar = array(
                    "codigo_doc_afectado" => $_POST["codigo_doc_afectado"],
                    "nombre_doc_afectado" => $_POST["nombre_doc_afectado"],
                    "afecta" => $_POST["afecta"],
                    "nombre_interna" => $_POST["nombre_interna"],
                    "correo_interna" => $_POST["correo_interna"],
                    "nombre_externa" => $_POST["nombre_externa"],
                    "correo_externa" => $_POST["correo_externa"],
                    "id_codificacion_fk" => $id_codificacion_fk,
                );

                $respuestaActividad = ModeloCodificar::mdlIngresarCorreos($datosCodificar);

                if ($respuestaActividad === "ok") {
                    echo "";
                } else {
                    echo "Error al insertar los datos.";
                }

                echo '<script>
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    title: "OJO!",
                    text: "Tu solicitud de Codificacion su enviada satisfactoriamente en poco recibiras respuesta.",
                    icon: "success"
                }).then(function() {
                    // Enviar datos por AJAX después de cerrar la alerta
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "codificacion",
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
                document.getElementById("codificar").reset();
                $("#codificacion").addClass("active");
                });
              </script>
            ';
            } else {
                echo '<script>
                Swal.fire({
                    type: "error",
                    title: "¡No se pudo guardar la solicitud",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                }).then(function(result){
                    if(result.value){
                        $("#solicitudes_soporte ").addClass("active");
                        
                    }
                });
            </script>
        ';
            }
        }
    }

    /*=============================================
	MOSTRAR SOLICITUDES REALIZADAS
	=============================================*/

    static public function ctrMostrarCodificacion($item, $valor, $consulta)
    {
        $tabla = "solicitud_codificacion";

        $respuesta = ModeloCodificar::mdlMostrarCodificacion($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

    /*=============================================
        INGRESAR RESPUESTA A LA CODIFICACION
        =============================================*/

    static public function ctrIngresarRespuestaCodificacion()
    {

        if (isset($_POST["id_codificar"])) {
            //...
            $tabla = "solicitud_codificacion";
            $datos = array(
                "id_codificar" => $_POST["id_codificar"],
                "estado_sig_codificacion" => $_POST["estado_sig_codificacion"],
                "fecha_sig_codificacion" => $_POST["fecha_sig_codificacion"],
                "responsable_sig_codificacion" => $_POST["responsable_sig_codificacion"],
                "causa_rechazo_codificacion" => $_POST["causa_rechazo_codificacion"],
                "evidencia_difucion" => $_POST["evidencia_difucion"]

            );

            $respuesta = ModeloCodificar::mdlIngresarRespuestaCodificacion($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "La urgencia ha sido registrada con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("").reset();
                        $("#").addClass("active");
                        
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La descrición del perfil no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>
            ';
            }
        }
    }

   /*=============================================
        CONSULTAR VERSION DE DOCUMENTOS CODIFICADOS
    =============================================*/
    
    static public function ctrMostrarVersionDocumentos($item, $valor)
    {
        $tabla = "version_documentos";

        $respuesta = ModeloCodificar::mdlMostrarVersionDocumentos($tabla, $item, $valor);

        return $respuesta;
    }
    
}
