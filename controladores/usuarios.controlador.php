<?php

class ControladorUsuarios
{

	/*=============================================
	INGRESO DE USUARIO
	=============================================*/

	static public function ctrIngresoUsuario()
	{

		if (isset($_POST["ingUsuario"])) {

			// Permitir letras, números y caracteres especiales comunes
			if (
				preg_match('/^[a-zA-Z0-9@._-]+$/', $_POST["ingUsuario"]) &&
				preg_match('/^[a-zA-Z0-9@#$%^&*()_+=!]+$/', $_POST["ingPassword"])
			) {

				$encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$tabla = "usuarios";

				$item = "correo_usuario";
				$valor = $_POST["ingUsuario"];

				$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

				$acceso = ModeloPerfiles::mdlMostrarPerfiles("perfiles", "perfil", $respuesta["perfil"]);

				if ($respuesta["correo_usuario"] == $_POST["ingUsuario"] && $respuesta["password"] != $encriptar) {
					$intentos = esCero($respuesta["intentos"]) + 1;

					$respuesta1 = ModeloUsuarios::mdlActualizarUsuario("usuarios", "intentos", $intentos, "id", $respuesta["id"]);

					if ($intentos > 5) {
						$respuesta = ModeloUsuarios::mdlActualizarUsuario("usuarios", "estado", 0, "id", $respuesta["id"]);
					}
				}

				if ($respuesta["correo_usuario"] == $_POST["ingUsuario"] && $respuesta["password"] == $encriptar) {

					if ($respuesta["estado"] == 1) {

						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["apellidos_usuario"] = $respuesta["apellidos_usuario"];
						$_SESSION["correo_usuario"] = $respuesta["correo_usuario"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];
						$_SESSION["id_proceso_fk"] = $respuesta["id_proceso_fk"];
						$_SESSION["siglas_proceso"] = $respuesta["siglas_proceso"];
						$_SESSION["id_cargo_fk"] = $respuesta["id_cargo_fk"];
						$_SESSION["nombre_cargo"] = $respuesta["nombre_cargo"];
						$_SESSION["descripcionPerfil"] = $acceso["descripcion"];

						// DERECHOS MENU CONFIGURACION
						$_SESSION["menuConfiguraciones"] = $acceso["menuConfiguraciones"];

						// REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha . ' ' . $hora;

						$item1 = "ultimo_login";
						$valor1 = $fechaActual;

						$item2 = "id";
						$valor2 = $respuesta["id"];

						$ultimoLogin = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

						if ($ultimoLogin == "ok") {
							echo '<script>window.location = "inicio";</script>';
						}
					} else {
						echo '<br><div class="alert alert-danger">El usuario aún no está activado</div>';
					}
				} else {
					echo '<br><div class="alert alert-danger">Error al ingresar, vuelve a intentarlo</div>';
				}
			} else {
				echo '<br><div class="alert alert-danger">Caracteres no permitidos</div>';
			}
		}
	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function ctrCrearUsuario()
	{


		if (isset($_POST["correo_usuario"])) {




			if (
				preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["apellidos_usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["correo_usuario"]) &&
				preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])
			) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";



				if (isset($_FILES["nuevaFoto"]["tmp_name"]) && $_FILES["nuevaFoto"]["tmp_name"] != "") {

					list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["correo_usuario"];

					mkdir($directorio, 0755);

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["correo_usuario"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["nuevaFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["correo_usuario"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}



				$tabla = "usuarios";

				//$encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

				$datos = array(
					"nombre" => $_POST["nuevoNombre"],
					"apellidos_usuario" => $_POST["apellidos_usuario"],
					"correo_usuario" => $_POST["correo_usuario"],
					"password" => $_POST["nuevoPassword"],
					"perfil" => $_POST["nuevoPerfil"],
					"foto" => $ruta
				);




				$respuesta = ModeloUsuarios::mdlIngresarUsuario($tabla, $datos);



				if ($respuesta == "ok") {

					echo '<script>

					Swal.fire({

						type: "success",
						title: "¡El usuario ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "usuarios";

						}

					});


					</script>';
				}
			} else {

				echo '<script>

					Swal.fire({

						type: "error",
						title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "usuarios";

						}

					});


				</script>';
			}
		}
	}

	/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuarios($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;
	}

		/*=============================================
	MOSTRAR USUARIO
	=============================================*/

	static public function ctrMostrarUsuario($item, $valor)
	{

		$tabla = "usuarios";

		$respuesta = ModeloUsuarios::MdlMostrarUsuario($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
	static public function ctrMostrarUsuariosCorreo($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuariosCorreo($tabla, $item, $valor);
		return $respuesta;
	}

		/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
static public function ctrMostrarUsuariosCorreoActividad($item, $valor)
{
	$tabla = "usuarios";
	$respuesta = ModeloUsuarios::mdlMostrarUsuariosCorreoActividad($tabla, $item, $valor);
	return $respuesta;
}

		/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
static public function ctrMostrarUsuariosCorreoTecnico($item, $valor)
{
	$tabla = "usuarios";
	$respuesta = ModeloUsuarios::mdlMostrarUsuariosCorreoSolicitud($tabla, $item, $valor);
	return $respuesta;
}

		/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
static public function ctrMostrarUsuariosCorreoJuridico($item, $valor)
{
	$tabla = "usuarios";
	$respuesta = ModeloUsuarios::mdlMostrarUsuariosCorreoJuridico($tabla, $item, $valor);
	return $respuesta;
}

/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
static public function ctrMostrarUsuariosCorreoSolucion($item)
{
	$tabla = "usuarios";
	$respuesta = ModeloUsuarios::mdlEnviarSolucion($tabla, $item);
	return $respuesta;
}

/*=============================================
MOSTRAR USUARIO CORREO
=============================================*/
static public function ctrMostrarUsuariosVacaciones($item, $valor)
{
    $tabla = "usuarios";
    return ModeloUsuarios::mdlEnviarSolicitudVacaciones($tabla, $item, $valor);
}

			/*=============================================
	MOSTRAR USUARIO CORREO
	=============================================*/
	static public function ctrMostrarUsuariosSolicitud($item, $valor)
	{
		$tabla = "usuarios";
		$respuesta = ModeloUsuarios::mdlMostrarUsuariosCorreoJuridico($tabla, $item, $valor);
		return $respuesta;
	}
	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarUsuario()
	{

		if (isset($_POST["editarUsuario"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				if ($_POST["editarPassword"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) {

						$encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "usuarios";

										}
									})

						  	</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}

				$datos = array(
					"nombre" => $_POST["editarNombre"],
					"correo_usuario" => $_POST["editarUsuario"],
					"password" => $encriptar,
					"perfil" => $_POST["editarPerfil"],
					"firma" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "usuarios";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					Swal.fire({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';
			}
		}
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function ctrBorrarUsuario()
	{

		if (isset($_POST["idUsuario"])) {

			$tabla = "usuarios";
			$datos = $_POST["idUsuario"];

			if ($_POST["fotoUsuario"] != "") {

				unlink($_POST["fotoUsuario"]);
				rmdir('vistas/img/usuarios/' . $_POST["correo_usuario"]);
			}

			$respuesta = ModeloUsuarios::mdlBorrarUsuario($tabla, $datos);

			if ($respuesta == "ok") {

				echo '<script>

				Swal.fire({
					  type: "success",
					  title: "El usuario ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "ti";

								}
							})

				</script>';
			}
		}
	}


	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrCambiarContra()
	{

		if (isset($_POST["cambiarPassword"]) && $_SESSION["iniciarSesion"] == "ok") {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_SESSION["nombre"])) {

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])) {

					list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

					$nuevoAncho = 500;
					$nuevoAlto = 500;

					/*=============================================
					CREAMOS EL DIRECTORIO DONDE VAMOS A GUARDAR LA FOTO DEL USUARIO
					=============================================*/

					$directorio = "vistas/img/usuarios/" . $_POST["editarUsuario"];

					/*=============================================
					PRIMERO PREGUNTAMOS SI EXISTE OTRA IMAGEN EN LA BD
					=============================================*/

					if (!empty($_POST["fotoActual"])) {

						unlink($_POST["fotoActual"]);
					} else {

						mkdir($directorio, 0755);
					}

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if ($_FILES["editarFoto"]["type"] == "image/jpeg") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".jpg";

						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagejpeg($destino, $ruta);
					}

					if ($_FILES["editarFoto"]["type"] == "image/png") {

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						$aleatorio = mt_rand(100, 999);

						$ruta = "vistas/img/usuarios/" . $_POST["editarUsuario"] . "/" . $aleatorio . ".png";

						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);

						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

						imagepng($destino, $ruta);
					}
				}

				$tabla = "usuarios";

				if ($_POST["password"] != "") {

					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])) {

						$encriptar = crypt($_POST["password"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
					} else {

						echo '<script>

								swal({
									  type: "error",
									  title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
									  showConfirmButton: true,
									  confirmButtonText: "Cerrar"
									  }).then(function(result) {
										if (result.value) {

										window.location = "cambiarContra";

										}
									})

						  	</script>';

						return;
					}
				} else {

					$encriptar = $_POST["passwordActual"];
				}



				$usuario = $_SESSION["usuario"];

				$datos = array(
					"nombre" => $_POST["nombre"],
					"usuario" => $usuario,
					"password" => $encriptar,
					"foto" => $ruta
				);

				$respuesta = ModeloUsuarios::mdlEditarContra($tabla, $datos);

				if ($respuesta == "ok") {

					echo '<script>

					swal({
						  type: "success",
						  title: "El usuario ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "salir";

									}
								})

					</script>';
				}
			} else {

				echo '<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';
			}
		}
	}
}
