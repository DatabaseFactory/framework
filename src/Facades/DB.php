<?php

namespace DatabaseFactory\Facades {

    use DatabaseFactory\Config;
    use DatabaseFactory\Connect;
    use DatabaseFactory\Helpers;
    use DatabaseFactory\Builder;
    use DatabaseFactory\Contracts;
    use DatabaseFactory\Exceptions;

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
        public static function table(string $table, string $config = \DatabaseFactory\Config::class): Builder
        {
            // does the config class implement the BaseConfigInterface?
            if (!Helpers\Cls::implements($config, Contracts\BaseConfigInterface::class)) {
                // if not, throw a new QueryBuilderException
                throw new Exceptions\QueryBuilderException(
                    'The config file must implement ' . Contracts\BaseConfigInterface::class
                );
            }

            // next, does it extend the BaseConfig class?
            if (
                !Helpers\Cls::equals($config, \DatabaseFactory\Config::class) &&
                !Helpers\Cls::extends($config, \DatabaseFactory\Config::class)
            ) {
                // if not, throw a new QueryBuilderException
                throw new Exceptions\QueryBuilderException(
                    'The config file must extend ' . \DatabaseFactory\Config::class
                );
            }

            // if validation passes, return a new query builder instance
            return (new Builder($table, $config));
        }
    }
}
