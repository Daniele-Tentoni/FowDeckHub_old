<?php
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$query = "SELECT s.Code, s.Name
			FROM card_sets s";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Code"] = $row["Code"];
			$stringa["Name"] = $row["Name"];
			array_push($msg["content"], $stringa);
		}
	}
}
if(isset($conn)){
	$conn->close();
}
echo json_encode($msg);
?>