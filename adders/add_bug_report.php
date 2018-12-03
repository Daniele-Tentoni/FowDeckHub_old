<?php
	// Variabili globali, funzioni di db/login e controllers.
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/bug_report.php';
	$result = array();
	$result["result"] = false;
	$result["error"] = "nothing";
	$content = "";

	// Per prima cosa controllo se è stato effettuato il login.
	if(!login_check($mysqli)) {
		$result["error"] = "Niente login";
		echo json_encode($result);
		return;
	}
	
	if(isset($_GET["new_bug"]) {
		$name = mysql_real_escape_string($_POST["name"]);
		$email = mysql_real_escape_string($_POST["email"]);
		$bug = mysql_real_escape_string($_POST["bug"]);
		$result = new_bug($name, $email, $bug);
		echo json_encode($result);
	} else {
		$result["error"] = "Operazione non riconosciuta.";
		echo json_encode($result);
	}
	
?>