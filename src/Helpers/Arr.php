<?php

namespace DatabaseFactory\Helpers {

    /**
     * Helper for interacting with arrays
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Arr
    {
        /**
         * Trim individual array keys
         *
         * @param array $array
         *
         * @return array
         */
        public static function trim(array $array): array
        {
            return array_map('trim', $array);
        }

        /**
         * Wrapper for array_key_exists()
         *
         * @param array  $array
         * @param string $key
         *
         * @return bool
         * @see  \array_key_exists()
         *
         */
        public static function hasKey(string $key, array $array): bool
        {
            return array_key_exists($key, $array);
        }

        /**
         * Pulls a random element from an array
         *
         * @param array $array
         *
         * @return string
         */
        public static function random(array $array): string
        {
            return $array[array_rand($array)];
        }
    }
}
