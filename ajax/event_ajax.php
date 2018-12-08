<?php
	// Variabili globali, funzioni di db/login e controllers.
	require_once '../definings.php';
	require_once ROOT_PATH . '/config/functions.php';
	require_once ROOT_PATH . '/controllers/event_controller.php';
	$result = array();
	$result["result"] = false;
	$result["error"] = "nothing";
	$content = "";
	
	/* 
	 * Come anche in altri destinatari di chiamate ajax, questo file dovrà sempre mandare in echo dei file json.
	 * In questo modo cerco di dare un certo ordine al mio codice per fare meglio manutenzione.
	 * L'obiettivo sarà poi quello di sfruttare appieno la potenzialità del linguaggio ad oggetti del php e non
	 * solamente il lato funzionale molto piatto. Model-View-Controller.
	 */
	
	// Qui controllo quale operazione devo eseguire arrivato dalla chiamata ajax.
	if(isset($_GET["event_map"])) {
        $event_map = get_event_map($mysqli);
        echo json_encode($event_map);
	} else if(isset($_GET["event_map_details"])) {
        $region = $_POST["region"];
        $event_map_details = get_event_map_details($mysqli, $region);
        echo json_encode($event_map_details);
    } else {
		// Comunico che non ho capito quale operazione mi è richiesta.
		$result["error"] = "Operazione non riconosciuta.";
		echo json_encode($result);
	}
	
?>

