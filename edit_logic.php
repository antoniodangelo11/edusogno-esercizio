<?php
// Connessione al database
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $evento_id = $_POST['evento_id'];
    $nome_evento = $_POST['nome_evento'];
    $data_evento = $_POST['data_evento'];
    $orario_evento = $_POST['orario_evento'];

    // Combina la data e l'orario in un unico campo
    $data_e_orario = $data_evento . ' ' . $orario_evento;

    // Query SQL per l'aggiornamento dei dati dell'evento
    $query = "UPDATE eventi SET nome_evento = '$nome_evento', data_evento = '$data_e_orario' WHERE id = $evento_id";

    // Esegui la query e gestisci gli errori
    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Errore nell\'aggiornamento: ' . mysqli_error($conn));
    }

    header("Location: personal_homepage.php"); 
    exit();
}
?>