<?php
require_once './definings.php';
require_once ROOT_PATH . '/config/functions.php';
$msg = array();
$msg["result"] = true;
$msg["error"] = "nothing";
$content = "";

if(!login_check($mysqli)) {
	$msg["result"] = false;
	$msg["error"] = "Niente login";
	echo json_encode($msg);
	return;
}

if(!isset($_POST)) {
	$msg["result"] = false;
	$msg["data"] = "Any data.";
	$msg["error"] = "No data.";
	echo json_encode($msg);
	return;
}

$content = "Operazioni effettuate: ";
try {
	$mysqli = new mysqli("localhost", "root", "", "my_fowdeckhub");
	$msg = array();
	$msg["result"] = true;
	if($mysqli->connect_error){
		$msg["error"] = "Connect Error";
		$msg["result"] = false;
	} else {
		// Inserisco la carta.
		$stmt = $mysqli->prepare("INSERT INTO `decklists`(`Name`, `Ruler`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`, `Position`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		if(!$stmt) {
			$msg["result"] = false;
			$msg["data"] = $mysqli->error_list;
			$msg["error"] = "Boolean value in \$stmt";
			echo json_encode($msg);
		} else {
            $stmt->bind_param("sisiiisi", $deckname, $ruler, $player, $event, $type, $visibility, $gachaCode, $position);
            $deckname = $mysqli->real_escape_string($_POST["deckname"]);
            $ruler = $mysqli->real_escape_string($_POST["ruler"]);
            $player = $mysqli->real_escape_string($_POST["player"]);
            $event = $mysqli->real_escape_string($_POST["event"]);
            $type = $mysqli->real_escape_string($_POST["type"]);
            $visibility = $mysqli->real_escape_string($_POST["visibility"]);
            $gachaCode = $mysqli->real_escape_string($_POST["gachaCode"]);
            $position = $mysqli->real_escape_string($_POST["position"]);
            if($stmt->execute()) {
                $content .= "Inserimento della carta $deckname effettuato con successo.";
            } else {
                $msg["result"] = false;
                $msg["data"] = $mysqli->error_list;
                $content .= "Riscontrato problema nell'inserimento della carta $deckname, contattare il supporto.";
            }
        }
	}
} catch (Exception $e) {
	// Posso effettuare un rollback di tutte le query fatte finora sul db.
	$msg["result"] = false;
	$msg["error"] = "Eccezione";
	$msg["msg"] = $e;
}
$msg["content"] = $content;
echo json_encode($msg);

?>