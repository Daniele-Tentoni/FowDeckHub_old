<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$msg = array();
$msg["result"] = true;
$msg["error"] = "nothing";

if(!login_check($mysqli)) {
	$msg["result"] = false;
	$msg["error"] = "Niente login";
	echo json_encode($msg);
	return;
}

if(!isset($_POST["data"])) {
	$msg["result"] = false;
	$msg["data"] = "Any data.";
	$msg["error"] = "No data.";
	echo json_encode($msg);
	return;
}

$data = $_POST["data"];
$msg["content"] = "Operazioni effettuate: ";
try {
	$mysqli->autocommit(false);
	$mysqli->begin_transaction();
	
	// Inserisco la carta.
	$stmt = $mysqli->prepare("insert into cards(Id, Name, Set, Number, Cost) values (?, ?, ?, ?, ?)");
	$stmt->bind_param("issis", $id, $name, $set, $number, $cost);
	$id = mysql_real_escape_string($data[0]);
	$name = mysql_real_escape_string($data[1]);
	$set = mysql_real_escape_string($data[2]);
	$number = mysql_real_escape_string($data[3]);
	$cost = mysql_real_escape_string($data[5]);
	$stmt->execute();
	$last_id = $conn->insert_id;
	$msg["content"] .= "\nInserita carta: " . $last_id;
	
	// Inserisco gli attributi.
	$stmt = $mysqli->prepare("INSERT INTO card_attributes (Card, Attribute) VALUES (?, ?)");
	$stmt->bind_param("ii", $last_id, $attribute);
	$attribute = mysql_real_escape_string($data[6]);
	$stmt->execute();
	$msg["content"] .= "\nInserito attributo: " . $attribute;
	
	// Inserisco i tipi.
	$stmt = $mysqli->prepare("INSERT INTO card_types (Card, Type) VALUES (?, ?)");
	$stmt->bind_param("ii", $last_id, $type);
	$type = mysql_real_escape_string($data[4]);
	$stmt->execute();
	$msg["content"] .= "\nInserito tipo: " . $type;
	
	// Inserisco la rarità.
	$stmt = $mysqli->prepare("INSERT INTO card_rarity (Card, Rarity) VALUES (?, ?)");
	$stmt->bind_param("ii", $last_id, $rarity);
	$rarity = mysql_real_escape_string($data[7]);
	$stmt->execute();
	$msg["content"] .= "\nInserita rarità: " . $rarity;
	
	$conn->commit();
	$conn->autocommit(true); // Disabilito le transizioni, applico le query.
} catch (Exception $e) {
	// Posso effettuare un rollback di tutte le query fatte finora sul db.
	$conn->rollBack();
	$msg["result"] = false;
	$msg["error"] = "Eccezione";
	$msg["msg"] = $e;
}
$msg["data"] = $_POST["data"];
echo json_encode($msg);
?>