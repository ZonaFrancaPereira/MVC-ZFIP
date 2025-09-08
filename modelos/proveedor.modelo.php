<?php

require_once "conexion.php";

class ModeloProveedor
{

    /*=============================================
	CREAR Proveedor
	=============================================*/

    static public function mdlIngresarProveedor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
            id_proveedor,
            nombre_proveedor,
            contacto_proveedor,
            telefono_proveedor,
            id_usuario_fk
        ) VALUES (
            :id_proveedor
			, :nombre_proveedor
			, :contacto_proveedor
			, :telefono_proveedor
			, :id_usuario_fk
																

		)");

        $stmt->bindParam(":id_proveedor", $datos["id_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_proveedor", $datos["nombre_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":contacto_proveedor", $datos["contacto_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono_proveedor", $datos["telefono_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":id_usuario_fk", $datos["id_usuario_fk"], PDO::PARAM_STR);
        


        if ($stmt->execute()) {

            return "ok";
        } else {

            $arr = $stmt->errorInfo();
            return $arr[2];
        }


        $stmt = null;
    }

    /*=============================================
	MOSTRAR Proveedor
	=============================================*/

    static public function mdlMostrarProveedor($tabla, $item, $valor)
    {

        if ($item != null) {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM 
														$tabla 
														WHERE $item = :$item");

            $stmt->bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt->execute();

            return $stmt->fetch();
        } else {

            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            $stmt->execute();

            return $stmt->fetchAll();
        }



        $stmt = null;
    }


    /*=============================================
	MOSTRAR Proveedor AJAX
	=============================================*/

    static public function mdlMostrarProveedorAjax()
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_proveedor,nombre_proveedor as text	
													 FROM proveedor_compras");

        $stmt->execute();

        $arr = $stmt->errorInfo();


        if ($arr[0] > 0) {
            $arr[3] = "ERROR";
            return $arr;
        } else {

            return $stmt->fetchAll();
        }

        $stmt = null;
    }

    /*=============================================
	MOSTRAR Proveedor
	=============================================*/

    static public function mdlMostrarProveedorDTServerSide($valor)
    {

        //LIMITE DE REGISTROS
        $limit = "LIMIT " . $valor['start'] . "  ," . $valor['length'];


        //BUSQUEDA
        if (isset($valor['search'])) {
            $buscar = $valor['search']['value'];
            $busquedaGeneral = "and  ( 

                                                    id_proveedor
                                                    like '%" . $buscar . "%'	

                                                    or

                                                    nombre_proveedor
                                                    like '%" . $buscar . "%'
                                                    or

                                                    contacto_proveedor
                                                    like '%" . $buscar . "%'
                                                    or

                                                    telefono_proveedor
                                                    like '%" . $buscar . "%'
                                                    or

                                                    id_usuario_fk
                                                    like '%" . $buscar . "%'
							)

									";
        } else {
            $busquedaGeneral = "";
        }


        //COMO VA SER ORDENADO
        $col = array(
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

        $orderBy = " ORDER BY " . $col[$valor['order'][0]['column']] . "   " . $valor['order'][0]['dir'];

        $stmt = Conexion::conectar()->prepare("SELECT * 
											FROM proveedor_compras
											where 1=1
											$busquedaGeneral
                                                                                        $orderBy   
                                                                                       $limit
											");

        $stmt->execute();

        return $stmt->fetchAll();



        $stmt = null;
    }


    /*=============================================
	MOSTRAR PRODUCTOS NUMERO DE REGISTROS
	=============================================*/

    static public function mdlMostrarNumRegistros($valor)
    {

        $stmt = Conexion::conectar()->prepare("SELECT count(documento) as contador FROM proveedor_compras 
                                
                                ");

        $stmt->execute();

        return $stmt->fetch();





        $stmt = null;
    }

    /*=============================================
	EDITAR Proveedor
	=============================================*/

    static public function mdlEditarProveedor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, ciudad = :ciudad WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
        $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
        $stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }

        $stmt = null;
    }

    /*=============================================
	ELIMINAR Proveedor
	=============================================*/

    static public function mdlEliminarProveedor($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE documento = :id");

        $stmt->bindParam(":id", $datos, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }



        $stmt = null;
    }

    /*=============================================
	ACTUALIZAR Proveedor
	=============================================*/

    static public function mdlActualizarProveedor($tabla, $item1, $valor1, $valor)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE documento = :id");

        $stmt->bindParam(":" . $item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":id", $valor, PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
        } else {

            return "error";
        }



        $stmt = null;
    }
}
