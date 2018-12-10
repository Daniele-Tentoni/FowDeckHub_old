<?php
require $_SERVER['DOCUMENT_ROOT'] . '/tentonibasididati/config/config.php';
$msg["result"] = true;
if(isset($_POST) &&
	 isset($_POST["nome"]) && 
	 isset($_POST["descrizione"]) && 
	 isset($_POST["data"]) &&
	 isset($_POST["ora"]) && 
	 isset($_POST["attivita"]) && 
	 isset($_POST["luogo"])) {
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
			$stmt = $conn->prepare("insert into appuntamento(`Nome`,`Descrizione`,`DataAppuntamento`,`OraAppuntamento`,`Luogo`,`Attivita`) VALUES (?, ?, ?, ?, ?, ?)");
			$stmt->bind_param("ssssss", $nome, $descrizione, $data, $ora, $attivita, $luogo);
			$nome = mysql_real_escape_string($_POST["nome"]);
			$descrizione = mysql_real_escape_string($_POST["descrizione"]);
			$data = mysql_real_escape_string($_POST["data"]);
			$ora = mysql_real_escape_string($_POST["ora"]);
			$attivita = mysql_real_escape_string($_POST["attivita"]);
			$luogo = mysql_real_escape_string($_POST["luogo"]);
			$stmt->execute();
			$conn->commit();
			$conn->autocommit(TRUE); // Disabilito le transizioni, applico le query.
			$msg["content"] = "Aggiunta riuscita.";
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
	$msg["msg"] = "Ci sono alcuni parametri post non ancora definiti: ";
	$msg["msg"] .= var_dump($_POST) . ".";
} 

// Chiusura degli errori parametri indefiniti
echo json_encode($msg);
?>