<?php

namespace DatabaseFactory\ORM {
	
	use DatabaseFactory\Builder;
	use DatabaseFactory\Facades;
	use DatabaseFactory\Facades\DB;
	
	/**
     * Allows an entity the ability to return all records
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasLike
    {
        public static function like(string $field, string $pattern, string $columns = '*'): Builder
        {
	        return DB::table(static::table())->select($columns)->like($field, $pattern);
        }
    }
}
