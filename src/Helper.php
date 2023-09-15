<?php

use DatabaseFactory\Contracts;
use DatabaseFactory\Facades;
use DatabaseFactory\Builder;
use DatabaseFactory\Factory;

// If the function doesn't exist, let's create it!
if (!function_exists('db_factory')) {
    /**
     * Returns a database factory instance
     *
     * @param string                             $table
     * @param Contracts\BaseConfigInterface|null $config
     *
     * @return Builder
     */
    function db_factory(string $table, Contracts\BaseConfigInterface $config = null): Builder
    {
        return Facades\DB::table($table, $config);
    }
}

// If the function doesn't exist, let's create it!
if (!function_exists('dump')) {
    /**
     * Data dump
     *
     * @param $data
     *
     * @return void
     */
    function dump(...$data): void
    {
        Facades\Debug::dump($data);
    }
}

// If the function doesn't exist, let's create it!
if (! function_exists('fake')) {
    /**
     * Returns a factory generator instance
     *
     * @return Factory\Generator
     */
    function fake(): Factory\Generator
    {
        // use the factory to create a Faker\Generator instance
        return new Factory\Generator();
    }
}
