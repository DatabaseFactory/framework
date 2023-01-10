<?php

namespace DatabaseFactory\Contracts {

    /**
     * Contract for the custom connection classes
     *
     * @package DatabaseFactory\Contracts
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    interface ConnectionInterface
    {
        /**
         * Connection string
         *
         * @param string $database
         * @param string $hostname
         *
         * @return string
         */
        public static function connection(string $database, string $hostname): string;
    }
}
