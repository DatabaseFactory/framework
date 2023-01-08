<?php

namespace DatabaseFactory\Modules\MySQL {
	
	use DatabaseFactory\Modules;
	use DatabaseFactory\Contracts;
	
	/**
     * SQL LIKE
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class NotLike extends Modules\MySQL\Builder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::WHERE . $params[0] . static::like($params[1], true);
        }
    }
}
