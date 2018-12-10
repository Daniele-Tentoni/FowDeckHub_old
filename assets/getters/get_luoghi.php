<?php
require $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
$msg["result"] = true;
$conn = new mysqli($dbaddress, "root", "", $dbname);
if($conn->connect_error) {
    // Qui la connessione non è riuscita.
    $msg["result"] = false;
    $msg["error"] = "Non sono riuscito ad instaurare la connessione.";
    echo json_encode($msg);
} else {
	$query = "SELECT luogo.Codice, luogo.Nome FROM luogo ORDER BY luogo.Nome";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Codice"] = $row["Codice"];
			$stringa["Nome"] = $row["Nome"];
			array_push($msg["content"], $stringa);
		}
	}
    $conn->close();
    $stmt->close();
    echo json_encode($msg);
}
?>