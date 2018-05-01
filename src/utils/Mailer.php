<?php

namespace utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{

    //TODO: poner servidor de email
    public function sendMail()
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp1.example.com;smtp2.example.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'user@example.com';
            $mail->Password = 'secret';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('contacto@iestiernogalvan.es', 'IES Enrique Tierno Galván');
            $mail->addAddress('destinatario@algo.es', 'Nombre del destinatario');
            $mail->addReplyTo('contacto@iestiernogalvan.es', 'Information');
            $mail->addCC('contacto@iestiernogalvan.es');
            $mail->addBCC('contacto@iestiernogalvan.es');

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
