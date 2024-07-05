<?php
class ControladorSoporte {

     static public function ctrCrearSoporte() {

        if (isset($_POST["correo_soporte"])) {
            //...
            $tabla = "soporte";
            $datos = array(
                "correo_soporte" => $_POST["correo_soporte"],
                "id_usuario_fk" => $_POST["id_usuario_fk"],
                "usuario_soporte" => $_POST["usuario_soporte"],
                "proceso_soporte" => $_POST["proceso_soporte"],
                "descripcion_soporte" => $_POST["descripcion_soporte"]
            );

            $respuesta = ModeloSoporte::mdlIngresarSoporte($tabla, $datos);

            if ($respuesta!= "ok") {
                echo '<script>
                    alert("Ha ocurrido un error al registrar el soporte: '. $respuesta. '");
                </script>';
            } else {
                echo '<script>
                    alert("El soporte ha sido registrado correctamente");
                </script>';
            }
        }
    }
}
?>
