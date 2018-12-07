<?php
require $_SERVER['DOCUMENT_ROOT'] . '/tentonibasididati/config/config.php';
$msg["result"] = true;
if(isset($_POST) &&
	 isset($_POST["cognome"]) && 
	 isset($_POST["via"]) && 
	 isset($_POST["numero"]) && 
	 isset($_POST["cap"])) {
	// Prima instauro la connessione, successivamente effettuo il bind dei parametri.
	$conn = new mysqli("localhost", "root", "", $dbname);
	if($conn->connect_error) {
		// Qui la connessione non è riuscita.
		$msg["result"] = false;
		$msg["error"] = "Non sono riuscito ad instaurare la connessione.";
	} else {
		// Qui la connessione è riuscita ed effettuo la insert, con successivo bind dei parametri.
		try {
			$conn->autocommit(FALSE); // Abilito le transizioni.
			$conn->begin_transaction();
			$stmt = $conn->prepare("insert into famiglia(Cognome, Via, Numero, CAP) values (?, ?, ?, ?)");
			$stmt->bind_param("ssii", $Cognome, $Via, $Numero, $Cap);
			$Cognome = mysql_real_escape_string($_POST["cognome"]);
			$Via = mysql_real_escape_string($_POST["via"]);
			$Numero = mysql_real_escape_string($_POST["numero"]);
			$Cap = mysql_real_escape_string($_POST["cap"]);
			$stmt->execute();
			$conn->commit();
			$conn->autocommit(TRUE); // Disabilito le transizioni, applico le query.
			$msg["content"] = $stmt->insert_id;
		} catch (Exception $e) {
			// Posso effettuare un rollback di tutte le query fatte finora sul db.
			$conn->rollBack();
			$msg["result"] = false;
			$msg["error"] = "Eccezione";
			$msg["msg"] = $e;
		}
	}
} else {
	$msg["result"] = false;
	$msg["error"] = "Parametri Post";
	$msg["msg"] = "Ci sono alcuni parametri post non ancora definiti.";
} 

// Chiusura degli errori parametri indefiniti
echo json_encode($msg);
?>