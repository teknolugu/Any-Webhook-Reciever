<?php

namespace src\AzheSpace\Modules;

use Bot;

class Git
{
    /**
     * @return string
     */
    public function getUrl()
    {
        $message = Bot::message();
        $chat_id = $message['chat']['id'];
        $url = "https://integrate.azhe.space/$chat_id.php";
        return $url;
    }
}
