<?php

include 'db_connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; 

$mail = new PHPMailer(true);

if (isset($_POST["email"])) {
    $email = $_POST["email"];

    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'testmailer492@gmail.com';
        $mail->Password   = 'hxzt paax xasn etqr';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('testmailer492@gmail.com', 'Test Mailer');
        $mail->addAddress($email);
        $mail->addReplyTo('testmailer492@gmail.com', 'TESTMAILER');

        $mail->isHTML(true);                                  
        $mail->Subject = 'Reset Password';
        $mail->Body    = 'Click <a href="http://localhost/task_for_edusogno/reset_pass.php">here</a> to reset to password.';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo "Il messaggio è stato invitato";
        header("refresh:2;url=index.php");
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php if (!isset($_POST["email"])) { ?>
        <form action="" method="post">
            <label for="email">Invia un'email per cambiare la password</label>
            <input name="email" placeholder="Inserisci l'indirizzo email">
            <button type="submit">INVIA</button>
        </form>
    <?php } ?>
</body>