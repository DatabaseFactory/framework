<?php

namespace DatabaseFactory\Contracts {

    /**
     * Contract for the custom config classes
     *
     * @package DatabaseFactory\Contracts
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    interface BaseConfigInterface
    {
        /**
         * Return the $modules array
         *
         * @return array|string[]
         */
        public function modules(): array;
    
        /**
         * Return the $env array
         *
         * @return array|string[]
         */
        public function env(): array;
    }
}
