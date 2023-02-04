<?php

namespace DatabaseFactory\Modules {

    use DatabaseFactory\Config;
    use DatabaseFactory\Contracts;

    /**
     * SQL WHERE
     *
     * @package DatabaseFactory\Modules
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class WhereNot extends Config\BaseBuilder implements Contracts\SQLStatementInterface
    {
        /**
         * @inheritDoc
         */
        public function statement(string $table, ...$params): string
        {
            return static::WHERE . $params[0] . static::SPC . static::NOT . static::SPC . static::SGLQT . $params[1] . static::SGLQT;
        }
    }
}
