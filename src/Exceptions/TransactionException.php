<?php

namespace DatabaseFactory\Exceptions {

    class TransactionException extends DatabaseException
    {
        public $message = 'A transaction error has occurred.';
    }
}
