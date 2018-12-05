<?php
// Funzione di aggiunta del bug.
function new_bug($name, $email, $bug){
    $msg = array();
    $msg["result"] = false;
    $msg["error"] = "nothing";
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
                $stmt->bind_param("sss", $name_sql, $nation_sql, $year_sql);
                $name_sql = mysql_real_escape_string($name);
                $nation_sql = mysql_real_escape_string($email);
                $year_sql = mysql_real_escape_string($bug);
                if($stmt->execute()) {
                    $msg["result"] = true;
                    $content .= "Inserimento del bug $name effettuato con successo.";
                    $msg["id"] = $conn->insert_id;
                } else {
                    $msg["data"] = $conn->error_list;
                    $content .= "Riscontrato problema nell'inserimento del bug $name, contattare il supporto.";
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
            $query = "update bug_reports set BugState = ? where Id = ?";
            $stmt = $mysqli->prepare($query);
            if(!$stmt) {
                $msg["data"] = $mysqli->error_list;
                $msg["error"] = "Boolean value in \$stmt";
            } else {
                $stmt->bind_param("ii", $state_sql, $id_sql);
                $id_sql = mysql_real_escape_string($id);
                $state_sql = mysql_real_escape_string($state);
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
                        s.Name as State
            from bug_reports b
            join bug_report_states s on b.BugState = s.Id
            order by b.Id";

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
            array_push($msg["content"], $stringa);
        }
    } else {
        $msg["error"] = "No data to view.";
        return $msg;
    }

    $msg["result"] = true;
    return $msg;
}

function get_bug_state_list(){
    return "Ahah";
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