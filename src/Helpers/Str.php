<?php

namespace DatabaseFactory\Helpers {

	/**
	 * Helper for interacting with strings
	 *
	 * @package DatabaseFactory\Helpers
	 * @author  Jason Napolitano
	 *
	 * @version 1.0.0
	 * @since   1.0.0
	 * @license MIT <https://mit-license.org>
	 */
	class Str
	{
		/** @var array|string[] $plural Array of pluralized words */
		private static array $plural = [
			'/(quiz)$/i'                     => "$1zes",
			'/^(ox)$/i'                      => "$1en",
			'/([m|l])ouse$/i'                => "$1ice",
			'/(matr|vert|ind)ix|ex$/i'       => "$1ices",
			'/(x|ch|ss|sh)$/i'               => "$1es",
			'/([^aeiouy]|qu)y$/i'            => "$1ies",
			'/(hive)$/i'                     => "$1s",
			'/(?:([^f])fe|([lr])f)$/i'       => "$1$2ves",
			'/(shea|lea|loa|thie)f$/i'       => "$1ves",
			'/sis$/i'                        => "ses",
			'/([ti])um$/i'                   => "$1a",
			'/(tomat|potat|ech|her|vet)o$/i' => "$1oes",
			'/(bu)s$/i'                      => "$1ses",
			'/(alias)$/i'                    => "$1es",
			'/(octop)us$/i'                  => "$1i",
			'/(ax|test)is$/i'                => "$1es",
			'/(us)$/i'                       => "$1es",
			'/s$/i'                          => "s",
			'/$/'                            => "s",
		];

		/** @var array|string[] $singular Array of singular words */
		private static array $singular = [
			'/(quiz)zes$/i'                                                    => "$1",
			'/(matr)ices$/i'                                                   => "$1ix",
			'/(vert|ind)ices$/i'                                               => "$1ex",
			'/^(ox)en$/i'                                                      => "$1",
			'/(alias)es$/i'                                                    => "$1",
			'/(octop|vir)i$/i'                                                 => "$1us",
			'/(cris|ax|test)es$/i'                                             => "$1is",
			'/(shoe)s$/i'                                                      => "$1",
			'/(o)es$/i'                                                        => "$1",
			'/(bus)es$/i'                                                      => "$1",
			'/([m|l])ice$/i'                                                   => "$1ouse",
			'/(x|ch|ss|sh)es$/i'                                               => "$1",
			'/(m)ovies$/i'                                                     => "$1ovie",
			'/(s)eries$/i'                                                     => "$1eries",
			'/([^aeiouy]|qu)ies$/i'                                            => "$1y",
			'/([lr])ves$/i'                                                    => "$1f",
			'/(tive)s$/i'                                                      => "$1",
			'/(hive)s$/i'                                                      => "$1",
			'/(li|wi|kni)ves$/i'                                               => "$1fe",
			'/(shea|loa|lea|thie)ves$/i'                                       => "$1f",
			'/(^analy)ses$/i'                                                  => "$1sis",
			'/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/i' => "$1$2sis",
			'/([ti])a$/i'                                                      => "$1um",
			'/(n)ews$/i'                                                       => "$1ews",
			'/(h|bl)ouses$/i'                                                  => "$1ouse",
			'/(corpse)s$/i'                                                    => "$1",
			'/(us)es$/i'                                                       => "$1",
			'/s$/i'                                                            => "",
		];

		/** @var array|string[] $irregular Array of irregular words */
		private static array $irregular = [
			'move'   => 'moves',
			'foot'   => 'feet',
			'goose'  => 'geese',
			'sex'    => 'sexes',
			'child'  => 'children',
			'man'    => 'men',
			'tooth'  => 'teeth',
			'person' => 'people',
			'valve'  => 'valves',
		];

		/** @var array|string[] $uncountable Array of uncountable words */
		private static array $uncountable = [
			'sheep',
			'fish',
			'deer',
			'series',
			'species',
			'money',
			'rice',
			'information',
			'equipment',
		];

		/**
		 * Return a singluarized string
		 *
		 * @param $string
		 *
		 * @return string
		 */
		public static function singular($string): string
		{
			self::isSame($string);

			// check for irregular plural forms
			foreach (self::$irregular as $result => $pattern) {
				$pattern = '/' . $pattern . '$/i';

				if (preg_match($pattern, $string)) {
					return preg_replace($pattern, $result, $string);
				}
			}

			// check for matches using regular expressions
			foreach (self::$singular as $pattern => $result) {
				if (preg_match($pattern, $string)) {
					return preg_replace($pattern, $result, $string);
				}
			}

			return $string;
		}

		/**
		 * Save some time in the case that singular and
		 * plural are the same
		 *
		 * @param string $string
		 *
		 * @return false|string
		 */
		private static function isSame(string $string): bool
		{
			return in_array(strtolower($string), self::$uncountable, true) ? $string : false;
		}

		/**
		 * Pluralize IF
		 *
		 * @param $count
		 * @param $string
		 *
		 * @return string
		 */
		public static function pluralizeIf($count, $string): string
		{
			if ($count === 1) {
				return "1 $string";
			}
			return $count . " " . self::plural($string);
		}

		/**
		 * Return a pluralized string
		 *
		 * @param $string
		 *
		 * @return string
		 */
		public static function plural($string): string
		{
			self::isSame($string);

			// check for irregular singular forms
			foreach (self::$irregular as $pattern => $result) {
				$pattern = '/' . $pattern . '$/i';
				if (preg_match($pattern, $string)) {
					return preg_replace($pattern, $result, $string);
				}
			}

			// check for matches using regular expressions
			foreach (self::$plural as $pattern => $result) {
				if (preg_match($pattern, $string)) {
					return preg_replace($pattern, $result, $string);
				}
			}

			return $string;
		}

		/**
		 * Wrapper for strtolower()
		 *
		 * @param string $string
		 *
		 * @return string
		 *
		 * @see \strtolower()
		 *
		 */
		public static function lower(string $string): string
		{
			return strtolower($string);
		}

		/**
		 * Wrapper for strtoupper()
		 *
		 * @param string $string
		 *
		 * @return string
		 *
		 * @see \strtoupper()
		 *
		 */
		public static function upper(string $string): string
		{
			return strtoupper($string ?? '');
		}

		/**
		 * Strip Quotes
		 *
		 * Removes single and double quotes from a string
		 *
		 * @param string $str
		 *
		 * @return    string
		 */
		public static function stripQuotes(string $str, bool $trim = false): string
		{
			return str_replace(['"', "'"], '', $trim ? trim($str) : $str);
		}

		/**
		 * Check if a string is empty
		 *
		 * @param string $string
		 *
		 * @return bool
		 */
		public static function empty(string $string): bool
		{
			return $string === '';
		}

		/**
		 * Slugify a string
		 *
		 * @param string $value
		 *
		 * @return string
		 */
		public static function slug(string $value): string
		{
			return strtolower(str_replace(' ', '-', $value));
		}

		public static function bcrypt(string $string): string
		{
			return password_hash($string, PASSWORD_BCRYPT);
		}

		public static function argon2i(string $string): string
		{
			return password_hash($string, PASSWORD_ARGON2I);
		}


		/**
		 * @param string $string
		 *
		 * @return string
		 *
		 * @see https://en.wikipedia.org/wiki/CamelCase
		 */
		public static function toUpperCamelCase($string): string
		{
			return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
		}

		/**
		 * @param string $string
		 *
		 * @return string
		 *
		 * @see https://en.wikipedia.org/wiki/CamelCase
		 */
		public static function toLowerCamelCase(string $string): string
		{
			return lcfirst(self::toUpperCamelCase($string));
		}

		/**
		 * @param string $string
		 *
		 * @return string
		 */
		public static function toSnakeCase(string $string): string
		{
			$string = strtolower(preg_replace('/([A-Z])/', '_$1', lcfirst(self::toUpperCamelCase(trim($string)))));
			$string = preg_replace('/[^A-Za-z0-9_]+/', '_', $string);
			$string = preg_replace('/_+/', '_', $string);
			if (self::endsWith($string, '_')) {
				$string = mb_substr($string, 0, -1);
			}

			return $string;
		}

		/**
		 * @param string $string
		 *
		 * @return string
		 */
		public static function toLowerCase(string $string): string
		{
			return str_replace('_', ' ', self::toSnakeCase($string));
		}

		/**
		 * @param string $string
		 *
		 * @return mixed
		 */
		public static function toHumanCase(string $string): string
		{
			return ucfirst(str_replace('_', ' ', self::toSnakeCase($string)));
		}

		/**
		 * @param string $haystack
		 * @param string $needle
		 *
		 * @return bool
		 */
		public static function endsWith(string $haystack, string $needle): bool
		{
			return $needle === ''
				|| (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
		}

		/**
		 * @param string $haystack
		 * @param string $needle
		 *
		 * @return bool
		 */
		public static function startsWith(string $haystack, string $needle): bool
		{
			return $needle === ''
				|| strrpos($haystack, $needle, -strlen($haystack)) !== false;
		}

		/**
		 * @param string $haystack
		 * @param string $separator
		 *
		 * @return null|string
		 */
		public static function extractPrefix(string $haystack, string $separator = '-')
		{
			$explodedGroup = explode($separator, $haystack);

			return array_values($explodedGroup)[0];
		}

		/**
		 * @param string $haystack
		 * @param string $separator
		 *
		 * @return string
		 */
		public static function extractSuffix(string $haystack, string $separator = '-'): string
		{
			if (!static::contains($haystack, $separator)) {
				return '';
			}

			$explodedRight = explode($separator, $haystack);

			return array_pop($explodedRight);
		}

		/**
		 * @param string $haystack
		 * @param string $separator
		 *
		 * @return string
		 */
		public static function removePrefix(string $haystack, string $separator = '-')
		{
			if (!static::contains($haystack, $separator)) {
				return $haystack;
			}

			$explodedRight = explode($separator, $haystack);
			array_shift($explodedRight);

			return implode($separator, $explodedRight);
		}

		/**
		 * @param string $haystack
		 * @param string $separator
		 *
		 * @return string
		 */
		public static function removeSuffix(string $haystack, string $separator = '-')
		{
			if (!static::contains($haystack, $separator)) {
				return $haystack;
			}

			$explodedRight = explode($separator, $haystack);
			array_pop($explodedRight);

			return implode($separator, $explodedRight);
		}

		/**
		 * @param string $haystack
		 * @param string $needle
		 *
		 * @return bool
		 */
		public static function contains(string $haystack, string $needle): bool
		{
			return strpos($haystack, $needle) !== false;
		}

		public static function getStringBetween(string $haystack, string $start, string $end): string
		{
			$haystack = ' ' . $haystack;
			$ini = strpos($haystack, $start);
			if ($ini == 0) {
				return '';
			}
			$ini += strlen($start);
			$len = strpos($haystack, $end, $ini) - $ini;

			return substr($haystack, $ini, $len);
		}
	}
}
