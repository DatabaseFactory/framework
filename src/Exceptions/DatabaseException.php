<?php

namespace DatabaseFactory\Exceptions {

    use PDOException;

    /**
     * Thrown when a database error occurs
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class DatabaseException extends PDOException
    {
        public $message = 'There was a database error';
    }
}
