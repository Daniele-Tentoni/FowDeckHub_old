<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
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
	require_once ROOT_PATH . '/controllers/bug_report.php';
	if(isset($_GET["bug_try"])) {
		$title = "Bug Try - Administrator - Fow Deck Hub";
		$page = "/pages/event/new_event.php";
	} else {
		$title = "Bug Reports - Administrator - Fow Deck Hub";
		$page = "/pages/bug_report/bug_report_list.php";
		$bugs = get_bug_list($mysqli);
        $states = get_bug_state_list($mysqli);
	}
	
	/*
	 * Assemblo la pagina.
	 */
	require_once ROOT_PATH . '/layout/header.php';
	require_once ROOT_PATH . $page;
	require_once ROOT_PATH . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 5;URL=login.php");
}
?>