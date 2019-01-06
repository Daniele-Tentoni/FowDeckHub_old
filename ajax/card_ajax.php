<?php
// Variabili globali, funzioni di db/login e controllers.
require_once '../definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();
require_once ROOT_PATH . '/controllers/card_controller.php';
$result = array();
$result["result"] = false;
$result["error"] = "nothing";
$content = "";

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);

// Qui controllo quale operazione devo eseguire arrivato dalla chiamata ajax.
if($log_result && $check_level == 0 && isset($_GET["add_card"])) {
	// Per entrare qui devo essere loggato come amministratore.
    $id = $_POST["Id"];
    $name = $_POST["CardName"];
    $set = $_POST["Set"];
    $number = $_POST["Number"];
    $cost = $_POST["Cost"];
    $rarity = $_POST["Rarity"];
    $res = create_or_update_card($mysqli, $id, $name, $set, $number, $cost, $rarity);
    echo json_encode($res);
}
else {
    // Comunico che non ho capito quale operazione mi è richiesta.
    $result["error"] = "Operazione non riconosciuta.";
    $result["content"] = "Log result: $log_result\nCheck Level: $check_level\n" . var_dump($_POST);
    echo json_encode($result);
}

?>