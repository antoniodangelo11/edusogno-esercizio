<?php

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

$mysqli = require "db_connection.php";

$sql = "SELECT * FROM utenti
    WHERE reset_token_hash = ?";

$stmt = $mysqli->prepare($sql);

$stmt->bind_param("s", $token_hash);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if ($user === null) {
    die("token non trovato");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die ("Il token è scaduto");
}

// echo "il token è valido e non è scaduto";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset password</title>
    <link rel="stylesheet" href="assets/styles/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/styles/index.css?v=<?php echo time(); ?>">
    <script src="./assets/js/script.js" defer></script> 
</head>
<body>
    <h1>Reset Password</h1>
    <div class="container">
        <div class="container_form">
            <form action="reset_logic.php" method="post" class="form">
                
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

                <div class="cont_label">
                    <label for="password" class="write_login">New Password</label>
                </div>
                <div>
                    <input type="password" name="password" id="password" class="password-field" placeholder="Scrivila qui">
                </div>

                <div class="cont_label">
                    <label for="password_confirmation" class="write_login">Repeat Password</label>
                </div>
                
                <div>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="password-field" placeholder="Scrivila qui">
                </div>

                <button>Invia</button>
            </form>
        </div>
    </div>  
</body>
</html>