<?php


class ControladorSoporteJuridico
{

    static public function ctrCrearSoporteJuridico()
    {
        if (isset($_POST["descripcion_solicitud_juridico"])) {

            $tabla = "soporte_juridico";

            $datos = array(

                "nombre_solicitante" => $_POST["nombre_solicitante"],
                "correo_solicitante" => $_POST["correo_solicitante"],
                "id_cargo_fk1" => $_POST["id_cargo_fk1"],    
                "id_proceso_fk1" => $_POST["id_proceso_fk1"], 
                "elaboracion_contrato" => $_POST["elaboracion_contrato"], 
                "formulacion_conceptos" => $_POST["formulacion_conceptos"], 
                "respuesta_requerimientos" => $_POST["respuesta_requerimientos"], 
                "descripcion_solicitud_juridico" => $_POST["descripcion_solicitud_juridico"],  // Corregido para que coincida
                "observaciones" => $_POST["observaciones"],
                "firma_solicitante" => $_POST["firma_solicitante"],
                "estado_legal" => $_POST["estado_legal"]
            );
            

            $respuesta = ModeloSoporteJuridico::mdlIngresarSoporteJuridico($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "Buen Trabajo!",
                    text: "Se ha dado respuesta a La solicitud con éxito.",
                    icon: "success"
                }).then(function() {
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "soporte_juridico",
                        id_consulta: "' . $_POST["id_soporte_juridico"] . '",
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
	MOSTRAR SOPORTE JURIDICO
	=============================================*/

    static public function ctrMostrarSoporteJuridico($item, $valor, $consulta)
    {
        $tabla = "soporte_juridico";

        $respuesta = ModeloSoporteJuridico::mdlMostrarSoporteJuridico($tabla, $item, $valor, $consulta);

        return $respuesta;
    }

      /*=============================================
	RESPONDER SOLICITUD
	=============================================*/

    static public function ctrResponderSolicitudJuridico()
    {
        if (isset($_POST["id_soporte_juridico"])) {
            $tabla = "soporte_juridico";
            $datos = array(
                "id_soporte_juridico" => $_POST["id_soporte_juridico"],
                "fecha_solucion_juridico" => $_POST["fecha_solucion_juridico"],
                "nombre_solucion" => $_POST["nombre_solucion"],
                "solucion_juridico" => $_POST["solucion_juridico"],
                "firma_juridica" => $_POST["firma_juridica"],
                "estado_legal" => $_POST["estado_legal_cerrado"]
            );
    
            $respuesta = ModeloSoporteJuridico::mdlResponderSolicitudJuridico($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                Swal.fire({
                    title: "Buen Trabajo!",
                    text: "Se ha dado respuesta a la solicitud con éxito.",
                    icon: "success"
                }).then(function() {
                    var datosCorreo = {
                        id_usuario_fk: "' . $_SESSION["id"] . '",
                        modulo: "solicitudes_juridico",
                        id_consulta: "' . $_POST["id_soporte_juridico"] . '",
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
                });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡No se pudo guardar la respuesta de la Solicitud!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
            }
        }
    }
    
        /*=============================================
	RESPONDER SOLICITUD
	=============================================*/

    static public function ctrAsignarEstadoJuridico()
    {
        if (isset($_POST["aceptar_solicitud"])) {
            $tabla = "soporte_juridico";
            $datos = array(
                "id_soporte_juridico" =>  $_POST["aceptar_solicitud"],  // Capturando el id correcto
                "estado_legal" =>  $_POST["estado_legal"]
            );

            $respuesta = ModeloSoporteJuridico::mdlAsignarEstadoJuridico($tabla, $datos);

            if ($respuesta == "ok") {

                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                    "El estado ha sido actualizado con éxito.",
                        "success"
                        ).then(function() {
                        document.getElementById("juri").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#aceptar_juridico").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡Hubo un problema al actualizar el estado!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"

                    }).then(function(result){
                        if(result.value){
                            $("# ").addClass("active");
                            
                        }
                    });
                </script>
            ';
            }
        }
    }

     /*=============================================
    MOSTRAR ELABORACION CONTRATO
    =============================================*/

    public static function ctrMostrarElaboracionContrato($item, $valor)
    {
        $tabla = "elaboracion_contrato";

        $respuesta = ModeloSoporteJuridico::mdlMostrarElaboracionContrato($tabla, $item, $valor);

        return $respuesta;
    }

        /*=============================================
    MOSTRAR FORMULACION DE CONCEPTOS
    =============================================*/

    public static function ctrMostrarFormulacionConceptos($item, $valor)
    {
        $tabla = "formulacion_conceptos";

        $respuesta = ModeloSoporteJuridico::mdlMostrarFormulacionConceptos($tabla, $item, $valor);

        return $respuesta;
    }
    

            /*=============================================
    MOSTRAR REQUERIMIENTOS
    =============================================*/

    public static function ctrMostrarRespuestaRequerimientos($item, $valor)
    {
        $tabla = "respuesta_requerimientos";

        $respuesta = ModeloSoporteJuridico::mdlMostrarRespuestaRequerimientos($tabla, $item, $valor);

        return $respuesta;
    }

    	/*=============================================
	MOSTRAR SOLICITUD GALAN
	=============================================*/

	public static  function ctrMostrarSolicitudLaboral($item, $valor)
	{

		$tabla = "soporte_juridico";

		$respuesta = ModeloSoporteJuridico::mdlMostrarSolicitudLaboral($tabla, $item, $valor);

		return $respuesta;
	}

        	/*=============================================
	MOSTRAR PROCESOS
	=============================================*/

	public static  function ctrMostrarProcesos($tablaProcesos, $itemProcesos, $valorProcesos)
	{

		$tablaProcesos = "proceso";

		$respuesta = ModeloSoporteJuridico::mdlMostrarProcesos($tablaProcesos, $itemProcesos, $valorProcesos);

		return $respuesta;
	}

    public static function ctrMostrarUsuarioPorId($idUsuario) {
        return ModeloSoporteJuridico::mdlMostrarUsuarioPorId($idUsuario);
    }
}
// Manejo directo de la solicitud AJAX en el controlador
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idUsuario"])) {
    require_once "../modelos/juridico.modelo.php"; // Asegurar que el modelo esté disponible
    $idUsuario = $_POST["idUsuario"];
    $respuesta = ControladorSoporteJuridico::ctrMostrarUsuarioPorId($idUsuario);
    echo json_encode($respuesta);
    exit; // Evita cualquier salida extra
}