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

if(!isset($_POST["data"])) {
	$msg["result"] = false;
	$msg["data"] = "Any data.";
	$msg["error"] = "No data.";
	echo json_encode($msg);
	return;
}

$data = $_POST["data"];
$content = "Operazioni effettuate: ";
try {
	$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
	$msg = array();
	$msg["result"] = true;
	if($conn->connect_error){
		$msg["error"] = "Connect Error";
		$msg["result"] = false;
	} else {
		$conn->autocommit(false);
		$conn->begin_transaction();

		// Inserisco la carta.
		$stmt = $conn->prepare("INSERT INTO `cards`(`Id`, `Name`, `Set`, `Number`, `Cost`) VALUES (?, ?, ?, ?, ?)");
		if(!$stmt) {
			$msg["result"] = false;
			$msg["data"] = $conn->error_list;
			$msg["error"] = "Boolean value in \$stmt";
			echo json_encode($msg);
		}
		$stmt->bind_param("issis", $id, $name, $set, $number, $cost);
		$id = mysql_real_escape_string($data[0]);
		$name = mysql_real_escape_string($data[1]);
		$set = mysql_real_escape_string($data[2]);
		$number = mysql_real_escape_string($data[3]);
		$cost = mysql_real_escape_string($data[5]);
		$stmt->execute();
		$content .= "\nInserita carta [0]: " . $id;

		// Inserisco gli attributi.
		$stmt = $conn->prepare("INSERT INTO card_attributes (Card, Attribute) VALUES (?, ?)");
		$stmt->bind_param("ii", $id, $attribute);
		$id = mysql_real_escape_string($data[0]);
		$attribute = $data[6];
		$stmt->execute();
		$content .= "\nInserito attributo [6]: " . $data[6];

		// Inserisco i tipi.
		$stmt = $conn->prepare("INSERT INTO card_types (Card, Type) VALUES (?, ?)");
		$stmt->bind_param("ii", $id, $type);
		$id = mysql_real_escape_string($data[0]);
		$type = $data[4];
		$stmt->execute();
		$content .= "\nInserito tipo [4]: " . $data[4];

		// Inserisco la rarità.
		$stmt = $conn->prepare("INSERT INTO card_rarity (Card, Rarity) VALUES (?, ?)");
		$stmt->bind_param("ii", $id, $rarity);
		$id = mysql_real_escape_string($data[0]);
		$rarity = $data[7];
		$stmt->execute();
		$content .= "\nInserita rarità [7]: " . $data[7];

		$conn->commit();
		$conn->autocommit(true); // Disabilito le transizioni, applico le query.
	}
} catch (Exception $e) {
	// Posso effettuare un rollback di tutte le query fatte finora sul db.
	$conn->rollBack();
	$msg["result"] = false;
	$msg["error"] = "Eccezione";
	$msg["msg"] = $e;
}
$msg["content"] = $content;
echo json_encode($msg);
?>