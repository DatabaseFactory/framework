<?php

namespace DatabaseFactory\ORM {

    use DatabaseFactory\Config;
    use DatabaseFactory\Contracts\BaseConfigInterface;
    use DatabaseFactory\Facades;
    use DatabaseFactory\Builder;

    trait HasQuery
    {
        public static function query(BaseConfigInterface $config = null): Builder
        {
            return Facades\DB::table(static::table(), $config);
        }
    }
}
