<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a database table error occurs
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class DatabaseTableException extends DatabaseException
    {
        public $message = 'An error was encountered with the database table';
    }
}
