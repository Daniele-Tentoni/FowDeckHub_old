<?php
define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
define("USER", "root"); // E' l'utente con cui ti collegherai al DB.
define("PASSWORD", ""); // Password di accesso al DB.
define("DATABASE", "id8124414_my_fowdeckhub"); // Nome del database.
$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
// Se ti stai connettendo usando il protocollo TCP/IP, invece di usare un socket UNIX, ricordati di aggiungere il parametro corrispondente al numero di porta.

// Definisce le variabili di test.
define("TEST", true);
define("TEST_PWD", "c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec");
?>
