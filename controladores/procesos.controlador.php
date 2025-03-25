<?php

class ControladorProcesos
{
    /*=============================================
    OBTENER TODOS LOS PROCESOS
    =============================================*/
    static public function ctrMostrarProcesos()
    {
        $tabla = "proceso";
        $respuesta = ModeloProcesos::mdlMostrarProcesos($tabla);
        return $respuesta;
    }

    /*=============================================
    AGREGAR PROCESO
    =============================================*/
    static public function ctrAgregarProceso()
    {
        if (isset($_POST["nombreProceso"]) && isset($_POST["descripcionProceso"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombreProceso"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["descripcionProceso"])
            ) {
                $tabla = "proceso";

                $datos = array(
                    "nombre" => $_POST["nombreProceso"],
                    "descripcion" => $_POST["descripcionProceso"]
                );

                $respuesta = ModeloProcesos::mdlAgregarProceso($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El proceso ha sido guardado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "procesos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡El proceso no puede llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "procesos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    ACTUALIZAR PROCESO
    =============================================*/
    static public function ctrActualizarProceso()
    {
        if (isset($_POST["editarNombreProceso"]) && isset($_POST["editarDescripcionProceso"])) {

            if (
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreProceso"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ., ]+$/', $_POST["editarDescripcionProceso"])
            ) {
                $tabla = "proceso";

                $datos = array(
                    "id" => $_POST["idProceso"],
                    "nombre" => $_POST["editarNombreProceso"],
                    "descripcion" => $_POST["editarDescripcionProceso"]
                );

                $respuesta = ModeloProcesos::mdlActualizarProceso($tabla, $datos);

                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire({
                            icon: "success",
                            title: "¡El proceso ha sido actualizado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then((result) => {
                            if (result.value) {
                                window.location = "procesos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡El proceso no puede llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "procesos";
                        }
                    });
                </script>';
            }
        }
    }

    /*=============================================
    ELIMINAR PROCESO
    =============================================*/
    static public function ctrEliminarProceso()
    {
        if (isset($_POST["idProcesoEliminar"])) {
            $tabla = "proceso";
            $id = $_POST["idProcesoEliminar"];

            $respuesta = ModeloProcesos::mdlEliminarProceso($tabla, $id);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire({
                        icon: "success",
                        title: "¡El proceso ha sido eliminado correctamente!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then((result) => {
                        if (result.value) {
                            window.location = "procesos";
                        }
                    });
                </script>';
            }
        }
    }
}