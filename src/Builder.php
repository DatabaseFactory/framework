<?php

namespace DatabaseFactory {
	
	use DatabaseFactory\Helpers;
	use DatabaseFactory\Modules;
	use DatabaseFactory\Facades;
	use DatabaseFactory\Exceptions;
	
	/**
	 * The main Query DB class. This class is responsible for
	 * building queries and handling the libraries that are used to
	 * execute the queries.
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
		 * Database table
		 *
		 * @var string $table
		 */
		private readonly string $table;
		
		/**
		 * Config class
		 *
		 * @var string $config
		 */
		private readonly string $config;
		
		/**
		 * Module collection
		 *
		 * @var array $modules
		 *
		 * @see \DatabaseFactory\Config\BaseConfig::$modules
		 */
		private array $modules = [
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
		 * @param string  $table  Database table
		 * @param ?string $config Config class
		 */
		public function __construct(string $table, string $config = null)
		{
			// config class
			$this->config = $config;
			
			// database table
			$this->table = $table;
			
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
			// the $modules collection
			if (!Helpers\Arr::hasKey($module, $this->modules)) {
				// if not, let's throw an error
				throw new Exceptions\InvalidModuleException(
					$module . ' must exist within the $modules collection'
				);
			}
			
			// if it does, let's set it as the current module
			$currentModule = $this->modules[$module] = (new $this->config())->modules()[$module];
			
			// let's see if that module extends the base builder
			if (!Helpers\Cls::extends($currentModule, Modules\BaseBuilder::class)) {
				throw new Exceptions\InvalidModuleException(
					$module . ' module must extend ' . Modules\BaseBuilder::class
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
			unset($this->connection);
		}
		
		/**
		 * Return the results as an array
		 *
		 * @return array|null
		 */
		public function get(): ?array
		{
			return $this->execute()->fetchAll(\PDO::FETCH_ASSOC);
		}
		
		/**
		 * Wrapper for $this->get()
		 *
		 * @return array
		 * @see \DatabaseFactory\Builder::get()
		 *
		 */
		public function toArray(): array
		{
			return (array)$this->get();
		}
		
		/**
		 * Return the results as a JSON string
		 *
		 * @return string|false
		 *
		 * @throws \JsonException
		 */
		public function toJSON(): bool|string
		{
			return json_encode($this->toArray(), JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
		}
		
		/**
		 * Returns the trimmed string value of
		 * $query
		 *
		 * @return string
		 */
		public function toSQL(): string
		{
			return trim($this->query);
		}
		
		/**
		 * __toString() implementation
		 *
		 * @return string
		 */
		public function __toString(): string
		{
			return $this->toSQL();
		}
		
		/**
		 * Destructor
		 */
		public function __destruct()
		{
			$this->close();
		}
	}
}
