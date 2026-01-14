<?php


class ControladorSoporte
{

    static public function ctrCrearSoporte()
    {
        if (isset($_POST["descripcion_soporte"])) {
            $idUsuario = $_SESSION['id']; // Valor por defecto
    
            // Si el usuario tiene cargo 1 o 2 y seleccionó un usuario en el select, usar ese valor
            if (isset($_SESSION["id_cargo_fk"]) && in_array($_SESSION["id_cargo_fk"], [1, 2]) && !empty($_POST["id_usuario_fk"])) {
                $idUsuario = $_POST["id_usuario_fk"];
            }
    
            $tabla = "soporte";
            $datos = array(
                "id_usuario_fk" => $idUsuario,
                "descripcion_soporte" => $_POST["descripcion_soporte"]
            );
    
            $respuesta = ModeloSoporte::mdlIngresarSoporte($tabla, $datos);
    
            if (is_numeric($respuesta)) {
                echo '<script>
                    Swal.fire({
                        title: "¡Buen Trabajo!",
                        text: "La solicitud número: ' . $respuesta . ' ha sido registrada con éxito.",
                        icon: "success"
                    }).then(function() {
                        var datosCorreo = {
                            id_usuario_fk: "' . $idUsuario . '",
                            modulo: "soporte",
                            id_consulta: "' . $respuesta . '",
                            destinatario: "ninguno"
                        };
            
                        // Enviar correo por AJAX
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
                    });
                </script>';
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

    static public function ctrMostrarSoporte($item, $valor)
    {
        $tabla = "soporte";

        $respuesta = ModeloSoporte::mdlMostrarSoporteUsuarios($tabla, $item, $valor);

        return $respuesta;
    }

        /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function ctrMostrarSoporteFinalizadasUsuario($item, $valor)
    {
        $tabla = "soporte";
        $idUsuariosoporte = $_SESSION['id'];

        $respuesta = ModeloSoporte::mdlMostrarSoporteFinalizadasUsuario($tabla, $idUsuariosoporte, $item, $valor);

        return $respuesta;
    }

            /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function ctrMostrarSoporteFinalizadas($item, $valor)
    {
        $tabla = "soporte";

        $respuesta = ModeloSoporte::mdlMostrarSoporteFinalizadas($tabla, $item, $valor);

        return $respuesta;
    }
            /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function ctrMostrarSoporteTi($item, $valor)
    {
        $tabla = "soporte";

        $respuesta = ModeloSoporte::mdlMostrarSoporteTi($tabla, $item, $valor);

        return $respuesta;
    }

    /*=============================================
	ASIGNAR URGENCIA SOPORTE
	=============================================*/

static public function ctrCrearUrgencia()
{
    if (isset($_POST["id_soporte"])) {

        $tabla = "soporte";

        $datos = array(
            "id_soporte" => $_POST["id_soporte"],
            "urgencia"   => $_POST["urgencia"]
        );

        $respuesta = ModeloSoporte::mdlIngresarUrgencia($tabla, $datos);

        if ($respuesta == "ok") {

            echo '<script>
                Swal.fire({
                    title: "¡Buen trabajo!",
                    text: "La urgencia ha sido registrada con éxito.",
                    icon: "success",
                    confirmButtonText: "OK"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = window.location.href;
                    }
                });
            </script>';

        } else {

            echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "La descripción no puede ir vacía ni contener caracteres especiales.",
                    confirmButtonText: "Cerrar"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $("#solicitudes_soporte").addClass("active");
                    }
                });
            </script>';
        }
    }
}


    /*=============================================
	ASIGNAR URGENCIA SOPORTE
	=============================================*/

    static public function ctrResponderSolicitud()
    {
        if (isset($_POST["id_soporte1"])) {
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
                    if (!sessionStorage.getItem("recargado")) {
                        Swal.fire({
                            title: "Buen Trabajo!",
                            text: "Se ha dado respuesta a la solicitud con éxito.",
                            icon: "success"
                        }).then(function() {
                            var datosCorreo = {
                                id_usuario_fk: "' . $_SESSION["id"] . '",
                                modulo: "solicitudes_soporte",
                                id_consulta: "' . $_POST["id_soporte1"] . '",
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
            
                            document.getElementById("soporte_ti").reset();
                            $("#solicitudes_soporte").addClass("active");
            
                            sessionStorage.setItem("recargado", "true"); // Marcar que ya se recargó
                            location.reload(); // Recargar la página
                        });
                    } else {
                        sessionStorage.removeItem("recargado"); // Eliminar la marca después de la recarga
                    }
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡No se pudo guardar la respuesta de la Solicitud!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#solicitudes_soporte").addClass("active");
                        }
                    });
                </script>';
            }
            
        }
    }

  // Simple proxy que devuelve conteo para YYYY-MM
    public static function ctrContarSoportesAtendidosPorMes($anoMes)
    {
        return ModeloSoporte::contarSoportesAtendidosPorMes($anoMes);
    }

    // Devuelve arreglo con los últimos N meses (ano_mes, atendidos)
    public static function ctrObtenerAtendidosUltimosMeses($ultimoNMeses = 12)
    {
        return ModeloSoporte::obtenerAtendidosUltimosMeses($ultimoNMeses);
    }

}
