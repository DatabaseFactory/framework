<?php

namespace DatabaseFactory\Helpers {

    /**
     * Helper for interacting with dates
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Date
    {
        /**
         * Wrapper for Carbon::now()
         *
         * @return string
         */
        public static function now(): string
        {
            return date('Y-m-d H:i:s');
        }
    }
}
