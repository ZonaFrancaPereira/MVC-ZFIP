<?php

class ControladorClientes
{
	/*=============================================
	CREAR CLIENTES
	=============================================*/

	static public function ctrCrearCliente(){

		if (isset($_POST["nuevoCliente"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoCliente"])) {

				$tabla = "clientes";

				$datos = array(
					"nombre" => $_POST["nuevoCliente"],
					"documento" => $_POST["nuevoDocumentoId"],
					"email" => $_POST["nuevoEmail"],
					"telefono" => $_POST["nuevoTelefono"],
					"direccion" => $_POST["nuevaDireccion"],
					"ciudad" => $_POST["nuevaCiudad"],
					"departamento" => $_POST["nuevoDepartamento"]
				);

				$respuesta = ModeloClientes::mdlIngresarCliente($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					  Swal.fire(
							"Buen Trabajo!",
							"El cliente  se ha registrado con éxito.",
							"success"
							).then(function() {
							actualizarDatalist();
							 //Limpiar el formulario
                            document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
                            $("#formclientes").addClass("active");
							
					
							
							
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

	static public function obtenerClientes() {
        $clientes = ModeloClientes::mdlMostrarClientesData(); // Método para obtener clientes desde la base de datos
        echo json_encode($clientes);
    }

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function ctrMostrarClientes($item, $valor)
	{

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientes($tabla, $item, $valor);

		return $respuesta;
	}
	static public function ctrMostrarClientesData()
	{

		$respuesta = ModeloClientes::mdlMostrarClientesData();

		return $respuesta;
	}


	/*=============================================
	MOSTRAR CLIENTES AJAX
	=============================================*/

	static public function ctrMostrarClientesAjax()
	{

		$tabla = "clientes";

		$respuesta = ModeloClientes::mdlMostrarClientesAjax();

		return $respuesta;
	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function ctrEditarCliente()
	{

		if (isset($_POST["editarCliente"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCliente"])) {

				$tabla = "clientes";

				$datos = array(
					"id" => $_POST["idCliente"],
					"nombre" => $_POST["editarCliente"],
					"documento" => $_POST["editarDocumentoId"],
					"email" => $_POST["editarEmail"],
					"telefono" => $_POST["editarTelefono"],
					"direccion" => $_POST["editarDireccion"],
					"fecha_nacimiento" => $_POST["editarFechaNacimiento"]
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

			$tabla = "clientes";
			$datos = $_POST["idCliente"];

			$respuesta = ModeloClientes::mdlEliminarCliente($tabla, $datos);

			if ($respuesta == "ok") {

				echo 'ok';
			}
		}
	}
}


/*=============================================
CREAR CLIENTE
=============================================*/


if (isset($_POST["guardarAjax"])) {


	require_once "../modelos/clientes.modelo.php";


	$crearCliente = new ControladorClientes();
	$respuesta = $crearCliente->ctrCrearCliente();

	echo  $respuesta;
}

/*=============================================
LEER CLIENTES AJAX
=============================================*/



if (isset($_POST["ajaxCliente"])) {

	require_once "../modelos/clientes.modelo.php";

	$leerCliente = new ControladorClientes();
	$respuesta = $leerCliente->ctrMostrarClientesAjax();

	echo json_encode($respuesta);
}

if (isset($_GET['action']) && $_GET['action'] === 'obtener_clientes') {
    // Aquí va la lógica para obtener los datos de los clientes
    $clientes = ControladorClientes::ctrMostrarClientesData(); // Suponiendo que este método devuelve los datos
    echo json_encode($clientes); // Devuelve los datos como JSON
}