<?php
function get_cards($mysqli, $id){
    $res = array();
    $res["result"] = false;

    // Controllo che la connessione sia impostata.
    if(!isset($mysqli)) {
        $res["msg"] = "Server connection error. Please, contact the support.";
        return $res;
    }

    if(isset($mysqli) && $mysqli->connect_error) {
        $res["msg"] = "Database server connection error. Please, contact the support.";
        return $res;
    } 

    // Effettuo finalmente il caricamento della decklist.
    // Carico tutte le decklists.
    $query = "select c.Id,
                c.Name, 
                c.Set, 
                c.Number,  
                c.Cost,
                c.Visibility,
                t.Name as Type,
                a.Name as Attribute, 
                r.Symbol as Rarity
            from cards c
            left join card_sets s on c.Set = s.Code 
            left join card_attributes ca on ca.Card = c.Id
            left join attributes a on ca.Attribute = a.Id 
            left join card_types ct on ct.Card = c.Id
            left join types t on ct.Type = t.Id
            left join rarity r on c.Rarity = r.Id
            where c.Visibility = 1";

    // Carico una specifica carta.
    if(isset($id) && $id > 0) {
        $query .= " and c.Id = " . $id;
    }
	
	$query .= " order by c.Id";

    $stmt = $mysqli->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0) {
        $res["content"] = array();
        $res["msg"] = "There's some data to view";
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
            array_push($res["content"], $stringa);
        }
    } else {
        $res["msg"] = "No data to view.";
        return $res;
    }

    $res["result"] = true;
    return $res;
}
?>