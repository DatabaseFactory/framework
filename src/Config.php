<?php

namespace DatabaseFactory {

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
    class Config implements Contracts\BaseConfigInterface
    {
        /**
         * Query builder modules
         *
         * @var string[] $modules
         */
        protected static array $modules = [
            'whereNot' => \DatabaseFactory\Modules\MySQL\WhereNot::class,
            'groupBy'  => \DatabaseFactory\Modules\MySQL\GroupBy::class,
            'orderBy'  => \DatabaseFactory\Modules\MySQL\OrderBy::class,
            'notLike'  => \DatabaseFactory\Modules\MySQL\NotLike::class,
            'andLike'  => \DatabaseFactory\Modules\MySQL\AndLike::class,
            'offset'   => \DatabaseFactory\Modules\MySQL\Offset::class,
            'select'   => \DatabaseFactory\Modules\MySQL\Select::class,
            'orLike'   => \DatabaseFactory\Modules\MySQL\OrLike::class,
            'count'    => \DatabaseFactory\Modules\MySQL\Count::class,
            'where'    => \DatabaseFactory\Modules\MySQL\Where::class,
            'limit'    => \DatabaseFactory\Modules\MySQL\Limit::class,
            'join'     => \DatabaseFactory\Modules\MySQL\Join::class,
            'like'     => \DatabaseFactory\Modules\MySQL\Like::class,
            'and'      => \DatabaseFactory\Modules\MySQL\AndWhere::class,
            'or'       => \DatabaseFactory\Modules\MySQL\OrWhere::class,
        ];

        /**
         * @inheritdoc
         */
        public function modules(): array
        {
            return [...self::$modules, ...static::$modules];
        }
    }
}
