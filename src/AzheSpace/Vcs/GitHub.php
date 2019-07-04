<?php

namespace src\AzheSpace\Vcs;

use src\AzheSpace\Utils\Converters;

class GitHub
{
	
	/**
	 * @param $json
	 * @return string
	 */
	public function parseJson($json)
	{
		$datas = json_decode($json, true);
		if ($datas['action'] != '') {
			$repoName = $datas['repository']['full_name'];
			$repoUrl = $datas['repository']['html_url'];
			$isRepoPrivate = $datas['repository']['private'];
			
			$repoVisibility = Converters::intToStr($isRepoPrivate, "Public", "Private");
			$text = "Repo <a href='$repoUrl'>$repoName</a> Publicized changed to $repoVisibility";
		} else {
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
		}
		
		return $text;
	}
}
