<?php
session_start();
include "db_connection.php";
if (isset($_POST['new_pass'])) {
    $newPass = $_POST['new_pass'];
    $user_mail = $_POST['email'];


    if (empty($newPass)) {
        header("Location: reset_password.php?error=New Pasword is required");
        exit();
    } else {
        $sqlNewPass = "UPDATE utenti SET password = '$newPass' WHERE email = '$user_mail'";

        if (mysqli_query($conn, $sqlNewPass)) {
        ?><div>
        <?php echo "La password è stata cambiata correttamente!"; ?>
            </div>

        <?php
            header("refresh:2;url=reset_pass.php");
            exit();
        } else {
            header("Location: reset_password.php?error=Hai inserito valori non validi");
            exit();
        }
    }
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/register.css">
    <title>Change Password</title>
</head>

<body>
    <form action="" method="post">
        <h2>CHANGE PASSWORD</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?= $_GET['error'] ?></p>
        <?php } ?>

        <label for="email">Inserisci la email</label>
        <input type="email" name="email">

        <label for="new_pass">Nuova Password</label>
        <input type="password" name="new_pass">

        <button type="submit">Cambia Password</button>

    </form>
</body>

</html>