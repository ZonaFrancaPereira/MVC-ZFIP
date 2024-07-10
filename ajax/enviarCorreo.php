<?php
// Incluir autoload de Composer
require_once __DIR__ . '../../extensiones/vlucas/autoload.php';
require_once __DIR__ . '../../extensiones/mail/autoload.php';
// USUARIOS
require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Definir la función para enviar correos
function EnviarCorreo($id_usuario_fk, $modulo, $id_consulta, $destinatario)
{
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

        $mail->SMTPDebug = SMTP::DEBUG_OFF;
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
                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                // Agregar destinatarios de ejemplo (debes ajustar según tu lógica)
                foreach ($usuarios as $key => $value) {
                    $mail->addAddress($value['correo']);
                }

                // Configurar el correo específico para el módulo 'soporte'
                $titulo_correo = "Nueva Solicitud de Soporte - Usuario: " . $id_usuario_fk;
                $message  = "<html><body>";
                $message .= '<div style="max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;">
                             <!-- Contenido del correo -->
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
?>
