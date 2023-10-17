<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/general_style.css?v=<?php echo time(); ?>">
</head>

<body>
<?php

include("db_connection.php");
?>
<div class="container">
    <div class="container_form">
    <h2 class="title_event_form">Modifica evento</h2>
        <?php
        if (isset($_GET['evento_id'])) {
            $evento_id = $_GET['evento_id'];
            $query = "SELECT * FROM eventi WHERE id = $evento_id";
            $result = mysqli_query($connection, $query);
            if (!$result) {
                die('Errore nella query: ' . mysqli_error($conn));
            }

            if (mysqli_num_rows($result) > 0) { 
                $row = mysqli_fetch_assoc($result);?>
                
                <form method="post" action="edit_logic.php" class="form_style">
                    <input type="hidden" name="evento_id" value="<?php echo $row['id']; ?>">
                    <label for="nome_evento" class="write_event">Nome dell'evento:</label>
                    <input type="text" name="nome_evento" id="nome_evento" value="<?php echo $row['nome_evento']; ?>" required>

                    <label for="data_evento" class="write_event">Data dell'evento:</label>
                    <?php
                        $data_evento = $row['data_evento'];
                        $formatted_date = date('Y-m-d', strtotime($data_evento));
                    ?>
                    
                    <input type="date" name="data_evento" id="data_evento" value="<?php echo $formatted_date; ?>" required>
                    <?php
                        $data_evento = $row['data_evento'];
                        $date = new DateTime($data_evento);
                        $orario_evento = $date->format('H:i');
                    ?>

                    <label for="orario_evento" class="write_event">Orario dell'evento:</label>
                    <input type="time" name="orario_evento" id="orario_evento" value="<?php echo $orario_evento; ?>" required>

                
                    <button type="submit">Modifica evento</button>
                </form>
            <?php
            } else {
                echo 'L\'evento specificato non è stato trovato.';
            }

        
        } else {
            echo 'ID dell\'evento non specificato.';
        }
        ?>
    </div>
</div>
</body>
</html>