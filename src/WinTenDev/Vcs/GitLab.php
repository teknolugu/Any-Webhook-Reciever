<?php

namespace src\WinTenDev\Vcs;

class GitLab
{
	/**
	 * @param $json
	 * @return string
	 */
	public function parseJson($json)
	{
		$datas = json_decode($json, true);
		
		$event_name = $datas['event_type'];
		$username = $datas['user']['name'];
		
		switch ($event_name) {
			case 'push':
				$commits = $datas['commits'];
				$listCommit = "";
				$no = 1;
				foreach ($commits as $key => $val) {
					$message = $val['message'];
					$url = $val['url'];
					$authorName = $val['author']['name'];
					
					$addedCount = count($val['added']);
					$modifiedCount = count($val['modified']);
					$removedCount = count($val['removed']);
					
					$listCommit .= "\n$no. <a href='$url'>$message</a> by <b>$authorName</b>" .
						"\nAdded: $addedCount, Modified: $modifiedCount, Removed: $removedCount.\n";
					$no++;
				}

//            $total_commit_count = $datas['total_commits_count'];
				
				$text = "🔨 <b>GitLab $event_name</b> by <b>$username</b>" . "$listCommit";
				break;
			case 'issue':
				$atributes = $datas['object_attributes'];
				$title = $atributes['title'];
				$desc = $atributes['description'];
				$urlIssue = $atributes['url'];
				$dueDate = $atributes['due_date'] ?? '- no due date -';
				$state = $atributes['state'];
				
				$text = "<b>GitLab Issue</b> $state by $username" .
					"\nTitle: <a href='$urlIssue'>$title</a>" .
					"\nDue date: $dueDate";
				break;
			
			default:
				$text = "GitLab Event not indentified, please ask @Azhe403";
				break;
		}
		
		return $text;
	}
}
