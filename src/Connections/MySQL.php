<?php

namespace DatabaseFactory\Connections {

    use DatabaseFactory\Contracts;

    /**
     * The MySQL connection class handles the connection to a
     * MySQL database
     *
     * @package DatabaseFactory\Connections
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     */
    class MySQL implements Contracts\ConnectionInterface
    {
        /** @var string $driver Database Driver */
        protected static string $driver = 'mysql';

        /**
         * Sets the connection string and returns it
         *
         * @param string $database Database name
         * @param string $hostname Database host
         *
         * @return string
         */
        public static function connection(string $database, string $hostname): string
        {
            return self::$driver . ":host=$hostname;dbname=$database";
        }
    }
}
