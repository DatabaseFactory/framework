<?php

namespace DatabaseFactory {

    use PDO;
    use DatabaseFactory\Exceptions;
    use DatabaseFactory\Connections;

    /**
     * This is the main connection entry point. This class
     * is responsible for establishing a new PDO connection
     *
     * @package DatabaseFactory
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Connect
    {
        /** @var string $username Username */
        private static string $username;

        /** @var string $password Password */
        private static string $password;

        /** @var string $hostname Hostname */
        private static string $hostname;

        /** @var string $database Database */
        private static string $database;

        /** @var \PDO $connection PDO instance */
        private static PDO $connection;

        /** @var string $driver Database driver */
        private static string $driver;

        /**
         * PDO connection instance
         *
         * @return \PDO
         */
        public static function start(): PDO
        {
            // try to establish a connection
            try {
                // credentials
                self::$database = getenv('DB_DATABASE');
                self::$username = getenv('DB_USERNAME');
                self::$password = getenv('DB_PASSWORD');
                self::$hostname = getenv('DB_HOSTNAME');

                // credentials check
                if (!self::$username || !self::$password) {
                    throw new Exceptions\InvalidCredentialsException();
                }

                // set driver
                self::setDriver(getenv('DB_DRIVER'));

                // driver check
                if (!self::$driver) {
                    throw new Exceptions\InvalidDriverException();
                }

                // connection implementation
                switch (self::$driver) {
                    // MySQL / MariaDB / Default
                    case 'mysql':
                    case 'maria':
                    default:
                        self::newConnection(Connections\MySQL::connection(self::$database, self::$hostname));
                }
                // return the connection
                return self::$connection;
            } catch (Exceptions\DatabaseException $exception) {
                // catch and throw any errors
                throw new Exceptions\ConnectionException($exception->getMessage());
            }
        }

        /**
         * Setter for the database driver
         *
         * @param ?string $driver
         *
         * @return void
         */
        private static function setDriver(string $driver = null): void
        {
            self::$driver = strtolower($driver);
        }

        /**
         * Generate a new PDO connection
         *
         * @param string $string
         *
         * @return void
         */
        private static function newConnection(string $string): void
        {
            self::$connection = new PDO($string, self::$username, self::$password);
        }

        public static function connection(): PDO
        {
            return self::$connection;
        }
    }
}
