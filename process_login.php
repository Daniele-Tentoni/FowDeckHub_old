<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$msg = array();
$msg["result"] = true;
if(isset($_POST['email'], $_POST['p'])) { 
	$email = $_POST['email'];
	$password = $_POST['p']; // Recupero la password criptata.
	if(login($email, $password, $mysqli) == true) {
		// Login eseguito
		$msg["success"] = 'Success: You have been logged in!';
	} else {
		// Login fallito
		$msg["result"] = false;
		$msg["error"] = "unknown";
	}
} else { 
	// Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
	$msg["result"] = false;
	$msg["error"] = "credentials";
}
echo json_encode($msg);
?>