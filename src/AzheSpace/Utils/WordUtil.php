<?php

namespace src\AzheSpace\Utils;

class WordUtil
{
	/**
	 * @param $word
	 * @param $contain
	 * @return bool
	 */
	public static function isContain($word, $contain)
	{
		$isContain = false;
		if (strpos($word, $contain) !== false) {
			$isContain = true;
		}
		return $isContain;
	}
}
