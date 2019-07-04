<?php

namespace src\AzheSpace\Handler;

use src\AzheSpace\Bot\Telegram\TelegramBot;
use src\AzheSpace\Utils\WordUtil;
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
			
			$text = "May your Git provider currently not supported or this's bug." .
				"\nPlease wait.";
			
			switch (true) {
				// GitLab Detect
				case WordUtil::isContain($datas['project']['web_url'], 'gitlab'):
				case $datas['event_name'] != '':
					$gitlab = new GitLab();
					$text = $gitlab->parseJson($json);
					break;
				
				// GitHub detect
				case WordUtil::isContain($datas['compare'], 'github'):
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
