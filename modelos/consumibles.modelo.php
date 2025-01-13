<?php
require_once "conexion.php";

class ModeloConsumibles{



    /*=============================================
        MOSTRAR IMPRESORAS
        =============================================*/

    static public function mdlMostrarImpresoras($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
          
            case 'impresora-consumibles':

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                
                // Retornar todos los resultados
                return $stmt->fetchAll();
                $stmt = null;
                break;

                case 'consumibles-utilizados':

                    $stmt = Conexion::conectar()->prepare("SELECT a.*,b.*,c.* FROM 
                    registro_consumible a 
                    INNER JOIN impresoras b ON b.id_impresora = a.id_impresora_fk 
                    INNER JOIN consumibles c ON c.id_tipo_consumible = a.id_tipo_consumible_fk");
                    $stmt->execute();
                    
                    // Retornar todos los resultados
                    return $stmt->fetchAll();
                    $stmt = null;
                    break;

                default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
        
    }

    static public function mdlMostrarImpresora($tabla, $item, $valor)
    {
        try {
            // Conectar a la base de datos
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

            // Ejecutar la consulta
            $stmt->execute();

            // Retornar todos los resultados
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo de todos los consumibles

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage(); // Manejo de errores
            return [];
        }

        
    }
        /*=============================================
        MOSTRAR CONSUMIBLES
        =============================================*/

        static public function mdlMostrarConsumibles($tabla, $item, $valor, $consulta)
        {
            switch ($consulta) {
              
                case 'nombre-consumible':
    
                    $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
                    $stmt->execute();
                    return $stmt->fetchAll();
                    $stmt = null;
                    break;

                    case 'factura-consumible':
                        $stmt = Conexion::conectar()->prepare(
                            "SELECT a.*, b.* FROM  compras_consumibles a INNER JOIN consumibles b ON  b.id_tipo_consumible = a.tipo_consumible" );
                        $stmt->execute();
                        $result = $stmt->fetchAll(); // Usar fetchAll() para obtener todos los resultados
                        $stmt = null;
                        return $result;
                        break;
                    
    
                    default:
                    $consulta = null;
                    $item = null;
                    $valor = null;
                    break;
            }
            
        }




              /*=============================================
        MOSTRAR  TIPO CONSUMIBLES
        =============================================*/

        static public function mdlMostrarTipoConsumibles($tabla, $item, $valor)
        {
            try {
                // Conectar a la base de datos
                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
    
                // Ejecutar la consulta
                $stmt->execute();
    
                // Retornar todos los resultados
                return $stmt->fetchAll(PDO::FETCH_ASSOC); // Devuelve un array asociativo de todos los consumibles
    
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage(); // Manejo de errores
                return [];
            }
    
            
        }


    
    /*=============================================
        CREAR IMPRESORA
        =============================================*/

    static public function mdlCrearImpresora($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO $tabla(
                    nombre_impresora, 
                    modelo_impresora, 
                    serial_impresora, 
                    ubicacion_impresora
            ) VALUES (
                   :nombre_impresora, 
                   :modelo_impresora, 
                   :serial_impresora, 
                   :ubicacion_impresora
                )");
    
            $stmt->bindParam(":nombre_impresora", $datos["nombre_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":modelo_impresora", $datos["modelo_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":serial_impresora", $datos["serial_impresora"], PDO::PARAM_STR);
            $stmt->bindParam(":ubicacion_impresora", $datos["ubicacion_impresora"], PDO::PARAM_STR);

    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error en ejecución SQL";
            }
        } catch (PDOException $e) {
            return "error en consulta: " . $e->getMessage(); // Muestra mensaje de error
        }

    }

        
    /*=============================================
       CREAR FACTURA
        =============================================*/


        static public function mdlCrearFactura($tablaCompras, $datosCompra)
        {
            try {
                $pdo = Conexion::conectar();
                $stmt = $pdo->prepare("INSERT INTO $tablaCompras(
                       fecha_compra, 
                       tipo_consumible, 
                       cantidad_adquirida, 
                       precio_unitario, 
                       total_compra, 
                       proveedor_consumible, 
                       numero_factura
                ) VALUES (
                       :fecha_compra, 
                       :tipo_consumible, 
                       :cantidad_adquirida, 
                       :precio_unitario, 
                       :total_compra, 
                       :proveedor_consumible, 
                       :numero_factura
                    )");
        
                $stmt->bindParam(":fecha_compra", $datosCompra["fecha_compra"], PDO::PARAM_STR);
                $stmt->bindParam(":tipo_consumible", $datosCompra["tipo_consumible"], PDO::PARAM_INT);
                $stmt->bindParam(":cantidad_adquirida", $datosCompra["cantidad_adquirida"], PDO::PARAM_STR);
                $stmt->bindParam(":precio_unitario", $datosCompra["precio_unitario"], PDO::PARAM_STR);
                $stmt->bindParam(":total_compra", $datosCompra["total_compra"], PDO::PARAM_STR);
                $stmt->bindParam(":proveedor_consumible", $datosCompra["proveedor_consumible"], PDO::PARAM_STR);
                $stmt->bindParam(":numero_factura", $datosCompra["numero_factura"], PDO::PARAM_STR);
    
        
                if ($stmt->execute()) {
                    return "ok";
                } else {
                    return "error en ejecución SQL";
                }
            } catch (PDOException $e) {
                return "error en consulta: " . $e->getMessage(); // Muestra mensaje de error
            }
    
        }

        /*=============================================
       ACTUALIZAR EN LA TABLA CONSUMIBLES LA CANTIDAD PARA QUE LA SUME
        =============================================*/


        static public function mdlActualizarEntrada($tablaConsumibles, $idTipoConsumible, $cantidadAdquirida)
        {
            try {
                $pdo = Conexion::conectar();
                $stmt = $pdo->prepare("UPDATE $tablaConsumibles SET entrada = entrada + :cantidadAdquirida WHERE id_tipo_consumible = :idTipoConsumible");
        
                $stmt->bindParam(":cantidadAdquirida", $cantidadAdquirida, PDO::PARAM_INT);
                $stmt->bindParam(":idTipoConsumible", $idTipoConsumible, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    return "ok";
                } else {
                    // Capturar información de depuración
                    $errorInfo = $stmt->errorInfo();
                    return "error en ejecución SQL: " . $errorInfo[2]; // Mensaje detallado de error
                }
            } catch (PDOException $e) {
                return "error en consulta: " . $e->getMessage();
            }
        }
        

      
    /*=============================================
       CREAR CONSUMIBLE
        =============================================*/
        static public function mdlCrearConsumible($tabla, $datos)
        {
            try {
                $pdo = Conexion::conectar();
                $stmt = $pdo->prepare("INSERT INTO $tabla(
                       nombre_consumible

                ) VALUES (
                       :nombre_consumible

                    )");
        
                $stmt->bindParam(":nombre_consumible", $datos["nombre_consumible"], PDO::PARAM_STR);
        
                if ($stmt->execute()) {
                    return "ok";
                } else {
                    return "error en ejecución SQL";
                }
            } catch (PDOException $e) {
                return "error en consulta: " . $e->getMessage(); // Muestra mensaje de error
            }
    
        }


            
    /*=============================================
       REGISTRAR CONSUMIBLE
        =============================================*/

    static public function mdlIngresarConsumible($tabla, $datos)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO $tabla(
                    id_impresora_fk, 
                    id_tipo_consumible_fk,
                    fecha_instalacion, 
                    cantidad_utilizada
            ) VALUES (
                   :id_impresora_fk, 
                   :id_tipo_consumible_fk,
                   :fecha_instalacion, 
                   :cantidad_utilizada
                )");
    
            $stmt->bindParam(":id_impresora_fk", $datos["id_impresora_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":id_tipo_consumible_fk", $datos["id_tipo_consumible_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_instalacion", $datos["fecha_instalacion"], PDO::PARAM_STR);
            $stmt->bindParam(":cantidad_utilizada", $datos["cantidad_utilizada"], PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error en ejecución SQL";
            }
        } catch (PDOException $e) {
            return "error en consulta: " . $e->getMessage(); // Muestra mensaje de error
        }

    }

       /*=============================================
       ACTUALIZAR EN LA TABLA CONSUMIBLES LA CANTIDAD PARA QUE LA SUME
        =============================================*/


        static public function mdlActualizarSalida($tablaSalida, $idTipo, $cantidadUtilizada)
        {
            try {
                $pdo = Conexion::conectar();
                $stmt = $pdo->prepare("UPDATE $tablaSalida SET salida = salida + :cantidadUtilizada WHERE id_tipo_consumible = :idTipo");
        
                $stmt->bindParam(":cantidadUtilizada", $cantidadUtilizada, PDO::PARAM_INT);
                $stmt->bindParam(":idTipo", $idTipo, PDO::PARAM_INT);
        
                if ($stmt->execute()) {
                    return "ok";
                } else {
                    // Capturar información de depuración
                    $errorInfo = $stmt->errorInfo();
                    return "error en ejecución SQL: " . $errorInfo[2]; // Mensaje detallado de error
                }
            } catch (PDOException $e) {
                return "error en consulta: " . $e->getMessage();
            }
        }





}










