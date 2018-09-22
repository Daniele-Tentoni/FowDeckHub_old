<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
$msg = array();
$msg["result"] = "done";
if(isset($_POST['u'], $_POST['p']) && $_POST['u'] != "a@a.com") { 
	$email = mysql_real_escape_string($_POST['u']);
	$password = mysql_real_escape_string($_POST['p']); // Recupero la password criptata.
    $log = login($email, $password, $mysqli);
	if($log == "eseguito") {
		// Login eseguito
		$msg["success"] = 'Success: You have been logged in!';
	} else {
		// Login fallito
		$msg["result"] = "fail";
		$msg["error"] = $log;
        $msg["u"] = $email;
        $msg["p"] = $password;
	}
} else { 
	// Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
	$msg["result"] = "fail";
	$msg["error"] = "unknown";
    $msg["message"] = "Login with test credentials or i don't know.";
}
echo json_encode($msg);
?>