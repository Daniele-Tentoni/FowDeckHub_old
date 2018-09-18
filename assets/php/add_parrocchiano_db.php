<?php
require $_SERVER['DOCUMENT_ROOT'] . '/tentonibasididati/config/config.php';
$msg["result"] = true;
if(isset($_POST) &&
	 isset($_POST["cf"]) && 
	 isset($_POST["nome"]) && 
	 isset($_POST["cognome"]) &&
	 isset($_POST["sesso"]) && 
	 isset($_POST["famiglia"]) && 
	 isset($_POST["ruolo"])) {
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
			$stmt = $conn->prepare("insert into persona(CF, Cognome, Nome, Sesso) values (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $cf, $nome, $cognome, $sesso);
			$cf = mysql_real_escape_string($_POST["cf"]);
			$nome = mysql_real_escape_string($_POST["nome"]);
			$cognome = mysql_real_escape_string($_POST["cognome"]);
			$sesso = mysql_real_escape_string($_POST["sesso"]);
			$stmt->execute();
			$last_parrocchiano = $conn->insert_id;
			$stmt = $conn->prepare("insert into compone(Famiglia, Persona, Ruolo) values (?, ?, ?)");
			$stmt->bind_param("iss", $famiglia, $persona, $ruolo);
			$famiglia = mysql_real_escape_string($_POST["famiglia"]);
			$persona = mysql_real_escape_string($cf);
			$ruolo = mysql_real_escape_string($_POST["ruolo"]);
			$stmt->execute();
			$last_compone = $conn->insert_id;
			$conn->commit();
			$conn->autocommit(TRUE); // Disabilito le transizioni, applico le query.
			$msg["content"] = "Parrocchiano: " . $last_parrocchiano . " | Compone: " . $last_compone;
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