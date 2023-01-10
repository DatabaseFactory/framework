<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a query string is invalid
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class InvalidQueryException extends DatabaseException
    {
        public $message = 'The query is invalid';
    }
}
