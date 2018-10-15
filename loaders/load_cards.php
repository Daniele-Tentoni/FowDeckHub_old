<?php
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$query = "SELECT c.Id, c.Name, c.Set, c.Number, t.Name as Type, c.Cost, a.Name as Attribute, r.Symbol as Rarity
			FROM cards c, card_sets s, card_attributes ca, attributes a, card_types ct, types t, card_rarity cr, rarity r 
			WHERE c.Set = s.Code 
			and ca.Card = c.Id and ca.Attribute = a.Id 
			and ct.Card = c.Id and ct.Type = t.Id
			and cr.Card = c.Id and cr.Rarity = r.Id";
	$stmt = $conn->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Set"] = $row["Set"];
			$stringa["Number"] = $row["Number"];
			$stringa["Type"] = $row["Type"];
			$stringa["Cost"] = $row["Cost"];
			$stringa["Attribute"] = $row["Attribute"];
			$stringa["Rarity"] = $row["Rarity"];
			array_push($msg["content"], $stringa);
		}
	}
}
if(isset($conn)){
	$conn->close();
}
echo json_encode($msg);
?>