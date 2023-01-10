<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a query string is empty
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class EmptyQueryException extends DatabaseException
    {
        public $message = 'Query must not be an empty string.';
    }
}
