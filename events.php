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
    $show_visibility = true;
    $show_deck_up = true;
    $show_actions = true; 
} else { 
    $header = '/layout/user_header.php';
    $show_visibility = false;
    $show_deck_up = false;
    $show_actions = false; 
} 

/*
 * Carico qui diverse informazioni a seconda della pagina richiesta.
 */
$active_page = 13;
$title = "";
$page = "";
require_once ROOT_PATH . '/controllers/event_controller.php';
require_once ROOT_PATH . '/controllers/chart_controller.php';
if($log_result && $check_level == 0 && isset($_GET["new_event"])) {
    $title = "New Event - Administrator - Fow Deck Hub";
    $event = create_new_event($mysqli);
    if(!$event["result"]) {
        header("Refresh: 2;URL=events.php");
    }
    $elem = $event["content"];
    $page = "/pages/event/event_edit.php";
} 
else if(isset($_GET["event_id"]) && $_GET["event_id"] > 0) {
    if($check_level == 0) {
        $header = '/layout/header.php';
        $title = "Event Details - Administrator - Fow Deck Hub";
    } else {
        $title = "Event Details - Fow Deck Hub";
    }
    $page = "/pages/event/events_details.php";
    $event_id = $_GET["event_id"];
    $event = get_event_by_id($mysqli, $event_id);
    if(!$event["result"]) {
        header("Refresh: 2;URL=events.php");
    } else {
        $event = $event["content"];
    }
    $decklists = get_event_decks($mysqli, $event_id, $check_level == 0);
    $chart_top8 = get_chart_data_by_top8_decks($decklists["content"]);
	$breakdown = get_event_rulers_breakdowns_by_id($mysqli, $event_id)["content"];
    $chart_event = get_chart_data_by_breakdown($breakdown);
    $rune_most_used = get_most_used_cards_by_event_and_deck_type($mysqli, $event_id, 1);
    $chart_rune_most_used = get_chart_data_by_card_list($rune_most_used["content"], "Rune Deck", "#000000");
    $main_most_used = get_most_used_cards_by_event_and_deck_type($mysqli, $event_id, 2);
    $chart_main_most_used = get_chart_data_by_card_list($main_most_used["content"], "Main Deck", "#333333");
    $side_most_used = get_most_used_cards_by_event_and_deck_type($mysqli, $event_id, 3);
    $chart_side_most_used = get_chart_data_by_card_list($side_most_used["content"], "Side Deck", "#666666");
    $stone_most_used = get_most_used_cards_by_event_and_deck_type($mysqli, $event_id, 4);
    $chart_stone_most_used = get_chart_data_by_card_list($stone_most_used["content"], "Stone Deck", "#999999");
    /*var_dump($chart_rune_most_used);
    echo "<br>";*/
    $show_event = false;
    $simple_table = true;
} 
else if($log_result && $check_level == 0 && isset($_GET["event_edit"]) && $_GET["event_edit"] > 0) {
    $header = '/layout/header.php';
    $login_checked = true;
    $title = "Event Edit - Administrator - Fow Deck Hub";
    $page = "/pages/event/event_edit.php";
    $event_id = $_GET["event_edit"];
    $event = get_event_by_id($mysqli, $event_id)["content"];
    // Ho già controllato che l'utente fosse un utente con i privilegi necessari.
    $decklists = get_event_decks($mysqli, $event_id, true);
	$breakdown = get_event_rulers_breakdowns_by_id($mysqli, $event_id)["content"];
} 
else {
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

/*
 * Assemblo la pagina.
 */
require_once ROOT_PATH . $header;
require_once ROOT_PATH . $page;
require_once ROOT_PATH . '/layout/footer.php';
?>
