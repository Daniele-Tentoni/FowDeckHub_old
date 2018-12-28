<?php
/*
 * Fill an array of chart data from a decklists array.
 */
function get_chart_data_by_top8_decks($decklists) {
    $data = array();
    foreach($decklists as $deck){
        if(isset($data) && isset($data[$deck["Ruler"]])) {
            $data[$deck["Ruler"]]++;
        } else {
            $data[$deck["Ruler"]] = 1;
        }
    }
    
    $chart = array();
    foreach($data as $key => $value){
        $row = array();
		$pieces = explode("/", $key);
        $row["label"] = $pieces[0];
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
	$data = array();
    foreach($breakdown as $key => $value){
		$data[$value["Name"]] = $value["Quantity"];
    }
    
    $chart = array();
    foreach($data as $key => $value){
        $row = array();
		$pieces = explode("/", $key);
        $row["label"] = $pieces[0];
        $row["value"] = $value;
        array_push($chart, $row);
    }
    
    return json_encode($chart);
}

/*
 * Get the most used cards for deck.
 */
function get_chart_data_by_card_list($card_list, $deck_name, $deck_color) {
    $data = array();

    foreach($card_list as $value){
        $row = array();
        $row["label"] = $value["Name"];
        $row["value"] = $value["Somma"];
        array_push($data, $row);
    }
    
    //$results = array();
    
    $chart = array();
    $chart["key"] = $deck_name;
    $chart["color"] = $deck_color;
    $chart["values"] = $data;
    //array_push($results, $chart);
    
    return $chart;
    return json_encode($chart);
}
?>