<?php

namespace DatabaseFactory\ORM {
	
	use DatabaseFactory\Builder;
	use DatabaseFactory\Facades\DB;


    /**
     * Allows an entity the ability to return the first
     * record
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasFirst
    {
        public static function first(string $columns = '*'): Builder
        {
            return DB::table(static::table())->select($columns)->orderBy('id', 'ASC')->limit(1);
        }
    }
}
