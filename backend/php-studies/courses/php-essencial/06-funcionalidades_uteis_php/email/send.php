<?php

// mail("weweb14636@ratedane.com", "Teste", "Shubs");

use Exception as GlobalException;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';


$mail = new PHPMailer;


$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = 'mail.for.development.tests@gmail.com';
$mail->Password = '#mail.for.development.tests*';

$mail->setFrom('mail.for.development.tests@gmail.com', "Teste PHPMailer");
$mail->addAddress('6254050e2e@fireboxmail.lol', 'Testador');
$mail->Subject = 'Email de teste';

$mail->Body = "<h1>Email enviado com sucesso!</h1>";

if(!$mail->send()) {
    echo "Falha ao enviar email";
} else {
    echo "Email enviado!";
}

?>