<?php
/*
 * Ritorna i dati utili ad implementare la mappa cliccabile per adesso.
 */
function get_event_map($mysqli) {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing1";
    $content = "";
    
    // Controllo che la connessione sia impostata.
    if(!isset($mysqli)) {
        $msg["error"] = "Server connection error. Please, contact the support.";
        return $msg;
    }

    if(isset($mysqli) && $mysqli->connect_error) {
        $msg["error"] = "Database server connection error. Please, contact the support.";
        return $msg;
    } 

    // Effettuo finalmente il caricamento della decklist.
    // Carico tutte le decklists.
    $query = "SELECT n.Id, n.WorldMapSign as Sign, COUNT(*) as Conteggio
              FROM events e
			  JOIN nations n ON e.Nation = n.Id
              GROUP BY Sign";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Id"] = $row["Id"];
            $stringa["Sign"] = $row["Sign"];
            $stringa["Conteggio"] = $row["Conteggio"];
            array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    $msg["result"] = true;
    return $msg;
}

/*
 * Ritorna la lista di eventi effettuati per una certa regione.
 * Molto utile per caricare i dati relativi agli eventi filtrati sulla mappa.
 */
function get_event_map_details($mysqli, $region) {
    return "Effetivamente funziona: " . $region;
}

?>