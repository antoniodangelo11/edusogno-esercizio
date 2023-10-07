<?php
session_start();
include "db_connection.php";
include "header.php";

if (isset($_SESSION['id']) && isset($_SESSION['nome']) && isset($_SESSION['cognome']) && isset($_SESSION['email'])) {

    $userEmail = $_SESSION['email'];
    $sqlAdminCheck = "SELECT admin FROM utenti WHERE email = '$userEmail'";
    $resultAdminCheck = mysqli_query($connection, $sqlAdminCheck);

    if ($resultAdminCheck) {
        $rowAdminCheck = mysqli_fetch_assoc($resultAdminCheck);
        $isAdmin = $rowAdminCheck['admin'];
    } else {
        echo "Errore nella query di verifica admin: " . mysqli_error($conn);
        exit();
    }

    if ($isAdmin) {
        $sqlEvents = "SELECT * FROM eventi";
    } else {
        $sqlEvents = "SELECT * FROM eventi WHERE attendees LIKE '%$userEmail%'";
    }

    $resultEvents = mysqli_query($connection, $sqlEvents);

    if ($resultEvents) {
    } else {
        echo "Errore nella query degli eventi: " . mysqli_error($conn);
        exit();
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
    </head>

    <body>
        <h1>Ciao, <?php echo $_SESSION['nome']; ?> <?php echo $_SESSION['cognome']; ?> ecco i tuoi eventi</h1>
        <div class="buttons">
            <button><a href="logout.php">Logout</a></button>

            <?php
            if ($isAdmin) {
            ?>
                <button><a href="dash_admin.php">Pannello di Amministrazione</a></button>
            <?php
            } else {
            ?>
                <button><a href="javascript:void(0)" onclick="alert('Non sei un amministratore')">Pannello di Amministrazione</a></button>
            <?php
            }
            ?>
        </div>

        <?php
        if (mysqli_num_rows($resultEvents) > 0) {

        ?> <div class="cards"> <?php
                            while ($row = mysqli_fetch_assoc($resultEvents)) {
                            ?>

                    <div class="card-body">
                        <h2 class="card-title"><?php echo $row['nome_evento']; ?></h2>
                        <p class="card-text">Data: <?php echo $row['data_evento']; ?></p>
                        <button>JOIN</button>
                    </div>

                <?php
                            } ?>
            </div> <?php
                    mysqli_free_result($resultEvents);
                } else {
                    echo "Nessun evento";
                }
                    ?>

    </body>

    </html>
<?php
} else {
}
?>