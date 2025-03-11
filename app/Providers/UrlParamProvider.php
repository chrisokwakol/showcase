<?php

namespace App\Providers;

use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;

class UrlParamProvider extends ServiceProvider
{

	/**
	 * Get a url parameter and sanitize it.
	 * @param string $param
	 * @param mixed $fallback
	 * @param string $returnAs string | array | bool | int
	 * @param string $delimiter If array is selected as the return.
	 * @return mixed
	 */
	public static function get(string $param,  mixed $fallback = '', string $returnAs = 'string', string $delimiter = ','): mixed
	{

		if (!isset($_GET[$param])) return $fallback;

		$value = self::sanitize($_GET[$param]);

		return self::returnAs($value, $returnAs, $delimiter);
	}

	public static function returnAs(mixed $value, string $returnAs = 'string', string $delimiter = ','): mixed
	{
		return match ($returnAs) {
			'array' => explode($delimiter, $value),
			'int' => (int)$value,
			'bool' => (bool)$value,
			'string' => (string)$value,
			default => $value,
		};
	}

	/**
	 * Takes in any value and sanitizes it before sending it back.
	 * If no sanitization can be completed, will return false.
	 *
	 * @param mixed $value
	 * @return mixed
	 */
	private static function sanitize(mixed $value): mixed
	{

		if (is_numeric($value))
			return preg_replace("@([^0-9])@Ui", "", $value);

		else if (is_bool((bool)$value))
			return $value;

		else if (is_float($value))
			return preg_replace("@([^0-9\,\.\+\-])@Ui", "", $value);

		else if (is_string($value)) {
			if (filter_var($value, FILTER_VALIDATE_URL))
				return $value;
			else if (filter_var($value, FILTER_VALIDATE_EMAIL))
				return $value;
			else if (filter_var($value, FILTER_VALIDATE_IP))
				return $value;
			else if (filter_var($value, FILTER_VALIDATE_FLOAT))
				return $value;
			else
				return preg_replace("@([^a-zA-Z0-9\+\-\_\*\@\$\!\;\.\?\#\:\=\%\/\ ]+)@Ui", "", $value);
		}

		return false;
	}
}
