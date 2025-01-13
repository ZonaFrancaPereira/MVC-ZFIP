<?php

require_once "conexion.php";

class ModeloBackup
{


    /*=============================================
	MOSTRAR USUARIOS
	=============================================*/

    public static function mdlMostrarBackup($tabla, $item, $valor, $consulta)
    {
        switch ($consulta) {
          
            case 'backup':
                // Preparar y ejecutar la consulta
                $conexion = Conexion::conectar();
                $stmt = $conexion->prepare("SELECT * FROM usuarios"); 
                $stmt->execute();
            
                // Retornar todos los resultados
                $resultados = $stmt->fetchAll();
            
                // Cerrar la conexión y liberar recursos
                $stmt = null;
                $conexion = null;
            
                return $resultados;
                break;
            case 'backup-Verificar':
                    // Preparar y ejecutar la consulta
                    $conexion = Conexion::conectar();
                    $stmt = $conexion->prepare("SELECT usuarios.*, copias_seguridad.carpeta_backup, copias_seguridad.verificado
                        FROM  usuarios 
                        INNER JOIN copias_seguridad 
                        ON usuarios.id = copias_seguridad.id_usuario_backup_fk
                    ");
                    $stmt->execute();
                
                    // Retornar todos los resultados
                    $resultados = $stmt->fetchAll();
                
                    // Cerrar la conexión y liberar recursos
                    $stmt = null;
                    $conexion = null;
                
                    return $resultados;
                    break;
                case 'backup-Panel':
                       // Obtener el ID del usuario que inició sesión desde la sesión
                $id_usuario = $_SESSION["id"];
                        // Preparar y ejecutar la consulta
                        $conexion = Conexion::conectar();
                        $stmt = $conexion->prepare("SELECT usuarios.*, copias_seguridad.carpeta_backup, copias_seguridad.verificado,  copias_seguridad.fecha_verificacion,  copias_seguridad.observaciones_copia
                            FROM  usuarios 
                            INNER JOIN copias_seguridad 
                            ON usuarios.id = copias_seguridad.id_usuario_backup_fk
                        WHERE usuarios.id = :id_usuario");
                        $stmt->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
                        $stmt->execute();
                    
                        // Retornar todos los resultados
                        $resultados = $stmt->fetchAll();
                    
                        // Cerrar la conexión y liberar recursos
                        $stmt = null;
                        $conexion = null;
                    
                        return $resultados;
                        break;
                default:
                $consulta = null;
                $item = null;
                $valor = null;
                break;
        }
    }

    /*=============================================
        ASIGNAR RUTA
        =============================================*/

    public static function mdlAsignarRuta($tabla,$datos)
    {
        try {
            $pdo = Conexion::conectar();
            $stmt = $pdo->prepare("INSERT INTO $tabla(
                    id_usuario_backup_fk, 
                    carpeta_backup,
                    verificado
            ) VALUES (
                   :id_usuario_backup_fk, 
                   :carpeta_backup,
                   :verificado
                )");
    
            $stmt->bindParam(":id_usuario_backup_fk", $datos["id_usuario_backup_fk"], PDO::PARAM_INT);
            $stmt->bindParam(":carpeta_backup", $datos["carpeta_backup"], PDO::PARAM_STR);
            $stmt->bindParam(":verificado", $datos["verificado"], PDO::PARAM_STR);

    
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
        INSERTAR VERIFICACION DE LA COPIA SEMANAL
        =============================================*/

        public static function mdlVerificarCopia($tabla,$datos)
        {
            try {
                $pdo = Conexion::conectar();
                $stmt = $pdo->prepare("INSERT INTO $tabla(
                        id_usuario_backup_fk, 
                        carpeta_backup, 
                        fecha_verificacion, 
                        verificado,
                        observaciones_copia
                ) VALUES (
                        :id_usuario_backup_fk, 
                        :carpeta_backup, 
                        :fecha_verificacion, 
                        :verificado,
                        :observaciones_copia
                    )");
        
                $stmt->bindParam(":id_usuario_backup_fk", $datos["id_usuario_backup_fk"], PDO::PARAM_INT);
                $stmt->bindParam(":carpeta_backup", $datos["carpeta_backup"], PDO::PARAM_STR);
                $stmt->bindParam(":fecha_verificacion", $datos["fecha_verificacion"], PDO::PARAM_STR);
                $stmt->bindParam(":verificado", $datos["verificado"], PDO::PARAM_STR);
                $stmt->bindParam(":observaciones_copia", $datos["observaciones_copia"], PDO::PARAM_STR);
    
        
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
             MOSTRAR EL FORMATO DE LAS VERIFICACIONES DE COPIAS DE SEGURIDAD 
                =============================================*/

                public static function mdlMostrarBackuppdf($tabla, $item, $valor, $consulta)
                {
                    try {
                        // Conectar a la base de datos
                        $stmt = Conexion::conectar()->prepare("SELECT 
                                a.id_usuario_backup_fk,
                                a.id_backup,
                                a.carpeta_backup,
                                a.fecha_verificacion,
                                a.verificado,
                                a.observaciones_copia,
                                u.nombre,
                                u.apellidos_usuario,
                                p.nombre_proceso
                            FROM $tabla a
                            INNER JOIN usuarios u ON a.id_usuario_backup_fk = u.id
                            INNER JOIN proceso p ON u.id_proceso_fk = p.id_proceso
                            WHERE $item = :$item
                        ");
                
                        // Vincular el parámetro de la consulta
                        $stmt->bindParam(":$item", $valor, PDO::PARAM_INT);
                
                        // Ejecutar la consulta
                        $stmt->execute();
                
                        // Devolver los resultados
                        return $stmt->fetchAll();
                    } catch (PDOException $e) {
                        // Manejo de errores
                        die("Error al obtener datos del Backup: " . $e->getMessage());
                    }
                }
                

}
