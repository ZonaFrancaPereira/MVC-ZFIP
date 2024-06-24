<?php

class ControladorPerfiles{


	/*=============================================
	REGISTRO DE PERFILES
	=============================================*/

	static public function ctrCrearPerfil(){
		echo $_POST["nuevoDescripcionPerfil"];
		if(isset($_POST["nuevoDescripcionPerfil"])){




			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionPerfil"])
			   ){

				$tabla = "perfiles";




				$datos = array("descripcion" => $_POST["nuevoDescripcionPerfil"]


							   ,"menuConfiguraciones" => $_POST["mConfiguraciones"]
							 
							);



				$respuesta = ModeloPerfiles::mdlIngresarPerfil($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El perfil ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "perfiles";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La discrición del perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "perfiles";

						}

					});


				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil(){

		if(isset($_POST["idPerfil"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["idPerfil"])){


				$tabla = "perfiles";

				$datos = array("perfil" => $_POST["idPerfil"]
							   ,"descripcion" => $_POST["editarDescripcion"]
							   ,"perfiles" => $_POST["editarsmPerfiles"]
							   ,"menuConfiguraciones" => $_POST["editarmConfiguraciones"]
							


								);

				$respuesta = ModeloPerfiles::mdlEditarPerfil($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "perfiles";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "perfiles";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR PERFIL
	=============================================*/

	static public function ctrBorrarPerfil(){

		if(isset($_GET["idPerfil"]) && isset($_GET["eliminar"])){

			$tabla ="perfiles";
			$datos = $_GET["idPerfil"];



			$respuesta = ModeloPerfiles::mdlBorrarPerfil($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Perfil ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "perfiles";

								}
							})

				</script>';

			}

		}

	}


}
