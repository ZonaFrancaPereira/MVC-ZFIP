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
                    document.getElementById("acciones_verificacion").reset();
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
    APROBAR ACPM
    =============================================*/
    static public function ctrAprobarAcpm() {
        if (isset($_POST["id_consecutivo"]) && isset($_POST["estado_acpm"])) {
            $datos = array(
                "id_consecutivo" => $_POST["id_consecutivo"],
                "estado_acpm" => $_POST["estado_acpm"]
            );
            
            echo "Datos recibidos: ";
            print_r($datos);
            
            $resultado = ModeloAcpm::mdlAprobarAcpm($datos);
            
            if ($resultado) {
                echo 'ok'; // Devolver 'ok' como respuesta exitosa
            } else {
                echo 'error'; // Devolver 'error' como respuesta de error
            }
        }
    }
    
    
}
    


