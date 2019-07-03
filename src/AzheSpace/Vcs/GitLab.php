<?php

namespace src\AzheSpace\Vcs;

class GitLab
{
    /**
     * @param $json
     * @return string
     */
    public function parseJson($json)
    {
        $datas = json_decode($json, true);
        $username = $datas['user_name'];
        $event_name = $datas['event_name'];
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

            $listCommit .= "\n$no. <a href='$url'>$message</a>" . " By " . $authorName;
            $no++;
        }

        $text = "<b>$username $event_name</b>" .
            "$listCommit" .
            "\n\nAdded: $addedCount, Modified: $modifiedCount, Removed: $removedCount.";
        return $text;
    }
}
