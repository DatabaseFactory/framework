<?php

namespace DatabaseFactory\ORM {
    use DatabaseFactory\Builder;
    use DatabaseFactory\Facades;

    trait HasTransact
    {
        public static function transact(callable $callback): Builder
        {
            self::begin(static function () use ($callback) {
                $callback(Facades\DB::table(static::table()));
                self::commit();
            });

            return Facades\DB::table(static::table());
        }

        public static function rollback(): bool
        {
            return Facades\DB::connection()->rollback();
        }

        private static function begin(callable $callback): void
        {
            Facades\DB::connection()->beginTransaction();
            $callback();
        }

        private static function commit(): bool
        {
            return Facades\DB::connection()->commit();
        }
    }
}
