<?php
/*
 * Richiedo le funzioni di base.
 */
require_once "base_controller.php";

#region Lettura e operazioni sulle decklist

/*
 * Legge tutte le carte di una singola decklist.
 */
function get_card_list_by_decklist_id($mysqli, $id) {
	$res = array();
	$res["result"] = false;
    
	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
        $res["error"] = "server_err";
        $res["number"] = $mysqli->errno;
        $res["message"] = SERVER_ERR;
		return $res;
	}
	if(isset($mysqli) && $mysqli->connect_error) {
        $res["error"] = "server_conn_err";
        $res["number"] = $mysqli->errno;
        $res["message"] = SERVER_CONN_ERR;
		return $res;
	} 

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "SELECT `Card`, t.`Name` as Decktype, `Quantity`, c.`Id`, c.`Name`, c.`Set`, c.`Number`, t.`Label`
	FROM `card_quantities` q 
	INNER JOIN `cards` c on q.`Card` = c.`Id` 
	INNER JOIN `deck_types` t on q.`Decktype` = t.`Id` 
	WHERE `Decklist` = ?
	ORDER BY t.`Id`, c.`Name`, c.`Set`, c.`Number`";

	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["result"] = true;
		$res["message"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Card"] = $row["Card"];
			$stringa["Decktype"] = $row["Decktype"];
			$stringa["Quantity"] = $row["Quantity"];
			$stringa["Name"] = $row["Name"];
			$stringa["Set"] = $row["Set"];
			$stringa["Number"] = $row["Number"];
			$stringa["DeckLabel"] = $row["Label"];
			array_push($res["content"], $stringa);
		}
	} else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = "No data to view. " . $mysqli->error;
		return $res;
	}

	$res["result"] = true;
	return $res;
}

/*
 * Legge una singola decklist.
 */ 
function get_decklist_by_id($mysqli, $id) {
	$res = array();
	$res["result"] = false;

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
        $res["error"] = "server_err";
        $res["number"] = $mysqli->errno;
        $res["message"] = SERVER_ERR;
	}
	if(isset($mysqli) && $mysqli->connect_error) {
        $res["error"] = "server_conn_err";
        $res["number"] = $mysqli->errno;
        $res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo finalmente il caricamento della decklist in base all'id.
	$query = "select d.Id, 
					 d.Name, 
					 d.Player, 
					 d.GachaCode, 
					 dt.Name as Type, 
					 p.Name as Style, 
					 e.Id as EventId, 
					 e.Name as Event, 
					 d.Position,
					 d.Visibility
			  from decklists d
			  left join decktypes dt on d.Type = dt.Id
			  left join playstyles p on dt.Style = p.Id
			  left join `events` e on d.Event = e.Id
			  where d.Id = ?";

	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		$row = $result->fetch_assoc();
		$stringa = array();
		$stringa["Id"] = $row["Id"];
		$stringa["Name"] = $row["Name"];
		$stringa["Player"] = $row["Player"];
		$stringa["GachaCode"] = $row["GachaCode"];
		$stringa["Type"] = $row["Type"];
		$stringa["Style"] = $row["Style"];
		$stringa["EventId"] = $row["EventId"];
		$stringa["Event"] = $row["Event"];
		$stringa["Position"] = $row["Position"];
		$stringa["Visibility"] = $row["Visibility"];
		$res["content"] = $stringa;
	} else {
		$res["msg"] = "No data to view with id $id.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}

/*
 * Mi permette di ottenere tutti i deck che sono storicizzati nel database, con visibilità in base ai permessi.
 */
function get_all_decks($mysqli, $visibility){
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
	$query = "select d.Id, d.Name, d.Player, d.GachaCode, dt.Name as Type, p.Name as Style, e.Name as Event, d.Position, d.Visibility
				from decklists d 
				left join decktypes dt on d.Type = dt.Id
				left join playstyles p on dt.Style = p.Id
				left join `events` e on d.Event = e.Id";

	$query .= $visibility ? " where d.Visibility = 1" : "";
	$query .= " order by Event, Position";

	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$res["content"] = array();
		$res["msg"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$checking = check_if_deck_have_card_list($mysqli, $row["Id"]);
			$stringa["DeckUp"] = $checking["result"] ? $checking["content"] : $checking["message"];
			if($checking["content"]) {
				$ruler = get_ruler_by_decklist($mysqli, $stringa["Id"]);
				$stringa["Ruler"] = $ruler["result"] ? $ruler["content"] : $ruler["message"];
			}
			$stringa["Name"] = $row["Name"];
			$stringa["Player"] = $row["Player"];
			$stringa["GachaCode"] = $row["GachaCode"];
			$stringa["Type"] = $row["Type"];
			$stringa["Style"] = $row["Style"];
			$stringa["Event"] = $row["Event"];
			$stringa["Position"] = $row["Position"];
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

#endregion

#region Creazione e modifica delle decklist.

/*
 * Creazione di una nuova decklist.
 */
function create_new_decklist($mysqli){
	$res = array();
	$res["result"] = false;
	$res["error"] = "nothing";
	$content = "";

	// Controllo che la connessione sia impostata e che vi sia il login.
	if(!isset($mysqli)) {
		$res["error"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["error"] = SERVER_CONN_ERR;
		return $res;
	}

	if(!login_check($mysqli)) {
		$res["error"] = "You don't have login permissions.";
		return $res;
	}

	$content = "Operazioni effettuate: ";
	try {
		// Inserisco la nuova decklist.
		$stmt = $mysqli->prepare("INSERT INTO `decklists`(`Name`) VALUES (?)");
		if(!$stmt) {
			$res["data"] = $mysqli->error_list;
			$res["error"] = "Boolean value in \$stmt";
			return $res;
		} else {
			$stmt->bind_param("s", $deckname);
			$deckname = "Not set";
			if($stmt->execute()) {
				return get_decklist_by_id($mysqli, $mysqli->insert_id);
			} else {
				$res["result"] = false;
				$res["data"] = $mysqli->error_list;
				$content .= "There's an error. Riscontrato problema nell'inserimento della carta $deckname, contattare il supporto.";
			}
		}
	} catch (Exception $e) {
		// Posso effettuare un rollback di tutte le query fatte finora sul db.
		$res["result"] = false;
		$res["error"] = "Eccezione";
		$res["msg"] = $e;
	}
	$res["content"] = $content;
	return $res;
}

/*
 * Mi salvo i dati base dell'evento.
 */
function save_base_decklist_data($mysqli, $id, $name, $player, $event, $type, $position, $gacha_code, $visibility) {
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
	$stmt->bind_param("ssiiisii", $name_param, $player_param, $event_param, $type_param, $visibility_param, $gacha_code_param, $position_param, $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$name_param = $mysqli->real_escape_string($name);
	$player_param = $mysqli->real_escape_string($player);
	$event_param = $mysqli->real_escape_string($event);
	$type_param = $mysqli->real_escape_string($type);
	$position_param = $mysqli->real_escape_string($position);
	$gacha_code_param = $mysqli->real_escape_string($gacha_code);
	$visibility_param = $mysqli->real_escape_string($visibility);
	if(check_if_deck_have_card_list($mysqli, $id)) {
        $res["error"] = "no_decklist";
        $res["message"] = "This decklist haven't a card list uploaded.";
	}
	if($stmt->execute()){
        $res["result"] = true;
        $res["message"] = "Update correctly completed.";
        $res["data"] = $name_param;
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
	$res["message"] = "";

	// Controllo che la connessione sia impostata.
	if(!isset($mysqli)) {
		$res["error"] = "server_err";
		$res["message"] = SERVER_ERR;
		return $res;
	}

	if(isset($mysqli) && $mysqli->connect_error) {
		$res["error"] = "server_conn_err";
		$res["message"] = SERVER_CONN_ERR;
		return $res;
	}

	// Effettuo finalmente il caricamento della decklist.
	// Carico tutte le decklists.
	$query = "DELETE FROM card_quantities WHERE Decklist = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $deck_param);
	$deck_param = $mysqli->real_escape_string($id);
	//$res["message"] .= var_dump($decks) . " ||| ";
	if($stmt->execute()){
		$correct = true;
        // Divido i mazzetti da aggiungere.
        foreach ($decks["ruler"]["deck"] as $key => $value) {
			$query = "INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?, (SELECT c.Id
					  FROM cards c
					  WHERE c.Name = ?), 0, ?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isi", $deck_param, $card_param, $quantity_param);
			$card_param = $value["name"];
			$quantity_param = intval($value["count"]);
			if(!$stmt->execute()) {
				$correct = false;
				// Interrompo solamente se c'è un errore.
        		$res["error"] = "query";
				$res["query"] = $query;
        		$res["number"] = $mysqli->errno;
        		$res["message"] .= $mysqli->error . var_dump($value);
				$res["message"] .= " There were problems during the insert of the ruler " . $card_param . " di quantita " . $quantity_param;
			}
        }
		
        foreach ($decks["rune"]["deck"] as $key => $value) {
			$query = 'INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?,(SELECT c.Id
					  FROM cards c
					  WHERE c.Name = ?),1,?)';
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isi", $deck_param, $card_param, $quantity_param);
			$card_param = $value["name"];
			$quantity_param = intval($value["count"]);
			if(!$stmt->execute()) {
				$correct = false;
				// Interrompo solamente se c'è un errore, provo subito a cercare la carta.
        		$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
				if(!check_if_card_exists($mysqli, $id)) {
					$res["message"] .= " The rune " . $value["name"] . " dosen't exists in database. Add it or call the system administrator.";
				} else {
					$res["message"] .= " There were problems during the insert of the rune " . $value["name"] . " of count " . $value["count"];
				}
			}
        }
		
        foreach ($decks["main"]["deck"] as $key => $value) {
			$query = "INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?,(SELECT c.Id
					  FROM cards c
					  WHERE c.Name = ?),2,?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isi", $deck_param, $card_param, $quantity_param);
			$card_param = $value["name"];
			$quantity_param = intval($value["count"]);
			if(!$stmt->execute()) {
				$correct = false;
				// Interrompo solamente se c'è un errore, provo subito a cercare la carta.
        		$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
				if(!check_if_card_exists($mysqli, $id)) {
					$res["message"] .= " The main " . $card_param . " dosen't exists in database. Add it or call the system administrator.";
				} else {
					$res["message"] .= " There were problems during the insert of main " . $card_param . " of count " . $quantity_param;
				}
			}
        }
		
        foreach ($decks["side"]["deck"] as $key => $value) {
			$query = "INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?,(SELECT c.Id
					  FROM cards c
					  WHERE c.Name = ?),3,?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isi", $deck_param, $card_param, $quantity_param);
			$card_param = $value["name"];
			$quantity_param = intval($value["count"]);
			if(!$stmt->execute()) {
				$correct = false;
				// Interrompo solamente se c'è un errore.
				$res["error"] = "query";
        		$res["number"] = $mysqli->errno;
				if(!check_if_card_exists($mysqli, $id)) {
					$res["message"] .= " The side " . $card_param . " dosen't exists in database. Add it or call the system administrator.";
				} else {
					$res["message"] .= " There were problems during the insert of side " . $card_param . " of count " . $quantity_param;
				}
			}
        }
		
        foreach ($decks["stone"]["deck"] as $key => $value) {
			$query = "INSERT INTO `card_quantities`(`Decklist`, `Card`, `Decktype`, `Quantity`) VALUES (?,(SELECT c.Id
					  FROM cards c
					  WHERE c.Name = ?),4,?)";
			$stmt = $mysqli->prepare($query);
			$stmt->bind_param("isi", $deck_param, $card_param, $quantity_param);
			$card_param = $value["name"];
			$quantity_param = intval($value["count"]);
			if(!$stmt->execute()) {
				$correct = false;
				// Interrompo solamente se c'è un errore.
        		$res["error"] = "query";
				$res["query"] = $query;
        		$res["number"] = $mysqli->errno;
				if(!check_if_card_exists($mysqli, $id)) {
					$res["message"] .= " The stone " . $card_param . " dosen't exists in database. Add it or call the system administrator.";
				} else {
					$res["message"] .= " There were problems during the insert of stone " . $card_param . " of count " . $quantity_param;
				}
			}
		}
		
		// Restituisco il messaggio affermativo.
		if($correct) {
			$res["result"] = true;
			$res["message"] .= "Decklist correctly imported.";
		}
    } else {
        $res["error"] = "query";
        $res["number"] = $mysqli->errno;
        $res["message"] = $mysqli->error;
    }
	return $res;
}

/*
 * Controlla se una carta esiste nel database.
 */
function check_if_card_exists($mysqli, $card_param) {
	$query = "SELECT c.Id FROM cards c WHERE c.Name = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("s", $card_param);
	if($stmt->execute()) {
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}
	return false;
}

#endregion
?>