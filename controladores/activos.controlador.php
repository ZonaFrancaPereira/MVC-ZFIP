<?php

class ControladorActivos
{
	/*=============================================
	CREAR Activos
	=============================================*/

	static public function ctrCrearActivos()
	{

		if (isset($_POST["nombre_articulo"])) {

			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre_articulo"])) {

				$tabla = "activos";

				$datos = array(
                    
                    "cod_renta" => $_POST["cod_renta"],
                    
                    "nombre_articulo" => $_POST["nombre_articulo"],
                    "descripcion_articulo" => $_POST["descripcion_articulo"],
                    "modelo_articulo" => $_POST["modelo_articulo"],
                    "referencia_articulo" => $_POST["referencia_articulo"],
                    "marca_articulo" => $_POST["marca_articulo"],
                    "tipo_articulo" => $_POST["tipo_articulo"],
                    "lugar_articulo" => $_POST["lugar_articulo"],
                    "observaciones_articulo" => $_POST["observaciones_articulo"],
                    "numero_factura" => $_POST["numero_factura"],
                    "fecha_garantia" => $_POST["fecha_garantia"],
                    "valor_articulo" => $_POST["valor_articulo"],
                    "condicion_articulo" => $_POST["condicion_articulo"],
                    "id_proveedor_fk" => $_POST["id_proveedor_fk"],
                    "descripcion_proveedor" => $_POST["descripcion_proveedor"],
                    "id_usuario_fk" => $_POST["id_usuario_fk"],
                    "estado_activo" => $_POST["estado_activo"],
                    "recurso_tecnologico" => $_POST["recurso_tecnologico"]
                );

				$respuesta = ModeloActivos::mdlIngresarActivos($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					  Swal.fire(
							"Buen Trabajo!",
							"El Activos  se ha registrado con éxito.",
							"success"
							).then(function() {
							 //Limpiar el formulario
                            $("#GuardarActivo")[0].reset(); // Resetea el formulario
							$("#panelcontabilidad").removeClass("active");
                            $("#consultar_activos").addClass("active");

							});

					</script>';
				}
			} else {

				echo '<script>

					 Swal.fire(
						  type: "error",
						  title: "¡El Activos no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {
                             //Limpiar el formulario
                            $("#GuardarActivo")[0].reset(); // Resetea el formulario
							$("#panelcontabilidad").removeClass("active");
                            $("#consultar_activos").addClass("active");

							}
						})

			  	</script>';
			}
		} else {
			return "error";
		}
	}

	/*=============================================
	CREAR ASIGNACION DE EQUIPOS
	=============================================*/

	static public function ctrCrearAsignacion()
	{

		if (isset($_POST["guardar_asignacion"])) {

			

				$tabla = "asignacion_equipos";

				$datos = array(
                    
                    "fecha_asignacion" => $_POST["fecha_asignacion"],
                    "estado_asignacion" =>"Activa",
                    "id_ti_fk" => $_SESSION["id"],
                    "id_usuario_fk" => $_POST["id_usuario_fk"]
        
                );

				$respuesta = ModeloActivos::mdlIngresarAsignacion($tabla, $datos);

				if ($respuesta == "ok") {
					
					echo '<script>

					  Swal.fire(
							"Buen Trabajo!",
							"El Activos  se ha registrado con éxito.",
							"success"
							).then(function() {
							 //Limpiar el formulario
                            $("#formAsignacion")[0].reset(); // Resetea el formulario
                           window.location = "index.php?ruta=ti
                           +-e";
							

							});

					</script>';
				}
			
		} else {
			return "error";
		}
	}

    static public function ctrCrearDetallesEquipo()
{
    
    if (isset($_POST["guardar_detalles"])) {
        

        $tabla = "detalles_equipos";

        $datos = array(
            "msd" => $_POST["msd"],
            "antivirus" => $_POST["antivirus"],
            "visio_pro" => $_POST["visio_pro"],
            "mac_osx" => $_POST["mac_osx"],
            "windows" => $_POST["windows"],
            "autocad" => $_POST["autocad"],
            "office" => $_POST["office"],
            "appolo" => $_POST["appolo"],
            "zeus" => $_POST["zeus"],
            "otros" => $_POST["otros"],
            "procesador" => $_POST["procesador"],
            "disco_duro" => $_POST["disco_duro"],
            "memoria_ram" => $_POST["memoria_ram"],
            "cd_dvd" => $_POST["cd_dvd"],
            "tarjeta_video" => $_POST["tarjeta_video"],
            "tarjeta_red" => $_POST["tarjeta_red"],
            "tipo_red" => $_POST["tipo_red"],
            "tiempo_bloqueo" => $_POST["tiempo_bloqueo"],
            "usuario" => $_POST["usuario"],
            "clave" => $_POST["clave"],
            "zfip" => $_POST["zfip"],
            "privilegios" => $_POST["privilegios"],
            "observaciones_equipo" => $_POST["observaciones_equipo"],
            "backup" => $_POST["backup"],
            "dia_backup" => $_POST["dia_backup"],
            "realiza_backup" => $_POST["realiza_backup"],
            "justificacion_backup" => $_POST["justificacion_backup"],
            "id_activo_fk" => $_POST["id_activo_fk"]
        );

        $respuesta = ModeloActivos::mdlIngresarDetallesEquipo($tabla, $datos);

        if ($respuesta == "ok") {
            echo '<script>
                Swal.fire(
                    "Buen Trabajo!",
                    "Los detalles del equipo se han registrado con éxito.",
                    "success"
                ).then(function() {
                    // Limpiar el formulario
                    $("#formDetallesEquipo")[0].reset();
                    window.location = "index.php?ruta=ti";
                });
            </script>';
        }
    } else {
        return "error";
    }
}

	/*=============================================
	MOSTRAR Activos
	=============================================*/

	static public function ctrMostrarActivos($item, $valor)
	{

		$tabla = "activos";

		$respuesta = ModeloActivos::mdlMostrarActivos($tabla, $item, $valor);

		return $respuesta;
	}

    
	/*=============================================
	MOSTRAR ACTIVOS TECNOLOGICOS
	=============================================*/

	static public function ctrMostrarActivosTI($item, $valor)
	{

		$tabla = "activos";

		$respuesta = ModeloActivos::mdlMostrarActivosTI($tabla, $item, $valor);

		return $respuesta;
	}

    /*=============================================
	MOSTRAR ACTIVOS EQUIPOS TECNOLOGICOS SOLO PC
	=============================================*/

	static public function ctrMostrarEquipos($item, $valor)
	{

		$tabla = "activos";

		$respuesta = ModeloActivos::mdlMostrarEquipos($tabla, $item, $valor);

		return $respuesta;
	}
	/*=============================================
	MOSTRAR ASIGNACION DE ACTIVOS TECNOLOGICOS
	=============================================*/

	static public function ctrMostrarAsignaciones($item, $valor)
	{

		$tabla = "asignacion_equipos";

		$respuesta = ModeloActivos::mdlMostrarAsignaciones($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR Activos AJAX
	=============================================*/

	static public function ctrMostrarActivosAjax()
	{

		$tabla = "Activos";

		$respuesta = ModeloActivos::mdlMostrarActivosAjax();

		return $respuesta;
	}
    	/*=============================================
	MOSTRAR Activos fijos no verificados en el invenario
	=============================================*/
    public static function ctrMostrarActivosNoVerificados($id_inventario) {
        $tablaActivos = "activos";
        $tablaVerificaciones = "verificaciones";
        return ModeloActivos::mdlMostrarActivosNoVerificados($tablaActivos, $tablaVerificaciones, $id_inventario);
    }
    /*=============================================
	MOSTRAR ACTIVOS POR USUARIO
	=============================================*/
    public static function obtenerActivosConUsuarios() {
        // Aquí deberías realizar la consulta SQL para obtener los activos con la información de los usuarios que los tienen
        // Este es un ejemplo simplificado
        $stmt = Conexion::conectar()->prepare("
            SELECT a.id_activo, a.nombre_articulo, u.nombre AS nombre_usuario, u.apellidos_usuario
            FROM activos a
            INNER JOIN usuarios u ON a.id_usuario_fk = u.id
            ORDER BY a.nombre_articulo ASC
        ");

        $stmt->execute();
        return $stmt->fetchAll();
    }
	/*=============================================
	EDITAR Activos
	=============================================*/

    static public function ctrEditarActivos() {

        if (isset($_POST["editarActivos"])) {
    
            // Validar el campo de nombre del artículo con una expresión regular (ajustar según los requisitos)
            if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nombre_articulo"])) {
    
                $tabla = "activos"; // Nombre de la tabla en la base de datos
    
                $datos = array(
                    "id_activo" => $_POST["id_activo"],
                    "cod_renta" => $_POST["cod_renta"],
                    "fecha_asignacion" => $_POST["fecha_asignacion"],
                    "nombre_articulo" => $_POST["nombre_articulo"],
                    "descripcion_articulo" => $_POST["descripcion_articulo"],
                    "modelo_articulo" => $_POST["modelo_articulo"],
                    "referencia_articulo" => $_POST["referencia_articulo"],
                    "marca_articulo" => $_POST["marca_articulo"],
                    "tipo_articulo" => $_POST["tipo_articulo"],
                    "lugar_articulo" => $_POST["lugar_articulo"],
                    "observaciones_articulo" => $_POST["observaciones_articulo"],
                    "numero_factura" => $_POST["numero_factura"],
                    "fecha_garantia" => $_POST["fecha_garantia"],
                    "valor_articulo" => $_POST["valor_articulo"],
                    "condicion_articulo" => $_POST["condicion_articulo"],
                    "id_proveedor_fk" => $_POST["id_proveedor_fk"],
                    "descripcion_proveedor" => $_POST["descripcion_proveedor"],
                    "id_usuario_fk" => $_POST["id_usuario_fk"],
                    "estado_activo" => $_POST["estado_activo"],
                    "recurso_tecnologico" => $_POST["recurso_tecnologico"]
                );
    
                $respuesta = ModeloActivos::mdlEditarActivos($tabla, $datos);
    
                if ($respuesta == "ok") {
                    echo '<script>
                        Swal.fire(
                            type: "success",
                            title: "El activo ha sido cambiado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result) {
                            if (result.value) {
                                window.location = "Activos";
                            }
                        });
                    </script>';
                } else {
                    echo '<script>
                        Swal.fire(
                            type: "error",
                            title: "¡Hubo un error al cambiar el activo!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result) {
                            if (result.value) {
                                window.location = "Activos";
                            }
                        });
                    </script>';
                }
            } else {
                echo '<script>
                    Swal.fire(
                        type: "error",
                        title: "¡El nombre del artículo no puede ir vacío o llevar caracteres especiales!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "Activos";
                        }
                    });
                </script>';
            }
        }
    }

	/*=============================================
	ELIMINAR Activos
	=============================================*/

	static public function ctrEliminarActivos()
	{

		if (isset($_POST["id_activo"])) {

			$tabla = "activos";
			$datos = $_POST["id_activo"];

			$respuesta = ModeloActivos::mdlEliminarActivos($tabla, $datos);

			if ($respuesta == "ok") {

				echo 'ok';
			}
		}
	}
    /*=============================================
    TRANSFERIR ACTIVO
    =============================================*/
     // Función para transferir un activo de un usuario a otro
     public static function ctrTransferirActivo() {
        if (isset($_POST["id_activo"], $_POST["usuario_destino"], $_POST["observaciones"])) {
            // Obtener los datos del formulario POST
            $id_activo = $_POST["id_activo"];
            $usuario_destino = $_POST["usuario_destino"];
            $observaciones = $_POST["observaciones"];
            
            // Obtener el usuario origen del activo
            $item = "id_activo";
            $valor = $id_activo;
            $activos = ControladorActivos::ctrMostrarActivos($item, $valor);
            $usuario_origen = null;
            foreach ($activos as $row) {
                $usuario_origen = $row['id_usuario_fk'];
            }

            // Verificar si se encontró el usuario origen
            if ($usuario_origen === null) {
                // Manejar el caso donde no se pudo obtener el usuario origen
                echo '<script>
                    Swal.fire(
                        type: "error",
                        title: "Error al obtener el usuario origen del activo.",
                        text: "Por favor, inténtelo de nuevo.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "Activos";
                        }
                    });
                </script>';
                return;
            }

            // Preparar los datos para la transferencia
            $datos = array(
                "id_activo" => $id_activo,
                "usuario_origen" => $usuario_origen,
                "usuario_destino" => $usuario_destino,
                "observaciones" => $observaciones
            );

            // Registrar la transferencia en el historial
            $respuestaHistorial = ModeloActivos::mdlRegistrarTransferencia($datos);

            // Actualizar el usuario del activo
            $respuestaActivo = ModeloActivos::mdlActualizarUsuarioActivo($datos);

            // Manejo de respuestas
            if ($respuestaHistorial == "ok" && $respuestaActivo == "ok") {
                echo '<script>
                    Swal.fire(
                        type: "success",
                        title: "El activo ha sido cambiado correctamente",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "inicio";
                        }
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire(
                        type: "error",
                        title: "¡Hubo un error al cambiar el activo!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "inicio";
                        }
                    });
                </script>';
            }
        } else {
            // Manejar el caso donde faltan parámetros en el POST
            echo '<script>
                Swal.fire(
                    type: "error",
                    title: "Faltan parámetros para transferir el activo.",
                    text: "Por favor, complete todos los campos requeridos.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                }).then(function(result) {
                    if (result.value) {
                        window.location = "inicio";
                    }
                });
            </script>';
        }
    }

/*=============================================
TRANSFERIR ACTIVOS DE UN USUARIO A OTRO
=============================================*/
public static function ctrTransferirActivosUsuarioMasivo() {
    if (isset($_POST["usuario_origen"], $_POST["usuario_destino"], $_POST["observaciones"])) {
        $usuario_origen = $_POST["usuario_origen"];
        $usuario_destino = $_POST["usuario_destino"];
        $observaciones = $_POST["observaciones"];

        // Obtener todos los activos del usuario origen
        $item = "id_usuario_fk";
        $valor = $usuario_origen;
        $activos_usuario_origen = ControladorActivos::ctrMostrarActivos($item, $valor);

        // Iterar sobre los activos y transferir cada uno al usuario destino
        foreach ($activos_usuario_origen as $activo) {
            $datos = array(
                "id_activo" => $activo["id_activo"],
                "usuario_origen" => $usuario_origen,
                "usuario_destino" => $usuario_destino,
                "observaciones" => $observaciones
            );

            // Registrar la transferencia en el historial
            $respuestaHistorial = ModeloActivos::mdlRegistrarTransferencia($datos);

            // Actualizar el usuario del activo
            $respuestaActivo = ModeloActivos::mdlActualizarUsuarioActivo($datos);

            // Verificar si hubo algún error en la transferencia
            if ($respuestaHistorial != "ok" || $respuestaActivo != "ok") {
                echo '<script>
                    Swal.fire(
                        type: "error",
                        title: "¡Hubo un error al cambiar el activo!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result) {
                        if (result.value) {
                            window.location = "inicio";
                        }
                    });
                </script>';
                return; // Salir del proceso si hay errores
            }
        }

        // Si se transfieren todos los activos correctamente
        echo '<script>
            Swal.fire(
                type: "success",
                title: "Los activos han sido transferidos correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            }).then(function(result) {
                if (result.value) {
                    window.location = "inicio";
                }
            });
        </script>';
    } else {
        echo '<script>
            Swal.fire(
                type: "error",
                title: "Faltan datos requeridos para la transferencia de activos",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
            }).then(function(result) {
                if (result.value) {
                    window.location = "inicio";
                }
            });
        </script>';
    }
}

public static function graficaVerificacionActivos() {
    // Obtener datos del modelo
  
    $verificados = ModeloActivos::contarActivosVerificados();
    $total_activos = ModeloActivos:: contarTotalActivos();

    // Calcular activos no verificados
    $no_verificados = $total_activos - $verificados;

    // Preparar datos para la vista
    $data = [
        'verificados' => $verificados,
        'no_verificados' => $no_verificados
    ];

    
    echo json_encode($data); 
}

  // Método para contar activos por usuario
  public static function ctrContarActivosPorUsuario($idUsuario) {
    return ModeloActivos::contarActivosPorUsuario($idUsuario);
}

// Método para contar activos inactivos por usuario
public static function ctrContarActivosInactivosPorUsuario($idUsuario) {
    return ModeloActivos::contarActivosInactivosPorUsuario($idUsuario);
}
public static function ctrGraficaTI()
{
    $respuesta = ModeloActivos::mdlContarActivosPorCategoria();
    echo json_encode($respuesta);
}


}


/*=============================================
CREAR Activos
=============================================*/


if (isset($_POST["guardarAjax"])) {


	require_once "../modelos/Activos.modelo.php";


	$crearActivos = new ControladorActivos();
	$respuesta = $crearActivos->ctrCrearActivos();

	echo  $respuesta;
}

/*=============================================
LEER Activos AJAX
=============================================*/



if (isset($_POST["ajaxActivos"])) {

	require_once "../modelos/activos.modelo.php";

	$leerActivos = new ControladorActivos();
	$respuesta = $leerActivos->ctrMostrarActivosAjax();

	echo json_encode($respuesta);
}

// Manejar la acción de la solicitud AJAX
if (isset($_GET['action']) && $_GET['action'] == 'graficaVerificacionActivos') {
    require_once '../modelos/activos.modelo.php';
    $modelo = new ModeloActivos();
    $controlador = new ControladorActivos($modelo);
    $controlador->graficaVerificacionActivos();
}

if (isset($_GET['action']) && $_GET['action'] == 'graficaCategorias') {
    require_once '../modelos/activos.modelo.php';
$modelo = new ModeloActivos();
$controlador = new ControladorActivos($modelo);
   
    $controlador->ctrGraficaTI();
}