<?php

namespace DatabaseFactory\ORM\Relations {

    class HasMany
    {
        public static function get(string $model): object
        {
            return new $model();
        }
    }
}
