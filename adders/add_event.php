<?php
require_once './definings.php';
require_once ROOT_PATH . '/config/functions.php';
$msg = array();
$msg["result"] = false;
$msg["error"] = "nothing";
$content = "";

if(!login_check($mysqli)) {
	$msg["error"] = "Niente login";
	echo json_encode($msg);
	return;
}

if(!isset($_POST)) {
	$msg["data"] = "Any data.";
	$msg["error"] = "No data.";
	echo json_encode($msg);
	return;
}

$content = "Operazioni effettuate: ";
try {
	$mysqli = new mysqli("localhost", "root", "", "my_fowdeckhub");
	$msg = array();
	if($mysqli->connect_error){
		$msg["error"] = "Connection Error";
		echo json_encode($msg);
		return;
	} else {
		// Inserisco la carta.
		$stmt = $mysqli->prepare("INSERT INTO  events (Name, Nation, Year, Attendance, Date) VALUES (?, ?, ?, ?, ?)");
		if(!$stmt) {
			$msg["data"] = $mysqli->error_list;
			$msg["error"] = "Boolean value in \$stmt";
			echo json_encode($msg);
			return;
		} else {
            $stmt->bind_param("siiis", $name, $nation, $year, $attendance, $date);
            $name = mysql_real_escape_string($_POST["Name"]);
            $nation = mysql_real_escape_string($_POST["Nation"]);
            $year = mysql_real_escape_string($_POST["Year"]);
            $attendance = mysql_real_escape_string($_POST["Attendance"]);
            $date = mysql_real_escape_string($_POST["Date"]);
            if($stmt->execute()) {
                $msg["result"] = true;
                $content .= "Inserimento della carta $name effettuato con successo.";
				$msg["id"] = $mysqli->insert_id;
            } else {
                $msg["result"] = false;
                $msg["data"] = $mysqli->error_list;
                $content .= "Riscontrato problema nell'inserimento della carta $name, contattare il supporto.";
				echo json_encode($msg);
            }
        }
	}
} catch (Exception $e) {
	// Posso effettuare un rollback di tutte le query fatte finora sul db.
	$msg["result"] = false;
	$msg["error"] = "Eccezione";
	$msg["msg"] = $e;
}
$msg["content"] = $content;
echo json_encode($msg);
?>