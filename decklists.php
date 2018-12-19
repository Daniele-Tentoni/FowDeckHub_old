<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();
require_once ROOT_PATH . '/controllers/decklist_controller.php';

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
	$active_page = 12;
	$title = "";
	$page = "";
	require_once ROOT_PATH . '/loaders/load_decklists.php';
	if(isset($_GET["newDecklist"])) {
		$decklist = create_new_decklist($mysqli);
		if(!$decklist["result"]) {
			var_dump($decklist);
			header("Refresh: 10;URL=decklists.php");
		}
		$elem = $decklist["content"];
		$title = "New Decklists - Administrator - Fow Deck Hub";
		$page = "/pages/decklist/decklist_edit.php";
	} 
	else if(isset($_GET["edit_decklist"]) && $_GET["edit_decklist"] > 0) {
		$decklist = get_decklist_by_id($mysqli, $_GET["edit_decklist"]);
		if(!$decklist["result"]) {
			var_dump($decklist);
			header("Refresh: 10;URL=decklists.php");
		}
		$elem = $decklist["content"];
		$title = "Edit Decklists - Administrator - Fow Deck Hub";
		$page = "/pages/decklist/decklist_edit.php";
	} 
	else {
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