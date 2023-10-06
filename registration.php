<!DOCTYPE html>
<html>

<head>
    <title>SIGN UP</title>
    <link rel="stylesheet" href="./assets/styles/style.css">
</head>

<body>
    <form action="registration_check.php" method="POST">
        <h2>SIGN UP</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <label>Nome</label>
        <?php if (isset($_GET['nome'])) { ?>
            <input type="text" name="nome" placeholder="Nome" value="<?php echo $_GET['nome']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="nome" placeholder="Nome"><br>
        <?php } ?>

        <label>Cognome</label>
        <?php if (isset($_GET['cognome'])) { ?>
            <input type="text" name="cognome" placeholder="Cognome" value="<?php echo $_GET['cognome']; ?>"><br>
        <?php } else { ?>
            <input type="text" name="cognome" placeholder="Cognome"><br>
        <?php } ?>

        <label>Email</label>
        <?php if (isset($_GET['email'])) { ?>
            <input type="email" name="email" placeholder="Email" value="<?php echo $_GET['email']; ?>"><br>
        <?php } else { ?>
            <input type="email" name="email" placeholder="Email"><br>
        <?php } ?>

        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <button type="submit">Sign Up</button>
        <a href="index.php">Already have an account?</a>
    </form>
</body>

</html>