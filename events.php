 <?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
if(!$log_result) {
	$login_checked = false;
} else {
	$login_checked = true;
}

// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);
if($check_level == 0) {
    $header = '/layout/header.php';
    $show_actions = false;
} else {
    $header = '/layout/user_header.php';
    $show_actions = true;
}

/*
 * Carico qui diverse informazioni a seconda della pagina richiesta.
 */
$active_page = 12;
$title = "";
$page = "";
require_once ROOT_PATH . '/loaders/load_events.php';
if($log_result && $check_level == 0 && isset($_GET["new_event"])) {
    $title = "New Event - Administrator - Fow Deck Hub";
    $page = "/pages/event/new_event.php";
} else if(isset($_GET["event_id"]) && $_GET["event_id"] > 0) {
    if($log_result) {
        $title = "Event Details - Administrator - Fow Deck Hub";
    } else {
        $title = "Event Details - Fow Deck Hub";
    }
    $page = "/pages/event/events_details.php";
    $event_id = $_GET["event_id"];
    $event = get_event_by_id($mysqli, $event_id)["content"];
    $decklists = get_event_decks($mysqli, $event_id);
    $chart = get_chart_data_by_decks($decklists["content"]);
} else if($log_result && $check_level == 0 && isset($_GET["event_edit"]) && $_GET["event_edit"] > 0) {
    $title = "Event Edit - Administrator - Fow Deck Hub";
    $page = "/pages/event/event_edit.php";
    $event_id = $_GET["event_edit"];
    $event = get_event_by_id($event_id)["content"];
    $decklists = get_event_decks($mysqli, $event_id);
} else {
    $title = "Events - Administrator - Fow Deck Hub";
    $page = "/pages/event/events_partial.php";
    $year = date("Y");
    if(isset($_GET) && isset($_GET["year"]) && $_GET["year"] < $year) {
        $year = $_GET["year"];
    }
    $events = get_all_events($mysqli, 0, $year);
}

/*
 * Assemblo la pagina.
 */
require_once ROOT_PATH . $header;
require_once ROOT_PATH . $page;
require_once ROOT_PATH . '/layout/footer.php';
?>
