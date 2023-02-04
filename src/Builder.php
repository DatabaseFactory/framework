<?php

namespace DatabaseFactory {

    use DatabaseFactory\Helpers;
    use DatabaseFactory\Facades;
    use DatabaseFactory\Exceptions;
    use DatabaseFactory\Collections;

    /**
     * The main Query Builder class. Objects initialized from this
     * class are responsible for building queries and handling the
     * libraries that are used to execute those queries
     *
     * @package DatabaseFactory
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Builder
    {
        /**
         * Raw SQL Query
         *
         * @var string|null $query
         */
        private ?string $query = '';

        /**
         * PDO Connection
         *
         * @var \PDO $connection
         */
        private \PDO $connection;

        /**
         * Module collection
         *
         * @var array $modules
         *
         * @see \DatabaseFactory\Config\BaseConfig::$modules
         */
        private array $modules = [
            'whereNot' => null,
            'groupBy'  => null,
            'orderBy'  => null,
            'andLike'  => null,
            'notLike'  => null,
            'update'   => null,
            'delete'   => null,
            'insert'   => null,
            'offset'   => null,
            'select'   => null,
            'orLike'   => null,
            'count'    => null,
            'where'    => null,
            'limit'    => null,
            'join'     => null,
            'like'     => null,
            'and'      => null,
            'or'       => null,
        ];

        /**
         * Constructor
         *
         * @param string $table  Database table
         * @param string $config Config class
         */
        public function __construct(private readonly string $table, private readonly string $config)
        {
            // connection string
            $this->connection = Facades\DB::connection();
        }

        /**
         * Check to see if the module used for a query exists within the
         * $modules array, extends the correct class, and implements the
         * correct interface.
         *
         * Once verified we call the query module from within our config
         * clas,s and execute the query that corresponds to that library
         *
         * @param string|null $module    The module within $modules
         * @param mixed       $arguments The arguments to pass to the query
         *
         * @return $this
         *
         * @throws \ReflectionException
         */
        public function __call(string $module = null, mixed $arguments = null): Builder
        {
            // let's ensure that the $name passed through lives within
            // the $modules array
            if (!Helpers\Arr::hasKey($module, $this->modules)) {
                // if not, let's throw an error
                throw new Exceptions\InvalidModuleException(
                    $module . ' must exist within the $modules array'
                );
            }

            // if it does, let's set it as the current module
            $currentModule = $this->modules[$module] = (new $this->config())->modules()[$module];

            // let's see if that module extends the base builder
            if (!Helpers\Cls::extends($currentModule, Config\BaseBuilder::class)) {
                throw new Exceptions\InvalidModuleException(
                    $module . ' module must extend ' . Config\BaseBuilder::class
                );
            }

            // let's see if it also conforms to the correct contract
            if (!Helpers\Cls::implements($currentModule, Contracts\SQLStatementInterface::class)) {
                throw new Exceptions\InvalidModuleException(
                    $module . ' must implement ' . Contracts\SQLStatementInterface::class
                );
            }

            // generate the query returned and assign it to $query
            // for execution
            $this->query .= (new $currentModule())->statement($this->table, ...$arguments);

            // allow for method chaining of queries
            return $this;
        }

        /**
         * Execute a query and return a PDOStatement
         *
         * @param ?array $params An array of params to bind to the
         *                       query [optional]
         *
         * @return \PDOStatement
         */
        public function execute(array $params = null): \PDOStatement
        {
            // binding parameters to a prepared statement
            if ($params) {
                // prepare the statement
                $statement = $this->prepare($this->toSQL());

                // execute the prepared statement
                $statement->execute($params);

                /// unset the query and the prepared statement
                unset($statement, $this->query);
            }

            // without binding parameters to a prepared statement
            return $this->query($this->toSQL());
        }

        /**
         * Generates a prepared PDO statement
         * using a trimmed query string
         *
         * @param string $query
         *
         * @return \PDOStatement|false
         */
        private function prepare(string $query): \PDOStatement|false
        {
            return $this->connection->prepare(trim($query));
        }

        /**
         * Generates a PDO query
         *
         * @param string $query
         *
         * @return \PDOStatement|false
         */
        private function query(string $query): \PDOStatement|false
        {
            return $this->connection->query(trim($query));
        }

        /**
         * Close the PDO connection
         */
        public function close(): void
        {
            unset($this->query, $this->connection);
        }

        /**
         * Return the results as an array
         *
         * @return array|null
         */
        private function get(): ?array
        {
            return $this->execute()->fetchAll(\PDO::FETCH_ASSOC);
        }

        /**
         * Wrapper for $this->get()
         *
         * @return array
         *
         * @see \DatabaseFactory\Builder::get()
         *
         */
        public function toArray(): array
        {
            return (new Collections\ToArray($this->get()))->collection();
        }

        /**
         * Return the results as a JSON string
         *
         * @return string|false
         *
         * @see \DatabaseFactory\Builder::get()
         */
        public function toJSON(): string|false
        {
            return json_encode(
                (new Collections\ToJSON($this->get())),
                JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT
            );
        }

        /**
         * Returns the trimmed string value of
         * $query
         *
         * @return string
         *
         * @see \DatabaseFactory\Builder::$query
         */
        public function toSQL(): string
        {
            return trim($this->query);
        }

        /**
         * __toString() implementation
         *
         * @return string
         *
         * @see \DatabaseFactory\Builder::toSQL()
         */
        public function __toString(): string
        {
            return $this->toSQL();
        }

        /**
         * Destructor
         *
         * @see \DatabaseFactory\Builder::close()
         */
        public function __destruct()
        {
            $this->close();
        }
    }
}
