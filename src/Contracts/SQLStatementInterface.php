<?php

namespace DatabaseFactory\Contracts {

    /**
     * Contract for custom Builder modules
     *
     * @package DatabaseFactory\Contracts
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    interface SQLStatementInterface
    {
        /**
         * SQL Statement string
         *
         * @param string $table
         * @param        ...$params
         *
         * @return string
         */
        public function statement(string $table, ...$params): string;
    }
}
