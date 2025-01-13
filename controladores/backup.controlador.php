<?php


class ControladorBackup
{

      /*=============================================
	MOSTRAR Usuario
	=============================================*/

    static public function ctrMostrarBackup($item, $valor, $consulta)
    {
        $tabla = "usuarios";

        $respuesta = ModeloBackup::mdlMostrarBackup($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

    /*=============================================
	ASIGNAR RUTA DE BACKUP
	=============================================*/

    static public function ctrAsignarRuta()
    {
        if (isset($_POST["carpeta_backup"])) {
            $tabla = "copias_seguridad";
            
            // Aquí agregamos el campo 'verificado' con el valor 'No verificado'
            $datos = array(
                "id_usuario_backup_fk" => $_POST["id_usuario_backup_fk"],
                "carpeta_backup" => $_POST["carpeta_backup"],
                "verificado" => "No verificado"  // Campo agregado con valor 'No verificado'
            );
    
            $respuesta = ModeloBackup::mdlAsignarRuta($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "La carpeta ha sido ingresada con exito.",
                        "success"
                        ).then(function() {
                        document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La Respuesta no pudo ser guardada!",
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
	VERIFICAR COPIA DE SEGURIDAD
	=============================================*/
    static public function ctrVerificarCopia()
    {
        if (isset($_POST["fecha_verificacion"])) {
            $tabla = "copias_seguridad";
            $datos = array(
                "id_usuario_backup_fk" => $_POST["id_usuario_copia"], 
                "carpeta_backup" => $_POST["carpeta_copia"],
                "fecha_verificacion" => $_POST["fecha_verificacion"],
                "verificado" => $_POST["verificado"],
                "observaciones_copia" => $_POST["observaciones_copia"]
            );
    
            $respuesta = ModeloBackup::mdlVerificarCopia($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                        "Buen Trabajo!",
                        "Se realizó la Verificación de la Copia de Seguridad.",
                        "success"
                    ).then(function() {
                        document.getElementById("").reset();  // Resetea el formulario
                        $("#").modal("hide");  // Oculta el modal si es necesario
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La Respuesta no pudo ser guardada!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").modal("hide");  // Oculta el modal si es necesario
                        }
                    });
                </script>';
            }
        }
    }
    
 
}