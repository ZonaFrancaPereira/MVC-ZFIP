<?php


class ControladorCodificar{


static public function ctrIngresarCodificacion(){

    if (isset($_POST["vigencia"])) {
        //...
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
           "todos_colaboradores" => $_POST["todos_colaboradores"],
           "solo_lider"=> $_POST["solo_lider"],
           "miembros_proceso" => $_POST["miembros_proceso"],
           "nombre_proceso_cod" => $_POST["nombre_proceso_cod"],
           "colaborador_expecifico" => $_POST["colaborador_expecifico"],
           "nombre_interna" => $_POST["nombre_interna"],
           "correo_interna" => $_POST["correo_interna"],
           "nombre_externa" => $_POST["nombre_externa"],
           "correo_externa" => $_POST["correo_externa"],
           "enviar_copia" => $_POST["enviar_copia"]
        );

        $respuesta = ModeloCodificar::mdlIngresarCodificacion($tabla, $datos);

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






}

?>