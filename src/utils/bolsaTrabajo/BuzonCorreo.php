<?php
/**
 * Created by PhpStorm.
 * User: Gato
 * Date: 01/06/2018
 * Time: 15:06
 */

namespace utils\bolsaTrabajo;


use config\ConfigBolsaTrabajo;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class BuzonCorreo
{

    public function enviarCorreo($destino, $nombreDestino, $asunto, $cuerpoMensaje)
    {
        $enviado = true;
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output (2)
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = ConfigBolsaTrabajo::SMTP_SERVER;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = ConfigBolsaTrabajo::MAIL_FROM;                 // SMTP username
            $mail->Password = ConfigBolsaTrabajo::MAIL_PASS;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = ConfigBolsaTrabajo::SMTP_PORT;                                    // TCP port to connect to


            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            //Recipients
            $mail->setFrom(ConfigBolsaTrabajo::EMAIL_ORIGEN, ConfigBolsaTrabajo::RESPONSABLE_ORIGEN);

            if ($nombreDestino == null) {
                $mail->addAddress($destino);               // Name is optional
            } else {
                $mail->addAddress($destino, $nombreDestino);     // Add a recipient
            }

            /* $mail->addReplyTo('info@example.com', 'Information');
             $mail->addCC('cc@example.com');
             $mail->addBCC('bcc@example.com');*/

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->CharSet = 'utf-8';
            $mail->Subject = $asunto;
            $mail->Body = $cuerpoMensaje;
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();

        } catch (Exception $e) {
            $enviado = false;
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
        return $enviado;
    }

}