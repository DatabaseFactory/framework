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
        public function modules(): array;
    }
}
