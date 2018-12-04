<?php
// Connessione al database.
$dbaddress = "localhost";
$dbname = "id8124414_my_fowdeckhub";
$dbuser = "id8124414_antoniofow";
define("USER_AVATAR_IMAGE", "assets/images/users/avatar.jpg");

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