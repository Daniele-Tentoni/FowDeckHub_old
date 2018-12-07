<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();
if(login_check($mysqli) || TEST) {
	$login_checked = true;
} else {
    header("Refresh: 0;URL=login.php");
}
$title = "Users - Administrator - Fow Deck Hub";
$active_page = 10;
require_once ROOT_PATH . '/config/config.php';
require_once ROOT_PATH . '/layout/header.php';
require_once ROOT_PATH . '/pages/users_partial.php';
require_once ROOT_PATH . '/layout/footer.php';
?>