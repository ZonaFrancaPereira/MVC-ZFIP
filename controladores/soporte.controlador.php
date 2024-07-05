<?php
class ControladorSoporte {

     static public function ctrCrearSoporte() {

        if (isset($_POST["descripcion_soporte"])) {
            //...
            $tabla = "soporte";
            $datos = array(
                "id_usuario_fk" => $_SESSION['id'],
                "descripcion_soporte" => $_POST["descripcion_soporte"]
            );

            $respuesta = ModeloSoporte::mdlIngresarSoporte($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "El soporte ha sido registrado con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("soporte_ti").reset();
                        $("#principal_soporte").addClass("active");
                        
                        });
                    </script>
                ';
            }else {
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
}
?>
