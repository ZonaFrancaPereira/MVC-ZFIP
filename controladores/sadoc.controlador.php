<?php

class ControladorSadoc
{


	/*=============================================
	SUBIR ARCHIVO DEPENDIENDO CATEGORÍA
	=============================================*/
	static public function ctrCrearArchivo(){
		function limpiarNombreArchivo($cadena){
			$cadena = preg_replace('/\.[^.]+$/', '', $cadena); // quitar la extensión
			$cadena = str_replace(
				['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
				['A', 'E', 'I', 'O', 'U', 'N', 'A', 'E', 'I', 'O', 'U', 'N'],
				$cadena
			);
			$cadena = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $cadena); // quitar símbolos raros
			$cadena = strtoupper(trim($cadena)); // convertir a MAYÚSCULAS
			return $cadena;
		}

		if (isset($_POST["codigo_sadoc"])) {

			$total = count($_POST["codigo_sadoc"]);
			$errores = [];

			for ($i = 0; $i < $total; $i++) {

				if (isset($_FILES["archivo_sadoc"]["tmp_name"][$i]) && !empty($_FILES["archivo_sadoc"]["tmp_name"][$i])) {

					$nombreArchivo = basename($_FILES["archivo_sadoc"]["name"][$i]);
					$nombreLimpio  = limpiarNombreArchivo($nombreArchivo);

					// Carpeta enviada desde el formulario
					$carpetaNombre = isset($_POST["carpeta"][$i]) ? $_POST["carpeta"][$i] : 'sin_nombre';
					$carpeta = "vistas/modulos/files/$carpetaNombre/";

					if (!file_exists($carpeta)) {
						mkdir($carpeta, 0777, true);
					}

					// Crear nombre único
					$nombreUnico = date("Ymd_His") . "_" . $nombreLimpio . "." . pathinfo($nombreArchivo, PATHINFO_EXTENSION);
					$rutaArchivo = $carpeta . $nombreUnico;

					if (move_uploaded_file($_FILES["archivo_sadoc"]["tmp_name"][$i], $rutaArchivo)) {

						$datos = array(
							"codigo"        => $_POST["codigo_sadoc"][$i],
							"ruta"          => $rutaArchivo,
							"fecha"         => date("Y-m-d H:i:s"),
							"estado"        => "activo",
							"id_cs_fk"      => $_POST["id_cs_detalle"][$i],
							"nombre_sadoc"  => $nombreLimpio
						);

						$respuesta = ModeloSadoc::mdlIngresarArchivo($datos);

						if ($respuesta !== "ok") {
							$errores[] = "Error al guardar los datos de la fila " . ($i + 1);
						}
					} else {
						$errores[] = "No se pudo subir el archivo en la fila " . ($i + 1);
					}
				} else {
					$errores[] = "No se seleccionó archivo en la fila " . ($i + 1);
				}
			}

			if (empty($errores)) {
				echo '
			<script>
				Swal.fire({
					icon: "success",
					title: "Archivos subidos correctamente",
					showConfirmButton: false,
					timer: 2000
				}).then(() => {
					window.location = "sadoc";
				});
			</script>';
			} else {
				$mensaje = implode("<br>", $errores);
				echo '
			<script>
				Swal.fire({
					icon: "error",
					title: "Se presentaron errores",
					html: "' . $mensaje . '",
					confirmButtonText: "Aceptar"
				});
			</script>';
			}
		}
	}

	static public function ctrActualizarArchivo($datos, $archivo)
	{
		function limpiarNombreArchivoe($cadena){
			$cadena = preg_replace('/\.[^.]+$/', '', $cadena); // quitar la extensión
			$cadena = str_replace(
				['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
				['A', 'E', 'I', 'O', 'U', 'N', 'A', 'E', 'I', 'O', 'U', 'N'],
				$cadena
			);
			$cadena = preg_replace('/[^a-zA-Z0-9_\- ]/', '', $cadena); // quitar símbolos raros
			$cadena = strtoupper(trim($cadena)); // convertir a MAYÚSCULAS
			return $cadena;
		}

		$tabla = "sadoc";
		$id = $datos["idArchivo"];
		$codigo = $datos["codigo"];

		// Buscar el archivo actual
		$archivoActual = ModeloSadoc::mdlObtenerArchivoPorId($tabla, $id);

		$rutaAnterior = $archivoActual["ruta"];
		$nombreAnterior = basename($rutaAnterior);
		$directorio = dirname($rutaAnterior) . "/";

		// Si se subió un nuevo archivo
		if (!empty($archivo["archivo"]["tmp_name"])) {
			$nombreArchivoNuevo = basename($archivo["archivo"]["name"]);
			$nombreLimpio = limpiarNombreArchivoe($nombreArchivoNuevo);
			$extension = pathinfo($nombreArchivoNuevo, PATHINFO_EXTENSION);

			// Nuevo nombre igual que en insertar
			$nombreUnico = date("Ymd_His") . "_" . $nombreLimpio . "." . $extension;
			$rutaNueva = $directorio . $nombreUnico;

			if (move_uploaded_file($archivo["archivo"]["tmp_name"], $rutaNueva)) {
				// Eliminar el archivo viejo
				if (file_exists($rutaAnterior)) {
					unlink($rutaAnterior);
				}
			} else {
				echo '<script>
					Swal.fire({
						icon: "error",
						title: "Error al subir el archivo.",
						showConfirmButton: true,
						confirmButtonText: "Cerrar",
						allowOutsideClick: false,
						allowEscapeKey: true
					});
				</script>';
				return "error_subida";
			}
		} else {
			$rutaNueva = $rutaAnterior; // mantener ruta anterior
			$nombreLimpio = $archivoActual["nombre_sadoc"];
		}

		$datosActualizados = array(
			"id" => $id,
			"codigo" => $codigo,
			"ruta" => $rutaNueva,
			"fecha" => date("Y-m-d H:i:s"),
			"nombre_sadoc" => $nombreLimpio
		);

		$respuesta = ModeloSadoc::mdlActualizarArchivo($tabla, $datosActualizados);

		if ($respuesta == "ok") {
			echo '<script>
				Swal.fire({
					icon: "success",
					title: "Archivo actualizado correctamente",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					allowOutsideClick: false,
					allowEscapeKey: true
				}).then(() => {
					window.location = "sadoc";
				});
			</script>';
		} else {
			echo '<script>
				Swal.fire({
					icon: "error",
					title: "No se pudo actualizar el archivo.",
					showConfirmButton: true,
					confirmButtonText: "Cerrar",
					allowOutsideClick: false,
					allowEscapeKey: true
				});
			</script>';
		}

		return $respuesta;
	}



static public function ctrEliminarArchivo()
{
	$id = $_POST["idArchivoEliminar"];
	$tabla = "sadoc";
	// Obtener información del archivo antes de eliminarlo de la base de datos
	$archivo = ModeloSadoc::mdlObtenerArchivoPorId($tabla, $id);

	if ($archivo && isset($archivo["ruta"]) && file_exists($archivo["ruta"])) {
		// Eliminar el archivo físico
		unlink($archivo["ruta"]);
	}

	// Eliminar el registro de la base de datos
	$respuesta = ModeloSadoc::mdlEliminarArchivo($tabla, $id);

	if ($respuesta == "ok") {
		echo '<script>
			Swal.fire({
				icon: "success",
				title: "Archivo eliminado correctamente",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				allowEscapeKey: true
			}).then(() => {
				window.location = "sadoc";
			});
		</script>';
	} else {
		echo '<script>
			Swal.fire({
				icon: "error",
				title: "No se pudo eliminar el archivo.",
				showConfirmButton: true,
				confirmButtonText: "Cerrar",
				allowOutsideClick: false,
				allowEscapeKey: true
			});
		</script>';
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
		// Verifica si se ha enviado el formulario para guardar una nueva categoría
		// y si el campo 'guardar_categoria' está presente en la solicitud POST.
		// Si es así, recoge los datos de la categoría desde el formulario.
		// Luego, llama al modelo para guardar la categoría en la base de datos.
		// Si la respuesta del modelo es "ok", muestra un mensaje de éxito con SweetAlert.
		// Si hay un error al guardar, muestra un mensaje de error con SweetAlert.
		// Finalmente, redirige al usuario a la página de categorías.
		// Si no se ha enviado el formulario, no hace nada.

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
	EDITAR CATEGORÍA
	=============================================*/
	static public function ctrEditarCategorias()
	{
		// Verifica si se ha enviado el formulario para editar una categoría
		if (isset($_POST["editar_categoria"])) {

			$id_categoria = $_POST["id_categoria"];
			$nombre_categoria = $_POST["nombre_categoria"];
			$descripcion_categoria = $_POST["descripcion_categoria"];
			$tabla = "categoria_sadoc";

			$datos = array(
				"id_categoria" => $id_categoria,
				"nombre_categoria" => $nombre_categoria,
				"descripcion_categoria" => $descripcion_categoria
			);

			$respuesta = ModeloSadoc::mdlEditarCategoria($tabla, $datos);

			if ($respuesta == "ok") {
				echo '<script>
						Swal.fire(
							"¡Actualizado!",
							"La categoría ha sido actualizada correctamente.",
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
							text: "No se pudo actualizar la categoría.",
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

	static public function mostrarArchivosPorCategoria($id_proceso_fk, $idCategoria)
	{
		$respuesta = ModeloSadoc::mdlObtenerArchivosPorCategoria($id_proceso_fk, $idCategoria);
		return $respuesta;
	}
}
