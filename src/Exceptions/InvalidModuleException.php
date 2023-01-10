<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a query module is invalid
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class InvalidModuleException extends DatabaseException
    {
        public $message = 'The module that was provided is invalid';
    }
}
