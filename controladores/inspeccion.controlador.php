<?php

class ControladorInspeccion
{

/*=============================================
CONTROLADOR DE INSPECCIÓN 
=============================================*/
public static function ctrGuardarInspeccion() {
    if (isset($_POST["id_cliente_fk"])) {	
        $img = $_POST['base64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $fileData = base64_decode($img);
        $fileName = uniqid() . '.png';
        file_put_contents("vistas/img/usuarios/firmas_inspeccion/" . $fileName, $fileData);
        $ruta="vistas/img/usuarios/firmas_inspeccion/".$fileName;
        // Asegurarse de que cada checkbox tenga un valor por defecto de 0 si no está marcado
        $datos = [
            "id_cliente_fk" => $_POST["id_cliente_fk"],
            "ingreso_salida" => $_POST["ingreso_salida"],
            "id_categoriaop_fk" => $_POST["id_categoriaop_fk"],
            "otro" => $_POST["otro"],  
            "transito" => $_POST["transito"],
            "fmm" => $_POST["fmm"],
            "arin" => $_POST["arin"],
            "documento" => $_POST["documento"],
            "fisico" => $_POST["fisico"],
            "estado" => $_POST["estado"],
            "descripcion_observaciones" => $_POST["descripcion_observaciones"],
            "nombre_firma" => $_POST["nombre_firma"],
            "cc_firma" => $_POST["cc_firma"],
            "firma_recibido"=>$ruta,
            "id_usuario_fk" => $_SESSION["id"]

        ];

        // Llamar al modelo para realizar el insert
        $respuesta = ModeloInspeccion::mdlGuardarInspeccion($datos);

        if ($respuesta == "ok") {
            echo '<script>
                Swal.fire(
                "Buen Trabajo!",
                "La inspección se ha registrado con éxito.",
                "success"
                ).then(function() {
                    document.getElementById("GuardarInspeccion").reset();
                });
            </script>';
        } else {
            echo '<script>
                Swal.fire({
                    type: "error",
                    title: "¡Error al registrar la inspección!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                });
            </script>';
        }
    }
}
	/*=============================================
	MOSTRAR CATEGORIAS INSPECCCION 
	=============================================*/

	static public function ctrMostrarCategoriasOp($item, $valor)
	{

		$tabla = "categoria_op";

		$respuesta = ModeloInspeccion::mdlMostrarCategoriaOp($tabla, $item, $valor);

		return $respuesta;
	}

    	/*=============================================
	MOSTRAR  INSPECCCION 
	=============================================*/

	static public function ctrMostrarInspeccion($item, $valor)
	{

		$tabla = "inspeccion_op";

		$respuesta = ModeloInspeccion::mdlMostrarInspeccion($tabla, $item, $valor);

		return $respuesta;
	}

    /*=============================================
	GRAFICAS INSPECCIONES
	=============================================*/
    public function graficaInspeccionesZFIPClinica()
    {
        // Obtén los resultados del modelo
        $resultados = ModeloInspeccion::mdlGraficaInspeccionesZFIPClinica();
    
        // Nombres de los meses
        $meses = [
            1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
            7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
        ];
    
        // Estructura los datos para el gráfico (por meses del año)
        $labels = [];
        $zfipData = [];
        $clinicaData = [];
    
        // Recorrer los resultados y estructurarlos para el gráfico
        foreach ($resultados as $anio => $mesesData) {
            foreach ($mesesData as $mes => $tipos) {
                // Asignar el nombre del mes correspondiente
                $labels[] = $meses[$mes]; // Usar el nombre del mes en lugar del número
    
                // Asignar el total de inspecciones por tipo
                $zfipData[] = isset($tipos['zfip']) ? $tipos['zfip'] : 0;
                $clinicaData[] = isset($tipos['clinica']) ? $tipos['clinica'] : 0;
            }
        }
    
        // Crear el arreglo con los datos finales para el gráfico
        $graficaData = [
            'labels' => $labels,
            'zfipData' => $zfipData,
            'clinicaData' => $clinicaData
        ];
    
        // Devuelve los resultados en formato JSON para que JavaScript lo procese
        echo json_encode($graficaData);
    }

  /*=============================================
	CONTAR USUARIOS POR ZFIP
	=============================================*/
    public static function ctrContarUsuariosPorTipoZF()
    {
        return ModeloInspeccion::mdlContarUsuariosPorTipoZF();
    }
 /*=============================================
	CONTAR POR INSPECCIONES ZFIP
	=============================================*/
    public static function ctrContarInspeccionesPorTipoZF()
    {
        return ModeloInspeccion::mdlContarInspeccionesPorTipoZF();
    }

    


	
}


if (isset($_GET['action']) && $_GET['action'] == 'graficaInspecciones') {
    require_once '../modelos/inspeccion.modelo.php';
    $modelo = new ModeloInspeccion();
    $controlador = new ControladorInspeccion($modelo);
    $controlador->graficaInspeccionesZFIPClinica();
}