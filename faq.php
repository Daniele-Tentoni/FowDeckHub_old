<?php
require_once 'definings.php';
require_once ROOT_PATH . '/config/functions.php';
sec_session_start();

// Controllo di essere collegato, se sono in test eseguo automaticamente un login.
$log_result = login_check($mysqli);
// Controllo il livello senza tracciarlo, altrimenti qui sarebbe un morire.
$check_level = check_level($mysqli, 2, false);

if($log_result && $check_level == 0) {
	$login_checked = true;
    $title = "F.A.Q. - Administrator - Fow Deck Hub";
    $active_page = 20;
    require_once ROOT_PATH . '/layout/header.php';
    require_once ROOT_PATH . '/pages/faq/faq_partial.php';
} else {
    $login_checked = false;
    $title = "F.A.Q. - Fow Deck Hub";
    $active_page = 20;
    require_once ROOT_PATH . '/layout/user_header.php';
    require_once ROOT_PATH . '/pages/faq/faq_partial.php';
}

// Ho bisogno di caricare ulteriori scripts.
$add_script = "<script type=\"text/javascript\" src=\"js/faq.js\"></script>";
// Il footer è uguale per entrambi. A dir la verità anche un pezzo di header.
require_once ROOT_PATH . '/layout/footer.php';
?>
