<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();
// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
if(login_check($mysqli)) {
	$login_checked = true;
    $title = "Dashboard - Administrator - Fow Deck Hub";
    $active_page = 0;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/index_partial.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
} else {
    echo "Senza login";
    header("Refresh: 5;URL=login.php");
}
?>