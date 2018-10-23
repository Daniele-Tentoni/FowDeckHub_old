<?php
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$query = "SELECT c.Id,
					c.Name, 
					c.Set, 
					c.Number, 
					t.Name as Type, 
					c.Cost,
					a.Name as Attribute, 
					r.Symbol as Rarity
				FROM cards c
				left join card_sets s on c.Set = s.Code 
				left join card_attributes ca on ca.Card = c.Id
				left join attributes a on ca.Attribute = a.Id 
				left join card_types ct on ct.Card = c.Id
				left join types t on ct.Type = t.Name
				left join rarity r on c.Rarity = r.Id";
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