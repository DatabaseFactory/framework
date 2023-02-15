<?php

namespace DatabaseFactory\Collections {

    /**
     * Takes a collection of data and provides the ability to access 
     * it as JSON
     *
     * @package DatabaseFactory\Collections
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    readonly class ToJSON implements \JsonSerializable
    {
        /**
         * Constructor
         */
        public function __construct(private array $collection = [])
        {
            // ...
        }

        /**
         * Specify data which should be serialized to JSON
         *
         * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
         */
        public function jsonSerialize(): array
        {
            return $this->collection;
        }
    }
}
