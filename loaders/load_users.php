<?php
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$msg["error"] = "Connect Error";
	$query = "SELECT u.Id, u.Username, u.FirstName, u.LastName, u.RegisterDate, r.Name as Role FROM users u, roles r WHERE u.Role = r.Id";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Username"] = $row["Username"];
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
echo json_encode($msg);
?>