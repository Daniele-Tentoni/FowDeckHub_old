<?php
if($TGBot->text == '/start')
{
	$TGBot->sendMessage($TGBot->chat_id, "Il Bot funziona! Tastiera normale: /tastiera Tastiera inline: /itastiera Iscritti: /iscritti Feedback: /feedback Foto: /foto");
} else if($TGBot->text == '/get_some_data')
{
	$TGBot->sendMessage($TGBot->chat_id, "Il Bot funziona! Tastiera normale: /tastiera Tastiera inline: /itastiera Iscritti: /iscritti Feedback: /feedback Foto: /foto");
}
echo "Questo è il dump.<br />";
var_dump($TGBot);
echo "Finito il dump.<br />";