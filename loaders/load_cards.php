<?php
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
$msg = array();
$msg["result"] = true;
if($conn->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	if(isset($_POST["id"]) && $_POST["id"] > 0) {
		// Preparo il contenitore della carta.
		$msg["content"] = "";
		$query = "select * from cards where Id = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('i', $id);
		$id = mysql_real_escape_string($_POST["id"]);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows == 1) {
			// Creo il primo scheletro della carta.
			$row = $result->fetch_assoc();
			$stringa["Id"] = $row["Id"];
			$stringa["Name"] = $row["Name"];
			$stringa["Set"] = $row["Set"];
			$stringa["Number"] = $row["Number"];
			$stringa["Cost"] = $row["Cost"];
			$stringa["Visibility"] = $row["Visibility"] == 1 ? "Visible" : "Hidden";
		}
		
		// Ottengo gli attributi della carta.
		$query = "select a.Name
					from card_attributes ca
					join attributes a on ca.Attribute = a.Id
					where ca.Card = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0) {
			$attributes = "";
			while($row = $result->fetch_assoc()) {
				$attributes .= $row["Name"];
			}
			$stringa["Attributes"] = $attributes;
		}
		
		// Ottengo i tipi della carta.
		$query = "select t.Name
					from card_types ct
					join types t on ct.Type = t.Id
					where ct.Card = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0) {
			$types = "";
			while($row = $result->fetch_assoc()) {
				$types .= $row["Name"];
			}
			$stringa["Types"] = $types;
		}
		
		// Aggiungo finalmente la stringa al risultato.
		$msg["content"] = $stringa;
	} 
	else if(isset($_POST["format"]) && $_POST["format"] != "") {
		echo "Questo problema.";
	}
	else {
		$query = "SELECT c.Id,
					c.Name, 
					c.Set, 
					c.Number,  
					c.Cost,
					c.Visibility,
					t.Name as Type,
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
				$stringa["Cost"] = $row["Cost"];
				$stringa["Visibility"] = $row["Visibility"];
				$stringa["Type"] = $row["Type"];
				$stringa["Attribute"] = $row["Attribute"];
				$stringa["Rarity"] = $row["Rarity"];
				array_push($msg["content"], $stringa);
			}
		}
	}
}

if(isset($conn)){
	$conn->close();
}
echo json_encode($msg);
?>