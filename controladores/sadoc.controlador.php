<?php

class ControladorSadoc
{

	static public function ctrCrearArchivo()
	{
		if (isset($_POST["subir"])) {
			// Verifica si hay errores en el archivo subido
			if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
				// Extraer los datos del archivo y las variables del formulario
				$codigo = $_POST["codigo"];
				$carpeta = $_POST["carpeta"];
				$archivoTmp = $_FILES["archivo"]["tmp_name"];
				$nombreArchivo = basename($_FILES["archivo"]["name"]);
				$ruta_principal = "vistas/modulos/files/" . $carpeta . "/";
				$ruta = $ruta_principal . $nombreArchivo;
				$estado = "activo";
				$id_proceso_fk = $_POST["id_proceso_fk"];
				$sub_carpeta = "No";
	
				// Asegúrate de que la carpeta de destino exista
				if (!is_dir($ruta_principal)) {
					mkdir($ruta_principal, 0777, true);
				}
	
				// Mover archivo al directorio de destino
				if (move_uploaded_file($archivoTmp, $ruta)) {
					echo "Archivo subido correctamente.";
	
					// Aquí va la lógica para guardar los datos en la base de datos
					$tabla = "sadoc";
					$datos = array(
						"codigo" => $codigo,
						"ruta" => $ruta,
						"ruta_principal" => $ruta_principal,
						"estado" => $estado,
						"sub_carpeta" => $sub_carpeta,
						"id_proceso_fk" => $id_proceso_fk
					);
					$respuesta = ModeloSadoc::mdlIngresarArchivo($tabla, $datos);
	
					if (is_array($respuesta)) {
						$ruta = $respuesta["ruta"];
						$ruta_principal = $respuesta["ruta_principal"];
						$nombreArchivo = basename($ruta);
	
						echo '<script>
							Swal.fire(
							"Buen Trabajo!",
							"El archivo ha sido registrado con éxito.",
							"success"
							).then(function() {
							
							document.querySelector(".FormArchivos").reset();
								$("#accesoRapido").addClass("active");
								// Abrir una nueva ventana con la vista previa del archivo
								window.open("vistas/modulos/sig/descarga_archivos.php?archivo=' . $nombreArchivo . '&ruta=' . $ruta . '", "_blank");
							});
						</script>';
					} else {
							echo '<script>
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "No funciono correctamente",
							footer: "<a href="ti">Soporte TI</a>"
						  });
						  </script>';
					}
				} else {
					//echo "Error al mover el archivo.";
				}
			} else {
				//echo "Error en la carga del archivo: " . $_FILES["archivo"]["error"];
			}
		}
	}
	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

	 static public function mostrarArchivosPorProceso($id_proceso_fk) {
        $respuesta = ModeloSadoc::mdlObtenerArchivosPorProceso($id_proceso_fk);

		return $respuesta;
    }
}

