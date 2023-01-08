<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Modules;
    use DatabaseFactory\Contracts;

    /**
     * SQL COUNT
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Count extends Modules\MySQL\Builder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return self::select($params[0]) . self::count() . self::from($table);
        }
    }
}
