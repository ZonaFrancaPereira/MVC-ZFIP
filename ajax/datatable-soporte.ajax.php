<?php

require_once "../controladores/soporte.controlador.php";
require_once "../modelos/soporte.modelo.php";
session_start();

class TablaSoporte
{
    public function mostrarTablaSoporte()
    {
        $item = null;
        $valor = null;

        $soporte = ControladorSoporte::ctrMostrarSoporte($item, $valor);

        $data = array();

        foreach ($soporte as $s) {
            $data[] = array(
                $s["id_soporte"],
                $s["fecha_soporte"],
                $s["descripcion_soporte"],
                $s["urgencia"],
                $s["solucion_soporte"],
                $s["fecha_solucion"],
                $s["usuario_respuesta"]
            );
        }

        echo json_encode(["data" => $data]);
    }
}

$activarSoporte = new TablaSoporte();
$activarSoporte->mostrarTablaSoporte();
