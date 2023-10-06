<?php
session_start();
include "db_connection.php";

if (isset($_POST['email']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    
    if (empty($email)) {
        header("Location: index.php?error=Email is required");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        $mysql = "SELECT * FROM utenti WHERE email='$email' AND password ='$password'";

        $result = mysqli_query($connection, $mysql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $password) {
                $_SESSION['email']    = $row['email'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['nome']     = $row['nome'];
                $_SESSION['cognome']  = $row['cognome'];
                $_SESSION['id']       = $row['id'];
                header("Location: personal_homepage.php");
                exit();
            } else {
                header("Location: index.php?error=Incorect email or password");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorect email or password");
            exit();
        }
    }

} else {
    header("Location: index.php");
    exit();
}

?>
