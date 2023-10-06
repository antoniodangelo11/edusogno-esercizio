<?php

class EventController {
    private $eventi = [];
    private $connection;

    public function __construct($conn) {
        $this->eventi = [];
        $this->connection = $conn;
    }

    public function addEvent($nome_evento, $attendees, $data_evento) {
        $evento = new Event(null, $nome_evento, $attendees, $data_evento);
        $this->eventi[] = $evento;
    
        $this->inserisciEventoNelDatabase($nome_evento, $attendees, $data_evento); 
    }
    
    public function getEventi() {

        $sql = "SELECT * FROM eventi";
        $result = mysqli_query($this->connection, $sql);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $evento = new Event($row['id'], $row['attendees'], $row['nome_evento'], $row['data_evento']);
                $eventi[] = $evento;
            }
            mysqli_free_result($result);
        }
    
        return $eventi;
    }

    public function modificaEvento($id_evento, $nome_evento, $attendees, $data_evento) {
        $this->aggiornaEventoNelDatabase($id_evento, $nome_evento, $attendees, $data_evento);
    }
    

    private function aggiornaEventoNelDatabase($id_evento, $nome_evento, $attendees, $data_evento) {
        $sql = "UPDATE eventi SET nome_evento = '$nome_evento', attendees = '$attendees', data_evento = '$data_evento' WHERE id = $id_evento";
    
        if (mysqli_query($this->connection, $sql)) {
            echo "Evento aggiornato con successo nel database.";
        } else {
            echo "Errore nell'aggiornamento dell'evento nel database: " . mysqli_error($this->connection);
        }
    }

    public function eliminaEvento($idDaEliminare) {
        foreach ($this->eventi as $indice => $evento) {
            if ($evento->getId() === $idDaEliminare) {
                unset($this->eventi[$indice]);
                break;
            }
        }
    
        $this->eliminaEventoDalDatabase($idDaEliminare);
    }
    
    
    private function trovaIdEventoDalDatabase($evento) {
        $sql = "SELECT id FROM eventi WHERE nome_evento = '{$evento->getNomeEvento()}' AND data_evento = '{$evento->getDataEvento()}'";
    
        $result = mysqli_query($this->connection, $sql);
    
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['id'];
        }
    
        return false;
    }
    
    private function eliminaEventoDalDatabase($idDaEliminare) {
        $sql = "DELETE FROM eventi WHERE id = $idDaEliminare";
        
        if (mysqli_query($this->connection, $sql)) {
            echo "Evento eliminato con successo dal database.";
        } else {
            echo "Errore nell'eliminazione dell'evento dal database: " . mysqli_error($this->connection);
        }
    }
    

    private function inserisciEventoNelDatabase($nome_evento, $attendees, $data_evento) {
        $server_name = "localhost";
        $user_name = "root";
        $password = "root";
        $db_name = "db_edu";
        $data_evento = date("Y-m-d H:i:s", strtotime($data_evento));

        $connection = mysqli_connect($server_name, $user_name, $password, $db_name);

        if (!$connection) {
            echo "Connessione al database fallita: " . mysqli_connect_error();
            return;
        }

        $nome_evento = mysqli_real_escape_string($connection, $nome_evento);
        $attendees = mysqli_real_escape_string($connection, $attendees);
        $data_evento = mysqli_real_escape_string($connection, $data_evento);

        $sql = "INSERT INTO eventi (nome_evento, attendees, data_evento) VALUES ('$nome_evento', '$attendees', '$data_evento')";

        if (mysqli_query($connection, $sql)) {
            echo "Nuovo evento inserito nel database con successo.";
        } else {
            echo "Errore nell'inserimento dell'evento nel database: " . mysqli_error($connection);
        }

        mysqli_close($connection);
    }
}
