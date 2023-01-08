<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Helpers;

    /**
     * Allows an entity access to its database
     * table
     *
     * @package DatabaseFactory\ORM
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    trait HasTable
    {
        /** @var string $table Database table */
        protected static string $table;

        /**
         * Returns a converted database table
         * name
         *
         * @return string
         */
        public static function table(): string
        {
            return static::$table ?? Helpers\Str::lower(
                Helpers\Str::plural(
                    Helpers\Cls::stripNamespace(static::class)
                )
            );
        }
    }
}
