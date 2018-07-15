<?php
namespace NinetyNine\Url\Helpers;

use NinetyNine\Url\Exceptions\InvalidArrayException;

class Methods
{
	/**
	 * Check if an array is associative or not
	 *
	 * @param array $array
	 * @return bool
	 */
	public static function isAssociative(array $array)
	{
		return !empty($array) && array_keys($array) !== range(0, count($array) - 1);
	}

	/**
	 * Check if an array is associative or not and throw
	 *
	 * @param array $array
	 * @throws InvalidArrayException
	 * @return void
	 */
	public static function isAssociativeVolatile(array $array)
	{
		if (!static::isAssociative($array)) {
			throw new InvalidArrayException;
		}
	}

	/**
	 * Flattern an array
	 *
	 * @param array $array
	 * @param array $tmp
	 * @return array
	 */
	public static function flattern(array $array, &$tmp = [])
	{
		foreach ($array as $element) {
			if (!is_array($element)) {
				$tmp[] = $element;

				continue;
			}

			$tmp = static::flattern($element, $tmp);
		}

		return $tmp;
	}

	/**
	 * Remove an array element
	 *
	 * @param string|int $key
	 * @param array      $array
	 * @return array
	 */
	public static function remove($key, array &$array)
	{
		unset($array[ $key ]);

		return $array;
	}
}