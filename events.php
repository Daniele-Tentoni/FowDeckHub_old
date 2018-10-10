<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();
if(login_check($mysqli) || TEST) {
	$login_checked = true;
} else {
    header("Refresh: 0;URL=login.php");
}
$title = "Events - Administrator - Fow Deck Hub";
$active_page = 12;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/events_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
?>