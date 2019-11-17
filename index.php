<?php

print 10;

use WinTenDev\Handler\Main;
use WinTenDev\Utils\Params;

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/Resources/Config/bot.php';

$chat_id = Params::get('chat_id');

if (strlen($chat_id) >= 9) {
	$bot = new Main();
	$bot->handle($chat_id);
} else {
	print "you can try send /start in Bot";
//    header('Location: https://winten.space');
}
