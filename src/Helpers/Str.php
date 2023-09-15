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
         * Return a pluralized string
         *
         * @param $string
         *
         * @return string
         */
        public static function plural($string): string
        {
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
         * Wrapper for trim(...)
         *
         * @param string $string
         *
         * @return string
         */
        public static function trim(string $string): string
        {
            return trim($string);
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
         * @param bool   $trim
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
         * Converts string to a slug format
         *
         * @param string $value
         *
         * @return string
         */
        public static function slug(string $value): string
        {
            return strtolower(self::replace($value, '-'));
        }

        /**
         * Converts a string to snake case format
         *
         * @param string $string
         *
         * @return string
         */
        public static function snakeCase(string $string): string
        {
            return self::replace($string, '_');
        }

        /**
         * Create a dot notation string
         *
         * @param string $string
         *
         * @return string
         */
        public static function dot(string $string)
        {
            return self::replace($string, '.');
        }

        /**
         * Replaces characters n a string
         *
         * @param string $string
         * @param string $value
         *
         * @return string
         */
        public static function replace(string $string, string $value): string
        {
            $string = strtolower(preg_replace('/([A-Z])/', $value . '$1', lcfirst(self::upperCamelCase(trim($string)))));
            $string = preg_replace('/[^A-Za-z0-9_]+/', $value, $string);
            $string = preg_replace('/_+/', $value, $string);

            if (str_ends_with($string, $value)) {
                $string = mb_substr($string, 0, -1);
            }
            return $string;
        }

        /**
         * Hashes a string using bcrypt
         *
         * @param string $string
         *
         * @return string
         */
        public static function bcrypt(string $string): string
        {
            return password_hash($string, PASSWORD_BCRYPT);
        }

        /**
         * Hashes a string using argon2i
         *
         * @param string $string
         *
         * @return string
         */
        public static function argon2i(string $string): string
        {
            return password_hash($string, PASSWORD_ARGON2I);
        }

        /**
         * Generate a UUID
         *
         * @return string
         */
        public static function uuid()
        {

            mt_srand((double)microtime() * 10000);
            $char = strtoupper(md5(uniqid(mt_rand(), true)));
            $hyphen = chr(45);
            return substr($char, 0, 8) . $hyphen
                . substr($char, 8, 4) . $hyphen
                . substr($char, 12, 4) . $hyphen
                . substr($char, 16, 4) . $hyphen
                . substr($char, 20, 12);
        }

        /**
         * Converts string to upper camel case format
         *
         * @param string $string
         *
         * @return string
         *
         * @see https://en.wikipedia.org/wiki/CamelCase
         */
        private static function upperCamelCase(string $string): string
        {
            return str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));
        }
    }
}
