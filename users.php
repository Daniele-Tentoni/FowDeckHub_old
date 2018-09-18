<?php
session_start();
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
if($conn->connect_error){
	$error = "Connect Error";
} else {
	$error = "Nothing";
	$query = "SELECT * FROM users";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Username"] = $row["Username"];
			$stringa["Email"] = $row["Email"];
			$stringa["Passwd"] = $row["Passwd"];
			$stringa["FirstName"] = $row["FirstName"];
			$stringa["LastName"] = $row["LastName"];
			$stringa["RegisterDate"] = $row["RegisterDate"];
			$stringa["Role"] = $row["Role"];
			array_push($msg["content"], $stringa);
		}
	}
}
if(isset($conn)){
	$conn->close();
}
$title = "Users - Administrator - Fow Deck Hub";
$active_page = 10;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/users_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
?>

		$query = "SELECT a.Nome as Nome, 
						 a.Descrizione as Descrizione, 
						 a.DataAppuntamento as Data, 
						 a.OraAppuntamento as Ora,
						 l.Nome as Luogo
				  FROM luogo l
				  JOIN ( appuntamento a
				  JOIN  edizione e 
				  ON a.Edizione = e.Codice) 
				  ON l.Codice = a.Luogo
				  WHERE a.DataAppuntamento > now()";
		
	}
} else {
	$msg["result"] = false;
	$msg["error"] = "Error 400, Bad Request: filter not set or wrongly set.";
}
if(isset($conn)){
	$conn->close();
}