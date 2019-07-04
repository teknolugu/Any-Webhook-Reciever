<?php

namespace src\AzheSpace\Vcs;

use src\AzheSpace\Utils\Converters;
use src\AzheSpace\Utils\WordUtil;

class GitHub
{
	
	/**
	 * @param $json
	 * @return string
	 */
	public function parseJson($json)
	{
		$datas = json_decode($json, true);
		$repoUrl = $datas['repository']['html_url'];
		$repoName = $datas['repository']['full_name'];
		$repoNameUrl = "<a href='$repoUrl'>$repoName</a>";
		
		if ($datas['action'] != '') {
			$isRepoPrivate = $datas['repository']['private'];
			
			$repoVisibility = Converters::intToStr($isRepoPrivate, "Public", "Private");
			$text = "Repo <a href='$repoUrl'>$repoName</a> Publicized changed to $repoVisibility";
		} elseif (WordUtil::isContain($datas['ref'], 'tags')) {
			$ref = $datas['ref'];
			$pecahRef = explode('/', $ref);
			$version = $pecahRef[2];
			
			$text = "<b>New Relase</b> of $repoNameUrl." .
				"\nVersion $version";
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
