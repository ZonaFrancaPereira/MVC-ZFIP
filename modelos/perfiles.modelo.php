<?php

require_once "conexion.php";

class ModeloPerfiles{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarPerfiles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                        ,descripcion

                                                                         ,(case when menuConfiguraciones='on' then 'on'
                                                                                       else 'off'
                                                                                       end) as menuConfiguraciones

                                                                        
	                                                                                        



                                                               FROM $tabla

                                                               WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                    ,descripcion

                                                                    ,(case when menuConfiguraciones='on' then 'on'
                                                                                  else 'off'
                                                                                  end) as menuConfiguraciones

                                                                   

                                                     FROM
                                                     $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlIngresarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion

                                                                        ,menuConfiguraciones
                                                                    

                                                                        )
                                                        VALUES (:descripcion

                                                                        ,:menuConfiguraciones
                                                                       
                                                                )");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$stmt->bindParam(":menuConfiguraciones", $datos["menuConfiguraciones"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function mdlEditarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla
                                                            SET descripcion = :descripcion

                                                                    ,menuConfiguraciones = :menuConfiguraciones
																	,perfiles = :perfiles
                                                                  
                                                            WHERE perfil = :perfil"
                                                            );


		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":menuConfiguraciones", $datos["menuConfiguraciones"], PDO::PARAM_STR);
		$stmt->bindParam(":perfiles", $datos["perfiles"], PDO::PARAM_STR);


		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR PERFIL
	=============================================*/

	static public function mdlBorrarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfil = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}
