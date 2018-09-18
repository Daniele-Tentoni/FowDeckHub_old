<?php
session_start();
$title = "Decklists - Administrator - Fow Deck Hub";
$active_page = 13;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/decklists_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
?>