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
if(isset($_GET["save_decklist"]) && isset($_POST["Id"]) && isset($_POST["Name"]) && isset($_POST["Player"]) && isset($_POST["Event"]) && isset($_POST["Type"]) && isset($_POST["Position"]) && isset($_POST["GachaCode"]) && isset($_POST["Visibility"])) {
    $id = mysql_real_escape_string($_POST["Id"]);
    $name = mysql_real_escape_string($_POST["Name"]);
    $player = mysql_real_escape_string($_POST["Player"]);
    $event = mysql_real_escape_string($_POST["Event"]);
    $type = mysql_real_escape_string($_POST["Type"]);
    $position = mysql_real_escape_string($_POST["Position"]);
    $gacha_code = mysql_real_escape_string($_POST["GachaCode"]);
    $visibility = mysql_real_escape_string($_POST["Visibility"]);
    $res = save_base_decklist_data($id, $name, $player, $event, $type, $position, $gacha_code, $visibility);
    echo json_encode($res);
} 
else if(isset($_GET["save_decklist"]) && isset($_POST["Id"]) && isset($_POST["Deck"])) {
    $id = mysql_real_escape_string($_POST["Id"]);
    $decks = json_decode($_POST["Deck"]);
    $res = save_decklist($id, $decks);
    echo json_encode($res);
}
else {
    // Comunico che non ho capito quale operazione mi è richiesta.
    $result["error"] = "Operazione non riconosciuta.";
    echo json_encode($result);
}

?>