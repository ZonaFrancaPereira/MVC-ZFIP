<?php

class ControladorProveedor
{
	/*=============================================
	CREAR Proveedor
	=============================================*/

	static public function ctrCrearProveedor()
	{

		if (isset($_POST["nuevoProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoProveedor"])) {

				$tabla = "Proveedor";

				$datos = array(
					"nombre" => $_POST["nuevoProveedor"],
					"documento" => $_POST["nuevoDocumentoId"],
					"email" => $_POST["nuevoEmail"],
					"telefono" => $_POST["nuevoTelefono"],
					"direccion" => $_POST["nuevaDireccion"],
					"ciudad" => $_POST["nuevaCiudad"],
					"departamento" => $_POST["nuevoDepartamento"]
				);

				$respuesta = ModeloProveedor::mdlIngresarProveedor($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					  Swal.fire(
							"Buen Trabajo!",
							"El Proveedor  se ha registrado con éxito.",
							"success"
							).then(function() {
							
							 //Limpiar el formulario
                            document.getElementById("GuardarProveedor").reset();
							$("#panelbascula").removeClass("active");
                            $("#formProveedor").addClass("active");
							refrescarProveedor();
							
						
							});

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							$("#panelbascula").removeClass("active");
                            $("#formProveedor").addClass("active");

							}
						})

			  	</script>';
			}
		} else {
			return "error";
		}
	}

	/*=============================================
	MOSTRAR Proveedor
	=============================================*/

	static public function ctrMostrarProveedor($item, $valor)
	{

		$tabla = "proveedor_compras";

		$respuesta = ModeloProveedor::mdlMostrarProveedor($tabla, $item, $valor);

		return $respuesta;
	}


	/*=============================================
	MOSTRAR Proveedor AJAX
	=============================================*/

	static public function ctrMostrarProveedorAjax()
	{

		$tabla = "proveedor_compras";

		$respuesta = ModeloProveedor::mdlMostrarProveedorAjax();

		return $respuesta;
	}

	/*=============================================
	EDITAR Proveedor
	=============================================*/

	static public function ctrEditarProveedor()
	{

		if (isset($_POST["editarProveedor"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarProveedor"])) {

				$tabla = "Proveedor";

				$datos = array(
					"id" => $_POST["idProveedor"],
					"nombre" => $_POST["editarProveedor"],
					"documento" => $_POST["editarDocumentoId"],
					"email" => $_POST["editarEmail"],
					"telefono" => $_POST["editarTelefono"],
					"direccion" => $_POST["editarDireccion"],
					"fecha_nacimiento" => $_POST["editarFechaNacimiento"]
				);

				$respuesta = ModeloProveedor::mdlEditarProveedor($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El Proveedor ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "Proveedor";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El Proveedor no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "Proveedor";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR Proveedor
	=============================================*/

	static public function ctrEliminarProveedor()
	{

		if (isset($_POST["idProveedor"])) {

			$tabla = "proveedor_compras";
			$datos = $_POST["id_proveedor"];

			$respuesta = ModeloProveedor::mdlEliminarProveedor($tabla, $datos);

			if ($respuesta == "ok") {

				echo 'ok';
			}
		}
	}
}


