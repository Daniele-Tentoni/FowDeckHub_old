<?php
#region Test
/*
 * Funzione base per testare il funzionamento dei controller.
 */
function test_controller($mysqli) {
	$stringa = "Hai richiesto correttamente il controller.";
	if(isset($mysqli)) {
		$stringa .= "La connessione è impostata.";
	} else {
		$stringa .= "La connessione non è impostata";
	}
	return $stringa;
}
#endregion

#region Common

/*
 * Funzione per capire se un deck ha una decklist e quindi può essere visibile agli utenti.
 */
function check_if_deck_have_card_list($mysqli, $id) {
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
	$query = "SELECT q.Decklist, q.Decktype, q.Somma
				from decklists d
				left join (SELECT Decklist, Decktype, sum(Quantity) as 'Somma'
							from card_quantities
							where Decklist = ?
							group by Decktype) q on d.Id = q.Decklist
				where q.Decktype in (0, 2, 4)
				group by q.Decklist, q.Decktype
				order by q.Decktype, q.Decklist";

	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $id_param);
	$id_param = $mysqli->real_escape_string($id);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
        $res["content"] = true;
		$res["message"] = "There's some data to view";
		while($row = $result->fetch_assoc()) {
			if($row["Decktype"] == 0 && ($row["Somma"] < 1 || $row["Somma"] > 3)) {
				$res["content"] = false;
			}
			if($row["Decktype"] == 2 && ($row["Somma"] < 40 || $row["Somma"] > 60)) {
				$res["content"] = false;
			}
			if($row["Decktype"] == 4 && ($row["Somma"] < 10 || $row["Somma"] > 20)) {
				$res["content"] = false;
			}
		}
	} else {
		$res["message"] = "No data to view with id $id.";
		return $res;
	}

	$res["result"] = true;
	return $res;
}
#endregion
?>