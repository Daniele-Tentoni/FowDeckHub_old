<?php
define("HOSTING", "Altervista");
if(HOSTING == "Altervista") {
	define("SERVER_MAIL", "fowdeckhub@altervista.org");
	define("COMPLETE_URL", "www.fowdeckhub.altervista.org");
    define("ROOT_PATH", "/membri/fowdeckhub");
} else {
	define("SERVER_MAIL", "daniele.tentoni.1996@gmail.com");
	define("COMPLETE_URL", "localhost");
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
}
?>