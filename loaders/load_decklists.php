<?php
function getDecks($id){
	$res = array();
	$res["result"] = false;
	$dlconn = new mysqli("localhost", "root", "", "my_fowdeckhub");

	// Controllo che la connessione sia impostata.
	if(!isset($dlconn)) {
		$res["msg"] = "Problemi di connessione al server, contact the support.";
		return $res;
	}

	if(isset($dlconn) && $dlconn->connect_error) {
		$res["msg"] = "Problema di connessione instaurata al server, contact the support.";
		return $res;
	} 

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "select d.Id, d.Name, d.Player, d.GachaCode, dt.Name as Type, p.Name as Style, e.Name as Event, d.Position, c.Name as Ruler
				from decklists d 
				join decktypes dt on d.Type = dt.Id
				join playstyles p on dt.Style = p.Id
				join `events` e on d.Event = e.Id
				join cards c on d.Ruler = c.Id
				where d.Visibility = 1";

	if(isset($id) && $id > 0) {
		// Carico una specifica decklist.
		$query .= " and d.Id = " . $id;
	}

	$query .= " order by Event, Position";

	$stmt = $dlconn->prepare($query);
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
			$stringa["Event"] = $row["Event"];
			$stringa["Position"] = $row["Position"];
			$stringa["Ruler"] = $row["Ruler"];
			array_push($res["content"], $stringa);
		}
	} else {
		$res["msg"] = "No data to view.";
		return $res;
	}

	$res["result"] = true;
	if(isset($dlconn)) {
		$dlconn->close();
	}
	return $res;
}
?>