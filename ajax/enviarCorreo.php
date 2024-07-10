<?php
// Incluir autoload de Composer
require_once __DIR__ . '../../extensiones/vlucas/autoload.php';
require_once __DIR__ . '../../extensiones/mail/autoload.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Definir la función para enviar correos
function EnviarCorreo($id_usuario_fk, $modulo, $id_consulta, $destinatario)
{
    // USUARIOS
    require_once __DIR__ . '../../controladores/usuarios.controlador.php';
    require_once __DIR__ . '../../modelos/usuarios.modelo.php';
    // Iniciar el buffer de salida
    ob_start();

    // Cargar las variables de entorno
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    $smtpUsername = $_ENV['SMTP_USERNAME'];
    $smtpPassword = $_ENV['SMTP_PASSWORD'];
    $smtpHost = $_ENV['SMTP_HOST'];
    $smtpPort = $_ENV['SMTP_PORT'];
    $smtpSecure = $_ENV['SMTP_SECURE'];

    try {
        // Inicializar PHPMailer
        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = $smtpHost;
        $mail->SMTPAuth = true;
        $mail->Username = $smtpUsername;
        $mail->Password = $smtpPassword;
        $mail->SMTPSecure = $smtpSecure;
        $mail->Port = $smtpPort;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom('info@zonafrancadepereira.com', 'Zona Franca Internacional de Pereira');

        // Agregar destinatarios y configurar el correo según el módulo
        switch ($modulo) {
            case 'soporte':
                // Ejemplo: Obtener usuarios según el id_usuario_fk
                $mail->addAddress('ymontoyag@zonafrancadepereira.com');
                $mail->addAddress('ygarciaz@zonafrancadepereira.com');

                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                // Agregar destinatarios de ejemplo (debes ajustar según tu lógica)
                foreach ($usuarios as $value) {
                    $nombre_usuario = $value['nombre'];
                }

                // Configurar el correo específico para el módulo 'soporte'
                $titulo_correo = "Nueva Solicitud de Soporte - Usuario: " . $nombre_usuario;
                $message  = "<html><body>";
                $message .= '
                <div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                <div style=" background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;">
                <img src="https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png">
                <h1>Solicitud de Soporte</h1>
                </div>
                <div style="padding: 20px;">
                <p>Se ha generado una nueva solicitud de soporte:</p>
                <ul>
                    <li>Correo del solicitante: ' . $correo_ . '</li>
                    <li>Usuario solicitante: ' . $usuario_soporte . '</li>
                    <li>Proceso relacionado: ' . $proceso_soporte . '</li>
                    <li>Descripción del problema: ' . $descripcion_soporte . '</li>
                </ul>
                <p>Por favor, toma las acciones necesarias para abordar esta solicitud lo antes posible.</p>
                <p>inicia sesión en nuestro sistema para revisar la Solicitud.</p>
                <center>
                    <a href="https://app.zonafrancadepereira.com/" target="_blank"><button style=" border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;">Iniciar Sesión</button></a>
                </center>
                <p>¡Gracias!</p>
                </div>
                <div style=" text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;">
                <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                </div>
                </div>';
                break;
            default:
                // Lógica para otros módulos si es necesario
                break;
        }

        // Cerrar el cuerpo del mensaje HTML
        $message .= "</body></html>";

        // Configurar el asunto y cuerpo del correo
        $mail->isHTML(true);
        $mail->Subject = $titulo_correo;
        $mail->Body = $message;

        // Enviar el correo y validar el resultado
        $mail->send();
        echo 'Correo enviado correctamente.';
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Mailer Error: {$mail->ErrorInfo}";
    }

    // Limpiar el buffer de salida y mostrar contenido
    ob_end_flush();
}

// Capturar las variables enviadas por AJAX
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if ($data) {
    $id_usuario_fk = $data['id_usuario_fk'];
    $modulo = $data['modulo'];
    $id_consulta = $data['id_consulta'];
    $destinatario = $data['destinatario'];

    // Llamar a la función EnviarCorreo con los parámetros obtenidos
    EnviarCorreo($id_usuario_fk, $modulo, $id_consulta, $destinatario);
} else {
    echo "No se recibieron datos.";
}
