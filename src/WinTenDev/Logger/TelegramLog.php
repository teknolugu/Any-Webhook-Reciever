<?php

namespace src\WinTenDev\Logger;

use src\WinTenDev\Bot\Telegram\TelegramBot;

class TelegramLog
{
	/**
	 * @param $json
	 * @return bool
	 */
	public static function logToMe($json)
	{
		$bot = new TelegramBot(BOT_TOKEN);
		$bot->setChatId(myId);
		$text = "<b>Json Data</b>\n" . json_encode($json, 128);
		$bot->Send($text);
		return true;
	}
	
	public static function logActivity($anu)
	{
		$bot = new TelegramBot(BOT_TOKEN);
		$bot->setChatId(myId);
		$text = "<b>Data</b>\n" . $anu;
		$bot->Send($text);
		return true;
	}
}
