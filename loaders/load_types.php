<?php
$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$query = "SELECT t.Id, t.Name
				FROM types t";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
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