<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();

/*
 * Controllo di essere loggato.
 * Se sono in test, eseguo automaticamente il login.
 */
$log_result = login_check($mysqli);
if($log_result) {
	$login_checked = true;
	
	/*
	 * Carico qui diverse informazioni a seconda della pagina richiesta.
	 */
	$active_page = 12;
	$title = "";
	$page = "";
	require_once $_SERVER['DOCUMENT_ROOT'] . '/loaders/load_events.php';
	if(isset($_GET["new_event"])) {
		$title = "New Event - Administrator - Fow Deck Hub";
		$page = "/pages/event/new_event.php";
	} else if(isset($_GET["event_id"]) && $_GET["event_id"] > 0) {
		$title = "Event Details - Administrator - Fow Deck Hub";
		$page = "/pages/event/events_details.php";
		$event_id = $_GET["event_id"];
		$event = get_event($event_id)["content"];
		$decklists = get_event_decks($event_id);
        $chart = get_chart_data_by_decks($decklists["content"]);
	} else if(isset($_GET["event_edit"]) && $_GET["event_edit"] > 0) {
		$title = "Event Edit - Administrator - Fow Deck Hub";
		$page = "/pages/event/event_edit.php";
		$event_id = $_GET["event_edit"];
		$event = get_event($event_id)["content"];
		$decklists = get_event_decks($event_id);
	} else {
		$title = "Events - Administrator - Fow Deck Hub";
		$page = "/pages/event/events_partial.php";
		$year = date("Y");
		if(isset($_GET) && isset($_GET["year"]) && $_GET["year"] < $year) {
			$year = $_GET["year"];
		}
		$events = get_events(0, $year);
	}
	
	/*
	 * Assemblo la pagina.
	 */
	require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . $page;
	require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 5;URL=login.php");
}
?>