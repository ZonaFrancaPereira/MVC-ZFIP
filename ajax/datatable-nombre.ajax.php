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
            case 'nombre-consumible':
                $this->mostrarTabla($item, $valor, "nombre-consumible");
                break;
            case 'factura-consumible':
                $this->mostrarTabla($item, $valor, "factura-consumible");
                break;

            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        // Obtener los consumibles desde el controlador
        $consumibles = ControladorConsumibles::ctrMostrarConsumible($item, $valor, $consulta);
        $data = [];

        // Recorrer los consumibles y calcular la cantidad
        foreach ($consumibles as $s) {
            if ($consulta == 'nombre-consumible') {
                $s['cantidad'] = $s['entrada'] - $s['salida'];  // Calcular la cantidad
            }

            // Preparar los datos para la tabla
            $columns = $this->prepararDatos($s, $consulta);
            if ($columns) {
                $data[] = $columns;
            }
        }

        // Devolver los datos en formato JSON
        echo json_encode(["data" => $data]);
    }

    private function prepararDatos($s, $consulta)
    {
        switch ($consulta) {
            case 'nombre-consumible':
                return [
                    $s["id_tipo_consumible"],
                    $s["nombre_consumible"],
                    $s["entrada"],
                    $s["salida"],
                    $s["cantidad"] // La cantidad ya está calculada
                ];

            case 'factura-consumible':
                return [
                    $s["id_consumible"],
                    $s["fecha_compra"],
                    $s["nombre_consumible"],
                    $s["cantidad_adquirida"],
                    $s["precio_unitario"],
                    $s["total_compra"],
                    $s["proveedor_consumible"],
                    $s["numero_factura"]
                ];

            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarBackup = new TablaBackup();
$activarBackup->mostrarTablaBackup();
