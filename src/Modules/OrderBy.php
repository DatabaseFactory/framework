<?php

namespace DatabaseFactory\Modules {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Config;

    /**
     * SQL ORDER BY
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class OrderBy extends Config\BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::ORDER_BY . $params[0] . static::SPC . $params[1] ?? static::ASC;
        }
    }
}
