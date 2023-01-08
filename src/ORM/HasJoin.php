<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Facades\DB;
	
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
        public static function join(string $table, string $columns, array $on)
        {
            return DB::table(static::table())->join($table, $columns, $on);
        }
    }
}
