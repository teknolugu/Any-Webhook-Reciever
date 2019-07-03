<?php

namespace src\AzheSpace\Vcs;

class GitHub
{
	
	/**
	 * @param $json
	 * @return string
	 */
	public function parseJson($json)
	{
		$datas = json_decode($json, true);
		$commits = $datas['commits'];
		$commitList = '';
		$no = 1;
		foreach ($commits as $key => $val) {
			$message = $val['message'];
			$url = $val['url'];
			$authorName = $val['author']['name'];
			
			$commitList .= "\n$no. <a href='$url'>$message</a>" . " By " . $authorName;
			$no++;
		}
		
		$text = "<b>GitHub Events.</b>" .
			"\n" . trim($commitList);
		return $text;
	}
}
