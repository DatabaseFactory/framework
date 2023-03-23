<?php

use DatabaseFactory\Config;
use DatabaseFactory\Facades;
use DatabaseFactory\Builder;

// If the function doesn't exist, let's create it!
if (! function_exists('db_factory')) {
    /**
     * Returns a database factory instance
     *
     * @param string $table
     * @param string $config
     *
     * @return \DatabaseFactory\Builder
     */
    function db_factory(string $table, string $config = DatabaseFactory\Config::class): Builder
    {
        return Facades\DB::table($table, $config);
    }
}

// If the function doesn't exist, let's create it!
if (! function_exists('dump')) {
    /**
     * Data dump
     *
     * @param $data
     *
     * @return void
     */
    function dump($data): void
    {
        Facades\Debug::dump($data);
    }
}
