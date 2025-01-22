<?php

class ControladorOrden{

    public static function ctrMostrarProvedor($item, $valor){
        $tabla = "proveedor_compras";
        $respuesta = ModeloOrden::mdlMostrarProvedor($tabla, $item, $valor);
        return $respuesta;
    }

    public static function ctrObtenerNombreCargo($id_cargo) {
        $cargo = ModeloOrden::mdlObtenerNombreCargo($id_cargo);
        return $cargo ? $cargo["nombre_cargo"] : "Cargo no encontrado";
    }
}