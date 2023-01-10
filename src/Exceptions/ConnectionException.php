<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a connection error occurs
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class ConnectionException extends DatabaseException
    {
        public $message = 'Could not connect to the database';
    }
}
