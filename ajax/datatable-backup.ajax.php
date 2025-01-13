<?php
require_once "../controladores/backup.controlador.php";
require_once "../modelos/backup.modelo.php";
session_start();

class TablaBackup
{

    public function mostrarTablaBackup()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'backup':
                $this->mostrarTabla($item, $valor, "backup");
                break;
                case 'backup-Verificar':
                    $this->mostrarTabla($item, $valor, "backup-Verificar");
                    break;
                    case 'backup-Panel':
                        $this->mostrarTabla($item, $valor, "backup-Panel");
                        break;
            
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $backup = ControladorBackup::ctrMostrarBackup($item, $valor, $consulta);
        $data = [];

        foreach ($backup as $s) {
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
            case 'backup':
             $asignar_ruta = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-ruta' data-id_usuario_backup_fk='{$s["id"]}'>Asignar Ruta</button>";

                return [
                    $s["id"],
                    $s["nombre"],
                    $s["apellidos_usuario"],
                    $s["correo_usuario"],
                    $asignar_ruta
                ];
                case 'backup-Verificar':
                    if ($s["verificado"] !== 'No verificado') return null;
                    $verificar_backup = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-verificar_backup' data-id_usuario_copia='{$s["id"]}' data-carpeta_copia='{$s["carpeta_backup"]}'>Verificar</button>";
                    $informe = "<a target='_blank' href='extensiones/tcpdf/pdf/backuppdf.php?id={$s["id"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                       return [
                           $s["id"],
                           $s["nombre"],
                           $s["apellidos_usuario"],
                           $s["correo_usuario"],
                           $s["carpeta_backup"],
                           $s["verificado"],
                           $informe,
                           $verificar_backup
                       ];
                    
                    case 'backup-Panel':
                        $informe = "<a target='_blank' href='extensiones/tcpdf/pdf/backuppdf.php?id={$s["id"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                           return [
                               $s["id"],
                               $s["nombre"],
                               $s["apellidos_usuario"],
                               $s["correo_usuario"],
                               $s["carpeta_backup"],
                               $s["fecha_verificacion"],
                               $s["verificado"],
                               $s["observaciones_copia"],
                               $informe
                           ];
            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarBackup = new TablaBackup();
$activarBackup->mostrarTablaBackup();
