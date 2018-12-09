<?php
/*
 * Ritorna i dati utili ad implementare la mappa cliccabile per adesso.
 */
function get_event_map($mysqli) {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $stringa = "";
    
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
            $stringa[$row["Sign"]] = $row["Conteggio"];
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    return $stringa;
}

/*
 * Ritorna la lista di eventi effettuati per una certa regione.
 * Molto utile per caricare i dati relativi agli eventi filtrati sulla mappa.
 */
function get_event_map_details($mysqli, $region) {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $msg["content"] = array();
    
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
    $query = "SELECT e.Id, e.Name, n.Name as Nation, e.Year, e.Date, e.Attendance, Cont
                FROM events e
                JOIN nations n on e.Nation = n.Id
                LEFT JOIN (SELECT d.Event, COUNT(*) as Cont
			                 FROM decklists d
			                 GROUP BY d.Event) AS de ON de.Event = e.Id
                WHERE n.WorldMapSign = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $region_sql);
    $region_sql = $region;
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Nation"] = $row["Nation"];
			$stringa["Year"] = $row["Year"];
			$stringa["Date"] = $row["Date"];
			$stringa["Attendance"] = $row["Attendance"];
			$stringa["Cont"] = $row["Cont"];
			array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

	$msg["result"] = true;
    return $msg;

}

?>