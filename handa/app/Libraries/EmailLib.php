<?php

namespace App\Libraries;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require APPPATH.'ThirdParty/PHPMailer/src/Exception.php';
require APPPATH.'ThirdParty/PHPMailer/src/PHPMailer.php';
require APPPATH.'ThirdParty/PHPMailer/src/SMTP.php';

class EmailLib {

    public function sendEmail($to, $subject, $message) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP(true);
            $mail->Host = 'smtp.google.com'; // Set your SMTP server
            $mail->SMTPAuth = false;
            $mail->SMTPDebug = 4;
            $mail->Username = 'rcabalunajr@gmail.com'; // Set your SMTP username
            $mail->Password = 'Rocj1010!'; // Set your SMTP password
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('rcabalunajr@gmail.com', 'Ruel Cabaluna Jr.'); // Set the sender's email and name
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } catch (\Exception $e) {
            exit($e->getMessage());
        }
    }
}