<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when database credentials are incorrect
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class InvalidCredentialsException extends DatabaseException
    {
        public $message = 'The credentials you provided are invalid';
    }
}
