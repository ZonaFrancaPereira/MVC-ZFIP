<?php

require_once "../controladores/inventario.controlador.php";
require_once "../modelos/inventario.modelo.php";
session_start();

class TablaInventario
{
    public function mostrarTablaInventario()
    {
        $item = null;
        $valor = null;

        $inventario = ControladorInventario::ctrMostrarInventario($item, $valor);
       

        $data = array();

        foreach ($inventario as $i) {
            $data[] = array(
                $i["id_inventario"],
                $i["fecha_apertura"],
                $i["fecha_cierre"],
                $i["estado_inventario"],
                $i["estado_inventario"],
                $i["estado_inventario"]
            );
        }

        echo json_encode(["data" => $data]);
    }
}

$activarInventario = new TablaInventario();
$activarInventario->mostrarTablaInventario();