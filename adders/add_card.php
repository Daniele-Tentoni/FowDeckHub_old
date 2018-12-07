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
	$msg = array();
	$msg["result"] = true;
	if($mysqli->connect_error){
		$msg["error"] = "Connect Error";
		$msg["result"] = false;
	} else {
		// Inserisco la carta.
		$stmt = $mysqli->prepare("INSERT INTO `cards`(`Id`, `Name`, `Set`, `Number`, `Cost`, `Rarity`, `Visibility`) VALUES (?, ?, ?, ?, ?, ?, 1)");
		if(!$stmt) {
			$msg["result"] = false;
			$msg["data"] = $mysqli->error_list;
			$msg["error"] = "Boolean value in \$stmt";
			echo json_encode($msg);
		}
		$stmt->bind_param("issisi", $id, $name, $set, $number, $cost, $rarity);
		$id = mysql_real_escape_string($_POST["Id"]);
		$name = mysql_real_escape_string($_POST["CardName"]);
		$set = mysql_real_escape_string($_POST["Set"]);
		$number = mysql_real_escape_string($_POST["Number"]);
		$cost = mysql_real_escape_string($_POST["Cost"]);
		$rarity = mysql_real_escape_string($_POST["Rarity"]);
		if($stmt->execute()) {
			$content .= "Inserimento della carta $name effettuato con successo.";
		} else {
			$content .= "Riscontrato problema nell'inserimento della carta $name, contattare il supporto.";
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

/*
DELETE FROM card_types t WHERE t.Card = 1234;
DELETE FROM card_attributes a WHERE a.Card = 1234;
DELETE FROM card_rarity r WHERE r.Card = 1234;
DELETE FROM cards c WHERE c.Id = 1234;
*/
?>