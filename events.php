<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

/*
 * Controllo di essere loggato.
 * Se sono in test, eseguo automaticamente il login.
 */
$active_page = 12;
$title = "";
$page = "";
require_once ROOT_PATH . '/controllers/event_controller.php';
if($log_result && $check_level == 0 && isset($_GET["new_event"])) {
    $header = '/layout/header.php';
    $login_checked = true;
    $title = "New Event - Administrator - Fow Deck Hub";
    $event = create_new_event($mysqli);
    if(!$event["result"]) {
        header("Refresh: 2;URL=events.php");
    }
    $elem = $event["content"];
    $page = "/pages/event/event_edit.php";
} else if(isset($_GET["event_id"]) && $_GET["event_id"] > 0) {
    if($log_result) {
        $header = '/layout/header.php';
        $title = "Event Details - Administrator - Fow Deck Hub";
    } else {
        $header = '/layout/user_header.php';
        $title = "Event Details - Fow Deck Hub";
    }
    $page = "/pages/event/events_details.php";
    $event_id = $_GET["event_id"];
    $event = get_event_by_id($mysqli, $event_id)["content"];
    $decklists = get_event_decks($mysqli, $event_id);
    $chart = get_chart_data_by_decks($decklists["content"]);
} else if($log_result && $check_level == 0 && isset($_GET["event_edit"]) && $_GET["event_edit"] > 0) {
    $header = '/layout/header.php';
    $login_checked = true;
    $title = "Event Edit - Administrator - Fow Deck Hub";
    $page = "/pages/event/event_edit.php";
    $event_id = $_GET["event_edit"];
    $event = get_event_by_id($event_id)["content"];
    $decklists = get_event_decks($mysqli, $event_id);
} else {
    $year = date("Y");
    if(isset($_GET) && isset($_GET["year"]) && $_GET["year"] < $year) {
        $year = $_GET["year"];
    }
    if($log_result) {
        $header = '/layout/header.php';
        $events = get_all_admin_events($mysqli, 0, $year);
        $show_visibility = true;
    } else {
        $header = '/layout/user_header.php';
        $events = get_all_events($mysqli, 0, $year);
        $show_visibility = false;
    }
    $title = "Events - Administrator - Fow Deck Hub";
    $page = "/pages/event/events_partial.php";
}
?>