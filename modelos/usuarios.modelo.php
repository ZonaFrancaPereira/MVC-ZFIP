<?php

require_once "conexion.php";

class ModeloUsuarios
{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	

	static public function mdlMostrarUsuarios($tabla, $item, $valor)
	{
	// Conexión a la base de datos
	$db = Conexion::conectar();

	// Construir la consulta SQL base
	$sql = "SELECT a.*, 
					(SELECT b.descripcion 
					FROM perfiles b 
					WHERE b.perfil = a.perfil) AS nombrePerfil,
					p.*
			FROM $tabla a
			INNER JOIN proceso p ON a.id_proceso_fk = p.id_proceso";

	// Si se proporciona un ítem y un valor, añadir una cláusula WHERE
	if ($item != null && $valor != null) {
		$sql .= " WHERE a.$item = :$item";
	}

	// Preparar la consulta
	$stmt = $db->prepare($sql);

	// Si hay un ítem y un valor, enlazar el valor con el parámetro de la consulta
	if ($item != null && $valor != null) {
		$stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);
	}

	// Ejecutar la consulta
	$stmt->execute();

	// Retorna un único registro si se proporcionó un ítem, o todos los registros si no se proporcionó ítem
	$result = ($item != null && $valor != null) ? $stmt->fetch() : $stmt->fetchAll();

	// Cierre del statement
	$stmt = null;

	// Retorna el resultado
	return $result;
	}

	

	/*=============================================
		MOSTRAR USUARIOS CORREO
	=============================================*/
	static public function mdlMostrarUsuariosCorreo($tabla, $item, $valor)
	{
		// Consulta con INNER JOIN incluyendo la tabla proceso
		$stmt = Conexion::conectar()->prepare(
			"SELECT u.*, s.*, p.*, a.*
			FROM $tabla u
			INNER JOIN soporte s ON u.id = s.id_usuario_fk
			INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
			INNER JOIN acpm a ON u.id = a.id_usuario_fk
			WHERE u.$item = :valor"
		);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
		$stmt->execute();

		// Utilizar fetchAll para obtener todos los resultados
		return $stmt->fetchAll();
	}


	/*=============================================
			ENVIO DE CORREO POR ACTIVIDAD ASIGNADA
		=============================================*/

	static public function mdlMostrarUsuariosCorreoActividad($tabla, $item, $valor)
	{
		// Consulta con INNER JOIN entre usuarios y actividades_acpm
		$stmt = Conexion::conectar()->prepare("SELECT u.correo_usuario, u.nombre, u.apellidos_usuario, a.descripcion_actividad, a.fecha_actividad, a.id_acpm_fk
			FROM $tabla u
			INNER JOIN actividades_acpm a ON u.id = a.id_usuario_fk
			WHERE u.$item = :valor"
		);
		$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
		$stmt->execute();
	
		// Utilizar fetchAll para obtener todos los resultados
		return $stmt->fetchAll();
	}

	/*=============================================
			ENVIO DE CORREO PARA SOLICITUD DE SOPORTE TECNICO
		=============================================*/

		static public function mdlMostrarUsuariosCorreoSolicitud($tabla, $item, $valor)
		{
			// Consulta con INNER JOIN entre usuarios y actividades_acpm
			$stmt = Conexion::conectar()->prepare("SELECT u.correo_usuario, u.nombre, u.apellidos_usuario, a.descripcion_soporte_tecnico, p.*
				FROM $tabla u
				INNER JOIN soporte_tecnico a ON u.id = a.id_usuario_fk1
				INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
				WHERE u.$item = :valor"
			);
			$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
			$stmt->execute();
		
			// Utilizar fetchAll para obtener todos los resultados
			return $stmt->fetchAll();
		}


		
	/*=============================================
			ENVIO DE CORREO PARA SOLICITUD DE SOPORTE TECNICO
		=============================================*/

		static public function mdlMostrarUsuariosCorreoJuridico($tabla, $item, $valor)
			{
				// Consulta con INNER JOIN entre usuarios y actividades_acpm
						$stmt = Conexion::conectar()->prepare("SELECT u.nombre, u.apellidos_usuario, u.correo_usuario, a.descripcion_solicitud_juridico,a.correo_solicitante, p.*, a.*
						FROM $tabla u
						INNER JOIN soporte_juridico a ON u.id = a.nombre_solicitante
						INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
						WHERE u.$item = :valor"
					);
					$stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
					$stmt->execute();
				
					// Utilizar fetchAll para obtener todos los resultados
					return $stmt->fetchAll();
			}

			static public function mdlEnviarSolucion($tabla)
{
    try {
        $stmt = Conexion::conectar()->prepare(
            "SELECT u.nombre, u.apellidos_usuario, u.correo_usuario, 
                    a.descripcion_solicitud_juridico, a.correo_solicitante, a.*
             FROM $tabla u
             INNER JOIN soporte_juridico a ON u.id = a.nombre_solicitante"
        );

        $stmt->execute();
        
        return $stmt->fetchAll(); // Obtener todos los resultados
    } catch (PDOException $e) {
        // Manejar el error, si ocurre
        echo "Error en la consulta: " . $e->getMessage();
        return [];
    }
}

			



	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos)
	{
		try {
			$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre, apellidos_usuario, correo_usuario, password, perfil, foto) VALUES (:nombre, :apellidos_usuario, :correo_usuario, :password, :perfil, :foto)");
	
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":apellidos_usuario", $datos["apellidos_usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":correo_usuario", $datos["correo_usuario"], PDO::PARAM_STR);
			$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
			$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
			$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
	
			// Ejecutar la consulta
			if ($stmt->execute()) {
				return "ok";
			} else {
				// Captura el error de la consulta y lo muestra
				$errorInfo = $stmt->errorInfo();
				$errorMessage = "SQLSTATE: " . $errorInfo[0] . "\n" . "Código de error: " . $errorInfo[1] . "\n" . "Mensaje: " . $errorInfo[2];
				echo "Error en la consulta: " . $errorMessage . "\n";
	
				// Puedes también registrar el error en un archivo de log
				error_log("Error en la consulta SQL: " . $errorMessage, 3, "error_log.log");
	
				return $errorMessage;
			}
		} catch (Exception $e) {
			// Captura y muestra excepciones
			echo "Excepción capturada: " . $e->getMessage() . "\n";
			error_log("Excepción capturada: " . $e->getMessage(), 3, "error_log.log");
			return $e->getMessage();
		}
	}
	

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}


	/*=============================================
	EDITAR CONTRA
	=============================================*/

	static public function mdlEditarContra($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
                                                                         password = :password
                                                                      
                                                                        , foto = :foto 
                                                                        WHERE usuario = :usuario");


		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}


	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":" . $item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt->bindParam(":id", $datos, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}



		$stmt = null;
	}




}