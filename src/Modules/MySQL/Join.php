<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Modules\BaseBuilder;

    /**
     * SQL JOIN
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Join extends BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return
                static::select($params[2] ?? '*') .
                static::from($table) .
                static::join($params[0], $params[1], $params[3] ?? self::EMPTY);
        }
    }
}
