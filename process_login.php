<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $password = $_POST['p']; // Recupero la password criptata.
   if(login($email, $password, $mysqli) == true) {
      // Login eseguito
      echo 'Success: You have been logged in!';
   } else {
      // Login fallito
      header('Location: ./login.php?error=1');
   }
} else { 
   // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
   echo 'Invalid Request';
}
?>