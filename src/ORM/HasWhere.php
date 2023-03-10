<?php

namespace DatabaseFactory\ORM {
	
	use DatabaseFactory\Builder;
	use DatabaseFactory\Facades\DB;


    /**
     * Allows an entity the ability to return records
     * based on a WHERE clause
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasWhere
    {
        public static function where($key, $is = null, $value = null, string $columns = '*'): Builder
        {
            return DB::table(static::table())->select($columns)->where($key, $is, $value);
        }
    }
}
