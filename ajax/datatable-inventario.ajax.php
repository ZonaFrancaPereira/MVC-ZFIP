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
            $estado = $i["estado_inventario"];
            switch ($estado) {
                case 'Abierto':
                    $estado_inventario = "<span class='badge badge-success'>Abierto</span>";
                    $informe="<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                   <i class='far fa-file-pdf'></i>
                  </button>";
                    $boton="<button type='button' class='btn bg-warning' data-toggle='modal' data-target='#modalCerrarInventario' data-id_inventario='{$i["id_inventario"]}' title='Cerrar Inventario'>
                            <i class='far fa-check-circle'></i>
                          </button>";
                    break;
                case 'Cerrado':
                    $estado_inventario = "<span class='badge badge-danger'>Cerrado</span>";
                    $informe="<button type='button' class='btn bg-danger ReporteInventario' data-id_inventario='{$i["id_inventario"]}'>
                   <i class='far fa-file-pdf'></i>
                  </button>";
                  $boton="<button type='button' class='btn bg-success'>
                    <i class='far fa-calendar-check'></i>
                  </button>";
                    break;
              
                default:
                    $estado = "<span class='badge badge-secondary'>Desconocido</span>";
                    break;
            }
          
            $data[] = array(
                $i["id_inventario"],
                $i["fecha_apertura"],
                $i["fecha_cierre"],
                $estado_inventario,
                $informe,
                
                $boton
            );
        }

        echo json_encode(["data" => $data]);
    }
}

$activarInventario = new TablaInventario();
$activarInventario->mostrarTablaInventario();