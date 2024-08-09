<?php


class ControladorAcpm
{

    static public function ctrCrearAcpm() {

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
                    Swal.fire(
                    "Buen Trabajo!",
                    "El ACPM fue creado con éxito.",
                    "success"
                    ).then(function() {
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
}
