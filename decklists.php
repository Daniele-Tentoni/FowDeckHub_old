<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);

// A questa pagina non ci posso accedere se non sono amministratore.
if($log_result && $check_level == 0) {
	$login_checked = true;
	
	/*
	 * Carico qui diverse informazioni a seconda della pagina richiesta.
	 */
	$active_page = 13;
	$title = "";
	$page = "";
	require_once ROOT_PATH . '/loaders/load_decklists.php';
	if(isset($_GET["newDecklist"])) {
		$title = "New Decklists - Administrator - Fow Deck Hub";
		$page = "/pages/decklist/new_decklist_partial.php";
	} else {
		$title = "Decklists - Administrator - Fow Deck Hub";
		$decklists = get_decks($mysqli, 0);
		$page = "/pages/decklist/decklists_partial.php";
	}
	
	/*
	 * Assemblo la pagina.
	 */
    require_once ROOT_PATH . '/layout/header.php';
	require_once ROOT_PATH . $page;
	require_once ROOT_PATH . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 2;URL=login.php");
}
?>