<?php

namespace DatabaseFactory\Exceptions {

    /**
     * Thrown when a query execution error occurs
     *
     * @package DatabaseFactory\Exceptions
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class QueryExecutionException extends DatabaseException
    {
        public $message = 'There was an problem while executing your query';
    }
}
