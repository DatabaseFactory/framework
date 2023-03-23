<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Builder;
    use DatabaseFactory\Facades;

    /**
     * Allows an entity the ability to join tables
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasJoin
    {
        public static function join(string $table, array $on, string $columns = '*'): Builder
        {
            return Facades\DB::table(static::table())->join($table, $on, $columns);
        }
    }
}
