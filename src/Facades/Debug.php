<?php

namespace DatabaseFactory\Facades {

    use DatabaseFactory\Libraries;

    /**
     * Helper for debugging code
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Debug
    {
        /**
         * Returns a new instance of the dump library
         *
         * @param ...$data
         *
         * @return Libraries\Dump
         */
        public static function dump(...$data): Libraries\Dump
        {
            return new Libraries\Dump($data);
        }
    }
}
