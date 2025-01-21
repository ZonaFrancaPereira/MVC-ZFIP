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
							// Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();
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
    // Verificamos si se ha enviado el formulario
    if (isset($_POST["editarIdCliente"])) {
            // Tabla donde se va a guardar el cliente editado
            $tabla = "clientes_zfip";

            // Datos a actualizar (ajustados según los campos de la tabla)
            $datos = array(
                "id_cliente" => $_POST["editarIdCliente"], // ID del cliente a editar
                "nombre_cliente" => $_POST["editarNombreCliente"], // Nombre del cliente
                "email_cliente" => $_POST["editarEmailCliente"], // Email del cliente
                "telefono_cliente" => $_POST["editarTelefonoCliente"], // Teléfono del cliente
                "direccion_cliente" => $_POST["editarDireccionCliente"], // Dirección del cliente
                "tipo_zf" => $_POST["editarTipoZF"] // Tipo de zona franca
            );

            // Llamada al modelo para realizar la actualización
            $respuesta = ModeloClientes::mdlEditarCliente($tabla, $datos);

            // Verificamos la respuesta del modelo
            if ($respuesta == "ok") {
                // Si la actualización fue exitosa, mostramos un mensaje
				echo '<script>
				Swal.fire(
				"Buen Trabajo!",
				"La información se guardo con éxito.",
				"success"
				).then(function() {
				document.getElementById("editarClientes").reset();
				
				// Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();
				
				});
			</script>';
            }else{
				echo '<script>

					Swal.fire({

						type: "error",
						title: "¡No se guardaron los cambios del Usuario!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							// Limpiar el formulario
							document.getElementById("GuardarCliente").reset();
							$("#panelbascula").removeClass("active");
							$("#formclientes").addClass("active");
							refrescarClientes();

						}

					});


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
	
			// Configura el encabezado para devolver JSON
			header('Content-Type: application/json');
	
			if ($respuesta == "ok") {
				echo json_encode([
					"status" => "ok"
					
				]);
			} else {
				echo json_encode([
					"status" => "error"
					
				]);
			}
		}
	}
	

}



if (isset($_POST['action'])) {
   
    require_once "../modelos/clientes.modelo.php"; // Incluye el modelo aquí dentro del switch

    switch ($_POST['action']) {
        case 'EliminarCliente':
            ControladorClientes::ctrEliminarCliente();
            break;
       
        default:
            echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
    }
}
