<?php
if($TGBot->text == '/all_info') {
	$TGBot->sendMessage($TGBot->chat_id, "Username: " . $TGBot->get_bot_info("username"));
	$TGBot->sendMessage($TGBot->chat_id, "First Name: " . $TGBot->get_bot_info("first_name"));
	$TGBot->sendMessage($TGBot->chat_id, "Id: " . $TGBot->get_bot_info("id"));
} else if($TGBot->text == '/last_event') {
	/*
	 * Recupero le stesse informazioni di un dettaglio online ma solamente dell'ultimo evento.
	 * Ovviamente so se un utente è amministratore grazie al chat_id.
	 */
    $test = test_controller($mysqli);
    $event = get_n_latest_events($mysqli, 1);
    if(!$event["result"]) {
		$message = "There was a problem, please contact the system administrator and notify the following informations:\n" . json_encode($event);
    } else {
    	$message = "";
    	// Informazioni base dell'evento.
        //$event = $event["content"];
        foreach ($event["content"] as $key => $value) {
        	$message .= "The latest event was <b>" . $value["Name"];
	        $message .= "</b>, done in " . $value["Nation"];
	        $message .= ", at " . $value["Date"];
	        $message .= ", with " . $value["Attendance"] . " partecipating players!\n";
	        $message .= "\nCommunity reports: " . $value["CommunityReports"] . "\n";
	        $message .= "\nOther links: " . $value["OtherLinks"] . "\n";

			$res = get_event_rulers_breakdowns_by_id($mysqli, $value["Id"]);
			$breakdown = $res["content"];
			$message .= "\nEvent ruler breakdown (total " . $res["Total"] . "):\n";
			foreach ($breakdown as $elem) {
				$perc = round($elem["Quantity"] / $res["Total"] * 100, 2);
		    	$message .= $elem["Name"] . ":\t\t\t" . $elem["Quantity"] . " (<code>" . $perc . "%</code>)\n";
		    	//$formatt = sprintf('%+15s:%+10d (<code>%2.2f&#37;</code>)', ((string)$elem["Name"]), ((int)$elem["Quantity"]), ((float)$perc));
		    	//$formatt = sprintf('%+4s:%+4d (<code>%+4f</code>)', "aa", 123, 12.3);
		    	//$message .= $formatt . "\n";
		    }

	        // Tabellina delle decklist.
		    $decklists = get_event_decks($mysqli, $value["Id"], $TGBot->botAdmin());
		    $message .= "\nThose are the top 8 decklist:\n";
		    foreach ($decklists["content"] as $elem) {
		    	//$message .= json_encode($elem);
		    	$message .= $elem["Position"] . "°:\t<a href=\"https://www.gachalog.com/list/" . $elem["GachaCode"] . "\">" . $elem["Name"] . "</a>\n";
			}
			
			$message .= "\nCheck all details at <a href=\"https://www.fowdeckhub.altervista.org/events.php?event_id=" . $value["Id"] . "\">Fow Deck Hub!</a>";
        }
    }

	$TGBot->sendMessage($TGBot->chat_id, $message);

} else if($TGBot->text == '/nation_event') {
	$TGBot->sendMessage($TGBot->chat_id, "This command is not implemented yet.");
} else if($TGBot->text == '/site') {
	$TGBot->sendMessage($TGBot->chat_id, "https://fowdeckhub.altervista.org");
} else if($TGBot->text == '/start') {
	$TGBot->sendMessage($TGBot->chat_id, "The bot seem to work very well! Here a list of request you can do to him:\n /last_event: Get lastest event info\n /nation_event: *Get events list by Nation*\n /site: Get the site link;\n /start: Get this message \n All command with * are not implemented yet.");
}