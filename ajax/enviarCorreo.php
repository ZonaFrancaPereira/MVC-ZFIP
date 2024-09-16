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
                // Agregar destinatarios
                $mail->addAddress('ymontoyag@zonafrancadepereira.com');
                $mail->addAddress('ygarciaz@zonafrancadepereira.com');

                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                foreach ($usuarios as $value) {
                    $nombre_usuario = $value['nombre'];
                    $correo_soporte = $value['correo_usuario'];
                    $proceso = $value['siglas_proceso'];
                    $descripcion_soporte = $value['descripcion_soporte'];
                }

                // Configurar el correo específico para el módulo 'soporte'
                $titulo_correo = "Nueva Solicitud de Soporte - Usuario: " . $nombre_usuario;
                $message = "
                    <html><body>
                    <div style='max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;'>
                        <div style='background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;'>
                            <img src='https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png'>
                            <h1>Solicitud de Soporte</h1>
                        </div>
                        <div style='padding: 20px;'>
                            <p>Se ha generado una nueva solicitud de soporte:</p>
                            <ul>
                                <li>Correo del solicitante: $correo_soporte</li>
                                <li>Usuario solicitante: $nombre_usuario</li>
                                <li>Proceso relacionado: $proceso</li>
                                <li>Descripción del problema: $descripcion_soporte</li>
                            </ul>
                            <p>Por favor, toma las acciones necesarias para abordar esta solicitud lo antes posible.</p>
                            <p>Inicia sesión en nuestro sistema para revisar la Solicitud.</p>
                            <center>
                                <a href='https://app.zonafrancadepereira.com/' target='_blank'>
                                    <button style='border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;'>Iniciar Sesión</button>
                                </a>
                            </center>
                            <p>¡Gracias!</p>
                        </div>
                        <div style='text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;'>
                            <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                        </div>
                    </div>
                    </body></html>";
                break;

            case 'solicitudes_soporte':
                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                foreach ($usuarios as $value) {
                    $nombre_usuario = $value['nombre'];
                    $fecha_solucion = $value['fecha_solucion'];
                    $solucion_soporte = $value['solucion_soporte'];
                    $id_soporte = $value['id_soporte'];
                    $correo_usuario = $value['correo_usuario'];
                }

                $mail->addAddress($correo_usuario);

                $titulo_correo = "Solicitud de soporte numero: " . $id_soporte;
                $message = "
                    <html><body>
                    <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>
                        <div style='background-color: #F8F9F9; color: black; text-align: center; padding: 10px; border-radius: 5px 5px 0 0;'>
                            <img src='https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png'>
                            <h1>Solución para la solicitud de soporte número: $id_soporte.</h1>
                        </div>
                        <div style='padding: 20px;'>
                            <p>Estimado usuario,</p>
                            <p>Nos complace informarle que se ha proporcionado una solución para su solicitud de soporte número $id_soporte. A continuación, podrá visualizar los detalles:</p>
                            <p><strong>Fecha de solución:</strong> $fecha_solucion</p>
                            <p><strong>Solución:</strong> $solucion_soporte</p>
                            <p>Por favor, inicie sesión en nuestro sistema para revisar la solicitud y confirmar la solución proporcionada.</p>
                            <center>
                                <a href='https://app.zonafrancadepereira.com/' target='_blank'>
                                    <button style='border: none; color: white; padding: 14px 28px; cursor: pointer; border-radius: 5px; background: #0b7dda;'>Iniciar Sesión</button>
                                </a>
                            </center>
                            <p>¡Gracias por su paciencia y colaboración!</p>
                        </div>
                        <div style='text-align: center; padding: 10px; background-color: #f4f4f4; border-radius: 0 0 5px 5px;'>
                            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
                        </div>
                    </div>
                    </body></html>";
                break;

            case 'acpm':
                $mail->addAddress('ygarciaz@zonafrancadepereira.com');

                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                foreach ($usuarios as $value) {
                    $nombre_usuario = $value['nombre'];
                    $correo_soporte = $value['correo_usuario'];
                    $proceso = $value['siglas_proceso'];
                    $descripcion_acpm = $value['descripcion_acpm'];
                    $fecha_finalizacion = $value['fecha_finalizacion'];
                }

                $titulo_correo = "Nueva ACPM del Proceso de $proceso / $fecha_finalizacion";
                $message = "
                    <html><body>
                    <div style='max-width: 600px; margin: 0 auto;padding: 20px;border: 1px solid #ccc;border-radius: 5px;'>
                        <div style='background-color: #F8F9F9;color: black;text-align: center;padding: 10px;border-radius: 5px 5px 0 0;'>
                            <img src='https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png'>
                            <h1>ACPM Radicada Por: $nombre_usuario</h1>
                        </div>
                        <div style='padding: 20px;'>
                            <p>Hola, Yuli Viviana Rios 😊</p>
                            <p>Te informamos que hay una nueva ACPM, radicada por $nombre_usuario, esperando tu revisión para ser ejecutada, la cual vence el día $fecha_finalizacion.</p>
                            <p><strong>Descripción ACPM:</strong> $descripcion_acpm</p>
                            <p>Por favor, inicia sesión en nuestro sistema para revisar la ACPM.</p>
                            <center>
                                <a href='https://app.zonafrancadepereira.com/' target='_blank'>
                                    <button style='border: none;color: white; padding: 14px 28px; cursor: pointer;border-radius: 5px; background: #0b7dda;'>Iniciar Sesión</button>
                                </a>
                            </center>
                            <p>¡Gracias!</p>
                        </div>
                        <div style='text-align: center; padding: 10px;background-color: #f4f4f4;border-radius: 0 0 5px 5px;'>
                            <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                        </div>
                    </div>
                    </body></html>";
                break;

            case 'acciones_verificacion':
                // Capturar el id del usuario desde la variable $id_usuario_fk
                $item = 'id';
                $valor = $id_usuario_fk;
                $usuarios = ControladorUsuarios::ctrMostrarUsuariosCorreo($item, $valor);

                if (!empty($usuarios)) {
                    // Asignar valores obtenidos de la consulta
                    foreach ($usuarios as $value) {
                        $nombre_usuario = $value['nombre'];
                        $apellidos_usuario = $value['apellidos_usuario'];
                        $correo_usuario = $value['correo_usuario'];
                        $siglas_proceso = $value['siglas_proceso'];
                        $descripcion_actividad = $value['descripcion_actividad'];
                        $fecha_actividad = $value['fecha_actividad'];
                        $id_acpm = $value['id_acpm_fk'];
                    }

                    // Asignar la dirección de correo del usuario
                    $mail->addAddress($correo_usuario);

                    // Preparar el título y el cuerpo del mensaje de correo electrónico
                    $titulo_correo = "Nueva Actividad Proceso del " . $siglas_proceso . " / " . $fecha_actividad;
                    $message = "
                            <html><body>
                            <div style='max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px;'>
                                <div style='background-color: #F8F9F9; color: black; text-align: center; padding: 10px; border-radius: 5px 5px 0 0;'>
                                    <img src='https://zonafrancadepereira.com/wp-content/uploads/2020/11/cropped-ZONA-FRANCA-LOGO-PNG-1-1-1-206x81.png'>
                                    <h1>Actividad Asignada Por: $nombre_usuario $apellidos_usuario</h1>
                                </div>
                                <div style='padding: 20px;'>
                                    <p>Hola, $nombre_usuario 😊</p>
                                    <p>Te informamos que hay una nueva actividad de la ACPM #$id_acpm, radicada por $nombre_usuario $apellidos_usuario, la cual vence el día $fecha_actividad.</p>
                                    <p><b>Descripción Actividad:</b> $descripcion_actividad</p>
                                    <p>Es de suma importancia que subas las evidencias correspondientes a esta actividad en el tiempo establecido. Recuerda que 'La fuerza del equipo viene de cada miembro'.</p>
                                    <p>Por favor, inicia sesión en nuestro sistema para revisar la Actividad.<br>
                                    <center>
                                    <a href='https://app.zonafrancadepereira.com/' target='_blank'><button style='border: none; color: white; padding: 14px 28px; cursor: pointer; border-radius: 5px; background: #0b7dda;'>Iniciar Sesión</button></a></center>
                                    <p>¡Gracias!</p>
                                </div>
                                <div style='text-align: center; padding: 10px; background-color: #f4f4f4; border-radius: 0 0 5px 5px;'>
                                    <p>Este es un mensaje automático, por favor no respondas a este correo.</p>
                                </div>
                            </div>
                            </body></html>";
                } else {
                    // Manejar el caso en el que no se encuentre ningún usuario
                    echo "No se encontró el usuario con ID: $id_usuario_fk";
                }
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
    $correo_usuario = $data['correo_usuario'];

    // Llamar a la función EnviarCorreo con los parámetros obtenidos
    EnviarCorreo($id_usuario_fk, $modulo, $id_consulta, $destinatario, $correo_usuario);
} else {
    echo "No se recibieron datos.";
}
