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
	$active_page = 13;
	$title = "";
	$page = "";
	if(isset($_GET["newDecklist"])) {
		$title = "New Decklists - Administrator - Fow Deck Hub";
		$page = "/pages/decklist/new_decklist_partial.php";
	} else {
		$title = "Decklists - Administrator - Fow Deck Hub";
		$page = "/pages/decklist/decklists_partial.php";
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