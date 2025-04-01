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

	static public function ctrAsignarCategorias()
{
    if (isset($_POST["btn-asignar-sadoc"])) {
        // Obtener el valor de la categoría (único)
        $id_categoria = $_POST["asignar_categoria_sadoc"];  // Este valor será una cadena como "ID - Nombre"
        
        // Obtener los procesos seleccionados (esto será un arreglo)
        $id_proceso_fk = $_POST["id_proceso_fk"]; // Este es un arreglo de procesos
        
        $estado_detalle = "Activo";
        $tabla = "categoria_sadoc_detalle";

        // Verificar que los procesos estén seleccionados
        if (is_array($id_proceso_fk) && count($id_proceso_fk) > 0) {
            foreach ($id_proceso_fk as $proceso) {
                // Guardamos cada proceso con la categoría seleccionada
                $datos = array(
                    "id_categoria" => $id_categoria,  // Categoría seleccionada
                    "id_proceso_fk" => $proceso,      // Cada proceso seleccionado
                    "estado_detalle" => $estado_detalle
                );
                
                // Insertamos en la base de datos
                $respuesta = ModeloSadoc::mdlAsignarCategorias($tabla, $datos);
                
                if ($respuesta != "ok") {
                    return $respuesta; // Si hay un error, lo devolvemos
                }
            }
            return "ok"; // Si todo salió bien
        } else {
            return "Error: No se han seleccionado procesos.";
        }
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
		if (isset($_POST["nuevaCategoria"])) {
			
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
							window.location = "index.php?ruta=categorias";
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
}
