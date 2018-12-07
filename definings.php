<?php
define("HOSTING", "localhost");
if(HOSTING == "Altervista") {
    define("ROOT_PATH", "/membri/fowdeckhub");
} else {
    define("ROOT_PATH", $_SERVER["DOCUMENT_ROOT"]);
}
?>