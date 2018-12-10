<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';

function generate_confirmation_link() {
    return "<p>Click <a href=\"" . COMPLETE_URL . "/login.php\">here</a> to confirm the registration and proceed to login.</p>";
}

function send_registration_mail($username, $email) {
    $contenuto_email = "Name: $username\n\n"; //Queste variabili sono create nel passaggio precedente
    $contenuto_email .= "Email: $email\n\n";
    $contenuto_email .= "You've completed the registration with $username! Well done!\n\n";
    $contenuto_email .= generate_confirmation_link();
    //limita la lunghezza a 70 caratteri per la compatibilità
    $contenuto_email = wordwrap($contenuto_email,70);
    //invia l'email    
    return mail($email, "Registration", $contenuto_email, 'From: ' . SERVER_MAIL);
}

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
        $mail_sent = send_registration_mail($username, $mail);
        $msg["success"] = "";
        if(isset($mail_sent) && $mail_sent == true) {
            $msg["success"] .= " We'll send you a registration mail. Click on the in link in the e-mail to proceed to login. Mail Sent: $mail_sent<br />";
        } else {
            $msg["success"] .= " We were unable to send the confirmation email. Since there is no need for confirmation, there is no problem..<br />";
        }
        $msg["success"] .= ' Success: You have been logged in!';
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

		

		

			

		

