<?php

use src\AzheSpace\Bot\Telegram\TelegramBot;

include_once './src/autoload.php';
include_once './Resources/Config/bot.php';

if (strlen($_GET['chat_id']) >= 9) {
	$bot = new TelegramBot(BOT_TOKEN);
	$bot->handle();
} else {
	print "you can try send /start in Bot";
}
