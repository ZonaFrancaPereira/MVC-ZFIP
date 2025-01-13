<?php

class ControladorInspeccion
{

/*=============================================
CONTROLADOR DE INSPECCIÓN 
=============================================*/
public static function ctrGuardarInspeccion() {
    if (isset($_POST["id_cliente_fk"])) {	
        $img = $_POST['base64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = uniqid() . '.png';
        file_put_contents("vistas/img/usuarios/firmas_inspeccion/" . $fileName, $fileData);
        $ruta="vistas/img/usuarios/firmas_inspeccion/".$fileName;
        // Asegurarse de que cada checkbox tenga un valor por defecto de 0 si no está marcado
        $datos = [
            "id_cliente_fk" => $_POST["id_cliente_fk"],
            "ingreso_salida" => $_POST["ingreso_salida"],
            "id_categoriaop_fk" => $_POST["id_categoriaop_fk"],
            "otro" => $_POST["otro"],  
            "transito" => $_POST["transito"],
            "fmm" => $_POST["fmm"],
            "arin" => $_POST["arin"],
            "documento" => $_POST["documento"],
            "fisico" => $_POST["fisico"],
            "estado" => $_POST["estado"],
            "descripcion_observaciones" => $_POST["descripcion_observaciones"],
            "nombre_firma" => $_POST["nombre_firma"],
            "cc_firma" => $_POST["cc_firma"],
            "firma_recibido"=>$ruta,
            "id_usuario_fk" => $_SESSION["id"]

        ];

        // Llamar al modelo para realizar el insert
        $respuesta = ModeloInspeccion::mdlGuardarInspeccion($datos);

        if ($respuesta == "ok") {
            echo '<script>
                Swal.fire(
                "Buen Trabajo!",
                "La inspección se ha registrado con éxito.",
                "success"
                ).then(function() {
                    document.getElementById("GuardarInspeccion").reset();
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "¡Error al registrar la inspección!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
        }
    }
}
	/*=============================================
	MOSTRAR CATEGORIAS INSPECCCION 
	=============================================*/

	static public function ctrMostrarCategoriasOp($item, $valor)
	{

		$tabla = "categoria_op";

		$respuesta = ModeloInspeccion::mdlMostrarCategoriaOp($tabla, $item, $valor);

		return $respuesta;
	}

    	/*=============================================
	MOSTRAR  INSPECCCION 
	=============================================*/

	static public function ctrMostrarInspeccion($item, $valor)
	{

		$tabla = "inspeccion_op";

		$respuesta = ModeloInspeccion::mdlMostrarInspeccion($tabla, $item, $valor);

		return $respuesta;
	}
	
}
