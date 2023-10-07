<?php

$email = $_GET["email"];

$token = bin2hex(random_bytes(16));

$token_hash = hash("sha256", $token);

$expiry = date ("Y-m-d H:i:s", time() + 60 * 30);

$mysqli = require __DIR__ . "/db_connection.php";

$sql = "UPDATE utenti
        SET reset_token_hash = ?,
        reset_token_expires_at = ?
        WHERE email = ?";
$stmt = $mysqli->prepare($sql);

$stmt->bind_param("sss", $token_hash, $expiry, $email);

$stmt->execute();

if ($mysqli->affected_rows) {
    $mail = require __DIR__ . "mailer.php";

    $mail->setFrom('from@example.com');
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body    = <<<END

    Click <a href="http://localhost/edusogno-esercizio/edusogno-esercizio/reset_pass.php?token=$token">here</a> to reset to password.

    END;

    try {
        $mail->send();
        echo 'Il messaggio è stato inviato con successo, controlla la tua mail o inbox.';

    } catch (Exception $e) {
        echo "Impossibile inviare il messaggio. Errore Mailer: {$mail->ErrorInfo}";
    }
}