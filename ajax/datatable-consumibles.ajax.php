<?php
require_once "../controladores/consumibles.controlador.php";
require_once "../modelos/consumibles.modelo.php";
session_start();

class TablaBackup
{

    public function mostrarTablaBackup()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'impresora-consumibles':
                $this->mostrarTabla($item, $valor, "impresora-consumibles");
                break;
                case 'consumibles-utilizados':
                    $this->mostrarTabla($item, $valor, "consumibles-utilizados");
                    break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $consumibles = ControladorConsumibles::ctrMostrarImpresoras($item, $valor, $consulta);
        $data = [];

        foreach ($consumibles as $s) {
            $columns = $this->prepararDatos($s, $consulta);
            if ($columns) {
                $data[] = $columns;
            }
        }

        echo json_encode(["data" => $data]);
    }

    private function prepararDatos($s, $consulta)
    {
        switch ($consulta) {
            case 'impresora-consumibles':
                return [
                    $s["nombre_impresora"],
                    $s["modelo_impresora"],
                    $s["serial_impresora"],
                    $s["ubicacion_impresora"]
                    
                ];

                case 'consumibles-utilizados':
                    return [
                        $s["id_registro"],
                        $s["nombre_impresora"],
                        $s["nombre_consumible"],
                        $s["fecha_instalacion"],
                        $s["cantidad_utilizada"]
                        
                    ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarBackup = new TablaBackup();
$activarBackup->mostrarTablaBackup();
