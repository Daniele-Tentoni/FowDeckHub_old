<?php
/*
 * Fill an array of chart data from a decklists array.
 */
function get_chart_data_by_top8_decks($ruler_card_list) {
    $data = array();
    foreach($ruler_card_list as $deck){
        $data[$deck["Player"]] = $deck["Name"];
    }
    
    $rulers = array();
    foreach($data as $key => $value) {
        if(isset($rulers[$value])) {
            $rulers[$value]++;
        } else {
            $rulers[$value] = 1;
        }
    }
    
    $chart = array();
    foreach($rulers as $key => $value){
        $row = array();
        $row["label"] = $key;
        $row["value"] = $value;
        array_push($chart, $row);
    }
    return json_encode($chart);
}

/*
 * Fill an array of chart data from a breakdown array.
 */
function get_chart_data_by_breakdown($breakdown) {
    $chart = array();
    foreach($breakdown as $value){
        $row = array();
        $row["label"] = $value["Name"];
        $row["value"] = $value["Quantity"];
        array_push($chart, $row);
    }
    
    return json_encode($chart);
}

/*
 * Get the most used cards for deck.
 */
function get_chart_data_by_card_list($card_list, $deck_name, $deck_color) {
    $data = array();
    $last_player = "";
    $last_color = hexdec("000000");
    $elem = array();

    foreach($card_list as $value){
        if($value["Player"] != $last_player) {
            if($last_player != "") {
                array_push($data, $elem);
            }
            $last_player = $value["Player"];
            $elem = array();
            $elem["key"] = $value["Player"];
            $elem["color"] = "#" . sprintf("%06d", $last_color);
            $last_color = $last_color + hexdec("1000");
            $elem["values"] = array();
        }

        $row = array();
        $row["label"] = $value["Name"];
        $row["value"] = $value["Quantity"];
        array_push($elem["values"], $row);
    }
    // Devo aggiungere l'ultimo elemento.
    array_push($data, $elem);
    
    return json_encode($data);
}
?>