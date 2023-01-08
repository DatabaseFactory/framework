<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Modules;
    use DatabaseFactory\Contracts;

    /**
     * SQL LIMIT
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Limit extends Modules\MySQL\Builder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::limit($params[0]);
        }
    }
}
