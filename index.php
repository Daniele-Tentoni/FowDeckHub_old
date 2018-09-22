<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
sec_session_start();
// Prima se sono in test e non ho eseguito il login lo faccio.
if(!login_check($mysqli) && TEST) {
    echo "login di test";
    echo login("a@a.com", TEST_PWD, $mysqli);
}
// Poi controllo se sono collegato.
if(login_check($mysqli)) {
	$login_checked = true;
    $title = "Dashboard - Administrator - Fow Deck Hub";
    $active_page = 0;
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/index_partial.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
} else {
    echo "Senza login";
    header("Refresh: 5;URL=login.php");
}
?>