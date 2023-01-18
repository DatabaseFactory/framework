<?php

namespace DatabaseFactory\Modules {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Config;

    /**
     * SQL GROUP BY
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class GroupBy extends Config\BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritdoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::GROUP_BY . static::columns($params);
        }
    }
}
