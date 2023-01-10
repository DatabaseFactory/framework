<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a database table name is empty
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class EmptyTableException extends DatabaseException
    {
        public $message = 'Table name must not be an empty string';
    }
}
