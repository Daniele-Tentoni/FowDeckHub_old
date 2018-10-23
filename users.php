<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();
if(login_check($mysqli) || TEST) {
	$login_checked = true;
} else {
    header("Refresh: 0;URL=login.php");
}
$title = "Users - Administrator - Fow Deck Hub";
$active_page = 10;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/users_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/layout/footer.php';
?>