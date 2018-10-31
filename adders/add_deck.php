<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
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
	$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
	$msg = array();
	$msg["result"] = true;
	if($conn->connect_error){
		$msg["error"] = "Connect Error";
		$msg["result"] = false;
	} else {
		// Inserisco la carta.
		$stmt = $conn->prepare("INSERT INTO `decklists`(`Name`, `Ruler`, `Player`, `Event`, `Type`, `Visibility`, `GachaCode`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		if(!$stmt) {
			$msg["result"] = false;
			$msg["data"] = $conn->error_list;
			$msg["error"] = "Boolean value in \$stmt";
			echo json_encode($msg);
		} else {
            $stmt->bind_param("sisiiis", $deckname, $ruler, $player, $event, $type, $visibility, $gachaCode);
            $deckname = mysql_real_escape_string($_POST["deckname"]);
            $ruler = mysql_real_escape_string($_POST["ruler"]);
            $player = mysql_real_escape_string($_POST["player"]);
            $event = mysql_real_escape_string($_POST["event"]);
            $type = mysql_real_escape_string($_POST["type"]);
            $visibility = mysql_real_escape_string($_POST["visibility"]);
            $gachaCode = mysql_real_escape_string($_POST["gachaCode"]);
            if($stmt->execute()) {
                $content .= "Inserimento della carta $deckname effettuato con successo.";
            } else {
                $msg["result"] = false;
                $msg["data"] = $conn->error_list;
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