<?php

namespace src\WinTenDev\Utils;

class Converters
{
	/**
	 * @param        $int
	 * @param string $strTrue
	 * @param string $strFalse
	 * @return string
	 */
	public static function intToStr($int, $strTrue = "Yes", $strFalse = "No")
	{
		return $int == 1 ? $strTrue : $strFalse;
	}
}
