<?php

namespace src\AzheSpace\Functions;

use Bot;

class Core
{
    /**
     * @return mixed
     */
    public static function Id()
    {
        $message = Bot::message();
        $text = "your id is " . $message['chat']['id'];

        $options = ['parse_mode' => 'html', 'reply' => true, 'disable_web_page_preview' => true];
        return Bot::sendMessage($text, $options);
    }
}
