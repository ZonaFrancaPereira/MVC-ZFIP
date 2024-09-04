<?php

class ControladorPw
{

    /*=============================================
	REGISTRO DE CONSTRASEÑAS
	=============================================*/
    static public function ctrCrearPw()
    {
// Verifica si el formulario ha sido enviado
if (isset($_POST['form_submitted']) && $_POST['form_submitted'] === 'true') {
    // Datos dinámicos
    $nombre_app = isset($_POST['nombre_app']) ? $_POST['nombre_app'] : [];
    $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : [];
    $pw_app = isset($_POST['pw_app']) ? $_POST['pw_app'] : [];

    $tabla = "detalle_pw";
    $datos = array(
        "estado_pw" => "Proceso",
        "id_usuario_fk" => $_SESSION["id"]
    );

    // Inserta el detalle en la tabla 'detalle_pw'
    $respuesta = ModeloPw::mdlDetallePw($tabla, $datos);

    // Verifica si se ha insertado correctamente y se ha obtenido un ID
    if (is_numeric($respuesta)) {
        // Recorrer y procesar los datos dinámicos
        $todosInsertados = true; // Indicador de éxito
        for ($i = 0; $i < count($nombre_app); $i++) {
            // Verifica si los datos están definidos y no están vacíos
            if (isset($nombre_app[$i]) && isset($nombre_usuario[$i]) && isset($pw_app[$i])) {
                $app = htmlspecialchars($nombre_app[$i]);
                $usuario = htmlspecialchars($nombre_usuario[$i]);
                $password = md5($pw_app[$i]);

                // Datos para la tabla de aplicaciones
                $datos_app = array(
                    "id_pw_fk" => $respuesta, // Asocia el ID del detalle insertado
                    "nombre_app" => $app,
                    "usuario_app" => $usuario,
                    "pw_app" => $password
                );
                $tabla_pw = "actualizacion_pw";

                // Llamada al modelo para insertar cada aplicación
                $respuestaApp = ModeloPw::mdlCambioPw($tabla_pw, $datos_app);

                // Verifica si hubo un error en la inserción
                if ($respuestaApp === "error" || !is_numeric($respuestaApp)) {
                    // Maneja el error, puedes enviar un mensaje o registrar el error en logs
                    $todosInsertados = false; // Marcamos como fallo
                    break;
                }
            } else {
                // Maneja el caso en que algún dato esté vacío o no definido
                $todosInsertados = false; // Marcamos como fallo
                break;
            }
        }

        // Redirige después de la inserción
        if ($todosInsertados) {
            // Redirige a la misma página o a otra página de éxito
            echo '<script>
                Swal.fire(
                    "Buen Trabajo! Se registró cambio de contraseñas ' . $respuesta . '",
                    "El formulario se ha registrado con éxito.",
                    "success"
                ).then(function() {
                    // Limpiar el formulario
                    document.getElementById("dynamicForm").reset();
                    $("#ActualizarPw").removeClass("active");
                    $("#ConsultarPw").addClass("active");
                    window.open("extensiones/tcpdf/pdf/formato_pw.php?codigo='.$respuesta. '", "_blank");
                });
            </script>';
        } else {
            // Redirige a una página de error o muestra un mensaje de error
            echo '<script>
						Swal.fire({
							type: "error",
							title: "¡La descripción del perfil no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
							//Limpiar el formulario
                            document.getElementById("dynamicForm").reset();
                    $("#ConsultarPw").removeClass("active");
                    $("#ActualizarPw").addClass("active");
							}
						});
					</script>';
        }
    } else {
        // Redirige a una página de error o muestra un mensaje de error
        echo '<script>
						Swal.fire({
							type: "error",
							title: "¡La descripción del perfil no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
							//Limpiar el formulario
                            document.getElementById("dynamicForm").reset();
                    $("#ConsultarPw").removeClass("active");
                    $("#ActualizarPw").addClass("active");
							}
						});
					</script>';
    }
}
    }
    /*=============================================
	MOSTRAR TABLA DETALLE 
	=============================================*/
    static public function ctrMostrarPwIndividual($item, $valor)
    {
        $tabla = "detalle_pw";
       

        $respuesta = ModeloPw::mdlMostrarPwIndividual($tabla,$item, $valor);

        return $respuesta;
    }
}
