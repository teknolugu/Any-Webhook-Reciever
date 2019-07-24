<?php

namespace src\AzheSpace\Handler;

use src\AzheSpace\Bot\Telegram\TelegramBot;
use src\AzheSpace\Utils\WordUtil;
use src\AzheSpace\Vcs\AppVeyor;
use src\AzheSpace\Vcs\GitHub;
use src\AzheSpace\Vcs\GitLab;

class Main
{
	/**
	 *
	 */
	public function handle()
	{
		$input = file_get_contents("php://input");
		$datas = json_decode($input, true);
		$chat_id = $_GET['chat_id'];
		
		$bot = new TelegramBot(BOT_TOKEN);
		
		if (is_array($datas)) {
			$json = json_encode($datas, 128);
			
			$bot->setChatId(myId);
			$bot->Send("<code>$json</code>");
			
			$text = "May your Git provider currently not supported or this's bug." .
				"\nPlease report to @Azhe403.";
			
			switch (true) {
				// GitLab Detect
				case WordUtil::isContain($datas['project']['web_url'], 'gitlab'):
				case $datas['event_name'] != '':
					$gitlab = new GitLab();
					$text = $gitlab->parseJson($json);
					break;
				
				// GitHub detect
				case WordUtil::isContain($datas['compare'], 'github'):
				case WordUtil::isContain($datas['organization']['url'], 'github'):
				case WordUtil::isContain($datas['repository']['url'], 'github'):
				case WordUtil::isContain($datas['sender']['url'], 'github'):
				case $datas['ref'] != '':
					$github = new GitHub();
					$text = $github->parseJson($json);
					break;
				
				// Appveyor
				case WordUtil::isContain($datas['eventData']['buildUrl'], 'appveyor'):
					$text = new AppVeyor($json);
					break;
			}
			
			$bot->setChatId($chat_id);
			$bot->Send($text);
		} else {
			include_once './Resources/Pages/home.php';
			
			echo true;
			$bot->setChatId(myId);
			
			$text = "<b>Data Invalid</b>" .
				"\nChatId: $chat_id";
			$bot->Send($text);
		}
	}
}
