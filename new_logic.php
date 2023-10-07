<?php
session_start();

if (isset($_SESSION['id']) && isset($_SESSION['nome']) && isset($_SESSION['cognome'])) {
    include "db_connection.php";

    $email = $_SESSION['email'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome_evento = $_POST['nome_evento'];
        $data_evento = $_POST['data_evento']; 
        $orario_evento = $_POST['orario_evento']; 
        $data_ora_evento = "$data_evento $orario_evento:00"; 

        $query = "INSERT INTO eventi (attendees, nome_evento, data_evento) VALUES ('$email', '$nome_evento', '$data_ora_evento')";
        $result = mysqli_query($connection, $query);

        if ($result) {  
            header('Location: personal_homepage.php');
            exit;
        } else {
            echo 'Si è verificato un errore durante la creazione dell\'evento.';
        }
    }
} else {
    header('Location: login.php');
    exit;
}
?>