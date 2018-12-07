<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
// Recupero la password criptata dal form di inserimento.
$password = mysql_real_escape_string($_POST['p']); 
$msg = array();
$msg["result"] = "done";
// Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
// Assicurati di usare statement SQL 'prepared'.
if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, email, password, salt) VALUES (?, ?, ?, ?)")) {    
    $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
    $username = mysql_real_escape_string($_POST["u"]);
    $email = mysql_real_escape_string($_POST["e"]);
    // Crea una password usando la chiave appena creata.
    $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
    $password = hash('sha512', $password.$random_salt);
    // Crea una chiave casuale
    // Esegui la query ottenuta.
    if($insert_stmt->execute()){
        $msg["success"] = 'Success: You have been logged in!';
    } else {
        $msg["result"] = "fail";
        $msg["error"] = "query";
        $msg["number"] = $mysqli->errno;
        $msg["message"] = $mysqli->error;
    }
} else {
    $msg["result"] = "fail";
    $msg["error"] = "error";
    $msg["message"] = $mysqli->connect_error();
}
echo json_encode($msg);
?>	
		
		
			
		
