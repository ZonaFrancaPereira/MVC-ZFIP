<?php

class ControladorClientes
{
	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente()
	{
		if (isset($_POST["id_cliente"])) {
	
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre_cliente"])) {
	
				$tabla = "clientes_zfip";
	
				$datos = array(
					"nombre_cliente" => $_POST["nombre_cliente"],
					"id_cliente" => $_POST["id_cliente"],
					"email_cliente" => $_POST["email_cliente"],
					"telefono_cliente" => $_POST["telefono_cliente"],
					"direccion_cliente" => $_POST["direccion_cliente"],
					"tipo_zf" => $_POST["tipo_zf"],
				);
	
				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);
	
				if ($respuesta == "ok") {
					echo '<script>
						Swal.fire(
							"Buen Trabajo!",
							"El cliente se ha registrado con éxito.",
							"success"
						).then(function() {
							// Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();
						});
					</script>';
				}
			} else {
				echo '<script>
					swal({
						type: "error",
						title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"
					}).then(function(result){
						if (result.value) {
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
						}
					})
				</script>';
			}
		} else {
			return "error";
		}
	}
		/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor)
	{

		$tabla = "clientes_zfip";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente()
	{

		if (isset($_POST["editarCliente"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"])) {

				$tabla = "clientes_zfip";

				$datos = array(
					"id" => $_POST["idCliente"],
					"nombre" => $_POST["editarCliente"],
					"documento" => $_POST["editarDocumentoId"],
					"email" => $_POST["editarEmail"],
					"telefono" => $_POST["editarTelefono"],
					"direccion" => $_POST["editarDireccion"],
					"tipo_zf" => $_POST["editarTipozf"]
				);

				$respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El cliente ha sido cambiado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "clientes";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El cliente no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "clientes";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function ctrEliminarCliente()
	{

		if (isset($_POST["idCliente"])) {

			$tabla = "clientes_zfip";
			$datos = $_POST["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo 'ok';
			}
		}
	}

}


