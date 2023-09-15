<?php

namespace DatabaseFactory\ORM {
    use DatabaseFactory\Builder;
	use DatabaseFactory\Exceptions\TransactionException;
	use DatabaseFactory\Facades;

    trait HasTransact
    {

		public static Builder $builder;

        public static function transact(callable $callback)
        {
			self::$builder = Facades\DB::table(static::table());
	        Facades\DB::connection()->beginTransaction();
	        $callback(self::$builder);
	        Facades\DB::connection()->commit();

			return new self();
        }

	    public function then(callable $callback)
	    {
		    $callback(self::$builder);
			return $this;
		}

	    public function stop(callable $callback)
	    {
		    $callback(self::$builder);
		}

	    public function error(callable $callback)
	    {
		    $callback(new TransactionException());
		}
    }
}
