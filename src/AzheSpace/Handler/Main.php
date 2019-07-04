<?php

namespace src\AzheSpace\Handler;

use src\AzheSpace\Bot\Telegram\TelegramBot;
use src\AzheSpace\Vcs\GitHub;
use src\AzheSpace\Vcs\GitLab;

class Main
{
    public function handle()
    {
        $input = file_get_contents("php://input");
        $datas = json_decode($input, true);
        $chat_id = $_GET['chat_id'];

        $bot = new TelegramBot(BOT_TOKEN);

        if (is_array($datas)) {
            $json = json_encode($datas, 128, JSON_UNESCAPED_SLASHES);

            $bot->setChatId(myId);
            $bot->Send("<code>$json</code>");

            $text = "May your Git provider currently not supported";

            switch (true) {
                case $datas['event_name'] != '':
                    $gitlab = new GitLab();
                    $text = $gitlab->parseJson($json);
                    break;

                case $datas['ref'] != '':
                    $github = new GitHub();
                    $text = $github->parseJson($json);
                    break;
            }

            $bot->setChatId($chat_id);
            $bot->Send($text);
        } else {
            $bot->setChatId(myId);
            $bot->Send("Data Invalid");
        }
    }
}
