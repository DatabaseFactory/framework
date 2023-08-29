<?php

use DatabaseFactory\Contracts;
use DatabaseFactory\Facades;
use DatabaseFactory\Builder;
use DatabaseFactory\Config;

// If the function doesn't exist, let's create it!
if (!function_exists('db_factory')) {
	/**
	 * Returns a database factory instance
	 *
	 * @param string                        $table
	 * @param Contracts\BaseConfigInterface $config
	 *
	 * @return Builder
	 */
	function db_factory(string $table, Contracts\BaseConfigInterface $config = null): Builder
	{
		return Facades\DB::table($table, $config ?? new Config());
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
	function dump($data): void
	{
		Facades\Debug::dump($data);
	}
}
