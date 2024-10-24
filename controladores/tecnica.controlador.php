<?php


class ControladorSoporteTecnico
{
    static public function ctrCrearSoporteTecnico()
    {
        if (isset($_POST["descripcion_soporte_tecnico"])) {

            $tabla = "soporte_tecnico";

            $datos = array(
                "id_usuario_fk1" => $_SESSION['id'],
                "correo_soporte" => $_POST["correo_soporte"],  // Nuevo campo
                "descripcion_soporte_tecnico" => $_POST["descripcion_soporte_tecnico"],  // Corregido para que coincida
                "proceso_fk1" => $_POST["proceso_fk1"]  // Campo corregido
            );

            $respuesta = ModeloSoporteTecnico::mdlIngresarSoporteTecnico($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "Buen Trabajo!",
                    text: "Se ha dado respuesta a La solicitud con éxito.",
                    icon: "success"
                }).then(function() {
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "solicitudes_tecnica",
                        id_consulta: "' . $_POST["id_soporte_tecnico"] . '",
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
    
                    document.getElementById("").reset();
                    $("#").addClass("active");
                });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡No se pudo guardar la respuesta de la Solicitud!",
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

    /*=============================================
	MOSTRAR SOPORTE
	=============================================*/

    static public function ctrMostrarSoporteTecnico($item, $valor, $consulta)
    {
        $tabla = "soporte_tecnico";

        $respuesta = ModeloSoporteTecnico::mdlMostrarSoporteTecnico($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

    /*=============================================
	ASIGNAR URGENCIA SOPORTE
	=============================================*/

    static public function ctrResponderSolicitudTecnico()
    {
        if (isset($_POST["id_soporte_tecnico"])) {
            $tabla = "soporte_tecnico";
            $datos = array(
                "id_soporte_tecnico" =>  $_POST["id_soporte_tecnico"],
                "solucion_soporte_tecnico" =>  $_POST["solucion_soporte_tecnico"],
                "fecha_solucion_soporte" =>  $_POST["fecha_solucion_soporte"],
                "usuario_respuesta" =>  $_POST["usuario_respuesta"],
            );

            $respuesta = ModeloSoporteTecnico::mdlResponderSolicitudTecnico($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                    "Buen Trabajo!",
                    "La solicitud ha sido registrada con éxito.",
                    "success"
                    ).then(function() {
                    document.getElementById("soporte_tecnico").reset();
                    $("#solicitudes_soporte").addClass("active");
                    });
                </script>
            ';
            } else {
                echo '<script>
                Swal.fire({
                    type: "error",
                    title: "¡La descripción no puede ir vacía o llevar caracteres especiales!",
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
}
