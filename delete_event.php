<?php
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_event'])) {
    $evento_id = $_POST['evento_id'];

    $query = "DELETE FROM eventi WHERE id = $evento_id";

    $result = mysqli_query($connection, $query);
    if (!$result) {
        die('Errore nella cancellazione: ' . mysqli_error($conn));
    }

    header("Location: personal_homepage.php");
    exit();
}
?>