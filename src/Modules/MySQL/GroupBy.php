<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Modules\BaseBuilder;

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
    class GroupBy extends BaseBuilder implements Contracts\SQLStatementInterface
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
