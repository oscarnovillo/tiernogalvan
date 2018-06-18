<?php

namespace utils;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use config\Config;
class Mailer
{

    public function sendMail($reciperEmail, $reciperName, $subject, $content)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = Config::MAIL_SERVER;
            $mail->SMTPAuth = true;
            $mail->Username = Config::MAIL_USER;
            $mail->Password = Config::MAIL_PASSWORD;
            $mail->Port = Config::MAIL_PORT;

            $mail->setFrom(Config::MAIL_USER, CONFIG::MAIL_NAME);
            $mail->addAddress($reciperEmail, $reciperName);
            $mail->addReplyTo(Config::MAIL_USER, CONFIG::MAIL_NAME);
            $mail->addCC(Config::MAIL_USER);
            $mail->addBCC(Config::MAIL_USER);
            $mail->CharSet = 'UTF-8';

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $content;
            $mail->AltBody = $content;

            $mail->send();
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }
}
