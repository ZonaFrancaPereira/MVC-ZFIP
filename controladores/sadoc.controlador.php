<?php

class ControladorSadoc
{


	/*=============================================
	SUBIR ARCHIVO DEPENDIENDO CATEGORÍA
	=============================================*/
	static public function ctrCrearArchivo()
{
    function limpiarNombreArchivo($cadena)
    {
        $cadena = strtolower($cadena);
        $cadena = preg_replace('/\.[^.]+$/', '', $cadena); // quitar la extensión
        $cadena = str_replace(
            ['á', 'é', 'í', 'ó', 'ú', 'ñ', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'],
            ['a', 'e', 'i', 'o', 'u', 'n', 'a', 'e', 'i', 'o', 'u', 'n'],
            $cadena
        );
        $cadena = preg_replace('/[^a-z0-9_\- ]/', '', $cadena); // quitar símbolos raros
        $cadena = trim($cadena);
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
                $nombreUnico = date("Ymd_His") . "_" . $nombreArchivo;
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

	static public function mostrarArchivosPorCategoria($id_proceso_fk, $idCategoria)
	{
		$respuesta = ModeloSadoc::mdlObtenerArchivosPorCategoria($id_proceso_fk, $idCategoria);
		return $respuesta;
	}
}
