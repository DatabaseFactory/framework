<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a query builder error occurs
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class QueryBuilderException extends DatabaseException
    {
        public $message = 'The query builder encountered an error';
    }
}
