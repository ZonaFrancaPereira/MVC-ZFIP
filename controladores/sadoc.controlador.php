<?php

class ControladorSadoc
{
	/*=============================================
	SUBIR ARCHIVO DEPENDIENDO CATEGORÍA
	=============================================*/
	static public function ctrCrearArchivo()
	{
		if (isset($_POST["subir"])) {
			// Verifica si hay errores en el archivo subido
			if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) {
				// Extraer los datos del archivo y las variables del formulario
				$codigo = $_POST["codigo"];
				$archivoTmp = $_FILES["archivo"]["tmp_name"];
				$nombreArchivo = basename($_FILES["archivo"]["name"]);
				$ruta_principal = "vistas/modulos/files/";
				$ruta = $ruta_principal . $nombreArchivo;
				$estado = "activo";
				$id_proceso_fk = $_POST["id_proceso_fk"];

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
						"estado" => $estado,
						"id_proceso_fk" => $id_proceso_fk
					);
					$respuesta = ModeloSadoc::mdlIngresarArchivo($tabla, $datos);

					if (is_array($respuesta)) {
						$ruta = $respuesta["ruta"];
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

	/**
	 * Asigna una o varias categorías a procesos seleccionados.
	 *
	 * Este método verifica si se ha enviado el formulario de asignación de procesos.
	 * Si se reciben procesos válidos, itera sobre cada uno y realiza la asignación
	 * en la base de datos utilizando el modelo correspondiente. Muestra mensajes
	 * de éxito o error mediante SweetAlert según el resultado de la operación.
	 *
	 * @static
	 * @return void
	 *
	 * Variables POST esperadas:
	 * - 'asignar-procesos': Indicador de envío del formulario.
	 * - 'categoria_detalle': ID de la categoría a asignar.
	 * - 'id_proceso_fk': Array de IDs de procesos a los que se asignará la categoría.
	 */
	static public function ctrAsignarCategorias()
	{
		if (isset($_POST["asignar-procesos"])) {

			$id_categoria = $_POST["categoria_detalle"];
			$procesos = $_POST["id_proceso_fk"];
			$estado_detalle = "Activo";
			$tabla = "categoria_sadoc_detalle";

			if (!is_array($procesos) || empty($procesos)) {
				echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "No se recibieron procesos para asignar.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
				return;
			}

			for ($i = 0; $i < count($procesos); $i++) {
				$datos = array(
					"id_categoria_fk" => $id_categoria,
					"id_proceso" => $procesos[$i],
					"estado_detalle" => $estado_detalle,
				);

				$respuesta = ModeloSadoc::mdlAsignarCategorias($tabla, $datos);

				if ($respuesta !== "ok") {
					echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Error al insertar el proceso: ' . htmlspecialchars($procesos[$i]) . '",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    });
                </script>';
					return;
				}
			}

			echo '<script>
            Swal.fire({
                icon: "success",
                title: "Procesos asignados correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            });
        </script>';
		}
	}
	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/

	static public function mostrarArchivosPorProceso($id_proceso_fk)
	{
		$respuesta = ModeloSadoc::mdlObtenerArchivosPorProceso($id_proceso_fk);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/
	static public function mostrarCategorias()
	{
		$tabla = "categoria_sadoc";
		$respuesta = ModeloSadoc::mdlObtenerCategorias($tabla);
		return $respuesta;
	}
	/*===================================================================
	DE AQUI EN ADELANTE SE MOSTRARAN FUNCIONES PARA EL CRUD DE CATEGORIAS
	=====================================================================*/
	/*=============================================
	CREAR CATEGORÍA
	=============================================*/
	static public function ctrCrearCategoria()
	{
		if (isset($_POST["guardar_categoria"])) {

			$nombre_categoria = $_POST["nuevaCategoria"];
			$descripcion_categoria = $_POST["descripcionCategoria"];
			$tabla = "categoria_sadoc";
			$datos = array(
				"nombre_categoria" => $nombre_categoria,
				"descripcion_categoria" => $descripcion_categoria,
				"estado_categoria" => "Activo"
			);

			$respuesta = ModeloSadoc::mdlIngresarCategoria($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
						Swal.fire(
							"Buen Trabajo!",
							"La categoría ha sido guardada correctamente.",
							"success"
						).then(function() {
							window.location = "sadoc";
						});
					</script>';
			} else {
				echo '<script>
						Swal.fire({
							icon: "error",
							title: "Oops...",
							text: "No se pudo guardar la categoría.",
							footer: "<a href=\'ti\'>Soporte TI</a>"
						});
					</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO
	=============================================*/
	static public function mostrarDetalleCategorias($id_proceso_fk)
	{
		$tabla = "categoria_sadoc_detalle";
		$respuesta = ModeloSadoc::mdlObtenerDetalleCategorias($tabla, $id_proceso_fk);
		return $respuesta;
	}

	/*=============================================
	MOSTRAR ARCHIVOS POR PROCESO Y CATEGORIA
	=============================================*/

	static public function mostrarArchivosPorCategoria($id_proceso_fk,$idCategoria)
	{
		$respuesta = ModeloSadoc::mdlObtenerArchivosPorCategoria($id_proceso_fk, $idCategoria);
		return $respuesta;
	}


}
