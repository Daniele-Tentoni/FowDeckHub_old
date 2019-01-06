<?php
/*
 * Richiedo le funzioni di base.
 */
require_once "base_controller.php";

#region Lettura e operazioni sulle carte.

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

/*
 * Controlla se una carta esiste nel database in base al suo Id.
 */
function check_if_card_exists_by_id($mysqli, $card_param) {
	$query = "SELECT c.Id FROM cards c WHERE c.Id = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("i", $card_param);
	if($stmt->execute()) {
		$result = $stmt->get_result();
		return $result->num_rows > 0;
	}
	return false;
}


function get_cards($mysqli){
    $res = array();
    $res["result"] = false;

	// Controllo che la connessione sia impostata e che vi sia il login.
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

    // Effettuo finalmente il caricamento delle carte.
    $query = "SELECT c.Id,
                c.Name, 
                c.Set, 
                c.Number,  
                c.Cost,
                c.Visibility,
                t.Name as Type,
                a.Name as Attribute, 
                r.Id as Rarity_Id,
                r.Symbol as Rarity
            from cards c
            left join card_sets s on c.Set = s.Code 
            left join card_attributes ca on ca.Card = c.Id
            left join attributes a on ca.Attribute = a.Id 
            left join card_types ct on ct.Card = c.Id
            left join types t on ct.Type = t.Id
            left join rarity r on c.Rarity = r.Id
            where c.Visibility = 1
            order by c.Id";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $res["content"] = array();
        $res["msg"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Id"] = $row["Id"];
            $stringa["Name"] = $row["Name"];
            $stringa["Set"] = $row["Set"];
            $stringa["Number"] = $row["Number"];
            $stringa["Cost"] = $row["Cost"];
            $stringa["Visibility"] = $row["Visibility"];
            $stringa["Type"] = $row["Type"];
            $stringa["Attribute"] = $row["Attribute"];
            $stringa["Rarity_Id"] = $row["Rarity_Id"];
            $stringa["Rarity"] = $row["Rarity"];
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

#region Creazione e Update delle carte.

function create_or_update_card($mysqli, $id, $name, $set, $number, $cost, $rarity) {
    $res = array();
	$res["result"] = false;
	$res["error"] = "nothing";
	$content = "";

	// Controllo che la connessione sia impostata e che vi sia il login.
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

	if(!login_check($mysqli)) {
        $res["error"] = "login_permissions";
		$res["message"] = "You don't have login permissions.";
		return $res;
    }
    
    $content = "Start operation: ";
    try {
        $check_exists = check_if_card_exists_by_id($mysqli, $id);
        if($check_exists) {
            // Procedo con l'update.
            // Inserisco la carta.
            $stmt = $mysqli->prepare("UPDATE `cards` SET `Name` = ?, `Set` = ?, `Number` = ?, `Cost` = ?, `Rarity` = ? WHERE `Id` = ?");
            if(!$stmt) {
                $res["result"] = false;
                $res["data"] = $mysqli->error_list;
                $res["error"] = "Boolean value in \$stmt";
                return $res;
            }
            $stmt->bind_param("ssisii", $name, $set, $number, $cost, $rarity, $id);
            $content .= "update ";
        } else {
            // Procedo con l'insert.
            // Inserisco la carta.
            $stmt = $mysqli->prepare("INSERT INTO `cards`(`Id`, `Name`, `Set`, `Number`, `Cost`, `Rarity`, `Visibility`) VALUES (?, ?, ?, ?, ?, ?, 1)");
            if(!$stmt) {
                $res["result"] = false;
                $res["data"] = $mysqli->error_list;
                $res["error"] = "Boolean value in \$stmt";
                return $res;
            }
            $stmt->bind_param("issisi", $id, $name, $set, $number, $cost, $rarity);
            $content .= "insert ";
        }

        // Eseguo l'operazione scelta.
        if($stmt->execute()) {
            $res["result"] = true;
            $content .= "correctly completed.";
        } else {
            $content .= "exception. $name, $stmt->error contact the support.";
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

#endregion
?>