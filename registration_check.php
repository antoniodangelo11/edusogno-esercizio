<?php
session_start();
include "db_connection.php";
if (isset($_POST['nome']) && isset($_POST['cognome']) && isset($_POST['email']) && isset($_POST['password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $nome       = validate($_POST['nome']);
    $cognome    = validate($_POST['cognome']);
    $email      = validate($_POST['email']);
    $password   = validate($_POST['password']);

    $user_data = 'email' . $email . '&nome=' . $nome . '&cognome=' . $cognome;


    if (empty($nome)) {
        header("Location: registration.php?error=Il nome è richiesto&$user_data");
        exit();
    } else if (empty($cognome)) {
        header("Location: registration.php?error=Il cognome è richiesto&$user_data");
        exit();
    } else if (empty($email)) {
        header("Location: registration.php?error=l'email è richiesta&$user_data");
        exit();
    } else if (empty($password)) {
        header("Location: registration.php?error=La password è richiesta&$user_data");
        exit();
    } else {

        $sql = "SELECT * FROM utenti WHERE nome= '$nome'";
        $result = mysqli_query($connection, $sql);

        if (mysqli_num_rows($result) > 0) {
            header("Location: registration.php?error= Il nome è già presente nel database&$user_data");
            exit();
        } else {
            $sql2 = "INSERT INTO utenti(nome, cognome, email, password) VALUES('$nome', '$cognome', '$email', '$password')";
            $result2 = mysqli_query($connection, $sql2);
            if ($result2) {
                $_SESSION['id'] = mysqli_insert_id($connection);
                $_SESSION['nome'] = $nome;
                $_SESSION['cognome'] = $cognome;
                $_SESSION['email'] = $email;

                header("Location: personal_homepage.php");
            } else {
                header("Location: registration.php?error= Assicurati di aver compilato tutti i campi&$user_data");
                exit();
            }
        }
    }
} else {
    header("Location: registration.php");
    exit();
}
