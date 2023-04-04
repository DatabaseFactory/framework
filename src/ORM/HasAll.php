<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Facades;
    use DatabaseFactory\Builder;

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
    trait HasAll
    {
        public static function all(string $columns = '*')
        {
            return Facades\DB::table(static::table())->select($columns)->get();
        }
    }
}
