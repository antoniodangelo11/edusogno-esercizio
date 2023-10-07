<?php

include 'db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth   = true;

$mail->Host       = 'smtp.gmail.com'; // Hostname di Mailtrap
$mail->Username   = 'testmailer492@gmail.com'; // Nome utente di Mailtrap
$mail->Password   = 'hxzt paax xasn etqr'; // Password di Mailtrap
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port       = 587;

$mail->isHTML(true);

return $mail;