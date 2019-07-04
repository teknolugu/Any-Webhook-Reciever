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
			$action = $datas['action'];
			switch ($action) {
				case 'started':
				case 'created':
					$text = "Someone give Star to repo $repoNameUrl. ";
					break;
				
				case 'deleted':
					$text = "Someone remove Star to repo $repoNameUrl. ";
					break;
				
				case 'publicized':
					$isRepoPrivate = $datas['repository']['private'];
					$repoVisibility = Converters::intToStr($isRepoPrivate, "Public", "Private");
					$text = "Repo <a href='$repoUrl'>$repoName</a> Publicized changed to $repoVisibility";
					break;
				
				default:
					$text = "Action may undetected. Please wait..";
					break;
			}
		} elseif (WordUtil::isContain($datas['ref'], 'tags')) {
			$ref = $datas['ref'];
			$pecahRef = explode('/', $ref);
			$version = $pecahRef[2];
			
			$text = "<b>New Relase</b> of $repoNameUrl." .
				"\nVersion $version";
		} elseif ($datas['hook'] != '') {
			$hookActive = $datas['hook']['active'];
			$hookContenType = $datas['hook']['config']['content_type'];
			$hookInSsl = $datas['hook']['config']['insecure_ssl'];
			$text = "<b>WebHook setting</b> for $repoNameUrl saved" .
				"\nContent type: $hookContenType";
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
