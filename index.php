<?php

use src\WinTenDev\Handler\Main;

include_once __DIR__ . '/src/autoload.php';
include_once __DIR__ . '/Resources/Config/bot.php';

if (strlen($_GET['chat_id']) >= 9) {
	$bot = new Main();
	$bot->handle();
} else {
	print "you can try send /start in Bot";
    header('Location: https://winten.space');
}
