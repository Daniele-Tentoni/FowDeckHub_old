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
	$query = "SELECT attivita.Codice, attivita.Nome as Attivita, attivita.Anno, gruppo.Nome as Gruppo FROM attivita JOIN (organizza JOIN gruppo ON organizza.Gruppo = gruppo.Codice) ON attivita.Codice = organizza.Attivita ORDER BY attivita.Anno, attivita.Nome";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Codice"] = $row["Codice"];
			$stringa["Attivita"] = $row["Attivita"];
			$stringa["Gruppo"] = $row["Gruppo"];
			$stringa["Anno"] = $row["Anno"];
			array_push($msg["content"], $stringa);
		}
	}
    $conn->close();
    $stmt->close();
    echo json_encode($msg);
}
?>