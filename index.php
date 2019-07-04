<?php

use src\AzheSpace\Handler\Main;

include_once './src/autoload.php';
include_once './Resources/Config/bot.php';

if (strlen($_GET['chat_id']) >= 9) {
    $bot = new Main();
	$bot->handle();
} else {
	print "you can try send /start in Bot";
}
