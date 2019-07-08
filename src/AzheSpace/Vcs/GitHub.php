<?php

namespace src\AzheSpace\Vcs;

use src\AzheSpace\Logger\TelegramLog;
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
		$repoName = $datas['repository']['name'];
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
			$hook_type = $datas['hook']['type'];
			switch ($hook_type) {
				case 'Organization':
					$orgName = $datas['organization']['login'];
					$orgUrl = str_replace(['api.', 'orgs/'], '', $datas['organization']['url']);
					$orgNameUrl = "<a href='$orgUrl'>$orgName</a>";
					$text = "<b>WebHook</b> for $orgNameUrl Organization connected succefully.";
					break;
				
				default:
					$text = "<b>WebHook setting</b> for $repoNameUrl saved";
					break;
			}
		} elseif ($datas['commits'] != '') {
			$commits = $datas['commits'];
			$commitList = '';
			$no = 1;
			foreach ($commits as $key => $val) {
				$message = $val['message'];
				$orgUrl = $val['url'];
				$authorName = $val['author']['name'];
				$addedCount = count($val['added']);
				$removedCount = count($val['removed']);
				$modifiedCount = count($val['modified']);
				$commitList .= "\n$no. <a href='$orgUrl'>$message</a> By $authorName" .
					"\n => Added: $addedCount, Removed: $removedCount, Modified: $modifiedCount\n";
				$no++;
			}
			
			$text = "🔨 <b>GitHub Push Events.</b>" .
				"\n" . trim($commitList);
		}

//		TelegramLog::logToMe($datas);
		
		return $text;
	}
}
