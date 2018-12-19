<?php
/*
 * Mi salvo i dati base dell'evento.
 */
function save_base_decklist_data($id, $name, $player, $event, $type, $position, $gacha_code, $visibility) {
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
	$query = "UPDATE `decklists` SET `Name`=?,`Player`=?,`Event`=?,`Type`=?,`Visibility`=?,`GachaCode`=?,`Position`=? WHERE `Id`=?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("ssiiisii", $name_param, $player_param, $event_param, $type_param, $position_param, $gacha_code_param, $visibility_param, $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$name_param = $mysqli->real_escape_string($name);
	$player_param = $mysqli->real_escape_string($player);
	$event_param = $mysqli->real_escape_string($event);
	$type_param = $mysqli->real_escape_string($type);
	$position_param = $mysqli->real_escape_string($position);
	$gacha_code_param = $mysqli->real_escape_string($gacha_code);
	$visibility_param = $mysqli->real_escape_string($visibility);
	if($stmt->execute()){
        $res["result"] = true;
        $res["message"] = "Update correctly completed.";
        $res["data"] = $data_param;
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
function save_decklist($mysqli, $id, $decks) {
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
	$query = "DELETE FROM card_quantities WHERE Decklist = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $deck_param);
	$deck_param = $mysqli->real_escape_string($id);
	if($stmt->execute()){
        // Divido i mazzetti da aggiungere.
		$ruler = array();
        foreach ($decks["ruler"]["deck"] as $value) {
			$query = "INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?, ?, ?, ?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("i", $event_param);
			if(!$stmt->execute()) {
				// Interrompo solamente se c'è un errore.
        		$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
        		$res["message"] = $mysqli->error;
				$res["message"] .= " There were problems during the insert of the ruler $value";
				return $res;
			}
        }
		$rune = array();
        foreach ($decks["rune"]["deck"] as $key => $value) {
			$rune[$key] = $value;
        }
		$main = array();
        foreach ($decks["main"]["deck"] as $key => $value) {
			$main[$key] = $value;
        }
		$side = array();
        foreach ($decks["side"]["deck"] as $key => $value) {
			$side[$key] = $value;
        }
		$stone = array();
        foreach ($decks["stone"]["deck"] as $key => $value) {
			$stone[$key] = $value;
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