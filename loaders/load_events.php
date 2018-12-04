<?php
function get_event($id) {
	$res = array();
	$res["result"] = false;
	// Occorre ridichiarare la connessione al database.
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

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
			join nations n on e.Nation = n.Id
			where e.Id = ? order by e.Date";

	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $id_param);
	$id_param = mysql_real_escape_string($id);
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
 * Get the lists of all events.
 */
function get_events($id, $year){
    $res = array();
	$res["result"] = false;
	// Occorre ridichiarare la connessione al database.
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
    
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
			where 1 = 1";

	/*
	// Carico in base all'anno.
	if(isset($year) && $year > 0) {
		$query .= " and e.Year = ?" . $year;
	}
	
	// Carico una specifica decklist.
	if(isset($id) && $id > 0) {
		$query .= " and e.Id = " . $id;
	}
	*/
	
	$query .= " order by e.Date";

	$stmt = $mysqli->prepare($query);
	
	/*
	// Codice poco pulito.
	if(isset($year) && $year > 0) {
		$stmt->bind_param("i", $year_param);
		$year_param = mysql_real_escape_string($year);
	}
	*/
	
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
 * Get all decklists from an event.
 */
function get_event_decks($event) {
	$res = array();
	$res["result"] = false;
	// Occorre ridichiarare la connessione al database.
    $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);

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

	$query .= " order by Event, Position";

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
 * Fill an array of chart data from an decklists array.
 */
function get_chart_data_by_decks($decklists){
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
        $row["label"] = $key;
        $row["value"] = $value;
        array_push($chart, $row);
    }
    
    return json_encode($chart);
}
?>