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
require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
// Se è stato richiesto un evento in particolare ne carico l'id.
if(isset($_GET) && isset($_GET["eventId"]) && $_GET["eventId"] > 0) {
	$eventId = $_GET["eventId"];
	require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/event/events_details.php';
} else {
	require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/event/events_partial.php';
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>