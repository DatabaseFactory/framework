<?php

namespace DatabaseFactory\Config {

    use DatabaseFactory\Modules\MySQL;
    use DatabaseFactory\Contracts\BaseConfigInterface;

    /**
     * The base configuration file for the library
     *
     * @package DatabaseFactory\Config
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class BaseConfig implements BaseConfigInterface
    {
        /** @var array|string[] $env env config */
        protected static array $env = [
            'username' => null,
            'hostname' => null,
            'password' => null,
            'database' => null,
            'driver'   => null,
        ];

        /** @var string[] $modules Query builder modules */
        protected static array $modules = [
            'groupBy' => MySQL\GroupBy::class,
            'orderBy' => MySQL\OrderBy::class,
            'notLike' => MySQL\NotLike::class,
            'andLike' => MySQL\AndLike::class,
            'offset'  => MySQL\Offset::class,
            'select'  => MySQL\Select::class,
            'orLike'  => MySQL\OrLike::class,
            'count'   => MySQL\Count::class,
            'where'   => MySQL\Where::class,
            'limit'   => MySQL\Limit::class,
            'join'    => MySQL\Join::class,
            'like'    => MySQL\Like::class,
            'and'     => MySQL\AndWhere::class,
            'or'      => MySQL\OrWhere::class,
        ];

        /**
         * Return the $modules array
         *
         * @return array|string[]
         */
        public function modules(): array
        {
            return [...self::$modules, ...static::$modules];
        }
    }
}
