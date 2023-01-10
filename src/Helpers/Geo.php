<?php

namespace DatabaseFactory\Helpers {

    /**
     * Helper for interacting with geolocation
     *
     * @package DatabaseFactory\Helpers
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class Geo
    {
        /**
         * Return the host IP
         *
         * @return string
         */
        public function get_ip(): string
        {
            $hostname = gethostname();
            return gethostbyname($hostname);
        }
    }
}
