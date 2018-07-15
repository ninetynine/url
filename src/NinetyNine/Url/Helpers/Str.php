<?php
namespace NinetyNine\Url\Helpers;


class Str
{
	/**
	 * Check if a string starts with
	 *
	 * @param string $query
	 * @param string $string
	 * @return bool
	 */
	public static function startsWith(string $query, string $string)
	{
		return substr($string, 0, strlen($query)) === $query;
	}

	/**
	 * Check if a string ends with
	 *
	 * @param string $query
	 * @param string $string
	 * @return bool
	 */
	public static function endsWith(string $query, string $string)
	{
		$length = strlen($query);

		return $length === 0 ||
			   (substr($string, -$length) === $query);
	}
}