<?php
session_start();
$title = "Dashboard - Administrator - Fow Deck Hub";
$active_page = 0;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/index_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
?>