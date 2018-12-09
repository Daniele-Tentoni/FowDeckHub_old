 <?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

/*
 * Controllo di essere loggato.
 * Se sono in test, eseguo automaticamente il login.
 */
$log_result = login_check($mysqli);

/*
 * Carico qui diverse informazioni a seconda della pagina richiesta.
 */
$active_page = 12;
$title = "";
$page = "";
require_once ROOT_PATH . '/loaders/load_events.php';
if($log_result && isset($_GET["new_event"])) {
    $login_checked = true;
    $title = "New Event - Administrator - Fow Deck Hub";
    $page = "/pages/event/new_event.php";
} else if(isset($_GET["event_id"]) && $_GET["event_id"] > 0) {
    $title = "Event Details - Administrator - Fow Deck Hub";
    $page = "/pages/event/events_details.php";
    $event_id = $_GET["event_id"];
    $event = get_event_by_id($mysqli, $event_id)["content"];
    $decklists = get_event_decks($mysqli, $event_id);
    $chart = get_chart_data_by_decks($decklists["content"]);
} else if($log_result && isset($_GET["event_edit"]) && $_GET["event_edit"] > 0) {
    $login_checked = true;
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
require_once ROOT_PATH . '/layout/header.php';
require_once ROOT_PATH . $page;
require_once ROOT_PATH . '/layout/footer.php';
?>
