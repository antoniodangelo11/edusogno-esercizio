<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edusogno</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <h1>Hai già un account?</h1>

    <form class="form_style" action="login.php" method="POST">
        <!-- Qui stampo l'errore -->

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>Inserisci l'e-mail</label>
        <input class="input_general" type="email" name="email" placeholder="Name@example.com">

        <label>Inserisci la Password</label>
        <input class="input_general" type="password" name="password" placeholder="Scrivila qui">

        <button type="submit">Accedi</button>
        <p>Non hai ancora un profilo? <a href="registration.php">Registrati</a></p>
        <p>Hai dimenticato la password? <a href="mailer.php">Recupera Password</a></p>
    </form>
</body>

</html>