<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Builder;
    use DatabaseFactory\Facades;

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
    trait HasNot
    {
        public static function whereNot($key = null, $value = null, string $columns = '*')
        {
            return Facades\DB::table(static::table())->select($columns)->whereNot($key, $value)->get();
        }
    }
}
