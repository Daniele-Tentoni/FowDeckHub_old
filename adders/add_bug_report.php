<?php
	// Variabili globali, funzioni di db/login e controllers.
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/bug_report.php';
	$result = array();
	$result["result"] = false;
	$result["error"] = "nothing";
	$content = "";
	
	/* 
	 * Come anche in altri destinatari di chiamate ajax, questo file dovrà sempre mandare in echo dei file json.
	 * In questo modo cerco di dare un certo ordine al mio codice per fare meglio manutenzione.
	 * L'obiettivo sarà poi quello di sfruttare appieno la potenzialità del linguaggio ad oggetti del php e non
	 * solamente il lato funzionale molto piatto. Model-View-Controller.
	 */

	// Per prima cosa controllo se è stato effettuato il login.
	if(!login_check($mysqli)) {
		$result["error"] = "Niente login";
		echo json_encode($result);
		return;
	}
	
	// Qui controllo quale operazione devo eseguire arrivato dalla chiamata ajax.
	if(isset($_GET["new_bug"]) {
		// Creo il nuovo bug.
		$name = mysql_real_escape_string($_POST["name"]);
		$email = mysql_real_escape_string($_POST["email"]);
		$bug = mysql_real_escape_string($_POST["bug"]);
		$result = new_bug($name, $email, $bug);
		echo json_encode($result);
	} else if(isset($_GET["change_state_bug"]) && isset($_POST["id"]) && $_POST["id"] > 0 && isset($_POST["state"]) && $_GET["state"] > 1 && $_GET["state"] < 5) {
		// Non deve essere possibile cambiare lo status di un bug_report  in new, quindi maggiore di 1 deve essere.
		$id = mysql_real_escape_string($_POST["id"]);
		$state = mysql_real_escape_string($_POST["state"]);
		$result = change_state_bug($id, $state);
		echo json_encode($result);
	} else {
		// Comunico che non ho capito quale operazione mi è richiesta.
		$result["error"] = "Operazione non riconosciuta.";
		echo json_encode($result);
	}
	
?>