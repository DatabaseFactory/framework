<?php

namespace DatabaseFactory\Config {
    
    use DatabaseFactory\Modules;
    use DatabaseFactory\Contracts;
    
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
    class BaseConfig implements Contracts\BaseConfigInterface
    {
        /**
         * ENV config overrides
         *
         * @var array|string[] $env
         */
        protected static array $env = [
            'username' => null,
            'hostname' => null,
            'password' => null,
            'database' => null,
            'driver'   => null,
        ];
    
        /**
         * Query builder modules
         *
         * @var string[] $modules
         */
        protected static array $modules = [
            'whereNot' => Modules\WhereNot::class,
            'groupBy'  => Modules\GroupBy::class,
            'orderBy'  => Modules\OrderBy::class,
            'notLike'  => Modules\NotLike::class,
            'andLike'  => Modules\AndLike::class,
            'offset'   => Modules\Offset::class,
            'select'   => Modules\Select::class,
            'orLike'   => Modules\OrLike::class,
            'count'    => Modules\Count::class,
            'where'    => Modules\Where::class,
            'limit'    => Modules\Limit::class,
            'join'     => Modules\Join::class,
            'like'     => Modules\Like::class,
            'and'      => Modules\AndWhere::class,
            'or'       => Modules\OrWhere::class,
        ];
        
        /**
         * @inheritdoc
         */
        public function modules(): array
        {
            return [...self::$modules, ...static::$modules];
        }
        
        /**
         * @inheritdoc
         */
        public function env(): array
        {
            return [...self::$env, ...static::$env];
        }
    }
}
