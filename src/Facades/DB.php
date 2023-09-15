<?php

namespace DatabaseFactory\Facades {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Connect;
    use DatabaseFactory\Builder;
    use DatabaseFactory\Config;

    /**
     * The main entry point for Database Factory. This class
     * gives access to the query builder and the current PDO
     * connection
     *
     *
     * @package DatabaseFactory\Facades
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class DB
    {
        /**
         * Establish a connection
         *
         * @return void
         */
        public static function connect(): void
        {
            Connect::start();
        }

        /**
         * Returns the current PDO connection
         *
         * @return \PDO
         */
        public static function connection(): \PDO
        {
            return Connect::connection();
        }

        /**
         * Allows for the execution of raw SQL
         *
         * @param string $sql
         *
         * @return array|false
         */
        public static function query(string $sql): array|false
        {
            return Connect::connection()->query(trim($sql))->fetchAll(\PDO::FETCH_ASSOC);
        }

        /**
         * Returns a query builder instance
         *
         * @param string $table  Database table
         * @param string $config Config class
         *
         * @return \DatabaseFactory\Builder
         */
        public static function table(string $table, Contracts\BaseConfigInterface $config = null): Builder
        {
            // if validation passes, return a new query builder instance
            return (new Builder($table, $config ?? new Config()));
        }
    }
}
