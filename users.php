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
} else {
	$login_checked = false;
    header("Refresh: 2;URL=login.php");
}

$title = "Users - Administrator - Fow Deck Hub";
$active_page = 10;
require_once ROOT_PATH . '/layout/header.php';
require_once ROOT_PATH . '/pages/users_partial.php';
require_once ROOT_PATH . '/layout/footer.php';
?>
?>
