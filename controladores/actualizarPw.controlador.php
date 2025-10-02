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
            $todosInsertados = true; // Indicador de éxito

            for ($i = 0; $i < count($nombre_app); $i++) {
                // Validar que todos los campos existan
                if (!empty($nombre_app[$i]) && !empty($nombre_usuario[$i]) && !empty($pw_app[$i])) {
                    
                    $app = htmlspecialchars($nombre_app[$i]);
                    $usuario = htmlspecialchars($nombre_usuario[$i]);

                    /* ===============================
                       ENCRIPTACIÓN REVERSIBLE CON AES
                    ================================== */
                    $password = openssl_encrypt($pw_app[$i], "AES-128-ECB", ENCRYPTION_KEY);

                    // Datos para la tabla de aplicaciones
                    $datos_app = array(
                        "id_pw_fk" => $respuesta, // ID del detalle
                        "nombre_app" => $app,
                        "usuario_app" => $usuario,
                        "pw_app" => $password
                    );

                    $tabla_pw = "actualizacion_pw";

                    // Llamada al modelo para insertar cada aplicación
                    $respuestaApp = ModeloPw::mdlCambioPw($tabla_pw, $datos_app);

                    if ($respuestaApp === "error" || !is_numeric($respuestaApp)) {
                        $todosInsertados = false;
                        break;
                    }
                } else {
                    $todosInsertados = false;
                    break;
                }
            }

            // Redirige después de la inserción
            if ($todosInsertados) {
                echo '<script>
                    Swal.fire(
                        "Buen Trabajo! Se registró cambio de contraseñas ' . $respuesta . '",
                        "El formulario se ha registrado con éxito.",
                        "success"
                    ).then(function() {
                        document.getElementById("dynamicForm").reset();
                        $("#ActualizarPw").removeClass("active");
                        $("#ConsultarPw").addClass("active");
                        window.open("extensiones/tcpdf/pdf/formato_pw.php?codigo=' . $respuesta . '", "_blank");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error en el registro!",
                        text: "Algunos datos están vacíos o no se pudieron guardar correctamente.",
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            document.getElementById("dynamicForm").reset();
                            $("#ConsultarPw").removeClass("active");
                            $("#ActualizarPw").addClass("active");
                        }
                    });
                </script>';
            }
        } else {
            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "¡Error en la base de datos!",
                    text: "No se pudo crear el registro principal.",
                    confirmButtonText: "Cerrar"
                }).then(function(result){
                    if(result.value){
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
	MOSTRAR TABLA DETALLE POR USUARIO
	=============================================*/
    static public function ctrMostrarPwGeneral($valor)
    {
        $tabla = "detalle_pw"; // Definir el nombre de la tabla

        // Llamar al modelo y pasar los parámetros
        $respuesta = ModeloPw::mdlMostrarPwGeneral($tabla,$valor);

        return $respuesta; // Devolver la respuesta del modelo
    }

        /*=============================================
	MOSTRAR TABLA DETALLE 
	=============================================*/
    static public function ctrMostrarPwIndividual($item, $valor)
    {
        $tabla = "detalle_pw";


        $respuesta = ModeloPw::mdlMostrarPwIndividual($tabla, $item, $valor);

        return $respuesta;
    }

       /*=============================================
    VERIFICAR CONTRASEÑA
    =============================================*/
    public function ctrVerificarPw()
    {
        if (isset($_POST["estado_pw"])) {
            $id_detalle_pw = $_POST["id_detalle_pw"];
            $estado_pw = $_POST["estado_pw"];
            $observaciones_pw = $_POST["observaciones_pw"];
            $id_usuario_ti = $_SESSION["id"];
            $tabla = "detalle_pw";
            $datos = array(
                "id_detalle_pw" => $id_detalle_pw,
                "estado_pw" => $estado_pw,
                "observaciones_pw" => $observaciones_pw,
                "id_usuario_ti" => $id_usuario_ti
            );
            $respuesta = ModeloPw::mdlVerificarPw($tabla, $datos);
            if ($respuesta === "ok") {
                echo '<script>
                    Swal.fire(
                        "Buen Trabajo!",
                        "La verificación de la contraseña se realizó con éxito.",
                        "success"
                    ).then(function() {
                        // Limpiar el formulario
                        $("#formVerificarPw")[0].reset(); // Resetea el formulario
                        $("#modalVerificarPw").modal("hide"); // Cierra el modal
                        window.location = "ti"; // Redirige a la página de TI
                        $("#panelti").addClass("active");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        "Error",
                        "Hubo un problema al verificar la contraseña.",
                        "error"
                    ).then(function() {
                        $("#panelti").addClass("active");
                    });
                </script>';
            }
        }
    }
}
