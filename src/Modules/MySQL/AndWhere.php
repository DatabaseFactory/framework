<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Modules;
    use DatabaseFactory\Contracts;

    /**
     * SQL AND
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class AndWhere extends Modules\MySQL\Builder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::AND . $params[0] . static::SPC . $params[1] . static::SPC . static::SGLQT . $params[2] . static::SGLQT;
        }
    }
}
