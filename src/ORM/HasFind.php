<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Builder;
    use DatabaseFactory\Facades;

    /**
     * Allows an entity the ability to return one record
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasFind
    {
        public static function find(int|string $value, string $by = 'id', string $columns = '*')
        {
            return Facades\DB::table(static::table())->select($columns)->where($by, '=', $value)->get();
        }
    }
}
