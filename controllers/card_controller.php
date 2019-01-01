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
	if(!$stmt->execute()) {
		return false;
	}
	return true;
}

#endregion

#region Creazione e Update delle carte.

function create_new_card($mysqli, $id, $name, $set, $number, $cost, $rarity) {
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
    
    $content = "Operazioni effettuate: ";
    try {
        // Inserisco la carta.
        $stmt = $mysqli->prepare("INSERT INTO `cards`(`Id`, `Name`, `Set`, `Number`, `Cost`, `Rarity`, `Visibility`) VALUES (?, ?, ?, ?, ?, ?, 1)");
        if(!$stmt) {
            $res["result"] = false;
            $res["data"] = $mysqli->error_list;
            $res["error"] = "Boolean value in \$stmt";
            return $res;
        }
        $stmt->bind_param("issisi", $id, $name, $set, $number, $cost, $rarity);
        if($stmt->execute()) {
            $res["result"] = true;
            $content .= "Inserimento della carta $name effettuato con successo.";
        } else {
            $content .= "Riscontrato problema nell'inserimento della carta $name, contattare il supporto.";
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