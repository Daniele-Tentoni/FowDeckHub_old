<?php
/*
 * Get the lists of all events.
 */
function get_all_events($mysqli, $id, $year){
    $res = array();
	$res["result"] = false;
    
	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["msg"] = "Problemi di connessione al server, contact the support1.";
		return $res;
	}
	if(isset($mysqli) && $mysqli->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	} 

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "SELECT e.Id, e.Name, n.Name as Nation, e.Year, e.Date, e.Attendance
			FROM events e
			join nations n on e.Nation = n.Id
			where e.Visibility = 1";
	
	$query .= " order by e.Date";

	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Nation"] = $row["Nation"];
			$stringa["Year"] = $row["Year"];
			$stringa["Attendance"] = $row["Attendance"];
			$stringa["Date"] = $row["Date"];
			array_push($res["content"], $stringa);
		}
	} else {
		$res["msg"] = "No data to view.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}

/*
 * Get the lists of all events.
 */
function get_all_admin_events($mysqli, $id, $year){
    $res = array();
	$res["result"] = false;
    
	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["msg"] = "Problemi di connessione al server, contact the support1.";
		return $res;
	}
	if(isset($mysqli) && $mysqli->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	} 

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "SELECT e.Id, e.Name, n.Name as Nation, e.Year, e.Date, e.Attendance, e.Visibility
			FROM events e
			join nations n on e.Nation = n.Id
			where 1 = 1";
	
	$query .= " order by e.Date";

	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Nation"] = $row["Nation"];
			$stringa["Year"] = $row["Year"];
			$stringa["Attendance"] = $row["Attendance"];
			$stringa["Date"] = $row["Date"];
			$stringa["Visibility"] = $row["Visibility"];
			array_push($res["content"], $stringa);
		}
	} else {
		$res["msg"] = "No data to view.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}

/*
 * Ritorna i dati relativi ad un evento dato il suo id.
 */
function get_event_by_id($mysqli, $id) {
	$res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["msg"] = "Problemi di connessione al server, contact the support.";
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	} 
	
	if(!isset($id)) {
		$res["msg"] = "Necessario indicate id";
		return $res;
	}

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "SELECT e.Id, e.Name, n.Name as Nation, e.Year, e.Date, e.Attendance, e.CommunityReports, e.OtherLinks
			FROM events e
			left join nations n on e.Nation = n.Id
			where e.Id = ? order by e.Date";

	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		$row = $result->fetch_assoc();
		$stringa["Id"] = $row["Id"];
		$stringa["Name"] = $row["Name"];
		$stringa["Nation"] = $row["Nation"];
		$stringa["Year"] = $row["Year"];
		$stringa["Attendance"] = $row["Attendance"];
		$stringa["Date"] = $row["Date"];
		$stringa["CommunityReports"] = $row["CommunityReports"];
		$stringa["OtherLinks"] = $row["OtherLinks"];
		$res["content"] = $stringa;
	} else {
		$res["msg"] = "No data to view.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}

/*
 * Get all decklists from an event.
 */
function get_event_decks($mysqli, $event) {
	$res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["msg"] = "Problemi di connessione al server, contact the support.";
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	} 

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "select d.Id, d.Name, d.Player, d.GachaCode, dt.Name as Type, p.Name as Style, d.Position, c.Name as Ruler
				from decklists d 
				join decktypes dt on d.Type = dt.Id
				join playstyles p on dt.Style = p.Id
				join cards c on d.Ruler = c.Id
				where d.Visibility = 1";

	if(isset($event) && $event > 0) {
		// Carico una specifica decklist.
		$query .= " and d.Event = " . $event;
	}

	$query .= " order by Event, d.Position";

	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Player"] = $row["Player"];
			$stringa["GachaCode"] = $row["GachaCode"];
			$stringa["Type"] = $row["Type"];
			$stringa["Style"] = $row["Style"];
			$stringa["Position"] = $row["Position"];
			$stringa["Ruler"] = $row["Ruler"];
			array_push($res["content"], $stringa);
		}
	} else {
		$res["msg"] = "No data to view.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}

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
              WHERE e.Visibility = 1
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
                             WHERE d.Visibility = 1
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

/*
 * Ottengo tutti i ruler breakdowns per un evento.
 */
function get_event_rulers_breakdowns_by_id($mysqli, $event_id) {
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

    // Effettuo finalmente il caricamento dei breakdown.
	$query = "select b.Ruler, c.Name, b.Quantity
				from event_rulers_breakdown b
				join cards c on b.Ruler = c.Id
				where b.Event = ?
				  and b.Quantity > 0";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $event_id_param);
	$event_id_param = $mysqli->real_escape_string($event_id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$stringa["Quantity"] = $row["Quantity"];
			$stringa["Name"] = $row["Name"];
			$msg["content"][$row["Ruler"]] = $stringa;
		}
	} else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

	$msg["result"] = true;
    return $msg;
}

/*
 * Ritorna i dati per la lista di eventi divisi per anno per il widget.
 */
function get_event_widget_details($mysqli, $year) {
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
    $query = "SELECT e.Id, e.Name, n.Name as Nation, e.Date, Cont
                FROM events e
                JOIN nations n on e.Nation = n.Id
                LEFT JOIN (SELECT d.Event, COUNT(*) as Cont
                             FROM decklists d
                             JOIN events e1 ON d.Event = e1.Id
                             WHERE e1.Year = ?
                             GROUP BY d.Event
                             HAVING Cont < 8) AS de ON de.Event = e.Id
                WHERE e.Year = ?";

    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $year_sql, $year_sql);
    $year_sql = $year;
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Id"] = $row["Id"];
            $stringa["Name"] = $row["Name"];
            $stringa["Nation"] = $row["Nation"];
            $stringa["Date"] = $row["Date"];
            $stringa["Cont"] = $row["Cont"] != null ? $row["Cont"] : 0;
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
 * Fill an array of chart data from a decklists array.
 */
function get_chart_data_by_top8_decks($decklists) {
    $data = array();
    foreach($decklists as $deck){
        if(isset($data) && isset($data[$deck["Ruler"]])) {
            $data[$deck["Ruler"]]++;
        } else {
            $data[$deck["Ruler"]] = 1;
        }
    }
    
    $chart = array();
    foreach($data as $key => $value){
        $row = array();
		$pieces = explode("/", $key);
        $row["label"] = $pieces[0];
        $row["label"] = $key;
        $row["value"] = $value;
        array_push($chart, $row);
    }
    
    return json_encode($chart);
}

/*
 * Fill an array of chart data from a breakdown array.
 */
function get_chart_data_by_breakdown($breakdown) {
	$data = array();
    foreach($breakdown as $key => $value){
		$data[$value["Name"]] = $value["Quantity"];
    }
    
    $chart = array();
    foreach($data as $key => $value){
        $row = array();
		$pieces = explode("/", $key);
        $row["label"] = $pieces[0];
        $row["value"] = $value;
        array_push($chart, $row);
    }
    
    return json_encode($chart);
}

/*
 * Crea un nuovo evento e ne ritorna l'id, oppure ritorna l'errore.
 */
function create_new_event($mysqli){
	$res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["msg"] = "Problemi di connessione al server, contact the support.";
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	}

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
    $year = date("Y");
	$query = "INSERT INTO events(Year) VALUES ($year)";

	$stmt = $mysqli->prepare($query);
	if($stmt->execute()){
        return get_event_by_id($mysqli, $mysqli->insert_id);
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
        return $res;
    }
    
	return $res;
}

/*
 * Mi salvo i dati base dell'evento.
 */
function save_base_data($mysqli, $id, $name, $year, $data, $nation, $attendance, $visibility) {
    $res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["message"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo update della sezione dei dati base e converto la data in timestamp se necessario.
	$query = "UPDATE events SET Name = ?, Nation = ?, Year = ?, Attendance = ?, `Date` = ?, Visibility = ? WHERE Id = ?";
    $pieces = explode(" ", $data);
    if(!isset($pieces[1])) {
        $data . " 00:00:00";
    }
    
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("siiisii", $name_param, $nation_param, $year_param, $attendance_param, $data_param, $visibility_param, $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$name_param = $mysqli->real_escape_string($name);
	$year_param = $mysqli->real_escape_string($year);
    $data_param = date("Y-m-d H:i:s", strtotime($data));
	$nation_param = $mysqli->real_escape_string($nation);
	$attendance_param = $mysqli->real_escape_string($attendance);
	$visibility_param = $mysqli->real_escape_string($visibility);
	if($stmt->execute()){
        $res["result"] = true;
        $res["message"] = "Update correctly completed.";
        $res["data"] = $data_param;
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
        $res["data"] = $data_param;
        $res["data"] = $id_param . "/" . $name_param . "/" . $year_param . "/" . $data_param . "/" . $nation_param . "/" . $attendance_param . "/" . $visibility_param . "/";
    }
    
	return $res;
}

/*
 * Mi salvo i community reports.
 */
function save_community_reports($mysqli, $id, $comm_rep) {
    $res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["message"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo update della sezione dei dati base e converto la data in timestamp se necessario.
	$query = "UPDATE events SET CommunityReports= ? WHERE Id = ?";
    
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("si", $comm_rep_param, $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$comm_rep_param = $mysqli->real_escape_string($comm_rep);
	if($stmt->execute()){
        $res["result"] = true;
        $res["message"] = "Update correctly completed.";
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
    }
    
	return $res;
}

/*
 * Mi salvo i link.
 */
function save_other_links($mysqli, $id, $other_links) {
    $res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["message"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo update della sezione dei dati base e converto la data in timestamp se necessario.
	$query = "UPDATE events SET OtherLinks= ? WHERE Id = ?";
    
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("si", $other_links_param, $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$other_links_param = $mysqli->real_escape_string($other_links);
	if($stmt->execute()){
        $res["result"] = true;
        $res["message"] = "Update correctly completed.";
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
    }
    
	return $res;
}

/*
 * Creo o aggiorno i ruler breakdown.
 */
function save_ruler_breakdown($mysqli, $id, $breakdown) {
    $res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["message"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "SELECT Ruler, Quantity FROM event_rulers_breakdown WHERE Event = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $event_param);
	$event_param = $mysqli->real_escape_string($id);
	if($stmt->execute()){
        $result = $stmt->get_result();
        // Divido i ruler in nuovi ed esistenti.
		$new = array();
		$old = array();
        while($row = $result->fetch_assoc()) {
			$old[$row["Ruler"]] = $row["Quantity"];
        }
        foreach ($breakdown as $key => $value) {
            if(isset($old[$key])) {
				$old[$key] = $value;
			} else {
				$new[$key] = $value;
			}
        }
		// Eseguo le update.
		foreach($old as $key => $value) {
			if($value == "" || $value <= 0) {
				// Se il valore non è valido vuol dire che è da eliminare.
				$query = "DELETE FROM event_rulers_breakdown WHERE Event = ? AND Ruler = $key";
			} else {
				$query = "UPDATE event_rulers_breakdown SET Quantity = $value WHERE Event = ? AND Ruler = $key";
			}
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("i", $event_param);
			if(!$stmt->execute()) {
				// Interrompo solamente se c'è un errore.
        		$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
        		$res["message"] = $mysqli->error;
				$res["message"] .= " There were problems during the update of the ruler $key";
				return $res;
			}
		}
		// Eseguo le insert.
		foreach($new as $key => $value) {
			if($value == "") {
				// Se il valore è null allora lo salto.
				continue;
			}
			$query = "INSERT INTO `event_rulers_breakdown` (`Event`, `Ruler`, `Quantity`) VALUES (?, $key, $value)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("i", $event_param);
			if(!$stmt->execute()) {
				// Interrompo solamente se c'è un errore.
        		$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
        		$res["message"] = $mysqli->error;
				$res["message"] .= " There were problems during the insert of the ruler $key";
				return $res;
			}
		}
		$res["result"] = true;
		$res["message"] = "Ruler Breakdowns correctly updated!";
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
    }
    
	return $res;
}
?>