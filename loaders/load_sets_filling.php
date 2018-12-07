<?php
require_once ROOT_PATH . '/config/functions.php';

// Utilizzo la connessione $mysqli dentro a functions->db_connect.
$msg = array();
$msg["result"] = true;
if($mysqli->connect_error){
	$msg["error"] = "Connect Error";
	$msg["result"] = false;
} else {
	$filtro_anno = "";
	if(isset($_GET["year"])) {
		$filtro_anno = $_GET["year"];
	}
	$query = "select s.Code, s.Name, s.NumCards, ca.Count
				from card_sets s
				left join (
					select se.Code, COUNT(*) as Count
					from card_sets se
					join cards c on se.Code = c.Set
					group by se.Code) as ca on s.Code = ca.Code";
	if($filtro_anno != "") {
		$query .= " where Year = $filtro_anno";
	}
	// Recupero i dati relativi al riempimento dei sets.
	$query .= " group by s.Code;";
	$stmt = $mysqli->prepare($query);
	$stmt->execute();
	$result = $stmt->get_result();
	if($result->num_rows > 0) {
		$msg["content"] = array();
		while($row = $result->fetch_assoc()) {
			$stringa["code"] = $row["Code"];
			$stringa["db_cards"] = $row["Count"] == null ? "0" : $row["Count"];
			$stringa["num_cards"] = $row["NumCards"];
			$stringa["perc"] = round($stringa["db_cards"] / $stringa["num_cards"] * 100, 2);
			if ($stringa["db_cards"] == 0) {
				$stringa["class"] = "danger";
				$stringa["text"] = "Empty";
			} else if (($stringa["db_cards"] < $stringa["num_cards"])) {
				$stringa["class"] = "warning";
				$stringa["text"] = "Developing";
			} else {
				$stringa["class"] = "success";
				$stringa["text"] = "Well done";
			}
			array_push($msg["content"], $stringa);
		}
	} else {
		$msg["error"] = "No data";
		$msg["result"] = false;
	}
}
if(isset($mysqli)){
	$mysqli->close();
}
echo json_encode($msg);
?>