<?php

namespace DatabaseFactory\Modules\MySQL {

    use DatabaseFactory\Contracts;
    use DatabaseFactory\Modules\BaseBuilder;

    /**
     * SQL OR
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class OrWhere extends BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::OR . $table . static::PRD . $params[0] . static::SPC . $params[1] . static::SPC . static::SGLQT . $params[2] . static::SGLQT;
        }
    }
}
