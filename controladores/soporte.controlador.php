<?php


class ControladorSoporte
{


    static public function ctrCrearSoporte()
    {

        if (isset($_POST["descripcion_soporte"])) {
            //...
            $tabla = "soporte";
            $datos = array(
                "id_usuario_fk" => $_SESSION['id'],
                "descripcion_soporte" => $_POST["descripcion_soporte"]
            );

            $respuesta = ModeloSoporte::mdlIngresarSoporte($tabla, $datos);
            if (is_numeric($respuesta)) {
                // Llamar a la función EnviarCorreo con el id_usuario_fk

                

                echo '<script>
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    title: "Buen Trabajo!",
                    text: "La solicitud número: ' . $respuesta . ' ha sido registrada con éxito.",
                    icon: "success"
                }).then(function() {
                    // Enviar datos por AJAX después de cerrar la alerta
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "soporte",
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
                    document.getElementById("soporte_ti").reset();
                    $("#principal_soporte").addClass("active");
                });
              </script>';
        
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La discrición del perfil no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            $("#principal_soporte").addClass("active");
                            
                        }
                    });
                </script>
            ';
            }
        }
    }
    /*=============================================
	MOSTRAR SOLICITUDES FINALIZADAS
	=============================================*/
    public static function ctrMostrarSoporteConSolucion($item = null, $valor = null)
    {
        $tabla = "soporte";

        $sql = "SELECT * FROM $tabla WHERE fecha_solucion IS NOT NULL";

        if ($item !== null && $valor !== null) {
            $sql .= " AND $item = :valor";
        }

        $stmt = Conexion::conectar()->prepare($sql);

        if ($item !== null && $valor !== null) {
            $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function ctrMostrarSoporte($item, $valor, $consulta)
    {
        $tabla = "soporte";

        $respuesta = ModeloSoporte::mdlMostrarSoporte($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

    /*=============================================
	ASIGNAR URGENCIA SOPORTE
	=============================================*/

    static public function ctrCrearUrgencia()
    {

        if (isset($_POST["id_soporte"])) {
            //...
            $tabla = "soporte";
            $datos = array(
                "id_soporte" => $_POST["id_soporte"],
                "urgencia" => $_POST["urgencia"]
            );

            $respuesta = ModeloSoporte::mdlIngresarUrgencia($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "La urgencia ha sido registrada con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("soporte_ti").reset();
                        $("#solicitudes_soporte").addClass("active");
                        
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La discrición del perfil no puede ir vacío o llevar caracteres especiales!",
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
	ASIGNAR URGENCIA SOPORTE
	=============================================*/

    static public function ctrResponderSolicitud()
    {

        if (isset($_POST["id_soporte1"])) {
            //...
            $tabla = "soporte";
            $datos = array(
                "id_soporte1" =>  $_POST["id_soporte1"],
                "solucion_soporte" =>  $_POST["solucion_soporte"],
                "fecha_solucion" =>  $_POST["fecha_solucion"],
                "usuario_respuesta" =>  $_POST["usuario_respuesta"],
            );

            $respuesta = ModeloSoporte::mdlResponderSolicitud($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "Se ha dado Respuesta con Exito.",
                        "success"
                        ).then(function() {
                        document.getElementById("soporte_ti").reset();
                        $("#solicitudes_soporte").addClass("active");
                        
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡No se pudo guardar la respuesta d la Solicitud!",
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
}
