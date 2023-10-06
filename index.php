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
    <form action="login.php" method="POST">
        <h2>Hai già un account?</h2>

        <!-- Qui stampo l'errore -->

        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <label>Email</label>
        <input type="email" name="email" placeholder="Email">

        <label>Password</label>
        <input type="password" name="password" placeholder="Password">

        <button type="submit">Login</button>
        <p>Non hai ancora un profilo? <a href="registration.php">Registrati</a></p>
        <p>Hai dimenticato la password? <a href="mailer.php">Reset</a></p>
    </form>
</body>

</html>