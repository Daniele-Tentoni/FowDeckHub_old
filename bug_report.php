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
	$active_page = 14;
	$title = "";
	$page = "";
	require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/bug_report.php';
	if(isset($_GET["bug_try"])) {
		$title = "Bug Try - Administrator - Fow Deck Hub";
		$page = "/pages/event/new_event.php";
	} else {
		$title = "Bug Reports - Administrator - Fow Deck Hub";
		$page = "/pages/bug_report/bug_report_list.php";
		$bugs = get_bug_list($mysqli);
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