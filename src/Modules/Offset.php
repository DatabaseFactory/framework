<?php

namespace DatabaseFactory\Modules {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Config;

    /**
     * SQL OFFSET
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Offset extends Config\BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::offset($params[0]);
        }
    }
}
