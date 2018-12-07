<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
if($log_result) {
	$login_checked = true;
    $title = "Dashboard - Administrator - Fow Deck Hub";
    $active_page = 0;
    require_once ROOT_PATH . '/layout/header.php';
    require_once ROOT_PATH . '/pages/index_partial.php';
    require_once ROOT_PATH . '/layout/footer.php';
} else {
    var_dump($log_result);
    header("Refresh: 5;URL=login.php");
}
?>