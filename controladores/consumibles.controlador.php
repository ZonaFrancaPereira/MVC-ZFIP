<?php

class ControladorConsumibles{


 /*=============================================
	MOSTRAR IMPRESORAS
	=============================================*/

    static public function ctrMostrarImpresoras($item, $valor, $consulta)
    {
        $tabla = "impresoras";

        $respuesta = ModeloConsumibles::mdlMostrarImpresoras($tabla, $item, $valor, $consulta);

        return $respuesta;

    }

    
 /*=============================================
	MOSTRAR IMPRESORAS EN EL DATALIS
	=============================================*/

    static public function ctrMostrarImpresora($item, $valor)
    {
        $tabla = "impresoras";

        $respuesta = ModeloConsumibles::mdlMostrarImpresora($tabla, $item, $valor);

        return $respuesta;

    }

 /*=============================================
	MOSTRAR CONSUMIBLE
	=============================================*/

    static public function ctrMostrarConsumible($item, $valor, $consulta)
    {
        $tabla = "consumibles";

        $respuesta = ModeloConsumibles::mdlMostrarConsumibles($tabla, $item, $valor, $consulta);

        return $respuesta;

    }


     /*=============================================
	MOSTRAR TIPO DE CONSUMIBLE
	=============================================*/

    static public function ctrMostrarTipoConsumible($item, $valor)
    {
        $tabla = "consumibles";

        $respuesta = ModeloConsumibles::mdlMostrarTipoConsumibles($tabla, $item, $valor);

        return $respuesta;

    }


    /*=============================================
        CREAR IMPRESORAS
        =============================================*/

    static public function ctrCrearImpresora()
    {
        if (isset($_POST["ubicacion_impresora"])) {

            $tabla = "impresoras";

            $datos = array(
                "nombre_impresora" => $_POST["nombre_impresora"],
                "modelo_impresora" => $_POST["modelo_impresora"],
                "serial_impresora" => $_POST["serial_impresora"],
                "ubicacion_impresora" => $_POST["ubicacion_impresora"]
                
            );
    
            $respuesta = ModeloConsumibles::mdlCrearImpresora($tabla, $datos);
    
            if ($respuesta == "ok") {
                echo '<script>
                        Swal.fire(
                        "Buen Trabajo!",
                        "la Impresora ha sido creada con EXITO.",
                        "success"
                        ).then(function() {
                        document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                        $("#").addClass("active");
                        });
                    </script>
                ';
            } else {
                echo '<script>
                    Swal.fire({
                        type: "error",
                        title: "¡La Respuesta no pudo ser guardada!",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if(result.value){
                            $("#").addClass("active");
                        }
                    });
                </script>';
            }
        }
    }



    /*=============================================
        CREAR FACTURA
        =============================================*/

        static public function ctrCrearFactura()
        {
            if (isset($_POST["numero_factura"])) {
        
                $tablaCompras = "compras_consumibles";
                $tablaConsumibles = "consumibles";
        
                $datosCompra = array(
                    "fecha_compra" => $_POST["fecha_compra"],
                    "tipo_consumible" => $_POST["tipo_consumible"],
                    "cantidad_adquirida" => $_POST["cantidad_adquirida"],
                    "precio_unitario" => $_POST["precio_unitario"],
                    "total_compra" => $_POST["total_compra"],
                    "proveedor_consumible" => $_POST["proveedor_consumible"],
                    "numero_factura" => $_POST["numero_factura"]
                );
        
                // Insertar los datos en la tabla compras_consumibles
                $respuestaCompra = ModeloConsumibles::mdlCrearFactura($tablaCompras, $datosCompra);
        
                if ($respuestaCompra == "ok") {
                    // Actualizar el campo entrada en la tabla consumibles
                    $idTipoConsumible = $_POST["tipo_consumible"];
                    $cantidadAdquirida = $_POST["cantidad_adquirida"];
        
                    $respuestaUpdate = ModeloConsumibles::mdlActualizarEntrada($tablaConsumibles, $idTipoConsumible, $cantidadAdquirida);
        
                    if ($respuestaUpdate == "ok") {
                        echo '<script>
                                Swal.fire(
                                "Buen Trabajo!",
                                "La factura fue creada y el stock fue actualizado con éxito.",
                                "success"
                                ).then(function() {
                                document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                                $("#").addClass("active");
                                });
                            </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                    type: "error",
                                    title: "¡No se pudo actualizar el stock!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if(result.value){
                                        $("#").addClass("active");
                                    }
                                });
                            </script>';
                    }
        
                } else {
                    echo '<script>
                            Swal.fire({
                                type: "error",
                                title: "¡La factura no pudo ser creada!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                    $("#").addClass("active");
                                }
                            });
                        </script>';
                }
            }
        }
          

    
    /*=============================================
        CREAR CONSUMIBLE
        =============================================*/

        static public function ctrCrearConsumible()
        {
            if (isset($_POST["nombre_consumible"])) {
    
                $tabla = "consumibles";
    
                $datos = array(
                    "nombre_consumible" => $_POST["nombre_consumible"]
                    
                );
        
                $respuesta = ModeloConsumibles::mdlCrearConsumible($tabla, $datos);
        
                if ($respuesta == "ok") {
                    echo '<script>
                            Swal.fire(
                            "Buen Trabajo!",
                            "El consumible fue Guardado con Exito",
                            "success"
                            ).then(function() {
                            document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                            $("#consumibles").addClass("active");
                            });
                        </script>
                    ';
                } else {
                    echo '<script>
                        Swal.fire({
                            type: "error",
                            title: "¡La Respuesta no pudo ser guardada!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        }).then(function(result){
                            if(result.value){
                                $("#").addClass("active");
                            }
                        });
                    </script>';
                }
            }
        }

    
    /*=============================================
      REGISTRAR CONSUMIBLE
        =============================================*/

        static public function ctrIngresarConsumible()
        {
            if (isset($_POST["id_impresora_fk"])) {
    
                $tabla = "registro_consumible";
                $tablaSalida = "consumibles";
    
                $datos = array(
                    "id_impresora_fk" => $_POST["id_impresora_fk"],
                    "id_tipo_consumible_fk" => $_POST["id_tipo_consumible_fk"],
                    "fecha_instalacion" => $_POST["fecha_instalacion"],
                    "cantidad_utilizada" => $_POST["cantidad_utilizada"]
                );
        
                $respuesta = ModeloConsumibles::mdlIngresarConsumible($tabla, $datos);
        
                if ($respuesta == "ok") {
                    // Actualizar el campo entrada en la tabla consumibles
                    $idTipo= $_POST["id_tipo_consumible_fk"];
                    $cantidadUtilizada = $_POST["cantidad_utilizada"];
        
                    $respuestaSalida = ModeloConsumibles::mdlActualizarSalida($tablaSalida, $idTipo, $cantidadUtilizada);
        
                    if ($respuestaSalida == "ok") {
                        echo '<script>
                                Swal.fire(
                                "Buen Trabajo!",
                                "La factura fue creada y el stock fue actualizado con éxito.",
                                "success"
                                ).then(function() {
                                document.getElementById("").reset(); // Reemplaza con el ID correcto de tu formulario
                                $("#").addClass("active");
                                });
                            </script>';
                    } else {
                        echo '<script>
                                Swal.fire({
                                    type: "error",
                                    title: "¡No se pudo actualizar el stock!",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                                }).then(function(result){
                                    if(result.value){
                                        $("#").addClass("active");
                                    }
                                });
                            </script>';
                    }
        
                } else {
                    echo '<script>
                            Swal.fire({
                                type: "error",
                                title: "¡La factura no pudo ser creada!",
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar"
                            }).then(function(result){
                                if(result.value){
                                    $("#").addClass("active");
                                }
                            });
                        </script>';
                }
            }
        }






}
























