<?php
// Connessione al database.
$dbaddress = "localhost";
$dbname = "my_tentonibasididati";
define("USER_AVATAR_IMAGE", "assets/images/users/avatar.jpg");

// Variabili di test.
define("TEST", true);
define("TEST_PWD", "c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec"); // Questa password è già criptata perché arriva così già dal client.

function try_config() {
	echo "Config file correctly configured.";
}

function load_session($name) {
	$default_session_var = array();	
	$default_session_var["user_avatar_img"] = "assets/images/users/avatar.jpg";
	$default_session_var["user_avatar_img_alt"] = "John Doe";
	$default_session_var["user_name"] = "Default User Name";
	$default_session_var["user_title"] = "Default User Title";
	if(isset($_SESSION[$name])) {
		echo $_SESSION[$name];
	} else {
		echo $default_session_var[$name];
	}
}

function check_session($name) {
	return isset($_SESSION) && isset($_SESSION[$name]);
}