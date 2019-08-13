<?php

namespace src\WinTenDev\Utils;

class Params
{
	/**
	 * @param string $key
	 * @return string
	 */
	public static function get(string $key): string
	{
		$val = "";
		if ($_GET != null) {
			$val = $_GET[$key];
		}
		return $val;
	}
	
}
