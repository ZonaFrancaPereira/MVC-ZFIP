<?php

class ControladorMantenimiento
{
    static public function ctrCrearMantenimiento()
    {
        if (isset($_POST["fecha_mantenimiento"])) {
            $tabla = "mantenimientos";
            $datos = array(
                "fecha_mantenimiento" => $_POST["fecha_mantenimiento"],
                "id_usuario_fk" => $_POST["id_usuario_fk"],
                "marca" => $_POST["marca"],
                "modelo" => $_POST["modelo"],
                "serie" => $_POST["serie"],
                "usuario_equipo" => $_POST["usuario_equipo"],
                "soplar_partes_externas" => $_POST["soplar_partes_externas"],
                "lubricar_puertos" => $_POST["lubricar_puertos"],
                "limpieza_equipo" => $_POST["limpieza_equipo"],
                "limpiar_partes_interna" => $_POST["limpiar_partes_interna"],
                "verificar_usuario" => $_POST["verificar_usuario"],
                "contra" => $_POST["contra"],
                "formato_asignacion_equipo" => $_POST["formato_asignacion_equipo"],
                "depurar_temporales" => $_POST["depurar_temporales"],
                "liberar_espacio" => $_POST["liberar_espacio"],
                "desinstalar_programas" => $_POST["desinstalar_programas"],
                "actualizar_logos" => $_POST["actualizar_logos"],
                "verificar_actualizaciones" => $_POST["verificar_actualizaciones"],
                "desfragmentar" => $_POST["desfragmentar"],
                "usuario" => $_POST["usuario"],
                "clave" => $_POST["clave"],
                "estandar" => $_POST["estandar"],
                "administrador" => $_POST["administrador"],
                "analisis_completo" => $_POST["analisis_completo"],
                "bloqueo_usb" => $_POST["bloqueo_usb"],
                "dominio_zfip" => $_POST["dominio_zfip"],
                "apagar_pantalla" => $_POST["apagar_pantalla"],
                "estado_suspension" => $_POST["estado_suspension"],
                "firma" => $_POST["firma"],
                "estado_mantenimiento_equipo" => $_POST["estado_mantenimiento_equipo"]


            );

            // Inserta los datos en la base de datos
            $respuesta = ModeloMantenimiento::mdlIngresarMantenimiento($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                    "Buen Trabajo!",
                    "El Mantenimiento fue creado con éxito.",
                    "success"
                    ).then(function() {
                    $("#equipo").addClass("active");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al crear el mantenimiento. ,
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#equipo").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrCrearMantenimientoImpresora()
    {
        if (isset($_POST["fecha_mantenimiento_impresora"])) {
            $tabla = "mantenimiento_impresora";
            $datos = array(
                "fecha_mantenimiento_impresora" => $_POST["fecha_mantenimiento_impresora"], 
                "id_usuario_fk2" => $_POST["id_usuario_fk2"],
                "nombre_impresora" => $_POST["nombre_impresora"], 
                "marca_impresora" => $_POST["marca_impresora"], 
                "modelo_impresora" => $_POST["modelo_impresora"], 
                "serial_impresora" => $_POST["serial_impresora"], 
                "soplar_exterior" => $_POST["soplar_exterior"], 
                "isopropilico" => $_POST["isopropilico"], 
                "toner" => $_POST["toner"], 
                "alinear" => $_POST["alinear"], 
                "verificar_cableado" => $_POST["verificar_cableado"], 
                "rodillos" => $_POST["rodillos"], 
                "reemplazar" => $_POST["reemplazar"], 
                "limpiar" => $_POST["limpiar"], 
                "imprimir" => $_POST["imprimir"], 
                "verificar" => $_POST["verificar"], 
                "estado_mantenimiento_impresora" => $_POST["estado_mantenimiento_impresora"], 
                "firma_impresora" => $_POST["firma_impresora"]
            );

            // Inserta los datos en la base de datos
            $respuesta = ModeloMantenimiento::mdlIngresarMantenimientoImpresora($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                    "Buen Trabajo!",
                    "El Mantenimiento de esta Impresora fue creado con éxito.",
                    "success"
                    ).then(function() {
                    $("#impresora").addClass("active");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al crear el mantenimiento. ,
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#impresora").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrCrearMantenimientoGeneral()
    {
        if (isset($_POST["fecha_mantenimiento3"])) {
            $tabla = "mantenimiento_general";
            $datos = array(

                "fecha_mantenimiento3" => $_POST["fecha_mantenimiento3"], 
                "id_usuario_fk3" => $_POST["id_usuario_fk3"], 
                "articulo" => $_POST["articulo"], 
                "marca_general" => $_POST["marca_general"], 
                "modelo_general" => $_POST["modelo_general"], 
                "serial_general" => $_POST["serial_general"], 
                "partes_externas" => $_POST["partes_externas"], 
                "condiciones_fisicas" => $_POST["condiciones_fisicas"], 
                "cableado_verificar" => $_POST["cableado_verificar"], 
                "dispositivo" => $_POST["dispositivo"], 
                "estado_general" => $_POST["estado_general"], 
                "firma_general" => $_POST["firma_general"]
            );

            // Inserta los datos en la base de datos
            $respuesta = ModeloMantenimiento::mdlIngresarMantenimientoGeneral($tabla, $datos);

            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                    "Buen Trabajo!",
                    "El Mantenimiento General fue creado con éxito.",
                    "success"
                    ).then(function() {
                    $("#general").addClass("active");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al crear el mantenimiento. ,
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#general").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }

    static public function ctrMostrarMantenimiento($item, $valor, $consulta)
    {
        $tabla = "mantenimientos";

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimiento($tabla, $item, $valor, $consulta);
        return $respuesta;
    }
   

    static public function ctrMostrarMantenimientoImpresora($item, $valor, $consulta)
    {
        $tabla = "mantenimiento_impresora";

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimientoImpresora($tabla, $item, $valor, $consulta);
        return $respuesta;
    }


    static public function ctrMostrarMantenimientoGeneral($item, $valor, $consulta)
    {
        $tabla = "mantenimiento_general";

        $respuesta = ModeloMantenimiento::mdlMostrarMantenimientoGeneral($tabla, $item, $valor, $consulta);
        return $respuesta;
    }
   

    static public function ctrFirmarMantenimiento()
    {
        if (isset($_POST["firma"])) {
            var_dump($_POST); // Para depurar
            $tabla = "mantenimientos";
            $datos = array(
                "id_mantenimiento" => $_POST["id_mantenimiento"],
                "firma" => $_POST["firma"],
                "estado_mantenimiento_equipo" => "Firmado"
            );
    
            $respuesta = ModeloMantenimiento::mdlFirmarMantenimiento($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                    Swal.fire(
                    "Buen Trabajo!",
                    "El Mantenimiento General fue firmado con éxito.",
                    "success"
                    ).then(function() {
                        // Cambia el selector a un elemento válido
                        $("#someElement").addClass("active");
                    });
                </script>';
            } else {
                echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "¡Error!",
                        text: "Hubo un problema al firmar el mantenimiento: ' . $respuesta . '",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#someElement").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }
    
    
}
