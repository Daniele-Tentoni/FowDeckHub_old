<?php
session_start();
$conn = new mysqli("localhost", "root", "", "my_fowdeckhub");
if($conn->connect_error){
	$error = "Connect Error";
} else {
	$error = "Nothing";
}
$title = "Users - Administrator - Fow Deck Hub";
$active_page = 10;
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/header.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/pages/users_partial.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/assets/layout/footer.php';
?>