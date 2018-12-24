<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);

if($log_result && $check_level == 0) {
	$login_checked = true;
	$active_page = 11;
    $title = "Cards - Administrator - Fow Deck Hub";
	require_once ROOT_PATH . '/loaders/load_cards.php';
	$cards = get_cards($mysqli, 0);
	$show_attributes = false;
	$show_quantity = false;
	$show_deck = false;
	require_once ROOT_PATH . '/layout/header.php';
	require_once ROOT_PATH . '/pages/cards_partial.php';
	require_once ROOT_PATH . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 2;URL=login.php");
}
?>