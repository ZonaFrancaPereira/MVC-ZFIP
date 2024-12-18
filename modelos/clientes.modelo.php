<?php

require_once "conexion.php";

class ModeloClientes{

	/*=============================================
	CREAR CLIENTE
	=============================================*/

	static public function mdlIngresarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre
																, documento
																, email
																, telefono
																, direccion
																, ciudad
																, departamento

																) 
																VALUES (:nombre
																, :documento
																, :email
																, :telefono
																, :direccion
																, :ciudad
																, :departamento

																)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":departamento", $datos["departamento"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			$arr=$stmt->errorInfo();
			return $arr[2];
		
		}

	
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientes($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * 
														
														FROM 
														$tabla 
														WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}



		$stmt = null;

	}


	/*=============================================
	MOSTRAR CLIENTES AJAX
	=============================================*/

	static public function mdlMostrarClientesAjax(){



		$stmt = Conexion::conectar()->prepare("SELECT documento 
													,nombre as text	
													 FROM clientes");

		$stmt -> execute();

		$arr = $stmt ->errorInfo();


		if ($arr[0]>0){
				$arr[3]="ERROR";
				return $arr;
			}
			else{

			return $stmt -> fetchAll();
		}

		

		

		$stmt = null;

	}

	/*=============================================
	MOSTRAR CLIENTES
	=============================================*/

	static public function mdlMostrarClientesDTServerSide($valor){

	    //LIMITE DE REGISTROS
	    $limit="LIMIT ".$valor['start']."  ,".$valor['length'];

	    
	    //BUSQUEDA
	    if(isset($valor['search'])){
			$buscar=$valor['search']['value'];
			$busquedaGeneral="and  ( 

                                                    nombre
                                                    like '%".$buscar."%'	

                                                    or

                                                    documento
                                                    like '%".$buscar."%'
                                                    or

                                                    email
                                                    like '%".$buscar."%'
                                                    or

                                                    telefono
                                                    like '%".$buscar."%'
                                                    or

                                                    ciudad
                                                    like '%".$buscar."%'
							)

									";
		}
		else{
			$busquedaGeneral="";
		}


		//COMO VA SER ORDENADO
			$col =array(
				0   =>  '1',
				1   =>  '5',
				2   =>  '3',
				3   =>  '4',
				4   =>  '2',
				5   =>  '6',
				6   =>  '8',
				7   =>  '10',
				8   =>  '1',
			);

		$orderBy=" ORDER BY ".$col[$valor['order'][0]['column']]."   ".$valor['order'][0]['dir'];

		$stmt = Conexion::conectar()->prepare("SELECT * 
											FROM clientes
											where 1=1
											$busquedaGeneral
                                                                                        $orderBy   
                                                                                       $limit
											");

		$stmt -> execute();

		return $stmt -> fetchAll();

		

		$stmt = null;

	}


	 /*=============================================
	MOSTRAR PRODUCTOS NUMERO DE REGISTROS
	=============================================*/

	static public function mdlMostrarNumRegistros($valor){

                        
			$stmt = Conexion::conectar()->prepare("SELECT count(documento) as contador FROM clientes 
                                
                                ");

			$stmt -> execute();

			return $stmt -> fetch();

		

		

		$stmt = null;

	}

	/*=============================================
	EDITAR CLIENTE
	=============================================*/

	static public function mdlEditarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, ciudad = :ciudad WHERE id = :id");

		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		$stmt = null;

	}

	/*=============================================
	ELIMINAR CLIENTE
	=============================================*/

	static public function mdlEliminarCliente($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE documento = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR CLIENTE
	=============================================*/

	static public function mdlActualizarCliente($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE documento = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		

		$stmt = null;

	}
	

}