<?php

use src\AzheSpace\Functions\Core;
use src\AzheSpace\Modules\Git;

require_once './src/autoload.php';
require_once './vendor/autoload.php';
require_once './../Resources/Config/bot.php';

$bot = new PHPTelebot(BOT_TOKEN, BOT_USERNAME);

$bot->cmd('/start', 'Hi, press /help');

$bot->cmd('/id', function () {
    $message = Bot::message();
    $text = "your id is " . $message['chat']['id'];

    $options = ['parse_mode' => 'html', 'reply' => true, 'disable_web_page_preview' => true];
    Bot::sendMessage($text, $options);
});

$bot->cmd('/gitintegration', function () {
    $git = new Git();
    $text = "Sambungkan bot ke repository Anda. " .
        "\nSilakan pasang url di bawah ini di pengaturan Webhook\Integrasi.\n" . $git->getUrl();

    $text .= "\n\nPenyedia yang di dukung: GitLab, GitHub";
    $options = ['parse_mode' => 'html', 'reply' => true, 'disable_web_page_preview' => true];

    Bot::sendMessage($text, $options);
});

$text = "Berikut adalah daftar peringah" .
    "\n/gitintegration";

$bot->cmd('/help', $text);

$bot->run();

