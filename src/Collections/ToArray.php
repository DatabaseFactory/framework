<?php

namespace DatabaseFactory\Collections {

    /**
     * Takes a collection of data and provides the ability to access 
     * objects as arrays
     *
     * @package DatabaseFactory\Collections
     * @author  Jason Napolitano
     *
     * @version 1.0.0
     * @since   1.0.0
     * @license MIT <https://mit-license.org>
     */
    class ToArray implements \ArrayAccess
    {
        /**
         * Constructor
         */
        public function __construct(private array $collection)
        {
            // ...
        }

        /**
         * Returns the raw collection of data
         */
        public function collection(): array
        {
            return $this->collection;
        }

        /**
         * Assigns a value to the specified offset
         *
         * @link https://www.php.net/manual/en/arrayaccess.offsetset.php
         */
        public function offsetSet($offset, $value): void
        {
            !is_null($offset)
                ? $this->collection[$offset] = $value
                : $this->collection[] = $value;
        }

        /**
         * Checks to see if an offset exists
         *
         * @link https://www.php.net/manual/en/arrayaccess.offsetexists.php
         */
        public function offsetExists($offset): bool
        {
            return isset($this->collection[$offset]);
        }

        /**
         * Unset an offset
         *
         * @link https://www.php.net/manual/en/arrayaccess.offsetunset.php
         */
        public function offsetUnset($offset): void
        {
            unset($this->collection[$offset]);
        }

        /**
         * Retrieves an offset
         *
         * @link https://www.php.net/manual/en/arrayaccess.offsetget.php
         */
        public function offsetGet($offset): ?int
        {
            return $this->collection[$offset] ?? null;
        }
    }
}
