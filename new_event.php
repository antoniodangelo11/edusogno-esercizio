<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/styles/general_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="container_form">
            <h2 class="title_event_form">Crea un nuovo evento</h2>
            <form method="post" action="new_logic.php" class="form_style">
                <label for="nome_evento" class="write_event">Nome dell'evento:</label>
                <input type="text" name="nome_evento" id="nome_evento" required>
                
                <label for="data_evento" class="write_event">Data dell'evento:</label>
                <input type="date" name="data_evento" id="data_evento" required>

                <label for="orario_evento" class="write_event">Orario dell'evento:</label>
                <input type="time" name="orario_evento" id="orario_evento" required>
                
                <button type="submit">Crea evento</button>
            </form>
        </div>
    </div>
</body>
</html>