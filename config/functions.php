<?php
require_once "db_connect.php";

function sec_session_start() {
    $session_name = 'sec_session_id'; // Imposta un nome di sessione
    $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
    $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
    ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
    $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
    session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
    session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
    session_start(); // Avvia la sessione php.
    session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
}

function login($email, $password, $mysqli) {
    // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
    if ($stmt = $mysqli->prepare("SELECT u.id as user_id, username as user_name, password, salt, r.Name as user_title, r.CanEditEvents as CanEditEvents FROM users u, roles r WHERE u.role = r.Id and email = ? LIMIT 1")) {
        $stmt->bind_param('s', $email); // esegue il bind del parametro '$email'.
        $stmt->execute(); // esegue la query appena creata.
        $stmt->store_result();
        $stmt->bind_result($user_id, $user_name, $db_password, $salt, $user_title, $can_edit_events); // recupera il risultato della query e lo memorizza nelle relative variabili.
        $stmt->fetch();
        $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.
        if($stmt->num_rows == 1) { // se l'utente esiste
            // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
            if(checkbrute($user_id, $mysqli) == true) { 
                // Account disabilitato
                // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
                return false;
            } else {
                /*
                 * Verifico la password inserita e segno in login_attemps il risultato.
                 */
                if($db_password == $password) {
                    $successed = $mysqli->prepare("INSERT INTO login_attempts (UserId, Risultato) VALUES (?, 1)");
                    $successed->bind_param("i", $idUser);
                    $idUser = $user_id;     
                    $successed->execute();
					
                    $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.

                    $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
                    $_SESSION['user_id'] = $user_id; 
                    $user_name = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $user_name); // ci proteggiamo da un attacco XSS
                    $_SESSION['user_name'] = $user_name;
                    $_SESSION['user_title'] = $user_title;
                    $_SESSION['can_edit_events'] = $can_edit_events;
                    $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                    
                    return "eseguito";    
                } else {
                    // Registriamo il tentativo fallito nel database.
                    $failed = $mysqli->prepare("INSERT INTO login_attempts (UserId) VALUES (?)");
                    $failed->bind_param("i", $idUser);
                    $idUser = $user_id;
                    $failed->execute();
                    return "Pass: $password, Salt: $salt";
                }
            }
        } else {
            // L'utente inserito non esiste.
            return "inesistente";
        }
    }
}

function checkbrute($user_id, $mysqli) {
   // Recupero il timestamp
   $now = time();
   // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
   $valid_attempts = $now - (2 * 60 * 60); 
   if ($stmt = $mysqli->prepare("SELECT DataAccesso FROM login_attempts WHERE UserId = ? AND DataAccesso > '$valid_attempts' AND Risultato = 0")) { 
      $stmt->bind_param('i', $user_id); 
      // Eseguo la query creata.
      $stmt->execute();
      $stmt->store_result();
      // Verifico l'esistenza di più di 5 tentativi di login falliti.
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

function login_check($mysqli) {
    // Se sono in test lo eseguo.
    if(TEST) {
        if(isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['login_string'])) {
            return true;
        } else {
			$log_result = login("a@a.com", TEST_PWD, $mysqli);
            if($log_result == "eseguito") {
                return true;
            } else {
                return "Non eseguito il login di test.<br>".$log_result;
            }
        }
    }
	
    // Verifica che tutte le variabili di sessione siano impostate correttamente
    if(isset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['login_string'])) {
        $user_id = $_SESSION['user_id'];
        $username = $_SESSION['user_name'];     
        $login_string = $_SESSION['login_string'];
        $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.
        if ($stmt = $mysqli->prepare("SELECT password FROM users WHERE id = ? LIMIT 1")) { 
            $stmt->bind_param('i', $user_id); // esegue il bind del parametro '$user_id'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();

            if($stmt->num_rows == 1) { // se l'utente esiste
                $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
                $stmt->fetch();
                $login_check = hash('sha512', $password.$user_browser);
                if($login_check == $login_string) {
                    // Login eseguito!!!!
                    return true;
                } else {
                    //  Login non eseguito.
                    return false;
                }
            } else {
                // Login non eseguito
                return false;
            }
        } else {
            // Login non eseguito
            return false;
        }
    } else {
        // Login non eseguito
        echo TEST;
        return false;
    }
}
?>