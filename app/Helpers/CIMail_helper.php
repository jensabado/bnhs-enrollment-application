<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (!function_exists('sendMail')) {
    function sendMail($mailConfig)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nextgen.techiq@gmail.com';
        $mail->Password = 'xtfzwjccyeganmyb';
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;
        $mail->setFrom($mailConfig['mailFromEmail'], $mailConfig['mailFromName']);
        $mail->addAddress($mailConfig['mailRecipientEmail'], $mailConfig['mailRecipientName']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mailSubject'];
        $mail->Body = $mailConfig['mailBody'];

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}
