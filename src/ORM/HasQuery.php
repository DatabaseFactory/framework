<?php

namespace DatabaseFactory\ORM {
	
	use DatabaseFactory\Config;
	use DatabaseFactory\Facades;
	use DatabaseFactory\Builder;
	
	trait HasQuery
	{
		public static function query(string $config = Config::class): Builder
		{
			return Facades\DB::table(static::table(), $config);
		}
	}
}