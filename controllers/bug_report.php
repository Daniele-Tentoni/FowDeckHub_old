<?php
// Funzione di aggiunta del bug.
function new_bug($mysqli, $name, $email, $bug){
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $msg["class"] = "warning";
    $content = "";
    try {
        if($mysqli->connect_error){
            $msg["error"] = "Connection Error";
        } else {
            $query = "insert into bug_reports(Name, Email, Bug) values (?, ?, ?)";
            $stmt = $mysqli->prepare($query);
            if(!$stmt) {
                $msg["data"] = $mysqli->error_list;
                $msg["error"] = "Boolean value in \$stmt";
            } else {
                $stmt->bind_param("sss", $name_sql, $email_sql, $bug_sql);
                $name_sql = $mysqli->real_escape_string($name);
                $email_sql = $mysqli->real_escape_string($email);
                $bug_sql = $mysqli->real_escape_string($bug);
                if($stmt->execute()) {
                    $msg["result"] = true;
                    $msg["class"] = "success";
                    $content .= "Successful Bug Report with number $mysqli->insert_id.<br />Write down the number of the problem that will be used when we will contact you. <br />";
                    // Costruisco il messaggio    
                    $contenuto_email = "Name: $name_sql\n\n"; //Queste variabili sono create nel passaggio precedente
                    $contenuto_email .= "Email: $email_sql\n\n";
                    $contenuto_email .= "Bug Explanation:\n $bug_sql\n\n";
                    //limita la lunghezza a 70 caratteri per la compatibilità
                    $contenuto_email = wordwrap($contenuto_email,70);
                    //invia l'email    
                    $mail_sent = mail($email_sql, "Bug Report", $contenuto_email, 'From: fowdeckhub@altervista.org');
                    if(isset($mail_sent) && $mail_sent) {
                        $content .= "<br />We've send an email to $email_sql. <br />We thank you for your patience and support. We believe a lot in cooperation and everyone's help is precious. We will contact you once the problem is solved. We apologize for the inconvenience. <br />";
                    } else {
                        $content .= "We haven't send an email for a problem. We apologize for the inconvenience. ";
                    }
                    $msg["id"] = $mysqli->insert_id;
                } else {
                    $msg["data"] = $mysqli->error_list;
                    $content .= "Problem encountered during the Bug Report. Contact the support.";
                }
            }
        }
    } catch (Exception $e) {
        // Posso effettuare un rollback di tutte le query fatte finora sul db.
        $msg["error"] = "Eccezione";
        $msg["msg"] = $e;
    }

    $msg["content"] = $content;
    return $msg;
}

// Funzione per cambiare state ad un bug report.
function change_state_bug($mysqli, $id, $state) {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $content = "";
    try {
        if($mysqli->connect_error){
            $msg["error"] = "Connection Error";
        } else {
            $query = "update bug_reports set BugState = ?, LastOperation = CURRENT_TIMESTAMP where Id = ?";
            $stmt = $mysqli->prepare($query);
            if(!$stmt) {
                $msg["data"] = $mysqli->error_list;
                $msg["error"] = "Boolean value in \$stmt";
            } else {
                $stmt->bind_param("ii", $state_sql, $id_sql);
                $id_sql = $mysqli->real_escape_string($id);
                $state_sql = $mysqli->real_escape_string($state);
                if($stmt->execute()) {
                    $msg["result"] = true;
                    $content .= "Cambiamento del bug $id effettuato con successo.";
                    $msg["update_id"] = $id_sql;
                    $msg["update_state"] = $state_sql;
                } else {
                    $msg["data"] = $mysqli->error_list;
                    $content .= "Riscontrato problema nel cambiamento del bug $id, contattare il supporto.";
                }
            }
        }
    } catch (Exception $e) {
        // Posso effettuare un rollback di tutte le query fatte finora sul db.
        $msg["error"] = "Eccezione";
        $msg["msg"] = $e;
    }

    $msg["content"] = $content;
    return $msg;
}

function get_bug_by_id($id) {
    return "This bug by $id";
}

function get_bug_list($mysqli) {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $content = "";
    
    // Controllo che la connessione sia impostata.
    if(!isset($mysqli)) {
        $msg["error"] = "Server connection error. Please, contact the support.";
        return $msg;
    }

    if(isset($mysqli) && $mysqli->connect_error) {
        $msg["error"] = "Database server connection error. Please, contact the support.";
        return $msg;
    } 

    // Effettuo finalmente il caricamento della decklist.
    // Carico tutte le decklists.
    $query = "select b.Id as Id,
                        b.Name as Name,
                        b.EMail as EMail,
                        b.Bug as Bug,
                        b.CreationDate as CreationDate,
                        b.LastOperation as LastOperation,
                        s.Name as State,
                        s.Color as Color,
                        s.Icon as Icon
            from bug_reports b
            join bug_report_states s on b.BugState = s.Id
            order by b.Id desc";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Id"] = $row["Id"];
            $stringa["Name"] = $row["Name"];
            $stringa["EMail"] = $row["EMail"];
            $stringa["Bug"] = $row["Bug"];
            $stringa["CreationDate"] = $row["CreationDate"];
            $stringa["LastOperation"] = $row["LastOperation"];
            $stringa["State"] = $row["State"];
            $stringa["Color"] = $row["Color"];
            $stringa["Icon"] = $row["Icon"];
            array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    $msg["result"] = true;
    return $msg;
}

function get_bug_state_list($mysqli){
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $content = "";
    
    // Controllo che la connessione sia impostata.
    if(!isset($mysqli)) {
        $msg["error"] = "Server connection error. Please, contact the support.";
        return $msg;
    }

    if(isset($mysqli) && $mysqli->connect_error) {
        $msg["error"] = "Database server connection error. Please, contact the support.";
        return $msg;
    } 

    // Effettuo finalmente il caricamento della decklist.
    // Carico tutte le decklists.
    $query = "SELECT * FROM bug_report_states
            order by Ordine";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Id"] = $row["Id"];
            $stringa["Name"] = $row["Name"];
            $stringa["Ordine"] = $row["Ordine"];
            $stringa["Color"] = $row["Color"];
            $stringa["Icon"] = $row["Icon"];
            array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    $msg["result"] = true;
    return $msg;
}

// Funzione apposita per il widget dei bug.
function get_bug_numbers() {
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
    $content = "";

    // Controllo che la connessione sia impostata.
    if(!isset($mysqli)) {
        $msg["error"] = "Server connection error. Please, contact the support.";
        return $msg;
    }

    if(isset($mysqli) && $mysqli->connect_error) {
        $msg["error"] = "Database server connection error. Please, contact the support.";
        return $msg;
    } 

    // Effettuo finalmente il caricamento della decklist.
    // Carico tutte le decklists.
    $query = "select b.State as Stato, count(*) as Numero
            from bug_reports b
            group by b.State";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $msg["content"] = array();
        $msg["error"] = "There's some data to view";
        while($row = $result->fetch_assoc()) {
            $stringa["Stato"] = $row["Stato"];
            $stringa["Numero"] = $row["Numero"];
            array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    $msg["result"] = true;
    return $msg;
}
?>