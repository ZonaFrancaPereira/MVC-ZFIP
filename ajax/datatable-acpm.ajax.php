<?php
require_once "../controladores/acpm.controlador.php";
require_once "../modelos/acpm.modelo.php";
session_start();

class TablaAcpm
{

    public function mostrarTablaAcpm()
    {
        $especifico = isset($_POST['especifico']) ? $_POST['especifico'] : '';
        $item = 'id_usuario_fk';
        $valor = $_SESSION['id'];

        switch ($especifico) {
            case 'acpm':
                $this->mostrarTabla($item, $valor, "acpm");
                break;
            case 'aprobar':
                $this->mostrarTabla($item, $valor, "aprobar");
                break;
            case 'abierta':
                $this->mostrarTabla($item, $valor, "abierta");
                break;
            case 'vencida':
                $this->mostrarTabla($item, $valor, "vencida");
                break;
            case 'proceso':
                $this->mostrarTabla($item, $valor, "proceso");
                break;
            case 'cerrada':
                $this->mostrarTabla($item, $valor, "cerrada");
                break;
            case 'rechazada':
                $this->mostrarTabla($item, $valor, "rechazada");
                break;
            case 'aceptar':
                $this->mostrarTabla($item, $valor, "aceptar");
                break;
            case 'tecnica':
                $this->mostrarTabla($item, $valor, "tecnica");
                break;
            case 'sig':
                $this->mostrarTabla($item, $valor, "sig");
                break;
            case 'administrativa':
                $this->mostrarTabla($item, $valor, "administrativa");
                break;
            case 'contable':
                $this->mostrarTabla($item, $valor, "contable");
                break;
            case 'juridica':
                $this->mostrarTabla($item, $valor, "juridica");
                break;
            case 'informatica':
                $this->mostrarTabla($item, $valor, "informatica");
                break;
            case 'operaciones':
                $this->mostrarTabla($item, $valor, "operaciones");
                break;

            case 'gerencia':
                $this->mostrarTabla($item, $valor, "gerencia");
                break;
            case 'seguridad':
                $this->mostrarTabla($item, $valor, "seguridad");
                break;
            default:
                echo json_encode(["data" => []]);
                break;
        }
    }

    private function mostrarTabla($item, $valor, $consulta)
    {
        $acpm = ControladorAcpm::ctrMostrarAcpm($item, $valor, $consulta);
        $data = [];

        foreach ($acpm as $s) {
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
            case 'acpm':
                if ($s["estado_acpm"] !== 'Verificacion') return null;
                $asignar_actividades = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id_acpm_fk='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-success'>Asignar actividades</button>";
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $informe_acpm,
                    $asignar_actividades,
                    $s["estado_acpm"]
                ];
            case 'abierta':
                
                if ($s["estado_acpm"] !== 'Abierta') return null;
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $actividades = "<a target='_blank' class='btn btn-outline-warning' href='index.php?ruta=acpm&id={$s["id_consecutivo"]}'>Gestionar ACPM</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $actividades
                ];
                case 'vencida':
                    if ($s["estado_acpm"] !== 'Abierta Vencida') return null;
                    $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                    $actividades = "<a target='_blank' class='btn btn-outline-warning' href='index.php?ruta=acpm&id={$s["id_consecutivo"]}'>Gestionar ACPM</a>";
                    return [
                        $s["id_consecutivo"],
                        $s["nombre"],
                        $s["origen_acpm"],
                        $s["fuente_acpm"],
                        $s["tipo_acpm"],
                        $s["descripcion_acpm"],
                        $s["fecha_finalizacion"],
                        $s["estado_acpm"],
                        $informe_acpm,
                        $actividades
                    ];
            case 'aprobar':
                if ($s["estado_acpm"] !== 'Verificacion') return null;
                $aprobar = "<button type='button' class='btn btn-outline-info aprobarAcpm' data-id='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-aprobar'>Responder</button>";
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $aprobar
                ];

            case 'proceso':
                if ($s["estado_acpm"] !== 'Proceso') return null;
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm
                ];
            case 'cerrada':
                if ($s["estado_acpm"] !== 'Cerrada') return null;
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm
                ];
            case 'rechazada':
                if ($s["estado_acpm"] !== 'Rechazada') return null;
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm
                ];
            case 'aceptar':
                if ($s["estado_acpm"] !== 'Proceso') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $responder = "<button type='button' class='btn btn-outline-info' data-id_acpm_fk_sig1='{$s["id_consecutivo"]}' data-toggle='modal' data-target='#modal-unificado'>Responder</button>";

                // Limitar la longitud de descripcion_acpm a 100 caracteres
                $descripcion_limited = strlen($s["descripcion_acpm"]) > 100 ? substr($s["descripcion_acpm"], 0, 100) . '...' : $s["descripcion_acpm"];

                // Limitar la longitud de origen_acpm a 50 caracteres
                $origen_limited = strlen($s["origen_acpm"]) > 50 ? substr($s["origen_acpm"], 0, 50) . '...' : $s["origen_acpm"];

                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    "<span style='max-width: 300px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>{$origen_limited}</span>", // Estilo en línea
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    "<span style='max-width: 300px; display: inline-block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;'>{$descripcion_limited}</span>", // Estilo en línea
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $responder
                ];
            case 'tecnica':
                if ($s["id_usuario_fk"] !== '14') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar'  data-id_acpm_fk1='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'sig':
                if ($s["id_usuario_fk"] !== '17') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-modificar-sig' data-sig='{$s["id_consecutivo"]}'>Modificar</button>";

                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'administrativa':
                if ($s["id_usuario_fk"] !== '27') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info' data-toggle='modal' data-target='#modal-modificar-administrativa' data-administrativa='{$s["id_consecutivo"]}'>Modificar</button>";

                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'contable':
                if ($s["id_usuario_fk"] !== '6') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-contable'  data-contable='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'juridica':
                if ($s["id_usuario_fk"] !== '24') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-juridica'  data-juridica='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'informatica':
                if ($s["id_usuario_fk"] !== '2') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-informatica'  data-informatica='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'operaciones':
                if ($s["id_usuario_fk"] !== '7') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-operaciones'  data-operaciones='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];

            case 'gerencia':
                if ($s["id_usuario_fk"] !== '11') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-gerencia'  data-gerencia='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];
            case 'seguridad':
                if ($s["id_usuario_fk"] !== '59') return null;

                // Crear enlaces para el informe y el botón de respuesta
                $informe_acpm = "<a target='_blank' href='extensiones/tcpdf/pdf/acpmpdf.php?id={$s["id_consecutivo"]}' class='btn btn-outline-success'><i class='fas fa-file-signature'></i> Formato</a>";
                $fecha = "<button type='button' class='btn btn-outline-info'  data-toggle='modal' data-target='#modal-modificar-seguridad'  data-seguridad='{$s["id_consecutivo"]}'>Modificar</button>";
                return [
                    $s["id_consecutivo"],
                    $s["nombre"],
                    $s["origen_acpm"],
                    $s["fuente_acpm"],
                    $s["tipo_acpm"],
                    $s["descripcion_acpm"],
                    $s["fecha_finalizacion"],
                    $s["estado_acpm"],
                    $informe_acpm,
                    $fecha
                ];

            default:
                return null;
        }
    }
}

// Inicialización y llamada a la función para mostrar la tabla
$activarAcpm = new TablaAcpm();
$activarAcpm->mostrarTablaAcpm();
