<?php

namespace WinTenDev\Bot\Telegram;

class TelegramBot
{
	private $chat_id;
	private $bot_token;
	
	public function __construct(string $bot_token)
	{
		$this->bot_token = $bot_token;
	}
	
	/**
	 * @param $chat_id
	 * @return string
	 */
	final public function setChatId(string $chat_id): string
	{
		return $this->chat_id = $chat_id;
	}
	
	/**
	 * @param string $data
	 * @return string
	 */
	final public function Send(string $data): string
	{
//        $chatid = '236205726';
//        $chatid = '-1001198887178';
		$post = [
			'chat_id'                  => $this->chat_id,
			'parse_mode'               => 'HTML',
			'text'                     => $data,
			'disable_web_page_preview' => true,
		];
		
		return $this->apiRequest($post);
	}
	
	/**
	 * @param array $post
	 * @return string
	 */
	private function apiRequest(array $post): string
	{
		$method = "sendMessage";
		$url = "https://api.telegram.org/bot" . $this->bot_token . "/" . $method;
		
		$header = [
			"X-Requested-With: XMLHttpRequest",
			"User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.84 Safari/537.36",
		];
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		
		$datas = curl_exec($ch);
		$error = curl_error($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		return $datas;
	}
	
}
