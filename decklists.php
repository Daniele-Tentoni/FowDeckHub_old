<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();
// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
if($log_result) {
	$login_checked = true;
	$active_page = 13;
	$title = "";
	if(isset($_GET["newDecklist"])) {
		$title = "New Decklists - Administrator - Fow Deck Hub";
	} else {
		$title = "Decklists - Administrator - Fow Deck Hub";
	}
	require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
	if(isset($_GET["newDecklist"])) {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/decklist/new_decklist_partial.php';
	} else {
		require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/decklist/decklists_partial.php';
	}
	require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 5;URL=login.php");
}
?>