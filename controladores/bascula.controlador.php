<?php

class ControladorBascula
{


	/*=============================================
	REGISTRO DE PERFILES
	=============================================*/

	static public function ctrCrearBascula()
	{

		if (isset($_POST["placa"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["placa"])) {

				$tabla = "pesaje_bascula";
				$datos = array(
					"placa" => $_POST["placa"],
					"peso_uno" => $_POST["peso_uno"],
					"id_cliente_fk" => $_POST["id_cliente_fk"]

				);

				$respuesta = ModeloBascula::mdlIngresarBascula($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>
							Swal.fire(
							"Buen Trabajo!",
							"El formulario se ha registrado con éxito.",
							"success"
							).then(function() {
							 //Limpiar el formulario
                            document.getElementById("GuardarPesaje").reset();
							$("#panelbascula").removeClass("active");
                            $("#formbascula").addClass("active");
					
							
							
							});
						</script>
					';
				}
			} else {
				echo '<script>
						Swal.fire({
							type: "error",
							title: "¡La descripción del perfil no puede ir vacío o llevar caracteres especiales!",
							showConfirmButton: true,
							confirmButtonText: "Cerrar"

						}).then(function(result){
							if(result.value){
							//Limpiar el formulario
                            document.getElementById("GuardarPesaje").reset();
							$("#panelbascula").removeClass("active");
                            $("#formbascula").addClass("active");
							}
						});
					</script>
				';
			}
		}
	}
}
