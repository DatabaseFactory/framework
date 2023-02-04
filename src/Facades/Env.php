<?php

namespace DatabaseFactory\Facades {

    use DatabaseFactory\Libraries;

    /**
     * Helper for interacting with environment variables
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Env
    {
        /**
         * Wrapper function to initialize the built-in env
         * library
         *
         * @param string $path
         * @param string $file
         *
         * @return void
         */
        public static function init(string $path, string $file = '.env'): void
        {
            (new Libraries\Dotenv($path, $file))->load();
        }

        /**
         * Returns an env value
         *
         * @param string $key
         *
         * @return string|array|bool
         */
        public static function get(string $key): string|array|bool
        {
            return getenv($key);
        }

        /**
         * Sets an environment variable
         *
         * @param string $key
         * @param mixed  $value
         *
         * @return bool
         */
        public static function set(string $key, string|array|bool $value): bool
        {
            $_ENV[$key] = $value;
            return array_key_exists($value, $_ENV);
        }

        /**
         * Dump the contents of the $_ENV array
         *
         * @return array
         */
        public static function dump(): array
        {
            return $_ENV;
        }
    }
}
