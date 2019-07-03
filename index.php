<?php

use src\AzheSpace\Bot\Telegram\TelegramBot;

include_once './src/autoload.php';
include_once './Resources/Config/bot.php';

$bot = new TelegramBot(BOT_TOKEN);
$bot->handle();
