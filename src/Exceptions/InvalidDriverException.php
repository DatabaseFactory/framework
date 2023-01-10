<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a database driver is invalid
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class InvalidDriverException extends DatabaseException
    {
        public $message = 'An invalid database driver was provided';
    }
}
