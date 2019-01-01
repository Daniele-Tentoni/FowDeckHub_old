<?php
// Variabili globali, funzioni di db/login e controllers.
require_once '../definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();
require_once ROOT_PATH . '/controllers/decklist_controller.php';
$result = array();
$result["result"] = false;
$result["error"] = "nothing";
$content = "";

/* 
 * Come anche in altri destinatari di chiamate ajax, questo file dovrà sempre mandare in echo dei file json.
 * In questo modo cerco di dare un certo ordine al mio codice per fare meglio manutenzione.
 * L'obiettivo sarà poi quello di sfruttare appieno la potenzialità del linguaggio ad oggetti del php e non
 * solamente il lato funzionale molto piatto. Model-View-Controller.
 */

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);

// Qui controllo quale operazione devo eseguire arrivato dalla chiamata ajax.
if($log_result && $check_level == 0 && isset($_GET["save_decklist_base_data"]) && isset($_POST["Id"]) && isset($_POST["Name"]) && isset($_POST["Player"]) && isset($_POST["Event"]) && isset($_POST["Type"]) && isset($_POST["Position"]) && isset($_POST["GachaCode"]) && isset($_POST["Visibility"])) {
    $id = $_POST["Id"];
    $name = $_POST["Name"];
    $player = $_POST["Player"];
    $event = $_POST["Event"];
    $type = $_POST["Type"];
    $position = $_POST["Position"];
    $gacha_code = $_POST["GachaCode"];
    $visibility = $_POST["Visibility"];
    $res = save_base_decklist_data($mysqli, $id, $name, $player, $event, $type, $position, $gacha_code, $visibility);
    echo json_encode($res);
} 
else if($log_result && $check_level == 0 && isset($_GET["save_decklist"]) && isset($_POST["Id"]) && isset($_POST["Deck"])) {
    $id = $_POST["Id"];
    $decks = json_decode($_POST["Deck"], true);
    $res = save_decklist($mysqli, $id, $decks);
    echo json_encode($res);
}
else {
    // Comunico che non ho capito quale operazione mi è richiesta.
    $result["error"] = "Operazione non riconosciuta.";
    $result["content"] = var_dump($_POST);
    echo json_encode($result);
}

?>